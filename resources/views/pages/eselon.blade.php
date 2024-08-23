@extends('layouts.main_layout')

@section('content')
<div class="pagetitle">
    <h1>Eselon</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
        <li class="breadcrumb-item">Referensi</li>
        <li class="breadcrumb-item active">Eselon</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <div class="card" style="width: 100%;">
  <div class="card-body">
      <div class="d-flex">
          <h5 class="card-title">Eselon</h5>
          <button type="button" class="btn btn-success ms-auto mt-3" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah data</button>

      </div>
      <h6 class="card-subtitle mb-2 text-body-secondary">Eselon</h6>
      
  </div>
</div>

<table id="tablePagination" class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Name</th>
      @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
        <th scope="col">Actions</th>    
      @endif
    </tr>
  </thead>
  <tbody>
    @foreach($data as $index => $eselon)
    <tr>
      <th scope="row">{{ $index + 1 }}</th>
      <td>{{ $eselon->name }}</td>
      @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
        <td>
          <!-- Edit Button -->
          <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $eselon->id }}">
            Edit
          </button>
        
          <!-- Delete Form -->
          <form action="{{ route('eselon.destroy', $eselon->id) }}" method="POST" style="display:inline;" id="delete-form-{{ $eselon->id }}">
            @csrf
            @method('DELETE')
            <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $eselon->id }})">
              Delete
            </button>
          </form>
        </td>
      @endif
      </tr>
      @endforeach
      </tbody>
      
      <script>
      function confirmDelete(eselonId) {
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
                  document.getElementById('delete-form-' + eselonId).submit();
              }
          });
      }
      </script>
</table>

@foreach($data as $eselon)
<div class="modal fade" id="editModal{{ $eselon->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $eselon->id }}" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="editModalLabel{{ $eselon->id }}">Edit Eselon</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('eselon.update', $eselon->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-body">
          <div class="mb-3">
            <label for="name{{ $eselon->id }}" class="form-label">Name</label>
            <input type="text" class="form-control" id="name{{ $eselon->id }}" name="name" value="{{ $eselon->name }}" required>
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

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Eselon</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('eselon.store') }}" method="POST">
      <div class="modal-body">
        <!-- Form for adding a new Eselon -->
          @csrf
          <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
          </div>
          <!-- Add any additional fields here if needed -->
          
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection