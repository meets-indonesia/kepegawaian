@extends('layouts.main_layout')

@section('content')
<div class="pagetitle">
    <h1>Fakultas</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
        <li class="breadcrumb-item">Settings</li>
        <li class="breadcrumb-item active">Fakultas</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <div class="card" style="width: 100%;">
  <div class="card-body">
      <div class="d-flex">
          <h5 class="card-title">Fakultas</h5>
          @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
            <button type="button" class="btn btn-success ms-auto mt-3" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah data</button>   
          @endif

      </div>
      <h6 class="card-subtitle mb-2 text-body-secondary">Fakultas</h6>
      
  </div>
</div>

<!-- Table to display Fakultas data -->
<div class="table-responsive">
  <table id="tablePagination" class="table table-bordered">
      <thead>
          <tr>
              <th scope="col">No</th>
              <th scope="col">Nama Fakultas</th>
              @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                <th scope="col">Aksi</th>
                
              @endif
          </tr>
      </thead>
      <tbody>
          @foreach($data as $index => $fakultas)
          <tr>
              <td>{{$index+1}}</td>
              <td>{{ $fakultas->name }}</td>
              @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
              <td>
                  <!-- Edit and Delete buttons (Optional) -->
                  <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $fakultas->id }}">
                      Edit
                  </button>
                  <!-- Delete Button -->
                  <form action="{{ route('fakultas.destroy', $fakultas->id) }}" method="POST" style="display:inline;" id="delete-form-{{ $fakultas->id }}">
                      @csrf
                      @method('DELETE')
                      <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $fakultas->id }})">Delete</button>
                  </form>
                
              </td>
                
              @endif
          </tr>
  
          <!-- Edit Modal (Optional, if you want to implement editing functionality) -->
          <div class="modal fade" id="editModal{{ $fakultas->id }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h1 class="modal-title fs-5" id="editModalLabel">Edit Fakultas</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                          <form id="editfakultasForm{{ $fakultas->id }}" action="{{ route('fakultas.update', $fakultas->id) }}" method="POST">
                              @csrf
                              @method('PUT')
                              <div class="mb-3">
                                  <input type="hidden" value="{{$fakultas->id}}" name="id">
                                  <label for="editfakultasName{{ $fakultas->id }}" class="form-label">Nama Fakultas</label>
                                  <input type="text" class="form-control" id="editfakultasName{{ $fakultas->id }}" name="name" value="{{ $fakultas->name }}" required>
                              </div>
                          </form>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                          <button type="submit" class="btn btn-primary" form="editfakultasForm{{ $fakultas->id }}">Submit</button>
                      </div>
                  </div>
              </div>
          </div>
          @endforeach
      </tbody>
  </table>

</div>

<script>
                  function confirmDelete(fakultasId) {
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
                              document.getElementById('delete-form-' + fakultasId).submit();
                          }
                      });
                  }
                  </script>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Fakultas</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Form to insert data into fakultasController -->
        <form id="fakultasForm" action="{{ route('fakultas.store') }}" method="POST">
          @csrf <!-- Include CSRF token for security -->
          <div class="mb-3">
            <label for="fakultasName" class="form-label">Nama Fakultas</label>
            <input type="text" class="form-control" id="fakultasName" name="name" required>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary" form="fakultasForm">Submit</button>
      </div>
    </div>
  </div>
</div>
@endsection