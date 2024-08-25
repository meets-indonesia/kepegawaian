@extends('layouts.main_layout')

@section('content')
<div class="pagetitle">
    <h1>Riwayat Jabatan Fungsional</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
        <li class="breadcrumb-item">Riwayat Jabatan Fungsional</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <div class="card" style="width: 100%;">
  <div class="card-body">
      <div class="d-flex">
          <h5 class="card-title">Riwayat Jabatan Fungsional</h5>
          @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
            <button type="button" class="btn btn-success ms-auto mt-3" data-bs-toggle="modal" data-bs-target="#addModal">Tambah data</button>   
          @endif

      </div>
      <h6 class="card-subtitle mb-2 text-body-secondary">Riwayat Jabatan Fungsional</h6>
      
  </div>
</div>

<div class="container">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Pegawai</th>
                <th>Jabatan Fungsional</th>
                <th>Tahun Mulai</th>
                <th>Tahun Selesai</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->pegawai->name }}</td>
                    <td>{{ $item->jabatanFungsional->name }}</td>
                    <td>{{ $item->tahun_mulai }}</td>
                    <td>{{ $item->tahun_selesai ?? '-' }}</td>
                    <td>
                        <!-- Edit Button triggers the modal -->
                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}">
                            Edit
                        </button>
                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $item->id }})">Delete</button>

                        <form id="delete-form-{{ $item->id }}" action="{{ route('riwayat-jabatan-fungsional.destroy', $item->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>

                        <!-- Edit Modal -->
                        <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel{{ $item->id }}">Edit Riwayat Jabatan Fungsional</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('riwayat-jabatan-fungsional.update', $item->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')

                                            <div class="mb-3">
                                                <label for="tahun_mulai{{ $item->id }}" class="form-label">Tahun Mulai</label>
                                                <input type="number" name="tahun_mulai" class="form-control" id="tahun_mulai{{ $item->id }}" value="{{ $item->tahun_mulai }}" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="tahun_selesai{{ $item->id }}" class="form-label">Tahun Selesai</label>
                                                <input type="number" name="tahun_selesai" class="form-control" id="tahun_selesai{{ $item->id }}" value="{{ $item->tahun_selesai }}">
                                            </div>

                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End of Edit Modal -->
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Add New Riwayat Jabatan Fungsional</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('riwayat-jabatan-fungsional.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="pegawai_id" class="form-label">Pegawai</label>
                            <select name="pegawai_id" id="pegawai_id" class="form-select" required>
                                @foreach($pegawais as $pegawai)
                                    <option value="{{ $pegawai->id }}">{{ $pegawai->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="jabatan_fungsional_id" class="form-label">Jabatan Fungsional</label>
                            <select name="jabatan_fungsional_id" id="jabatan_fungsional_id" class="form-select" required>
                                @foreach($jabatanFungsionals as $jabatanFungsional)
                                    <option value="{{ $jabatanFungsional->id }}">{{ $jabatanFungsional->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="tahun_mulai" class="form-label">Tahun Mulai</label>
                            <input type="number" name="tahun_mulai" class="form-control" id="tahun_mulai" required>
                        </div>

                        <div class="mb-3">
                            <label for="tahun_selesai" class="form-label">Tahun Selesai</label>
                            <input type="number" name="tahun_selesai" class="form-control" id="tahun_selesai" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
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
    })
}
</script>
@endsection