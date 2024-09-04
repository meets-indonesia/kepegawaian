<?php

namespace App\Http\Controllers;

use App\Imports\PegawaiImport;
use App\Models\Pegawai;
use App\Models\Golongan;
use App\Models\KelompokPegawai;
use App\Models\JenisPegawai;
use App\Models\UnitKerja;
use App\Models\Jurusan;
use App\Models\Prodi;
use App\Models\Grade;
use App\Models\Pendidikan;
use App\Models\JabatanFungsional;
use App\Models\JabatanStruktural;
use App\Models\PendingAction;
use App\Models\Posisi;
use App\Models\PosisiPegawai;
use App\Models\RiwayatGolongan;
use App\Models\RiwayatJabatanFungsional;
use App\Models\RiwayatJabatanStruktural;
use App\Models\RiwayatJenisPegawai;
use App\Models\RiwayatKelompokPegawai;
use App\Models\RiwayatPendidikan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\RiwayatGrade;
use App\Models\RiwayatMutasi;
use App\Models\RiwayatUnitKerja;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve all necessary data for the form
        $data = Pegawai::with([
            'golongan',
            'kelompok_pegawai',
            'jenis_pegawai',
            'unit_kerja',
            'jurusan',
            'prodi',
            'grade',
            'pendidikan',
            'jabatan_fungsional',
            'jabatan_struktural',
            'riwayatJabatanStruktural',
            'riwayatJabatanFungsional',
        ]);

        if(request('search')){
            $data = $data->where('nip', 'LIKE', '%' . request('search') . '%')
            ->orWhere('name', 'LIKE', '%' . request('search') . '%')
            ->orWhere('email', 'LIKE', '%' . request('search') . '%');
        }


        $data = $data->paginate('10')->appends(request()->query());


        $golongan = Golongan::all();
        $kelompok_pegawai = KelompokPegawai::all();
        $jenis_pegawai = JenisPegawai::all();
        $unit_kerja = UnitKerja::all();
        $jurusan = Jurusan::all();
        $prodi = Prodi::all();
        $grade = Grade::all();
        $pendidikan = Pendidikan::all();
        $jabatan_fungsional = JabatanFungsional::all();
        $jabatan_struktural = JabatanStruktural::all();

        return view('pages.pegawai', [
            'pagename' => "pegawai",
            'data' => $data,
            'golongan' => $golongan,
            'kelompok_pegawai' => $kelompok_pegawai,
            'jenis_pegawai' => $jenis_pegawai,
            'unit_kerja' => $unit_kerja,
            'jurusan' => $jurusan,
            'prodi' => $prodi,
            'grade' => $grade,
            'pendidikan' => $pendidikan,
            'jabatan_fungsional' => $jabatan_fungsional,
            'jabatan_struktural' => $jabatan_struktural,
            'search' => request('search')
        ]);
    }

    public function show(Request $request) {
        $pegawai = Pegawai::with([
            'golongan',
            'kelompok_pegawai',
            'jenis_pegawai',
            'unit_kerja',
            'jurusan',
            'prodi',
            'grade',
            'pendidikan',
            'jabatan_fungsional',
            'jabatan_struktural',
            'riwayatGolongan',
            'riwayatKelompokPegawai',
            'riwayatJenisPegawai',
            'riwayatPendidikan',
            'riwayatJabatanStruktural',
            'riwayatJabatanFungsional',
            'riwayatGrade',
            'riwayatMutasi',
            'riwayatUnitKerja',
            
        ])->whereId($request->id)->first();

        $posisi = PosisiPegawai::with([
            'posisi',
            'unitKerja',
            'jurusan',
            'prodi',
            'atasan',
        ])->where('pegawai_id', $request->id)->first();

        $golongan = Golongan::all();
        $kelompok_pegawai = KelompokPegawai::all();
        $jenis_pegawai = JenisPegawai::all();
        $unit_kerja = UnitKerja::all();
        $jurusan = Jurusan::all();
        $prodi = Prodi::all();
        $grade = Grade::all();
        $pendidikan = Pendidikan::all();
        $jabatan_fungsional = JabatanFungsional::all();
        $jabatan_struktural = JabatanStruktural::all();

        return view('pages.detail-pegawai', [
            'pagename' => "detail-pegawai",
            'pegawai' => $pegawai,
            'golongan' => $golongan,
            'kelompok_pegawai' => $kelompok_pegawai,
            'jenis_pegawai' => $jenis_pegawai,
            'unit_kerja' => $unit_kerja,
            'jurusan' => $jurusan,
            'prodi' => $prodi,
            'grade' => $grade,
            'pendidikan' => $pendidikan,
            'jabatan_fungsional' => $jabatan_fungsional,
            'jabatan_struktural' => $jabatan_struktural,
            'posisi' => $posisi,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'nip' => 'required|unique:pegawai,nip',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:pegawai,email',
            'golongan_id' => 'required|exists:golongan,id',
            'kelompok_pegawai_id' => 'required|exists:kelompok_pegawai,id',
            'jenis_pegawai_id' => 'required|exists:jenis_pegawai,id',
            'unit_kerja_id' => 'required|exists:unit_kerja,id',
            'jurusan_id' => 'required|exists:jurusan,id',
            'prodi_id' => 'required|exists:prodi,id',
            'grade_id' => 'required|exists:grade,id',
            'tamat_cpns' => 'nullable|date',
            'tamat_pns' => 'nullable|date',
            'pendidikan_id' => 'required|exists:pendidikan,id',
            'jabatan_fungsional_id' => 'nullable|exists:jabatan_fungsional,id',
            'jabatan_struktural_id' => 'nullable|exists:jabatan_struktural,id',
        ]);

        // Create a new Pegawai instance
        Pegawai::create($validated);

        // Redirect to a page or return a response
        return redirect()->route('pegawai.index')->with('success', 'Pegawai berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pegawai $pegawai)
    {
        return view('pages.edit-pegawai', [
            'pagename' => "edit-pegawai",
            'pegawai' => $pegawai
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
           
        // find the pegawai 
        $data = Pegawai::with([
            'golongan',
            'kelompok_pegawai',
            'jenis_pegawai',
            'unit_kerja',
            'jurusan',
            'prodi',
            'grade',
            'pendidikan',
            'jabatan_fungsional',
            'jabatan_struktural',
        ])->findOrFail($request->id);

        // Validate the incoming request data
        $validated = $request->validate([
            'nip' => 'required',
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'golongan_id' => 'required',
            'kelompok_pegawai_id' => 'required',
            'jenis_pegawai_id' => 'required',
            'unit_kerja_id' => 'required',
            'jurusan_id' => 'required',
            'prodi_id' => 'required',
            'grade_id' => 'required',
            'tamat_cpns' => 'nullable|date',
            'tamat_pns' => 'nullable|date',
            'pendidikan_id' => 'required',
            'jabatan_fungsional_id' => 'nullable',
            'jabatan_struktural_id' => 'nullable',
        ]);

        if (Auth::user()->role_id == 2) {
            $updateData = [
                'id' => $data->id,
                'validated_data' => $validated,
                'type' => 'Pegawai',
                'requested_by' => Auth::user()->id,
                'requested_at' => now(),
            ];

            PendingAction::savePendingAction('update', $data->id, $updateData);

            return redirect()->back()->with('success', 'Pegawai update requested successfully');
        }

        // Update the Pegawai instance
        $originalData = $data->toArray();
        $originalData = array_slice($originalData, 1);

        if($originalData['jurusan_id'] != $validated['jurusan_id'] || $originalData['prodi_id'] != $validated['prodi_id']){
            $riwayat = [
                'pegawai_id' => $request->id,
                'fakultas_id' => $originalData['jurusan']['fakultas_id'],
                'jurusan_id' => $originalData['jurusan']['id'],
                'prodi_id' => $originalData['prodi']['id'],
                'tanggal_sk' => now(),
            ];
            RiwayatMutasi::create($riwayat);
        }

        if($originalData['unit_kerja_id'] != $validated['unit_kerja_id']){
            $riwayat = [
                'pegawai_id' => $request->id,
                'unit_kerja_id' => $originalData['unit_kerja']['id'],
            ];
            RiwayatUnitKerja::create($riwayat);
        }

        if($originalData['golongan_id'] != $validated['golongan_id']){
            $riwayat = [
                'pegawai_id' => $request->id,
                'golongan_id' => $originalData['golongan']['id'],
            ];
            RiwayatGolongan::create($riwayat);
        }

        if($originalData['grade_id'] != $validated['grade_id']){
            $riwayat = [
                'pegawai_id' => $request->id,
                'grade_id' => $originalData['grade']['id'],
            ];
            RiwayatGrade::create($riwayat);
        }

        if($originalData['kelompok_pegawai_id'] != $validated['kelompok_pegawai_id']){
            $riwayat = [
                'pegawai_id' => $request->id,
                'kelompok_pegawai_id' => $originalData['kelompok_pegawai']['id'],
            ];
            RiwayatKelompokPegawai::create($riwayat);
        }

        if($originalData['jenis_pegawai_id'] != $validated['jenis_pegawai_id']){
            $riwayat = [
                'pegawai_id' => $request->id,
                'jenis_pegawai_id' => $originalData['jenis_pegawai']['id'],
            ];
            RiwayatJenisPegawai::create($riwayat);
        }

        if($originalData['pendidikan_id'] != $validated['pendidikan_id']){
            $riwayat = [
                'pegawai_id' => $request->id,
                'pendidikan_id' => $originalData['pendidikan']['id'],
            ];
            RiwayatPendidikan::create($riwayat);
        }

        if($originalData['jabatan_fungsional_id'] != $validated['jabatan_fungsional_id']){
            $riwayat = [
                'pegawai_id' => $request->id,
                'jabatan_fungsional_id' => $originalData['jabatan_fungsional']['id'],
            ];
            RiwayatJabatanFungsional::create($riwayat);
        }

        if($originalData['jabatan_struktural_id'] != $validated['jabatan_struktural_id']){
            $riwayat = [
                'pegawai_id' => $request->id,
                'jabatan_struktural_id' => $originalData['jabatan_struktural']['id'],
            ];
            RiwayatJabatanStruktural::create($riwayat);
        }

        Pegawai::where('id', $request->id)->update($validated);

        // Redirect to a page or return a response
        return redirect()->back()->with('success', 'Pegawai updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        // Find the Pegawai record
        $data = Pegawai::findOrFail($request->id);

        // If the user is not an admin, save the delete request to the pending actions table
        if (Auth::user()->role_id == 2) {
            $deleteData = [
                'id' => $data->id,
                'name' => $data->name,
                'type' => 'Pegawai',
                'requested_by' => Auth::user()->id,
                'requested_at' => now(),
            ];

            PendingAction::savePendingAction('delete', $data->id, $deleteData);

            return redirect()->route('pegawai.index')->with('success', 'Pegawai delete request submitted successfully.');
        }

        // Delete the Pegawai record
        $data->delete();

        // Redirect to a page or return a response
        return redirect()->route('pegawai.index')->with('success', 'Pegawai deleted successfully.');
    }

    /**
     * Import data from Excel file
     */
    public function import()
    {
        Excel::import(new PegawaiImport, public_path('pegawai.xlsx'));

        return redirect('/')->with('success', 'All good!');
    }
}
