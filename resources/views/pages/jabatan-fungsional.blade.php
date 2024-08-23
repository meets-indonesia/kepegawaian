@extends('layouts.main_layout')

@section('content')
<div class="pagetitle">
    <h1>Jabatan Fungsional</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
        <li class="breadcrumb-item">Referensi</li>
        <li class="breadcrumb-item active">Jabatan Fungsional</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <div class="card" style="width: 100%;">
  <div class="card-body">
      <div class="d-flex">
          <h5 class="card-title">Jabatan Fungsional</h5>
          <button type="button" class="btn btn-success ms-auto mt-3" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah data</button>

      </div>
      <h6 class="card-subtitle mb-2 text-body-secondary">Jabatan Fungsional</h6>
      
  </div>
</div>

<div class="table-responsive">
  <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">No</th>
        <th scope="col">Nama</th>
        <th scope="col">Masa</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach($data as $index => $item)
      <tr>
        <th scope="row">{{ $index + 1 }}</th>
        <td>{{ $item->name }}</td>
        <td>{{ $item->masa }}</td>
        <td>
          <!-- Edit Button -->
          <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}">
            Edit
          </button>
  
          <!-- Delete Button -->
          <form action="{{ route('jabatan-fungsional.destroy', $item->id) }}" method="POST" style="display:inline-block;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this item?');">
              Delete
            </button>
          </form>
        </td>
      </tr>
  
      <!-- Edit Modal -->
      <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="editModalLabel{{ $item->id }}">Edit Jabatan Fungsional</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="{{ route('jabatan-fungsional.update', $item->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                  <label for="name{{ $item->id }}" class="form-label">Nama</label>
                  <input type="hidden" name="id" value="{{$item->id}}">
                  <input type="text" class="form-control" id="name{{ $item->id }}" name="name" value="{{ $item->name }}" required>
                </div>
                <div class="mb-3">
                  <label for="masa{{ $item->id }}" class="form-label">Description</label>
                  <input type="number" class="form-control" id="masa{{ $item->id }}" name="masa" value="{{ $item->masa }}" required />
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
  
      @endforeach
    </tbody>
  </table>
</div>


<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Create Jabatan Fungsional</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="jabatanFungsionalForm" action="{{ route('jabatan-fungsional.store') }}" method="POST">
          @csrf
          <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" class="form-control" id="name" name="name" required>
          </div>
          <div class="mb-3">
            <label for="masa" class="form-label">Description</label>
            <input type="number" class="form-control" id="masa" name="masa"></input>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" form="jabatanFungsionalForm" class="btn btn-primary">Submit</button>
      </div>
    </div>
  </div>
</div>

@endsection