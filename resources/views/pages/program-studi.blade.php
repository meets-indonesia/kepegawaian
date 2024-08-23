@extends('layouts.main_layout')

@section('content')
<div class="pagetitle">
    <h1>Program Studi</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
        <li class="breadcrumb-item">Settings</li>
        <li class="breadcrumb-item active">Program Studi</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <div class="card" style="width: 100%;">
  <div class="card-body">
      <div class="d-flex">
          <h5 class="card-title">Program Studi</h5>
          <button type="button" class="btn btn-success ms-auto mt-3" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah data</button>

      </div>
      <h6 class="card-subtitle mb-2 text-body-secondary">Program Studi</h6>
      
  </div>
</div>

<!-- Table to display Jurusan data -->
<table class="table table-bordered">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Program Studi</th>
            <th scope="col">Jurusan</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $index => $program_studi)
        <tr>
            <td>{{ $index+1 }}</td>
            <td>{{ $program_studi->name }}</td>
            <td>{{$program_studi->jurusan->name}}</td>
            <td>
                <!-- Edit and Delete buttons (Optional) -->
                <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $program_studi->id }}">
                    Edit
                </button>
                <form action="{{ route('program-studi.destroy', $program_studi->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this item?');">Delete</button>
                </form>
            </td>
        </tr>

        <!-- Edit Modal (Optional, if you want to implement editing functionality) -->
        <div class="modal fade" id="editModal{{ $program_studi->id }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editModalLabel">Edit Program Studi</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editprogram_studiForm{{ $program_studi->id }}" action="{{ route('program-studi.update', $program_studi->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <input type="hidden" value="{{$program_studi->id}}" name="id">
                                <label for="editprogram_studiName{{ $program_studi->id }}" class="form-label">Nama Program Studi</label>
                                <input type="text" class="form-control" id="editprogram_studiName{{ $program_studi->id }}" name="name" value="{{ $program_studi->name }}" required>
                            </div>
                            <div class="mb-3">
                              <label for="jurusanName" class="form-label">Nama Jurusan</label>
                              <select class="form-control" name="jurusan_id" required>
                                @foreach($jurusan as $item)
                                  <option value="{{ $item->id }}"
                                    @if ($program_studi->jurusan_id == $item->id)
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
                        <button type="submit" class="btn btn-primary" form="editprogram_studiForm{{ $program_studi->id }}">Submit</button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </tbody>
</table>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Program Studi</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Form to insert data into program_studiController -->
        <form id="program_studiForm" action="{{ route('program-studi.store') }}" method="POST">
          @csrf <!-- Include CSRF token for security -->
          <div class="mb-3">
            <label for="program_studiName" class="form-label">Nama Program Studi</label>
            <input type="text" class="form-control" id="program_studiName" name="name" required>
          </div>
          <div class="mb-3">
            <label for="jurusanName" class="form-label">Nama Jurusan</label>
            <select class="form-control" id="jurusan_id" name="jurusan_id" required>
              @foreach($jurusan as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
              @endforeach
            </select>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary" form="program_studiForm">Submit</button>
      </div>
    </div>
  </div>
</div>

@endsection