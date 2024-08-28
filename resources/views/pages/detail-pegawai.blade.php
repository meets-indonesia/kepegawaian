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
          @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
            <button class="ms-auto my-auto btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{$pegawai->id}}">Edit</button>  
          @endif
      </div>
      <h6 class="card-subtitle mb-2 text-body-secondary"><span class="fw-bold">Nama : </span> {{$pegawai->name}}</h6>
      <h6 class="card-subtitle mb-2 text-body-secondary"><span class="fw-bold">NIP : </span> {{$pegawai->nip}}</h6>
      <h6 class="card-subtitle mb-2 text-body-secondary"><span class="fw-bold">Email : </span> {{$pegawai->email}}</h6>
      <h6 class="card-subtitle mb-2 text-body-secondary"><span class="fw-bold">Unit Kerja : </span> {{$pegawai->unit_kerja->name}}</h6>
      <h6 class="card-subtitle mb-2 text-body-secondary"><span class="fw-bold">Jurusan : </span> {{$pegawai->jurusan->name}}</h6>
      <h6 class="card-subtitle mb-2 text-body-secondary"><span class="fw-bold">Program Studi : </span> {{$pegawai->prodi->name}}</h6>
      <h6 class="card-subtitle mb-2 text-body-secondary"><span class="fw-bold">Grade : </span> {{$pegawai->grade->name}}</h6>
      <h6 class="card-subtitle mb-2 text-body-secondary"><span class="fw-bold">Tamat PNS : </span> {{$pegawai->tamat_pns ?? '-'}}</h6>
      <h6 class="card-subtitle mb-2 text-body-secondary"><span class="fw-bold">Tamat CPNS : </span> {{$pegawai->tamat_cpns ?? '-'}}</h6>
  </div>
</div>

