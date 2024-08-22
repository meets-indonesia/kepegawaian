@extends('layouts.main_layout')

@section('content')
<div class="pagetitle">
    <h1>Struktur</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
        <li class="breadcrumb-item">Referensi</li>
        <li class="breadcrumb-item active">Struktur</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <div class="card" style="width: 100%;">
  <div class="card-body">
      <div class="d-flex">
          <h5 class="card-title">Struktur</h5>
          <button type="button" class="btn btn-success ms-auto mt-3" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah data</button>

      </div>
      <h6 class="card-subtitle mb-2 text-body-secondary">Struktur</h6>
      
  </div>
</div>

<table class="table table-bordered">
  <thead>
    <tr>
      <th>No</th>
      <th>Jabatan Struktural</th>
      <th>Jabatan Fungsional</th>
      <th>Grade</th>
      <th>Eselon</th>
      <th>Parent Struktur</th>
      <th>JV</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    @foreach($data as $key => $item)
    <tr>
      <td>{{ $key + 1 }}</td>
      <td>{{ $item->jabatan_struktural->name }}</td>
      <td>{{ $item->jabatan_fungsional ? $item->jabatan_fungsional->name : '-' }}</td>
      <td>{{ $item->grade->name }}</td>
      <td>{{ $item->eselon->name }}</td>
      <td>{{ $item->parent ? $item->parent->jabatan_struktural->name : '-' }}</td>
      <td>{{ $item->jv }}</td>
      <td>
        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal-{{ $item->id }}">
          Edit
        </button>
        <form action="{{ route('struktur.destroy', $item->id) }}" method="POST" style="display:inline;">
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
        <h1 class="modal-title fs-5" id="editModalLabel-{{ $item->id }}">Edit Struktur</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editForm-{{ $item->id }}" action="{{ route('struktur.update', $item->id) }}" method="POST">
          @csrf
          @method('PUT')
          <div class="mb-3">
            <label for="edit_jabatan_struktural_id-{{ $item->id }}" class="form-label">Jabatan Struktural</label>
            <select class="form-select" id="edit_jabatan_struktural_id-{{ $item->id }}" name="jabatan_struktural_id" required>
              <option value="">Select Jabatan Struktural</option>
              @foreach($jabatan_struktural as $option)
              <option value="{{ $option->id }}" {{ $item->jabatan_struktural_id == $option->id ? 'selected' : '' }}>
                {{ $option->name }}
              </option>
              @endforeach
            </select>
          </div>

          <div class="mb-3">
            <label for="edit_jabatan_fungsional_id-{{ $item->id }}" class="form-label">Jabatan Fungsional</label>
            <select class="form-select" id="edit_jabatan_fungsional_id-{{ $item->id }}" name="jabatan_fungsional_id">
              <option value="">Select Jabatan Fungsional</option>
              @foreach($jabatan_fungsional as $option)
              <option value="{{ $option->id }}" {{ $item->jabatan_fungsional_id == $option->id ? 'selected' : '' }}>
                {{ $option->name }}
              </option>
              @endforeach
            </select>
          </div>

          <div class="mb-3">
            <label for="edit_grade_id-{{ $item->id }}" class="form-label">Grade</label>
            <select class="form-select" id="edit_grade_id-{{ $item->id }}" name="grade_id" required>
              <option value="">Select Grade</option>
              @foreach($grade as $option)
              <option value="{{ $option->id }}" {{ $item->grade_id == $option->id ? 'selected' : '' }}>
                {{ $option->name }}
              </option>
              @endforeach
            </select>
          </div>

          <div class="mb-3">
            <label for="edit_eselon_id-{{ $item->id }}" class="form-label">Eselon</label>
            <select class="form-select" id="edit_eselon_id-{{ $item->id }}" name="eselon_id" required>
              <option value="">Select Eselon</option>
              @foreach($eselon as $option)
              <option value="{{ $option->id }}" {{ $item->eselon_id == $option->id ? 'selected' : '' }}>
                {{ $option->name }}
              </option>
              @endforeach
            </select>
          </div>

          <div class="mb-3">
            <label for="edit_parent_id-{{ $item->id }}" class="form-label">Parent Struktur</label>
            <select class="form-select" id="edit_parent_id-{{ $item->id }}" name="parent_id">
              <option value="">Select Parent Struktur</option>
              @foreach($parent as $option)
              <option value="{{ $option->id }}" {{ $item->parent_id == $option->id ? 'selected' : '' }}>
                {{ $option->jabatan_struktural->name }}
              </option>
              @endforeach
            </select>
          </div>

          <div class="mb-3">
            <label for="edit_jv-{{ $item->id }}" class="form-label">JV</label>
            <input type="number" class="form-control" id="edit_jv-{{ $item->id }}" name="jv" value="{{ $item->jv }}" required>
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
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Struktur</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="strukturForm" action="{{ route('struktur.store') }}" method="POST">
          @csrf
          <div class="mb-3">
            <label for="jabatan_struktural_id" class="form-label">Jabatan Struktural</label>
            <select class="form-select" id="jabatan_struktural_id" name="jabatan_struktural_id" required>
              @foreach($jabatan_struktural as $item)
              <option value="{{ $item->id }}">{{ $item->name }}</option>
              @endforeach
            </select>
          </div>

          <div class="mb-3">
            <label for="jabatan_fungsional_id" class="form-label">Jabatan Fungsional</label>
            <select class="form-select" id="jabatan_fungsional_id" name="jabatan_fungsional_id">
              @foreach($jabatan_fungsional as $item)
              <option value="{{ $item->id }}">{{ $item->name }}</option>
              @endforeach
            </select>
          </div>

          <div class="mb-3">
            <label for="grade_id" class="form-label">Grade</label>
            <select class="form-select" id="grade_id" name="grade_id" required>
              @foreach($grade as $item)
              <option value="{{ $item->id }}">{{ $item->name }}</option>
              @endforeach
            </select>
          </div>

          <div class="mb-3">
            <label for="eselon_id" class="form-label">Eselon</label>
            <select class="form-select" id="eselon_id" name="eselon_id" required>
              @foreach($eselon as $item)
              <option value="{{ $item->id }}">{{ $item->name }}</option>
              @endforeach
            </select>
          </div>

          <div class="mb-3">
            <label for="parent_id" class="form-label">Parent Struktur</label>
            <select class="form-select" id="parent_id" name="parent_id">
              @foreach($parent as $item)
              <option value="{{ $item->id }}">{{ $item->jabatan_struktural->name }}</option>
              @endforeach
            </select>
          </div>

          <div class="mb-3">
            <label for="jv" class="form-label">JV</label>
            <input type="number" class="form-control" id="jv" name="jv" required>
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