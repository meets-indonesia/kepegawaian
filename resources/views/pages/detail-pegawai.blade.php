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

<div >
  <div class="row">
    <div class="col-12 col-lg-9">
      @include('pages.pegawai-info')
    </div>
    <div class="col-12 col-lg-3">
      <div class="card" style="width: 100%;">
        <div class="card-body">
            <div class="d-flex">
                <h5 class="card-title">Riwayat Kepegawaian</h5>
            </div>
            <button type="button" class="btn btn-outline-primary my-1 w-100" data-bs-toggle="modal" data-bs-target="#unitKerjaModal">Unit Kerja</button>
            <button type="button" class="btn btn-outline-primary my-1 w-100" data-bs-toggle="modal" data-bs-target="#mutasiModal">Mutasi</button>
            <button type="button" class="btn btn-outline-primary my-1 w-100" data-bs-toggle="modal" data-bs-target="#gradeModal">Grade</button>
            <button type="button" class="btn btn-outline-primary my-1 w-100" data-bs-toggle="modal" data-bs-target="#golonganModal">Golongan</button>
            <button type="button" class="btn btn-outline-primary my-1 w-100" data-bs-toggle="modal" data-bs-target="#kelompokPegawaiModal">Kelompok Pegawai</button>
            <button type="button" class="btn btn-outline-primary my-1 w-100" data-bs-toggle="modal" data-bs-target="#jenisPegawaiModal">Jenis Pegawai</button>
            <button type="button" class="btn btn-outline-primary my-1 w-100" data-bs-toggle="modal" data-bs-target="#pendidikanModal">Pendidikan</button>
            <button type="button" class="btn btn-outline-primary my-1 w-100" data-bs-toggle="modal" data-bs-target="#jabatanStrukturalModal">Jabatan Struktural</button>
            <button type="button" class="btn btn-outline-primary my-1 w-100" data-bs-toggle="modal" data-bs-target="#jabatanFungsionalModal">Jabatan Fungsional</button>
        </div>
      </div>
    </div>
  </div>

</div>
@include('pages.detail-pegawai-modal')
@endsection