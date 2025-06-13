<?php

namespace App\Http\Controllers;

use App\Models\JabatanStruktural;
use App\Models\Pegawai;
use App\Models\JenisPegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HierarkiPegawaiController extends Controller
{
    /**
     * Display the hierarchical view of employees
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Use caching to improve performance
        $cacheKey = 'employee_hierarchy_' . $request->input('level', 'all');
        $cacheDuration = 60; // Cache for 60 minutes

        // Check if we should bypass cache
        $refreshCache = $request->has('refresh');

        if (!$refreshCache && Cache::has($cacheKey)) {
            $hierarchy = Cache::get($cacheKey);
        } else {
            // Get the top-level position (root)
            $rootJabatan = JabatanStruktural::with(['children'])->whereNull('parent_id')->first();

            if (!$rootJabatan) {
                return view('pages.hierarki-pegawai', [
                    'hierarchy' => null,
                    'jenisPegawai' => JenisPegawai::all()
                ]);
            }

            // Build the hierarchy
            $maxLevel = null;
            $hierarchy = $this->buildHierarchy($rootJabatan, 0, $maxLevel);

            // Store in cache
            Cache::put($cacheKey, $hierarchy, $cacheDuration);
        }
        function getHierarchyDepth($node) {
            // If the node has no children, its depth is 1
            if (empty($node['children'])) {
                return 1;
            }

            $maxChildDepth = 0;
            // Find the maximum depth among all children
            foreach ($node['children'] as $child) {
                $childDepth = getHierarchyDepth($child);
                if ($childDepth > $maxChildDepth) {
                    $maxChildDepth = $childDepth;
                }
            }

            // The depth of the current node is 1 + the depth of its deepest child
            return $maxChildDepth + 1;
        }
        $maxDepth = getHierarchyDepth($hierarchy);
        return view('pages.hierarki-pegawai', [
            'hierarchy' => $hierarchy,
            'jenisPegawai' => JenisPegawai::all(),
            'maxDepth' => $maxDepth
        ]);
    }

    /**
     * Recursively build the hierarchy structure
     *
     * @param JabatanStruktural $jabatan
     * @param int $currentLevel
     * @param int|null $maxLevel
     * @return array
     */
    private function buildHierarchy(JabatanStruktural $jabatan, $currentLevel = 0, $maxLevel = null)
    {
        // Get the employee in this position with eager loading
        $pegawai = Pegawai::with(['jenis_pegawai', 'golongan'])
            ->where('jabatan_struktural_id', $jabatan->id)
            ->first();

        $node = [
            'jabatan' => $jabatan,
            'pegawai' => $pegawai,
            'level' => $currentLevel,
            'children' => []
        ];

        // If we've reached max level, don't process children
        if ($maxLevel !== null && $currentLevel >= $maxLevel) {
            return $node;
        }

        // Get all children positions with eager loading
        $children = $jabatan->children()->with(['pegawai', 'children'])->get();

        foreach ($children as $child) {
            $node['children'][] = $this->buildHierarchy($child, $currentLevel + 1, $maxLevel);
        }

        return $node;
    }

    /**
     * Download the organizational chart as PDF
     * 
     * @return \Illuminate\Http\Response
     */
    public function downloadPdf()
    {
        // Implementation for PDF download if needed
        // You would need a PDF library like dompdf, barryvdh/laravel-dompdf, etc.

        // Example:
        // $pdf = PDF::loadView('hierarki-pegawai-pdf', ['hierarchy' => $hierarchy]);
        // return $pdf->download('hierarki-pegawai.pdf');
    }
}
