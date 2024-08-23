@extends('layouts.main_layout')

@section('content')
<div class="pagetitle">
    <h1>Lokasi Kerja</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
        <li class="breadcrumb-item">Referensi</li>
        <li class="breadcrumb-item active">Lokasi Kerja</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <div class="card" style="width: 100%;">
  <div class="card-body">
      <div class="d-flex">
          <h5 class="card-title">Lokasi Kerja</h5>
          <button type="button" class="btn btn-success ms-auto mt-3" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah data</button>

      </div>
      <h6 class="card-subtitle mb-2 text-body-secondary">Lokasi Kerja</h6>
      
  </div>
</div>

<div class="table-responsive">
  <table class="table">
    <thead>
      <tr>
        <th scope="col">No</th>
        <th scope="col">Name</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach($data as $index => $lokasi)
      <tr>
        <th scope="row">{{ $index + 1 }}</th>
        <td>{{ $lokasi->name }}</td>
        <td>
          <!-- Edit Button -->
          <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $lokasi->id }}">
            Edit
          </button>

          <!-- Delete Form -->
          <form action="{{ route('lokasi-kerja.destroy', $lokasi->id) }}" method="POST" style="display:inline;" id="delete-form-{{ $lokasi->id }}">
            @csrf
            @method('DELETE')
            <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $lokasi->id }})">
              Delete
            </button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

@foreach($data as $lokasi)
<div class="modal fade" id="editModal{{ $lokasi->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $lokasi->id }}" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="editModalLabel{{ $lokasi->id }}">Edit Lokasi Kerja</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('lokasi-kerja.update', $lokasi->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-body">
          <div class="mb-3">
            <label for="name{{ $lokasi->id }}" class="form-label">Name</label>
            <input type="text" class="form-control" id="name{{ $lokasi->id }}" name="name" value="{{ $lokasi->name }}" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endforeach


<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Lokasi Kerja</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('lokasi-kerja.store') }}" method="POST">
        @csrf
        <div class="modal-body">
          <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
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