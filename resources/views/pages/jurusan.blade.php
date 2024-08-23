@extends('layouts.main_layout')

@section('content')
<div class="pagetitle">
    <h1>Jurusan</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
        <li class="breadcrumb-item">Settings</li>
        <li class="breadcrumb-item active">Jurusan</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <div class="card" style="width: 100%;">
  <div class="card-body">
      <div class="d-flex">
          <h5 class="card-title">Jurusan</h5>
          <button type="button" class="btn btn-success ms-auto mt-3" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah data</button>

      </div>
      <h6 class="card-subtitle mb-2 text-body-secondary">Jurusan</h6>
      
  </div>
</div>

<!-- Table to display Jurusan data -->
<div class="table-responsive">
  <table id="tablePagination" class="table table-bordered">
      <thead>
          <tr>
              <th scope="col">No</th>
              <th scope="col">Nama Jurusan</th>
              <th scope="col">Fakultas</th>
              @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
              <th scope="col">Aksi</th>
                
              @endif
          </tr>
      </thead>
      <tbody>
          @foreach($data as $index => $jurusan)
          <tr>
              <td>{{ $index+1 }}</td>
              <td>{{ $jurusan->name }}</td>
              <td>{{$jurusan->fakultas->name}}</td>
              @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
              <td>
                  <!-- Edit and Delete buttons (Optional) -->
                  <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $jurusan->id }}">
                      Edit
                  </button>
                  <form action="{{ route('jurusan.destroy', $jurusan->id) }}" method="POST" style="display:inline;" id="delete-form-{{ $jurusan->id }}">
                      @csrf
                      @method('DELETE')
                      <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $jurusan->id }})">Delete</button>
                  </form>
              </td>
                
              @endif
          </tr>
  
          <!-- Edit Modal (Optional, if you want to implement editing functionality) -->
          <div class="modal fade" id="editModal{{ $jurusan->id }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h1 class="modal-title fs-5" id="editModalLabel">Edit Jurusan</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                          <form id="editjurusanForm{{ $jurusan->id }}" action="{{ route('jurusan.update', $jurusan->id) }}" method="POST">
                              @csrf
                              @method('PUT')
                              <div class="mb-3">
                                  <input type="hidden" value="{{$jurusan->id}}" name="id">
                                  <label for="editjurusanName{{ $jurusan->id }}" class="form-label">Nama Jurusan</label>
                                  <input type="text" class="form-control" id="editjurusanName{{ $jurusan->id }}" name="name" value="{{ $jurusan->name }}" required>
                              </div>
                              <div class="mb-3">
                                <label for="fakultasName" class="form-label">Nama Fakultas</label>
                                <select class="form-control" name="fakultas_id" required>
                                  @foreach($fakultas as $item)
                                    <option value="{{ $item->id }}" 
                                      @if ($jurusan->fakultas_id == $item->id)
                                        selected
                                      @endif
                                    >{{ $item->name }}</option>
                                  @endforeach
                                </select>
                              </div>
                          </form>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                          <button type="submit" class="btn btn-primary" form="editjurusanForm{{ $jurusan->id }}">Submit</button>
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
        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Jurusan</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Form to insert data into jurusanController -->
        <form id="jurusanForm" action="{{ route('jurusan.store') }}" method="POST">
          @csrf <!-- Include CSRF token for security -->
          <div class="mb-3">
            <label for="jurusanName" class="form-label">Nama Jurusan</label>
            <input type="text" class="form-control" id="jurusanName" name="name" required>
          </div>
          <div class="mb-3">
            <label for="fakultasName" class="form-label">Nama Fakultas</label>
            <select class="form-control" id="fakultas_id" name="fakultas_id" required>
              @foreach($fakultas as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
              @endforeach
            </select>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary" form="jurusanForm">Submit</button>
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