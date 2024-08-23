@extends('layouts.main_layout')

@section('content')
<div class="pagetitle">
    <h1>Unit Kerja</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
        <li class="breadcrumb-item">Settings</li>
        <li class="breadcrumb-item active">Unit Kerja</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <div class="card" style="width: 100%;">
  <div class="card-body">
      <div class="d-flex">
          <h5 class="card-title">Unit Kerja</h5>
          <button type="button" class="btn btn-success ms-auto mt-3" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah data</button>

      </div>
      <h6 class="card-subtitle mb-2 text-body-secondary">Unit kerja</h6>
      
  </div>
</div>

<!-- Table to display Unit Kerja data -->
<table id="tablePagination" class="table table-bordered">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Nama Unit Kerja</th>
            @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
            <th scope="col">Aksi</th>
              
            @endif
        </tr>
    </thead>
    <tbody>
        @foreach($data as $index => $unitKerja)
        <tr>
            <td>{{ $index+1 }}</td>
            <td>{{ $unitKerja->name }}</td>
            @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
            <td>
                <!-- Edit and Delete buttons (Optional) -->
                <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $unitKerja->id }}">
                    Edit
                </button>
                <form action="{{ route('unit-kerja.destroy', $unitKerja->id) }}" method="POST" style="display:inline;" id="delete-form-{{ $unitKerja->id }}">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $unitKerja->id }})">Delete</button>
                </form>
            </td>
              
            @endif
        </tr>

        <!-- Edit Modal (Optional, if you want to implement editing functionality) -->
        <div class="modal fade" id="editModal{{ $unitKerja->id }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editModalLabel">Edit Unit Kerja</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editUnitKerjaForm{{ $unitKerja->id }}" action="{{ route('unit-kerja.update', $unitKerja->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <input type="hidden" value="{{$unitKerja->id}}" name="id">
                                <label for="editUnitKerjaName{{ $unitKerja->id }}" class="form-label">Nama Unit Kerja</label>
                                <input type="text" class="form-control" id="editUnitKerjaName{{ $unitKerja->id }}" name="name" value="{{ $unitKerja->name }}" required>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" form="editUnitKerjaForm{{ $unitKerja->id }}">Submit</button>
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
        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Unit Kerja</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Form to insert data into UnitKerjaController -->
        <form id="unitKerjaForm" action="{{ route('unit-kerja.store') }}" method="POST">
          @csrf <!-- Include CSRF token for security -->
          <div class="mb-3">
            <label for="unitKerjaName" class="form-label">Nama Unit Kerja</label>
            <input type="text" class="form-control" id="unitKerjaName" name="name" required>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary" form="unitKerjaForm">Submit</button>
      </div>
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