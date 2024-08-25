@extends('layouts.main_layout')

@section('content')
<div class="pagetitle">
    <h1>Pegawai</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
        <li class="breadcrumb-item active">Pegawai</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <div class="card" style="width: 100%;">
  <div class="card-body">
      <div class="d-flex">
          <h5 class="card-title">Data pegawai</h5>
          @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
            <button type="button" class="btn btn-success ms-auto mt-3" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah data</button>   
          @endif

      </div>
      <h6 class="card-subtitle mb-2 text-body-secondary">Data pegawai</h6>
      
  </div>
</div>

<div class="d-flex w-100">
@if (isset($search))
<p class="text-dark-blue fw-bold">Searching for "{{$search}}"</p>
  
@endif
<form action="{{route('pegawai.index')}}" class="w-100">
  <div class="input-group mb-3 w-50 ms-auto">
    <input type="text" class="form-control" placeholder="Search here" aria-label="Search here" aria-describedby="button-addon2" name="search">
    <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Search</button>
  </div>

</form>
</div>


<div class="table-responsive">
<table class="table table-bordered table-bordered">
        <thead>
            <tr>
                <th>NIP</th>
                <th>Name</th>
                <th>Email</th>

                <th>Actions</th>
                  

            </tr>
        </thead>
        <tbody>

            @foreach($data as $index => $pegawai)
            <tr>
                <td>{{ $pegawai->nip }}</td>
                <td>{{ $pegawai->name }}</td>
                <td>{{ $pegawai->email }}</td>
                @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                <td>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#showModal{{$pegawai->id}}">
                      Detail
                    </button>
                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal{{$pegawai->id}}">Edit</button>
                    <form action="{{ route('pegawai.destroy', $pegawai->id) }}" method="POST" style="display:inline;" id="delete-form-{{ $pegawai->id }}">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $pegawai->id }})">Delete</button>
                    </form>
                </td>
                @else
                  <td>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#showModal{{$pegawai->id}}">
                      Detail
                    </button>
                  </td>
                @endif
<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="showModal{{$pegawai->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Informasi pegawai</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <div id="carouselExampleIndicators{{$pegawai->id}}" class="carousel slide">
    <div class="d-flex mb-3">
      <button type="button" data-bs-target="#carouselExampleIndicators{{$pegawai->id}}" data-bs-slide="prev" class="btn btn-primary" aria-current="true" aria-label="Slide 1"><</button>
      <!-- <button type="button" data-bs-target="#carouselExampleIndicators{{$pegawai->id}}" data-bs-slide-to="1" class="btn btn-primary" aria-label="Slide 2">Riwayat Jabatan Struktural</button> -->
      <button type="button" data-bs-target="#carouselExampleIndicators{{$pegawai->id}}" data-bs-slide="next" class="btn btn-primary ms-auto" aria-label="Slide 3">></button>

    </div>
  <div class="carousel-inner">
    <div class="carousel-item active">

    <h5 class="fw-bold">NIP</h5>
            <p>{{ $pegawai->nip }}</p>
            <h5 class="fw-bold">Name</h5>
            <p>{{ $pegawai->name }}</p>
            <h5 class="fw-bold">Email</h5>
            <p>{{ $pegawai->email }}</p>
            <h5 class="fw-bold">Golongan</h5>
            <p>{{ $pegawai->golongan->name ?? 'N/A' }}</p>
            <h5 class="fw-bold">Kelompok pegawai</h5>
            <p>{{ $pegawai->kelompok_pegawai->name ?? 'N/A' }}</p>
            <h5 class="fw-bold">Jenis pegawai</h5>
            <p>{{ $pegawai->jenis_pegawai->name ?? 'N/A' }}</p>
            <h5 class="fw-bold">Unit kerja</h5>
            <p>{{ $pegawai->unit_kerja->name ?? 'N/A' }}</p>
            <h5 class="fw-bold">Jurusan</h5>
            <p>{{ $pegawai->jurusan->name ?? 'N/A' }}</p>
            <h5 class="fw-bold">Prodi</h5>
            <p>{{ $pegawai->prodi->name ?? 'N/A' }}</p>
            <h5 class="fw-bold">Grade</h5>
            <p>{{ $pegawai->grade->name ?? 'N/A' }}</p>
            <h5 class="fw-bold">Tamat cpns</h5>
            <p>{{ $pegawai->tamat_cpns ?? 'N/A' }}</p>
            <h5 class="fw-bold">Tamat pns</h5>
            <p>{{ $pegawai->tamat_pns ?? 'N/A' }}</p>
            <h5 class="fw-bold">Pendidikan</h5>
            <p>{{ $pegawai->pendidikan->name ?? 'N/A' }}</p>
            <h5 class="fw-bold">Jabatan fungsional</h5>
            <p>{{ $pegawai->jabatan_fungsional->name ?? 'N/A' }}</p>
            <h5 class="fw-bold">Jabatan struktural</h5>
            <p>{{ $pegawai->jabatan_struktural->name ?? 'N/A' }}</p>
    </div>
    <div class="carousel-item">
    <h5 class="fw-bold">Riwayat Jabatan Struktural</h5>
      @foreach ($pegawai->riwayatJabatanStruktural as $index => $riwayatStruktural)
        <p>{{ $index+1 }}.  {{ $riwayatStruktural->jabatanStruktural->name }} ({{ $riwayatStruktural->tahun_mulai }} - {{ $riwayatStruktural->tahun_selesai }})</p>
      @endforeach
    </div>
    <div class="carousel-item">
    <h5 class="fw-bold">Riwayat Jabatan Fungsional</h5>
      @foreach ($pegawai->riwayatJabatanFungsional as $index => $riwayatFungsional)
        <p>{{ $index+1 }}.  {{ $riwayatFungsional->jabatanFungsional->name }} ({{ $riwayatFungsional->tahun_mulai }} - {{ $riwayatFungsional->tahun_selesai }})</p>
      @endforeach
    </div>
  </div>
  <!-- <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators{{$pegawai->id}}" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="false"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators{{$pegawai->id}}" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button> -->
</div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
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
              @foreach($golongan as $item)
                @if ($pegawai->golongan_id == $item->id)
                  <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                @else
                  <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endif
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label for="kelompok_pegawai_id" class="form-label">Kelompok Pegawai</label>
            <select class="form-control" id="kelompok_pegawai_id" name="kelompok_pegawai_id" required>
              @foreach($kelompok_pegawai as $item)
                @if ($pegawai->kelompok_pegawai_id == $item->id)
                  <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                @else
                  <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endif
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label for="jenis_pegawai_id" class="form-label">Jenis Pegawai</label>
            <select class="form-control" id="jenis_pegawai_id" name="jenis_pegawai_id" required>
              @foreach($jenis_pegawai as $item)
                @if ($pegawai->jenis_pegawai_id == $item->id)
                  <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                @else
                  <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endif
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label for="unit_kerja_id" class="form-label">Unit Kerja</label>
            <select class="form-control" id="unit_kerja_id" name="unit_kerja_id" required>
              @foreach($unit_kerja as $item)
                @if ($pegawai->unit_kerja_id == $item->id)
                  <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                @else
                  <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endif
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label for="jurusan_id" class="form-label">Jurusan</label>
            <select class="form-control" id="jurusan_id" name="jurusan_id" required>
              @foreach($jurusan as $item)
                @if ($pegawai->jurusan_id == $item->id)
                  <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                @else
                  <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endif
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label for="prodi_id" class="form-label">Program Studi</label>
            <select class="form-control" id="prodi_id" name="prodi_id" required>
              @foreach($prodi as $item)
                @if ($pegawai->prodi_id == $item->id)
                  <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                @else
                  <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endif
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label for="grade_id" class="form-label">Grade</label>
            <select class="form-control" id="grade_id" name="grade_id" required>
              @foreach($grade as $item)
                @if ($pegawai->grade_id == $item->id)
                  <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                @else
                  <option value="{{ $item->id }}">{{ $item->name }}</option>
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
              @foreach($pendidikan as $item)
                @if ($pegawai->pendidikan_id == $item->id)
                  <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                @else
                  <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endif
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label for="jabatan_fungsional_id" class="form-label">Jabatan Fungsional</label>
            <select class="form-control" id="jabatan_fungsional_id" name="jabatan_fungsional_id" required>
              @foreach($jabatan_fungsional as $item)
                @if ($pegawai->jabatan_fungsional_id == $item->id)
                  <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                @else
                  <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endif
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label for="jabatan_struktural_id" class="form-label">Jabatan Struktural</label>
            <select class="form-control" id="jabatan_struktural_id" name="jabatan_struktural_id" required>
              @foreach($jabatan_struktural as $item)
                @if ($pegawai->jabatan_struktural_id == $item->id)
                  <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                @else
                  <option value="{{ $item->id }}">{{ $item->name }}</option>
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

            </tr>
            @endforeach
        </tbody>
    </table>
</div>



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('pegawai.store') }}" method="POST">
        @csrf
        <div class="modal-body">
          <div class="mb-3">
            <label for="nip" class="form-label">NIP</label>
            <input type="text" class="form-control" id="nip" name="nip" required>
          </div>
          <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
          </div>
          <div class="mb-3">
            <label for="golongan_id" class="form-label">Golongan</label>
            <select class="form-control" id="golongan_id" name="golongan_id" required>
              @foreach($golongan as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label for="kelompok_pegawai_id" class="form-label">Kelompok Pegawai</label>
            <select class="form-control" id="kelompok_pegawai_id" name="kelompok_pegawai_id" required>
              @foreach($kelompok_pegawai as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label for="jenis_pegawai_id" class="form-label">Jenis Pegawai</label>
            <select class="form-control" id="jenis_pegawai_id" name="jenis_pegawai_id" required>
              @foreach($jenis_pegawai as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label for="unit_kerja_id" class="form-label">Unit Kerja</label>
            <select class="form-control" id="unit_kerja_id" name="unit_kerja_id" required>
              @foreach($unit_kerja as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label for="jurusan_id" class="form-label">Jurusan</label>
            <select class="form-control" id="jurusan_id" name="jurusan_id" required>
              @foreach($jurusan as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label for="prodi_id" class="form-label">Program Studi</label>
            <select class="form-control" id="prodi_id" name="prodi_id" required>
              @foreach($prodi as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label for="grade_id" class="form-label">Grade</label>
            <select class="form-control" id="grade_id" name="grade_id" required>
              @foreach($grade as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label for="tamat_cpns" class="form-label">Tamat CPNS</label>
            <input type="date" class="form-control" id="tamat_cpns" name="tamat_cpns" required>
          </div>
          <div class="mb-3">
            <label for="tamat_pns" class="form-label">Tamat PNS</label>
            <input type="date" class="form-control" id="tamat_pns" name="tamat_pns" required>
          </div>
          <div class="mb-3">
            <label for="pendidikan_id" class="form-label">Pendidikan</label>
            <select class="form-control" id="pendidikan_id" name="pendidikan_id" required>
              @foreach($pendidikan as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label for="jabatan_fungsional_id" class="form-label">Jabatan Fungsional</label>
            <select class="form-control" id="jabatan_fungsional_id" name="jabatan_fungsional_id" required>
              @foreach($jabatan_fungsional as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label for="jabatan_struktural_id" class="form-label">Jabatan Struktural</label>
            <select class="form-control" id="jabatan_struktural_id" name="jabatan_struktural_id" required>
              @foreach($jabatan_struktural as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
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

<script>
  function confirmDelete(id) {
      Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
          if (result.isConfirmed) {
              document.getElementById('delete-form-' + id).submit();
          }
      });
  }
</script>
<div class="mb-3"></div>
{{ $data->links() }}
@endsection