@extends('layouts.main_layout')

@section('content')
<div class="pagetitle">
<h1>Detail Pegawai</h1>
<nav>
    <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
    <li class="breadcrumb-item"><a href="/pegawai">Pegawai</a></li>
    <li class="breadcrumb-item active">Detail Pegawai</li>
    </ol>
</nav>
</div><!-- End Page Title -->

<div class="card" style="width: 100%;">
  <div class="card-body">
      <div class="d-flex">
          <h5 class="card-title">Detail pegawai</h5>
      </div>
      <h6 class="card-subtitle mb-2 text-body-secondary"><span class="fw-bold">Nama : </span> {{$pegawai->name}}</h6>
      <h6 class="card-subtitle mb-2 text-body-secondary"><span class="fw-bold">NIP : </span> {{$pegawai->nip}}</h6>
      <h6 class="card-subtitle mb-2 text-body-secondary"><span class="fw-bold">Email : </span> {{$pegawai->email}}</h6>
      <h6 class="card-subtitle mb-2 text-body-secondary"><span class="fw-bold">Golongan : </span> {{$pegawai->golongan->name}}</h6>
      <h6 class="card-subtitle mb-2 text-body-secondary"><span class="fw-bold">Kelompok Pegawai : </span> {{$pegawai->kelompok_pegawai->name}}</h6>
      <h6 class="card-subtitle mb-2 text-body-secondary"><span class="fw-bold">Jenis Pegawai : </span> {{$pegawai->jenis_pegawai->name}}</h6>
      <h6 class="card-subtitle mb-2 text-body-secondary"><span class="fw-bold">Unit Kerja : </span> {{$pegawai->unit_kerja->name}}</h6>
      <h6 class="card-subtitle mb-2 text-body-secondary"><span class="fw-bold">Jurusan : </span> {{$pegawai->jurusan->name}}</h6>
      <h6 class="card-subtitle mb-2 text-body-secondary"><span class="fw-bold">Program Studi : </span> {{$pegawai->prodi->name}}</h6>
      <h6 class="card-subtitle mb-2 text-body-secondary"><span class="fw-bold">Grade : </span> {{$pegawai->grade->name}}</h6>
      <h6 class="card-subtitle mb-2 text-body-secondary"><span class="fw-bold">Pendidikan : </span> {{$pegawai->pendidikan->name}}</h6>
      <h6 class="card-subtitle mb-2 text-body-secondary"><span class="fw-bold">Jabatan Fungsional : </span> {{$pegawai->jabatan_fungsional->name}}</h6>
      <h6 class="card-subtitle mb-2 text-body-secondary"><span class="fw-bold">Jabatan Struktural : </span> {{$pegawai->jabatan_struktural->name}}</h6>
      <h6 class="card-subtitle mb-2 text-body-secondary"><span class="fw-bold">Tamat PNS : </span> {{$pegawai->tamat_pns ?? '-'}}</h6>
      <h6 class="card-subtitle mb-2 text-body-secondary"><span class="fw-bold">Tamat CPNS : </span> {{$pegawai->tamat_cpns ?? '-'}}</h6>
  </div>
</div>

<div class="card" style="width: 100%;">
  <div class="card-body">
      <div class="d-flex">
          <h5 class="card-title">Riwayat Golongan</h5>
      </div>
        <table class="table table-bordered table-responsive">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Golongan</th>
                    <th>Tahun Mulai</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pegawai->riwayatGolongan as $index => $riwayat)
                    <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$riwayat->golongan->name}}</td>
                        <td>{{$riwayat->tahun_mulai}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
  </div>
</div>

<div class="card" style="width: 100%;">
  <div class="card-body">
      <div class="d-flex">
          <h5 class="card-title">Riwayat Kelompok Pegawai</h5>
      </div>
        <table class="table table-bordered table-responsive">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kelompok Pegawai</th>
                    <th>Tahun Mulai</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pegawai->riwayatKelompokPegawai as $index => $riwayat)
                    <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$riwayat->kelompok_pegawai->name}}</td>
                        <td>{{$riwayat->tahun_mulai}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
  </div>
</div>

<div class="card" style="width: 100%;">
  <div class="card-body">
      <div class="d-flex">
          <h5 class="card-title">Riwayat Jenis Pegawai</h5>
      </div>
      <table class="table table-bordered table-responsive">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Jenis Pegawai</th>
                    <th>Tahun Mulai</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pegawai->riwayatJenisPegawai as $index => $riwayat)
                    <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$riwayat->jenis_pegawai->name}}</td>
                        <td>{{$riwayat->tahun_mulai}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
  </div>
</div>

<!-- <div class="card" style="width: 100%;">
  <div class="card-body">
      <div class="d-flex">
          <h5 class="card-title">Riwayat Pendidikan</h5>
      </div>

  </div>
</div> -->

<div class="card" style="width: 100%;">
  <div class="card-body">
      <div class="d-flex">
          <h5 class="card-title">Riwayat Jabatan Struktural</h5>
      </div>
      <table class="table table-bordered table-responsive">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Jabatan Struktural</th>
                    <th>Tahun Mulai</th>
                    <th>Tahun Selesai</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pegawai->riwayatJabatanStruktural as $index => $riwayat)
                    <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$riwayat->jabatanStruktural->name}}</td>
                        <td>{{$riwayat->tahun_mulai}}</td>
                        <td>{{$riwayat->tahun_selesai}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
  </div>
</div>

<div class="card" style="width: 100%;">
  <div class="card-body">
      <div class="d-flex">
          <h5 class="card-title">Riwayat Jabatan Fungsional</h5>
      </div>
      <table class="table table-bordered table-responsive">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Jabatan Fungsional</th>
                    <th>Tahun Selesai</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pegawai->riwayatJabatanFungsional as $index => $riwayat)
                    <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$riwayat->jabatanFungsional->name}}</td>
                        <td>{{$riwayat->tahun_selesai}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
  </div>
</div>
@endsection