@extends('layouts.main_layout')

@section('content')
<div class="pagetitle">
    <h1>Pendidikan</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
        <li class="breadcrumb-item">Referensi</li>
        <li class="breadcrumb-item active">Pendidikan</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <div class="card" style="width: 100%;">
  <div class="card-body">
      <div class="d-flex">
          <h5 class="card-title">Pendidikan</h5>
          @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
            <button type="button" class="btn btn-success ms-auto mt-3" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah data</button>   
          @endif

      </div>
      <h6 class="card-subtitle mb-2 text-body-secondary">Pendidikan</h6>
      
  </div>
</div>

<div class="table-responsive">
<table id="tablePagination" class="table">
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
        @foreach($data as $index => $pendidikan)
        <tr>
            <th scope="row">{{ $index + 1 }}</th>
            <td>{{ $pendidikan->name }}</td>
            @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
            <td>
                <!-- Edit Button -->
                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $pendidikan->id }}">
                    Edit
                </button>

                <!-- Delete Form -->
                <form action="{{ route('pendidikan.destroy', $pendidikan->id) }}" method="POST" style="display:inline;" id="delete-form-{{ $pendidikan->id }}">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $pendidikan->id }})">
                        Delete
                    </button>
                </form>
            </td>
              
            @endif
        </tr>

        <!-- Edit Modal -->
        <div class="modal fade" id="editModal{{ $pendidikan->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $pendidikan->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editModalLabel{{ $pendidikan->id }}">Edit Pendidikan</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('pendidikan.update', $pendidikan->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="name{{ $pendidikan->id }}" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name{{ $pendidikan->id }}" name="name" value="{{ $pendidikan->name }}" required>
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
    </tbody>
</table>

</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Pendidikan</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('pendidikan.store') }}" method="POST">
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