<div class="card" style="width: 100%;">
  <div class="card-body">
      <div class="d-flex">
          <h5 class="card-title">Riwayat Golongan</h5>
          @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
            <button class="ms-auto my-auto btn btn-warning" data-bs-toggle="modal" data-bs-target="#editGolongan{{$pegawai->id}}">Edit</button>  
          @endif
      </div>
      <h6 class="card-subtitle mb-2 text-body-secondary"><span class="fw-bold">Golongan Saat ini : </span> {{$pegawai->golongan->name}}</h6>
        <table class="table table-bordered table-responsive">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Golongan</th>
                    <th>Tahun Mulai</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pegawai->riwayatGolongan as $index => $riwayat)
                    <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$riwayat->golongan->name}}</td>
                        <td>{{$riwayat->tahun_mulai}}</td>
                        <td>
                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editRiwayatGolongan{{ $riwayat->id }}">
                                Edit
                            </button>
                            <div class="modal fade" id="editRiwayatGolongan{{ $riwayat->id }}" tabindex="-1" aria-labelledby="editRiwayatGolongan{{ $riwayat->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editRiwayatGolongan{{ $riwayat->id }}">Edit Riwayat Golongan</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('riwayat-golongan.update', $riwayat->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')

                                                <div class="mb-3">
                                                    <label for="tahun_mulai{{ $riwayat->id }}" class="form-label">Tahun Mulai</label>
                                                    <input type="date" name="tahun_mulai" class="form-control" id="tahun_mulai{{ $riwayat->id }}" value="{{ $riwayat->tahun_mulai }}">
                                                </div>

                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
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
          @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
            <button class="ms-auto my-auto btn btn-warning" data-bs-toggle="modal" data-bs-target="#editKelompokPegawai{{$pegawai->id}}">Edit</button>  
          @endif
      </div>
      <h6 class="card-subtitle mb-2 text-body-secondary"><span class="fw-bold">Kelompok Pegawai Saat ini : </span> {{$pegawai->kelompok_pegawai->name}}</h6>
        <table class="table table-bordered table-responsive">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kelompok Pegawai</th>
                    <th>Tahun Mulai</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pegawai->riwayatKelompokPegawai as $index => $riwayat)
                    <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$riwayat->kelompok_pegawai->name}}</td>
                        <td>{{$riwayat->tahun_mulai}}</td>
                        <td>
                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editRiwayatKelompokPegawai{{ $riwayat->id }}">
                                Edit
                            </button>
                            <div class="modal fade" id="editRiwayatKelompokPegawai{{ $riwayat->id }}" tabindex="-1" aria-labelledby="editRiwayatKelompokPegawai{{ $riwayat->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editRiwayatKelompokPegawai{{ $riwayat->id }}">Edit Riwayat Kelompok Pegawai</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('riwayat-kelompok-pegawai.update', $riwayat->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')

                                                <div class="mb-3">
                                                    <label for="tahun_mulai{{ $riwayat->id }}" class="form-label">Tahun Mulai</label>
                                                    <input type="date" name="tahun_mulai" class="form-control" id="tahun_mulai{{ $riwayat->id }}" value="{{ $riwayat->tahun_mulai }}">
                                                </div>

                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
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
          @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
            <button class="ms-auto my-auto btn btn-warning" data-bs-toggle="modal" data-bs-target="#editJenisPegawai{{$pegawai->id}}">Edit</button>  
          @endif
      </div>
      <h6 class="card-subtitle mb-2 text-body-secondary"><span class="fw-bold">Jenis Pegawai Saat ini : </span> {{$pegawai->jenis_pegawai->name}}</h6>
      <table class="table table-bordered table-responsive">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Jenis Pegawai</th>
                    <th>Tahun Mulai</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pegawai->riwayatJenisPegawai as $index => $riwayat)
                    <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$riwayat->jenis_pegawai->name}}</td>
                        <td>{{$riwayat->tahun_mulai}}</td>
                        <td>
                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editRiwayatJenisPegawai{{ $riwayat->id }}">
                                Edit
                            </button>
                            <div class="modal fade" id="editRiwayatJenisPegawai{{ $riwayat->id }}" tabindex="-1" aria-labelledby="editRiwayatJenisPegawai{{ $riwayat->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editRiwayatJenisPegawai{{ $riwayat->id }}">Edit Jenis Pegawai</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('riwayat-jenis-pegawai.update', $riwayat->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')

                                                <div class="mb-3">
                                                    <label for="tahun_mulai{{ $riwayat->id }}" class="form-label">Tahun Mulai</label>
                                                    <input type="date" name="tahun_mulai" class="form-control" id="tahun_mulai{{ $riwayat->id }}" value="{{ $riwayat->tahun_mulai }}">
                                                </div>

                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
  </div>
</div>

<div class="card" style="width: 100%;">
  <div class="card-body">
      <div class="d-flex">
          <h5 class="card-title">Riwayat Pendidikan</h5>
          @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
            <button class="ms-auto my-auto btn btn-warning" data-bs-toggle="modal" data-bs-target="#editPendidikan{{$pegawai->id}}">Edit</button>  
          @endif
      </div>
      <h6 class="card-subtitle mb-2 text-body-secondary"><span class="fw-bold">Pendidikan Saat ini : </span> {{$pegawai->pendidikan->name}}</h6>
      <table class="table table-bordered table-responsive">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Pendidikan</th>
                    <th>Bidang Ilmu</th>
                    <th>Nama Sekolah</th>
                    <th>Tahun Selesai</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pegawai->riwayatPendidikan as $index => $riwayat)
                    <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$riwayat->pendidikan->name}}</td>
                        <td>{{$riwayat->bidang_ilmu}}</td>
                        <td>{{$riwayat->nama_sekolah}}</td>
                        <td>{{$riwayat->tahun_selesai}}</td>
                        <td>
                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editRiwayatPendidikan{{ $riwayat->id }}">
                                Edit
                            </button>
                            <div class="modal fade" id="editRiwayatPendidikan{{ $riwayat->id }}" tabindex="-1" aria-labelledby="editRiwayatPendidikan{{ $riwayat->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editRiwayatPendidikan{{ $riwayat->id }}">Edit Riwayat Pendidikan</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('riwayat-pendidikan.update', $riwayat->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')

                                                <div class="mb-3">
                                                    <label for="bidang_ilmu{{ $riwayat->id }}" class="form-label">Bidang Ilmu</label>
                                                    <input type="text" name="bidang_ilmu" class="form-control" id="bidang_ilmu{{ $riwayat->id }}" value="{{ $riwayat->bidang_ilmu }}">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="nama_sekolah{{ $riwayat->id }}" class="form-label">Nama Sekolah</label>
                                                    <input type="text" name="nama_sekolah" class="form-control" id="nama_sekolah{{ $riwayat->id }}" value="{{ $riwayat->nama_sekolah }}">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="tahun_selesai{{ $riwayat->id }}" class="form-label">Tahun Selesai</label>
                                                    <input type="date" name="tahun_selesai" class="form-control" id="tahun_selesai{{ $riwayat->id }}" value="{{ $riwayat->tahun_selesai }}">
                                                </div>

                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
  </div>
</div>

<div class="card" style="width: 100%;">
  <div class="card-body">
      <div class="d-flex">
          <h5 class="card-title">Riwayat Jabatan Struktural</h5>
          @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
            <button class="ms-auto my-auto btn btn-warning" data-bs-toggle="modal" data-bs-target="#editJabatanStruktural{{$pegawai->id}}">Edit</button>  
          @endif
      </div>
      <h6 class="card-subtitle mb-2 text-body-secondary"><span class="fw-bold">Jabatan Struktural Saat ini : </span> {{$pegawai->jabatan_struktural->name}}</h6>
      <table class="table table-bordered table-responsive">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Jabatan Struktural</th>
                    <th>Tahun Mulai</th>
                    <th>Tahun Selesai</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pegawai->riwayatJabatanStruktural as $index => $riwayat)
                    <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$riwayat->jabatanStruktural->name}}</td>
                        <td>{{$riwayat->tahun_mulai}}</td>
                        <td>{{$riwayat->tahun_selesai}}</td>
                        <td>
                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModalRiwayatJabatanStruktural{{ $riwayat->id }}">
                                Edit
                            </button>
                            <div class="modal fade" id="editModalRiwayatJabatanStruktural{{ $riwayat->id }}" tabindex="-1" aria-labelledby="editModalRiwayatJabatanStruktural{{ $riwayat->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel{{ $riwayat->id }}">Edit Riwayat Jabatan Struktural</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('riwayat-jabatan-struktural.update', $riwayat->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')

                                                <div class="mb-3">
                                                    <label for="tahun_mulai{{ $riwayat->id }}" class="form-label">Tahun Mulai</label>
                                                    <input type="date" name="tahun_mulai" class="form-control" id="tahun_mulai{{ $riwayat->id }}" value="{{ $riwayat->tahun_mulai }}" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="tahun_selesai{{ $riwayat->id }}" class="form-label">Tahun Selesai</label>
                                                    <input type="date" name="tahun_selesai" class="form-control" id="tahun_selesai{{ $riwayat->id }}" value="{{ $riwayat->tahun_selesai }}">
                                                </div>

                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
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
          @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
            <button class="ms-auto my-auto btn btn-warning" data-bs-toggle="modal" data-bs-target="#editJabatanFungsional{{$pegawai->id}}">Edit</button>  
          @endif
      </div>
      <h6 class="card-subtitle mb-2 text-body-secondary"><span class="fw-bold">Jabatan Fungsional Saat ini : </span> {{$pegawai->jabatan_fungsional->name}}</h6>
      <table class="table table-bordered table-responsive">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Jabatan Fungsional</th>
                    <th>Tahun Selesai</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pegawai->riwayatJabatanFungsional as $index => $riwayat)
                    <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$riwayat->jabatanFungsional->name}}</td>
                        <td>{{$riwayat->tahun_selesai}}</td>
                        <td>
                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editRiwayatJabatanFungsional{{ $riwayat->id }}">
                                Edit
                            </button>
                            <div class="modal fade" id="editRiwayatJabatanFungsional{{ $riwayat->id }}" tabindex="-1" aria-labelledby="editRiwayatJabatanFungsional{{ $riwayat->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel{{ $riwayat->id }}">Edit Riwayat Jabatan Fungsional</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('riwayat-jabatan-fungsional.update', $riwayat->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')

                                                <div class="mb-3">
                                                    <label for="tahun_selesai{{ $riwayat->id }}" class="form-label">Tahun Selesai</label>
                                                    <input type="date" name="tahun_selesai" class="form-control" id="tahun_selesai{{ $riwayat->id }}" value="{{ $riwayat->tahun_selesai }}">
                                                </div>

                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
  </div>
</div>

<div class="modal fade" id="exampleModal{{$pegawai->id}}" tabindex="-1" aria-labelledby="exampleModal{{$pegawai->id}}" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('pegawai.update') }}" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-body">
          <div class="mb-3">
            <label for="nip" class="form-label">NIP</label>
            <input type="text" class="form-control" id="nip" name="nip" value="{{$pegawai->nip}}" required>
            <input type="hidden" class="form-control" id="id" name="id" value="{{$pegawai->id}}" required>
          </div>
          <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{$pegawai->name}}" required>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{$pegawai->email}}" required>
          </div>
          <div class="mb-3">
            <label for="golongan_id" class="form-label">Golongan</label>
            <select class="form-control" id="golongan_id" name="golongan_id" required>
              @foreach($golongan as $riwayat)
                @if ($pegawai->golongan_id == $riwayat->id)
                  <option value="{{ $riwayat->id }}" selected>{{ $riwayat->name }}</option>
                @else
                  <option value="{{ $riwayat->id }}">{{ $riwayat->name }}</option>
                @endif
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label for="kelompok_pegawai_id" class="form-label">Kelompok Pegawai</label>
            <select class="form-control" id="kelompok_pegawai_id" name="kelompok_pegawai_id" required>
              @foreach($kelompok_pegawai as $riwayat)
                @if ($pegawai->kelompok_pegawai_id == $riwayat->id)
                  <option value="{{ $riwayat->id }}" selected>{{ $riwayat->name }}</option>
                @else
                  <option value="{{ $riwayat->id }}">{{ $riwayat->name }}</option>
                @endif
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label for="jenis_pegawai_id" class="form-label">Jenis Pegawai</label>
            <select class="form-control" id="jenis_pegawai_id" name="jenis_pegawai_id" required>
              @foreach($jenis_pegawai as $riwayat)
                @if ($pegawai->jenis_pegawai_id == $riwayat->id)
                  <option value="{{ $riwayat->id }}" selected>{{ $riwayat->name }}</option>
                @else
                  <option value="{{ $riwayat->id }}">{{ $riwayat->name }}</option>
                @endif
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label for="unit_kerja_id" class="form-label">Unit Kerja</label>
            <select class="form-control" id="unit_kerja_id" name="unit_kerja_id" required>
              @foreach($unit_kerja as $riwayat)
                @if ($pegawai->unit_kerja_id == $riwayat->id)
                  <option value="{{ $riwayat->id }}" selected>{{ $riwayat->name }}</option>
                @else
                  <option value="{{ $riwayat->id }}">{{ $riwayat->name }}</option>
                @endif
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label for="jurusan_id" class="form-label">Jurusan</label>
            <select class="form-control" id="jurusan_id" name="jurusan_id" required>
              @foreach($jurusan as $riwayat)
                @if ($pegawai->jurusan_id == $riwayat->id)
                  <option value="{{ $riwayat->id }}" selected>{{ $riwayat->name }}</option>
                @else
                  <option value="{{ $riwayat->id }}">{{ $riwayat->name }}</option>
                @endif
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label for="prodi_id" class="form-label">Program Studi</label>
            <select class="form-control" id="prodi_id" name="prodi_id" required>
              @foreach($prodi as $riwayat)
                @if ($pegawai->prodi_id == $riwayat->id)
                  <option value="{{ $riwayat->id }}" selected>{{ $riwayat->name }}</option>
                @else
                  <option value="{{ $riwayat->id }}">{{ $riwayat->name }}</option>
                @endif
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label for="grade_id" class="form-label">Grade</label>
            <select class="form-control" id="grade_id" name="grade_id" required>
              @foreach($grade as $riwayat)
                @if ($pegawai->grade_id == $riwayat->id)
                  <option value="{{ $riwayat->id }}" selected>{{ $riwayat->name }}</option>
                @else
                  <option value="{{ $riwayat->id }}">{{ $riwayat->name }}</option>
                @endif
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label for="tamat_cpns" class="form-label">Tamat CPNS</label>
            <input type="date" class="form-control" id="tamat_cpns" name="tamat_cpns" value="{{$pegawai->tamat_cpns}}" required>
          </div>
          <div class="mb-3">
            <label for="tamat_pns" class="form-label">Tamat PNS</label>
            <input type="date" class="form-control" id="tamat_pns" name="tamat_pns" value="{{$pegawai->tamat_pns}}" required>
          </div>
          <div class="mb-3">
            <label for="pendidikan_id" class="form-label">Pendidikan</label>
            <select class="form-control" id="pendidikan_id" name="pendidikan_id" required>
              @foreach($pendidikan as $riwayat)
                @if ($pegawai->pendidikan_id == $riwayat->id)
                  <option value="{{ $riwayat->id }}" selected>{{ $riwayat->name }}</option>
                @else
                  <option value="{{ $riwayat->id }}">{{ $riwayat->name }}</option>
                @endif
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label for="jabatan_fungsional_id" class="form-label">Jabatan Fungsional</label>
            <select class="form-control" id="jabatan_fungsional_id" name="jabatan_fungsional_id" required>
              @foreach($jabatan_fungsional as $riwayat)
                @if ($pegawai->jabatan_fungsional_id == $riwayat->id)
                  <option value="{{ $riwayat->id }}" selected>{{ $riwayat->name }}</option>
                @else
                  <option value="{{ $riwayat->id }}">{{ $riwayat->name }}</option>
                @endif
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label for="jabatan_struktural_id" class="form-label">Jabatan Struktural</label>
            <select class="form-control" id="jabatan_struktural_id" name="jabatan_struktural_id" required>
              @foreach($jabatan_struktural as $riwayat)
                @if ($pegawai->jabatan_struktural_id == $riwayat->id)
                  <option value="{{ $riwayat->id }}" selected>{{ $riwayat->name }}</option>
                @else
                  <option value="{{ $riwayat->id }}">{{ $riwayat->name }}</option>
                @endif
              @endforeach
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="editGolongan{{$pegawai->id}}" tabindex="-1" aria-labelledby="editGolongan{{$pegawai->id}}" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="editGolonganLabel">Edit Data</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('pegawai.update') }}" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-body">

          <input type="hidden" class="form-control" id="nip" name="nip" value="{{$pegawai->nip}}" required>
          <input type="hidden" class="form-control" id="id" name="id" value="{{$pegawai->id}}" required>
          <input type="hidden" class="form-control" id="name" name="name" value="{{$pegawai->name}}" required>
          <input type="hidden" class="form-control" id="email" name="email" value="{{$pegawai->email}}" required>

          <div class="mb-3">
            <label for="golongan_id" class="form-label">Golongan</label>
            <select class="form-control" id="golongan_id" name="golongan_id" required>
              @foreach($golongan as $riwayat)
                @if ($pegawai->golongan_id == $riwayat->id)
                  <option value="{{ $riwayat->id }}" selected>{{ $riwayat->name }}</option>
                @else
                  <option value="{{ $riwayat->id }}">{{ $riwayat->name }}</option>
                @endif
              @endforeach
            </select>
          </div>
          <input type="hidden" class="form-control" id="kelompok_pegawai_id" name="kelompok_pegawai_id" value="{{$pegawai->kelompok_pegawai_id}}" required>
          <input type="hidden" class="form-control" id="jenis_pegawai_id" name="jenis_pegawai_id" value="{{$pegawai->jenis_pegawai_id}}" required>
          <input type="hidden" class="form-control" id="unit_kerja_id" name="unit_kerja_id" value="{{$pegawai->unit_kerja_id}}" required>
          <input type="hidden" class="form-control" id="jurusan_id" name="jurusan_id" value="{{$pegawai->jurusan_id}}" required>
          <input type="hidden" class="form-control" id="prodi_id" name="prodi_id" value="{{$pegawai->prodi_id}}" required>                   
          <input type="hidden" class="form-control" id="grade_id" name="grade_id" value="{{$pegawai->grade_id}}" required>     
          <input type="hidden" class="form-control" id="tamat_cpns" name="tamat_cpns" value="{{$pegawai->tamat_cpns}}" required>  
          <input type="hidden" class="form-control" id="tamat_pns" name="tamat_pns" value="{{$pegawai->tamat_pns}}" required>
          <input type="hidden" class="form-control" id="pendidikan_id" name="pendidikan_id" value="{{$pegawai->pendidikan_id}}" required>
          <input type="hidden" class="form-control" id="jabatan_fungsional_id" name="jabatan_fungsional_id" value="{{$pegawai->jabatan_fungsional_id}}" required>
          <input type="hidden" class="form-control" id="jabatan_struktural_id" name="jabatan_struktural_id" value="{{$pegawai->jabatan_struktural_id}}" required>             

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>


<div class="modal fade" id="editKelompokPegawai{{$pegawai->id}}" tabindex="-1" aria-labelledby="editKelompokPegawai{{$pegawai->id}}" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="editKelompokPegawaiLabel">Edit Data</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('pegawai.update') }}" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-body">

          <input type="hidden" class="form-control" id="nip" name="nip" value="{{$pegawai->nip}}" required>
          <input type="hidden" class="form-control" id="id" name="id" value="{{$pegawai->id}}" required>
          <input type="hidden" class="form-control" id="name" name="name" value="{{$pegawai->name}}" required>
          <input type="hidden" class="form-control" id="email" name="email" value="{{$pegawai->email}}" required>
          <input type="hidden" class="form-control" id="golongan_id" name="golongan_id" value="{{$pegawai->golongan_id}}" required>
          <div class="mb-3">
            <label for="kelompok_pegawai_id" class="form-label">Kelompok Pegawai</label>
            <select class="form-control" id="kelompok_pegawai_id" name="kelompok_pegawai_id" required>
              @foreach($kelompok_pegawai as $riwayat)
                @if ($pegawai->kelompok_pegawai_id == $riwayat->id)
                  <option value="{{ $riwayat->id }}" selected>{{ $riwayat->name }}</option>
                @else
                  <option value="{{ $riwayat->id }}">{{ $riwayat->name }}</option>
                @endif
              @endforeach
            </select>
          </div>
          <input type="hidden" class="form-control" id="jenis_pegawai_id" name="jenis_pegawai_id" value="{{$pegawai->jenis_pegawai_id}}" required>
          <input type="hidden" class="form-control" id="unit_kerja_id" name="unit_kerja_id" value="{{$pegawai->unit_kerja_id}}" required>
          <input type="hidden" class="form-control" id="jurusan_id" name="jurusan_id" value="{{$pegawai->jurusan_id}}" required>
          <input type="hidden" class="form-control" id="prodi_id" name="prodi_id" value="{{$pegawai->prodi_id}}" required>                   
          <input type="hidden" class="form-control" id="grade_id" name="grade_id" value="{{$pegawai->grade_id}}" required>     
          <input type="hidden" class="form-control" id="tamat_cpns" name="tamat_cpns" value="{{$pegawai->tamat_cpns}}" required>  
          <input type="hidden" class="form-control" id="tamat_pns" name="tamat_pns" value="{{$pegawai->tamat_pns}}" required>
          <input type="hidden" class="form-control" id="pendidikan_id" name="pendidikan_id" value="{{$pegawai->pendidikan_id}}" required>
          <input type="hidden" class="form-control" id="jabatan_fungsional_id" name="jabatan_fungsional_id" value="{{$pegawai->jabatan_fungsional_id}}" required>
          <input type="hidden" class="form-control" id="jabatan_struktural_id" name="jabatan_struktural_id" value="{{$pegawai->jabatan_struktural_id}}" required>             

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>


<div class="modal fade" id="editJenisPegawai{{$pegawai->id}}" tabindex="-1" aria-labelledby="editJenisPegawai{{$pegawai->id}}" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="editJenisPegawaiLabel">Edit Data</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('pegawai.update') }}" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-body">

          <input type="hidden" class="form-control" id="nip" name="nip" value="{{$pegawai->nip}}" required>
          <input type="hidden" class="form-control" id="id" name="id" value="{{$pegawai->id}}" required>
          <input type="hidden" class="form-control" id="name" name="name" value="{{$pegawai->name}}" required>
          <input type="hidden" class="form-control" id="email" name="email" value="{{$pegawai->email}}" required>
          <input type="hidden" class="form-control" id="golongan_id" name="golongan_id" value="{{$pegawai->golongan_id}}" required>
          <input type="hidden" class="form-control" id="kelompok_pegawai_id" name="kelompok_pegawai_id" value="{{$pegawai->kelompok_pegawai_id}}" required>
          <div class="mb-3">
            <label for="jenis_pegawai_id" class="form-label">Jenis Pegawai</label>
            <select class="form-control" id="jenis_pegawai_id" name="jenis_pegawai_id" required>
              @foreach($jenis_pegawai as $riwayat)
                @if ($pegawai->jenis_pegawai_id == $riwayat->id)
                  <option value="{{ $riwayat->id }}" selected>{{ $riwayat->name }}</option>
                @else
                  <option value="{{ $riwayat->id }}">{{ $riwayat->name }}</option>
                @endif
              @endforeach
            </select>
          </div>
          <input type="hidden" class="form-control" id="unit_kerja_id" name="unit_kerja_id" value="{{$pegawai->unit_kerja_id}}" required>
          <input type="hidden" class="form-control" id="jurusan_id" name="jurusan_id" value="{{$pegawai->jurusan_id}}" required>
          <input type="hidden" class="form-control" id="prodi_id" name="prodi_id" value="{{$pegawai->prodi_id}}" required>                   
          <input type="hidden" class="form-control" id="grade_id" name="grade_id" value="{{$pegawai->grade_id}}" required>     
          <input type="hidden" class="form-control" id="tamat_cpns" name="tamat_cpns" value="{{$pegawai->tamat_cpns}}" required>  
          <input type="hidden" class="form-control" id="tamat_pns" name="tamat_pns" value="{{$pegawai->tamat_pns}}" required>
          <input type="hidden" class="form-control" id="pendidikan_id" name="pendidikan_id" value="{{$pegawai->pendidikan_id}}" required>
          <input type="hidden" class="form-control" id="jabatan_fungsional_id" name="jabatan_fungsional_id" value="{{$pegawai->jabatan_fungsional_id}}" required>
          <input type="hidden" class="form-control" id="jabatan_struktural_id" name="jabatan_struktural_id" value="{{$pegawai->jabatan_struktural_id}}" required>             

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="editPendidikan{{$pegawai->id}}" tabindex="-1" aria-labelledby="editPendidikan{{$pegawai->id}}" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="editPendidikanLabel">Edit Data</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('pegawai.update') }}" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-body">

          <input type="hidden" class="form-control" id="nip" name="nip" value="{{$pegawai->nip}}" required>
          <input type="hidden" class="form-control" id="id" name="id" value="{{$pegawai->id}}" required>
          <input type="hidden" class="form-control" id="name" name="name" value="{{$pegawai->name}}" required>
          <input type="hidden" class="form-control" id="email" name="email" value="{{$pegawai->email}}" required>
          <input type="hidden" class="form-control" id="golongan_id" name="golongan_id" value="{{$pegawai->golongan_id}}" required>
          <input type="hidden" class="form-control" id="kelompok_pegawai_id" name="kelompok_pegawai_id" value="{{$pegawai->kelompok_pegawai_id}}" required>
          <input type="hidden" class="form-control" id="jenis_pegawai_id" name="jenis_pegawai_id" value="{{$pegawai->jenis_pegawai_id}}" required>
          <input type="hidden" class="form-control" id="unit_kerja_id" name="unit_kerja_id" value="{{$pegawai->unit_kerja_id}}" required>
          <input type="hidden" class="form-control" id="jurusan_id" name="jurusan_id" value="{{$pegawai->jurusan_id}}" required>
          <input type="hidden" class="form-control" id="prodi_id" name="prodi_id" value="{{$pegawai->prodi_id}}" required>                   
          <input type="hidden" class="form-control" id="grade_id" name="grade_id" value="{{$pegawai->grade_id}}" required>     
          <input type="hidden" class="form-control" id="tamat_cpns" name="tamat_cpns" value="{{$pegawai->tamat_cpns}}" required>  
          <input type="hidden" class="form-control" id="tamat_pns" name="tamat_pns" value="{{$pegawai->tamat_pns}}" required>
          <div class="mb-3">
            <label for="pendidikan_id" class="form-label">Pendidikan</label>
            <select class="form-control" id="pendidikan_id" name="pendidikan_id" required>
              @foreach($pendidikan as $riwayat)
                @if ($pegawai->pendidikan_id == $riwayat->id)
                  <option value="{{ $riwayat->id }}" selected>{{ $riwayat->name }}</option>
                @else
                  <option value="{{ $riwayat->id }}">{{ $riwayat->name }}</option>
                @endif
              @endforeach
            </select>
          </div>
          <input type="hidden" class="form-control" id="jabatan_fungsional_id" name="jabatan_fungsional_id" value="{{$pegawai->jabatan_fungsional_id}}" required>
          <input type="hidden" class="form-control" id="jabatan_struktural_id" name="jabatan_struktural_id" value="{{$pegawai->jabatan_struktural_id}}" required>             

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="editJabatanStruktural{{$pegawai->id}}" tabindex="-1" aria-labelledby="editJabatanStruktural{{$pegawai->id}}" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="editJabatanStrukturalLabel">Edit Data</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('pegawai.update') }}" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-body">

          <input type="hidden" class="form-control" id="nip" name="nip" value="{{$pegawai->nip}}" required>
          <input type="hidden" class="form-control" id="id" name="id" value="{{$pegawai->id}}" required>
          <input type="hidden" class="form-control" id="name" name="name" value="{{$pegawai->name}}" required>
          <input type="hidden" class="form-control" id="email" name="email" value="{{$pegawai->email}}" required>
          <input type="hidden" class="form-control" id="golongan_id" name="golongan_id" value="{{$pegawai->golongan_id}}" required>
          <input type="hidden" class="form-control" id="kelompok_pegawai_id" name="kelompok_pegawai_id" value="{{$pegawai->kelompok_pegawai_id}}" required>
          <input type="hidden" class="form-control" id="jenis_pegawai_id" name="jenis_pegawai_id" value="{{$pegawai->jenis_pegawai_id}}" required>
          <input type="hidden" class="form-control" id="unit_kerja_id" name="unit_kerja_id" value="{{$pegawai->unit_kerja_id}}" required>
          <input type="hidden" class="form-control" id="jurusan_id" name="jurusan_id" value="{{$pegawai->jurusan_id}}" required>
          <input type="hidden" class="form-control" id="prodi_id" name="prodi_id" value="{{$pegawai->prodi_id}}" required>                   
          <input type="hidden" class="form-control" id="grade_id" name="grade_id" value="{{$pegawai->grade_id}}" required>     
          <input type="hidden" class="form-control" id="tamat_cpns" name="tamat_cpns" value="{{$pegawai->tamat_cpns}}" required>  
          <input type="hidden" class="form-control" id="tamat_pns" name="tamat_pns" value="{{$pegawai->tamat_pns}}" required>
          <input type="hidden" class="form-control" id="pendidikan_id" name="pendidikan_id" value="{{$pegawai->pendidikan_id}}" required>
          <input type="hidden" class="form-control" id="jabatan_fungsional_id" name="jabatan_fungsional_id" value="{{$pegawai->jabatan_fungsional_id}}" required>
          <div class="mb-3">
            <label for="jabatan_struktural_id" class="form-label">Jabatan Struktural</label>
            <select class="form-control" id="jabatan_struktural_id" name="jabatan_struktural_id" required>
              @foreach($jabatan_struktural as $riwayat)
                @if ($pegawai->jabatan_struktural_id == $riwayat->id)
                  <option value="{{ $riwayat->id }}" selected>{{ $riwayat->name }}</option>
                @else
                  <option value="{{ $riwayat->id }}">{{ $riwayat->name }}</option>
                @endif
              @endforeach
            </select>
          </div>             

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="editJabatanFungsional{{$pegawai->id}}" tabindex="-1" aria-labelledby="editJabatanFungsional{{$pegawai->id}}" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="editJabatanFungsionalLabel">Edit Data</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('pegawai.update') }}" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-body">

          <input type="hidden" class="form-control" id="nip" name="nip" value="{{$pegawai->nip}}" required>
          <input type="hidden" class="form-control" id="id" name="id" value="{{$pegawai->id}}" required>
          <input type="hidden" class="form-control" id="name" name="name" value="{{$pegawai->name}}" required>
          <input type="hidden" class="form-control" id="email" name="email" value="{{$pegawai->email}}" required>
          <input type="hidden" class="form-control" id="golongan_id" name="golongan_id" value="{{$pegawai->golongan_id}}" required>
          <input type="hidden" class="form-control" id="kelompok_pegawai_id" name="kelompok_pegawai_id" value="{{$pegawai->kelompok_pegawai_id}}" required>
          <input type="hidden" class="form-control" id="jenis_pegawai_id" name="jenis_pegawai_id" value="{{$pegawai->jenis_pegawai_id}}" required>
          <input type="hidden" class="form-control" id="unit_kerja_id" name="unit_kerja_id" value="{{$pegawai->unit_kerja_id}}" required>
          <input type="hidden" class="form-control" id="jurusan_id" name="jurusan_id" value="{{$pegawai->jurusan_id}}" required>
          <input type="hidden" class="form-control" id="prodi_id" name="prodi_id" value="{{$pegawai->prodi_id}}" required>                   
          <input type="hidden" class="form-control" id="grade_id" name="grade_id" value="{{$pegawai->grade_id}}" required>     
          <input type="hidden" class="form-control" id="tamat_cpns" name="tamat_cpns" value="{{$pegawai->tamat_cpns}}" required>  
          <input type="hidden" class="form-control" id="tamat_pns" name="tamat_pns" value="{{$pegawai->tamat_pns}}" required>
          <input type="hidden" class="form-control" id="pendidikan_id" name="pendidikan_id" value="{{$pegawai->pendidikan_id}}" required>
          <div class="mb-3">
            <label for="jabatan_fungsional_id" class="form-label">Jabatan Fungsional</label>
            <select class="form-control" id="jabatan_fungsional_id" name="jabatan_fungsional_id" required>
              @foreach($jabatan_fungsional as $riwayat)
                @if ($pegawai->jabatan_fungsional_id == $riwayat->id)
                  <option value="{{ $riwayat->id }}" selected>{{ $riwayat->name }}</option>
                @else
                  <option value="{{ $riwayat->id }}">{{ $riwayat->name }}</option>
                @endif
              @endforeach
            </select>
          </div>
          <input type="hidden" class="form-control" id="jabatan_struktural_id" name="jabatan_struktural_id" value="{{$pegawai->jabatan_struktural_id}}" required>             

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection