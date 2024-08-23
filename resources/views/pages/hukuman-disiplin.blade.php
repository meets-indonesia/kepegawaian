@extends('layouts.main_layout')

@section('content')
<div class="pagetitle">
    <h1>Hukuman Disiplin</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
        <li class="breadcrumb-item">Referensi</li>
        <li class="breadcrumb-item active">Hukuman Disiplin</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <div class="card" style="width: 100%;">
  <div class="card-body">
      <div class="d-flex">
          <h5 class="card-title">Hukuman Disiplin</h5>
          <button type="button" class="btn btn-success ms-auto mt-3" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah data</button>

      </div>
      <h6 class="card-subtitle mb-2 text-body-secondary">Hukuman Disiplin</h6>
      
  </div>
</div>

<!-- Table to Display Data -->
<div class="table-responsive">
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
      @foreach($data as $item)
      <tr>
        <th scope="row">{{ $loop->iteration }}</th>
        <td>{{ $item->name }}</td>
        @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
        <td>
          <!-- Edit Button triggers the specific modal -->
          <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}">Edit</button>
          <form action="{{ route('hukuman-disiplin.destroy', $item->id) }}" method="POST" style="display:inline;" id="delete-form-{{ $item->id }}">
            @csrf
            @method('DELETE')
            <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $item->id }})">Delete</button>
          </form>
        </td>
          
        @endif
      </tr>
  
      <!-- Edit Modal for each item -->
      <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="editModalLabel{{ $item->id }}">Edit Hukuman Disiplin</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form method="POST" action="{{ route('hukuman-disiplin.update', $item->id) }}">
                @csrf
                @method('PUT')
                <div class="mb-3">
                  <label for="editName{{ $item->id }}" class="form-label">Name</label>
                  <input type="text" class="form-control" id="editName{{ $item->id }}" name="name" value="{{ $item->name }}" required>
                </div>
                <button type="submit" class="btn btn-primary">Save changes</button>
              </form>
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
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Hukuman Disiplin</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('hukuman-disiplin.store') }}" method="POST">
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