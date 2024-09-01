@extends('layouts.main_layout')

@section('content')
<div class="pagetitle">
    <h1>Kelompok Pegawai</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
        <li class="breadcrumb-item">Settings</li>
        <li class="breadcrumb-item active">Kelompok Pegawai</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <div class="card" style="width: 100%;">
  <div class="card-body">
      <div class="d-flex">
          <h5 class="card-title">Kelompok Pegawai</h5>
          @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
            <button type="button" class="btn btn-success ms-auto mt-3" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah data</button>   
          @endif

      </div>
      <h6 class="card-subtitle mb-2 text-body-secondary">Kelompok Pegawai</h6>
      
  </div>
</div>

<!-- Table to display Kelompok Pegawai data -->
<div class="table-responsive">
  <table id="tablePagination" class="table table-bordered">
      <thead>
          <tr>
              <th scope="col">No</th>
              <th scope="col">Nama Kelompok Pegawai</th>
              @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
              <th scope="col">Aksi</th>
                
              @endif
          </tr>
      </thead>
      <tbody>
          @foreach($data as $index => $kelompokPegawai)
          <tr>
              <td>{{ $index+1 }}</td>
              <td>{{ $kelompokPegawai->name }}</td>
              @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
              <td>
                  <!-- Edit and Delete buttons (Optional) -->
                  <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $kelompokPegawai->id }}">
                      Edit
                  </button>
                  <form action="{{ route('kelompok-pegawai.destroy', $kelompokPegawai->id) }}" method="POST" style="display:inline;" id="delete-form-{{ $kelompokPegawai->id }}">
                      @csrf
                      @method('DELETE')
                      <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $kelompokPegawai->id }})">Delete</button>
                  </form>
              </td>
                
              @endif
          </tr>
  
          <!-- Edit Modal (Optional, if you want to implement editing functionality) -->
          <div class="modal fade" id="editModal{{ $kelompokPegawai->id }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h1 class="modal-title fs-5" id="editModalLabel">Edit Kelompok Pegawai</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                          <form id="editKelompokPegawaiForm{{ $kelompokPegawai->id }}" action="{{ route('kelompok-pegawai.update', $kelompokPegawai->id) }}" method="POST">
                              @csrf
                              @method('PUT')
                              <div class="mb-3">
                                  <input type="hidden" value="{{$kelompokPegawai->id}}" name="id">
                                  <label for="editKelompokPegawaiName{{ $kelompokPegawai->id }}" class="form-label">Nama Kelompok Pegawai</label>
                                  <input type="text" class="form-control" id="editKelompokPegawaiName{{ $kelompokPegawai->id }}" name="name" value="{{ $kelompokPegawai->name }}" required>
                              </div>
                          </form>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                          <button type="submit" class="btn btn-primary" form="editKelompokPegawaiForm{{ $kelompokPegawai->id }}">Submit</button>
                      </div>
                  </div>
              </div>
          </div>
          @endforeach
      </tbody>
  </table>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Kelompok Pegawai</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Form to insert data into KelompokPegawaiController -->
        <form id="kelompokPegawaiForm" action="{{ route('kelompok-pegawai.store') }}" method="POST">
          @csrf <!-- Include CSRF token for security -->
          <div class="mb-3">
            <label for="kelompokPegawaiName" class="form-label">Nama Kelompok Pegawai</label>
            <input type="text" class="form-control" id="kelompokPegawaiName" name="name" required>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary" form="kelompokPegawaiForm">Submit</button>
      </div>
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
@endsection