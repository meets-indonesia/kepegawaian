@extends('layouts.main_layout')

@section('content')
<div class="pagetitle">
    <h1>Jabatan Struktural</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
        <li class="breadcrumb-item">Referensi</li>
        <li class="breadcrumb-item active">Jabatan Struktural</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <div class="card" style="width: 100%;">
  <div class="card-body">
      <div class="d-flex">
          <h5 class="card-title">Jabatan Struktural</h5>
          <button type="button" class="btn btn-success ms-auto mt-3" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah data</button>

      </div>
      <h6 class="card-subtitle mb-2 text-body-secondary">Jabatan Struktural</h6>
      
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Create Jabatan Struktural</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('jabatan-struktural.store') }}" method="POST">
        @csrf
        <div class="modal-body">
          <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
          </div>
          <div class="mb-3">
            <label for="masa" class="form-label">Masa</label>
            <input type="number" class="form-control" id="masa" name="masa" required>
          </div>
          <div class="mb-3">
            <label for="eselon_id" class="form-label">Eselon</label>
            <select class="form-select" id="eselon_id" name="eselon_id" required>
              @foreach($eselon as $e)
                <option value="{{ $e->id }}">{{ $e->name }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="table-responsive">
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Masa</th>
        <th>Eselon</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach($data as $key => $item)
      <tr>
        <td>{{ $key + 1 }}</td>
        <td>{{ $item->name }}</td>
        <td>{{ $item->masa }}</td>
        <td>{{ $item->eselon->name }}</td>
        <td>
          <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal-{{ $item->id }}">
            Edit
          </button>
          <form action="{{ route('jabatan-struktural.destroy', $item->id) }}" method="POST" style="display:inline;" id="delete-form-{{ $item->id }}">
            @csrf
            @method('DELETE')
            <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $item->id }})">
              Delete
            </button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>


<!-- Edit Modal -->
@foreach($data as $item)
<div class="modal fade" id="editModal-{{ $item->id }}" tabindex="-1" aria-labelledby="editModalLabel-{{ $item->id }}" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="editModalLabel-{{ $item->id }}">Edit Jabatan Struktural</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editForm-{{ $item->id }}" action="{{ route('jabatan-struktural.update', $item->id) }}" method="POST">
          @csrf
          @method('PUT')
          <div class="mb-3">
            <label for="edit-nama-{{ $item->id }}" class="form-label">Nama</label>
            <input type="text" class="form-control" id="edit-nama-{{ $item->id }}" name="name" value="{{ $item->name }}" required>
          </div>

          <div class="mb-3">
            <label for="edit-jabatan-struktural-{{ $item->id }}" class="form-label">Masa</label>
            <input type="number" class="form-control" id="edit-jabatan-struktural-{{ $item->id }}" name="masa" value="{{ $item->masa }}" required>
          </div>

          <div class="mb-3">
            <label for="edit_golongan_id-{{ $item->id }}" class="form-label">Jabatan Struktural</label>
            <select class="form-select" id="edit_golongan_id-{{ $item->id }}" name="eselon_id" required>
              @foreach($eselon as $option)
              <option value="{{ $option->id }}" {{ $item->eselon_id == $option->id ? 'selected' : '' }}>
                {{ $option->name }}
              </option>
              @endforeach
            </select>
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