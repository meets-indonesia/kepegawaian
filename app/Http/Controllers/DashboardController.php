<?php

namespace App\Http\Controllers;

use App\Models\JenisPegawai;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $labels = JenisPegawai::select('name')->get()->toArray();
        foreach ($labels as $key => $label) {
            $labels[$key] = $label['name'];
        }
        $id = array();

        foreach ($labels as $label) {
            $id[] = JenisPegawai::select('id')->where('name', 'like', $label)->first()->toArray()['id'];
        }
        $countArr = array();
        foreach ($id as $key) {
            $countArr[] = Pegawai::all()->where('jenis_pegawai_id', 'like', $key)->count();
        }

        $label = "["."'".implode("', '",$labels)."'"."]";
        $count = "[".implode(", ",$countArr)."]";
        
        return view('pages.dashboard', [
            'pagename' => "dashboard",
            'label' => $label,
            'count' => $count,
        ]);
    }
}
