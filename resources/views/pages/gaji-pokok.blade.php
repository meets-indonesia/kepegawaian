@extends('layouts.main_layout')

@section('content')
<div class="pagetitle">
    <h1>Gaji Pokok</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
        <li class="breadcrumb-item">Referensi</li>
        <li class="breadcrumb-item active">Gaji Pokok</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <div class="card" style="width: 100%;">
  <div class="card-body">
      <div class="d-flex">
          <h5 class="card-title">Gaji Pokok</h5>
          <button type="button" class="btn btn-success ms-auto mt-3" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah data</button>

      </div>
      <h6 class="card-subtitle mb-2 text-body-secondary">Gaji Pokok</h6>
      
  </div>
</div>

<table class="table table-bordered">
  <thead>
    <tr>
      <th>No</th>
      <th>Golongan</th>
      <th>Masa Kerja</th>
      <th>Gaji Pokok</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    @foreach($data as $key => $item)
    <tr>
      <td>{{ $key + 1 }}</td>
      <td>{{ $item->golongan->name }}</td>
      <td>{{ $item->masa_kerja }}</td>
      <td>{{ $item->gaji_pokok }}</td>
      <td>
        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal-{{ $item->id }}">
          Edit
        </button>
        <form action="{{ route('gaji-pokok.destroy', $item->id) }}" method="POST" style="display:inline;">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');">
            Delete
          </button>
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

<!-- Edit Modal -->
@foreach($data as $item)
<div class="modal fade" id="editModal-{{ $item->id }}" tabindex="-1" aria-labelledby="editModalLabel-{{ $item->id }}" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="editModalLabel-{{ $item->id }}">Edit Gaji Pokok</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editForm-{{ $item->id }}" action="{{ route('gaji-pokok.update', $item->id) }}" method="POST">
          @csrf
          @method('PUT')
          <div class="mb-3">
            <label for="edit_golongan_id-{{ $item->id }}" class="form-label">Jabatan Struktural</label>
            <select class="form-select" id="edit_golongan_id-{{ $item->id }}" name="golongan_id" required>
              <option value="">Select Golongan</option>
              @foreach($golongan as $option)
              <option value="{{ $option->id }}" {{ $item->golongan_id == $option->id ? 'selected' : '' }}>
                {{ $option->name }}
              </option>
              @endforeach
            </select>
          </div>

          <div class="mb-3">
            <label for="edit-masa-kerja-{{ $item->id }}" class="form-label">Masa kerja</label>
            <input type="text" class="form-control" id="edit-masa-kerja-{{ $item->id }}" name="masa_kerja" value="{{ $item->masa_kerja }}" required>
          </div>

          <div class="mb-3">
            <label for="edit-gaji-pokok-{{ $item->id }}" class="form-label">Gaji pokok</label>
            <input type="number" class="form-control" id="edit-gaji-pokok-{{ $item->id }}" name="gaji_pokok" value="{{ $item->gaji_pokok }}" required>
          </div>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" form="editForm-{{ $item->id }}">Save changes</button>
      </div>
    </div>
  </div>
</div>
@endforeach


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Gaji Pokok</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="strukturForm" action="{{ route('gaji-pokok.store') }}" method="POST">
          @csrf
          <div class="mb-3">
            <label for="golongan_id" class="form-label">Golongan</label>
            <select class="form-select" id="golongan_id" name="golongan_id" required>
              @foreach($golongan as $item)
              <option value="{{ $item->id }}">{{ $item->name }}</option>
              @endforeach
            </select>
          </div>

          <div class="mb-3">
            <label for="masa_kerja" class="form-label">Masa kerja</label>
            <input type="text" class="form-control" id="masa_kerja" name="masa_kerja" required>
          </div>

          <div class="mb-3">
            <label for="gaji_pokok" class="form-label">Gaji pokok</label>
            <input type="number" class="form-control" id="gaji_pokok" name="gaji_pokok" required>
          </div>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" form="strukturForm">Submit</button>
      </div>
    </div>
  </div>
</div>
@endsection