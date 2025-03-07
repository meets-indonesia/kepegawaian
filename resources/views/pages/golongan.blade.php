@extends('layouts.main_layout')

@section('content')
<div class="pagetitle">
    <h1>Golongan</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
        <li class="breadcrumb-item">Referensi</li>
        <li class="breadcrumb-item active">Golongan</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <div class="card" style="width: 100%;">
  <div class="card-body">
      <div class="d-flex">
          <h5 class="card-title">Golongan</h5>
          @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
            <button type="button" class="btn btn-success ms-auto mt-3" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah data</button>   
          @endif

      </div>
      <h6 class="card-subtitle mb-2 text-body-secondary">Golongan</h6>
      
  </div>
</div>

<!-- Table to display Golongan data -->
<table id="tablePagination" class="table table-bordered">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Nama Golongan</th>
            <th scope="col">Golongan</th>
            @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
              
            <th scope="col">Aksi</th>
            @endif
        </tr>
    </thead>
    <tbody>
        @foreach($data as $index => $golongan)
        <tr>
            <td>{{$index+1}}</td>
            <td>{{ $golongan->name }}</td>
            <td>{{ $golongan->golongan }}</td>
            @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
            <td>
                <!-- Edit and Delete buttons (Optional) -->
                <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $golongan->id }}">
                    Edit
                </button>
                <form action="{{ route('golongan.destroy', $golongan->id) }}" method="POST" style="display:inline;" id="delete-form-{{ $golongan->id }}">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $golongan->id }})">Delete</button>
                </form>
            </td>
              
            @endif
        </tr>

        <!-- Edit Modal (Optional, if you want to implement editing functionality) -->
        <div class="modal fade" id="editModal{{ $golongan->id }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editModalLabel">Edit Golongan</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editgolonganForm{{ $golongan->id }}" action="{{ route('golongan.update', $golongan->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <input type="hidden" value="{{$golongan->id}}" name="id">
                                <label for="editgolonganName{{ $golongan->id }}" class="form-label">Nama Golongan</label>
                                <input type="text" class="form-control" id="editgolonganName{{ $golongan->id }}" name="name" value="{{ $golongan->name }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="editgolonganType{{ $golongan->id }}" class="form-label">Nama Golongan</label>
                                <input type="number" class="form-control" id="editgolonganType{{ $golongan->id }}" name="golongan" value="{{ $golongan->golongan }}" required>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" form="editgolonganForm{{ $golongan->id }}">Submit</button>
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
        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Golongan</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Form to insert data into golonganController -->
        <form id="golonganForm" action="{{ route('golongan.store') }}" method="POST">
          @csrf <!-- Include CSRF token for security -->
          <div class="mb-3">
            <label for="golonganName" class="form-label">Nama Golongan</label>
            <input type="text" class="form-control" id="golonganName" name="name" required>
          </div>
          <div class="mb-3">
            <label for="golonganType" class="form-label">Golongan</label>
            <input type="number" class="form-control" id="golonganType" name="golongan" required>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary" form="golonganForm">Submit</button>
      </div>
    </div>
  </div>
</div>

<script>
function confirmDelete(golonganId) {
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
            document.getElementById('delete-form-' + golonganId).submit();
        }
    });
}
</script>
@endsection