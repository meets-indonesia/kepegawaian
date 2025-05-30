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
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <h5 class="card-title">Jabatan Struktural</h5>
                        @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                            <button type="button" class="btn btn-success ms-auto mt-3" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">Tambah data</button>
                        @endif

                    </div>
                    <h6 class="card-subtitle mb-2 text-body-secondary">Jabatan Struktural</h6>

                </div>

                <div class="table-responsive">
                    <table id="tablePagination" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Masa</th>
                                <th>Eselon</th>
                                <th>Atasan</th>
                                @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                    <th>Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->masa }}</td>
                                    <td>{{ $item->eselon->name }}</td>
                                    <td>{{ $item->parent ? $item->parent->name : '-' }}</td>
                                    @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                        <td>
                                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#editModal-{{ $item->id }}">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            <form action="{{ route('jabatan-struktural.destroy', $item->id) }}"
                                                method="POST" style="display:inline;" id="delete-form-{{ $item->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger btn-sm"
                                                    onclick="confirmDelete({{ $item->id }})">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- Create Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Tambah Jabatan Struktural</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('jabatan-struktural.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Jabatan</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="masa" class="form-label">Masa Jabatan (tahun)</label>
                            <input type="number" class="form-control" id="masa" name="masa" required>
                        </div>
                        <div class="mb-3">
                            <label for="eselon_id" class="form-label">Eselon</label>
                            <select class="form-select" id="eselon_id" name="eselon_id" required>
                                <option value="">Pilih Eselon</option>
                                @foreach ($eselon as $e)
                                    <option value="{{ $e->id }}">{{ $e->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="parent_id" class="form-label">Atasan Langsung</label>
                            <select class="form-select" id="parent_id" name="parent_id">
                                <option value="">Tidak Ada</option>
                                @foreach ($data as $jabatan)
                                    <option value="{{ $jabatan->id }}">{{ $jabatan->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Modals -->
    <!-- Edit Modals -->
    @foreach ($data as $item)
        <div class="modal fade" id="editModal-{{ $item->id }}" tabindex="-1"
            aria-labelledby="editModalLabel-{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel-{{ $item->id }}">Edit Jabatan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('jabatan-struktural.update', $item->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="edit-name-{{ $item->id }}" class="form-label">Nama Jabatan</label>
                                <input type="text" class="form-control" id="edit-name-{{ $item->id }}"
                                    name="name" value="{{ $item->name }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="edit-masa-{{ $item->id }}" class="form-label">Masa Jabatan</label>
                                <input type="number" class="form-control" id="edit-masa-{{ $item->id }}"
                                    name="masa" value="{{ $item->masa }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="edit-eselon_id-{{ $item->id }}" class="form-label">Eselon</label>
                                <select class="form-select" id="edit-eselon_id-{{ $item->id }}" name="eselon_id"
                                    required>
                                    @foreach ($eselon as $e)
                                        <option value="{{ $e->id }}"
                                            {{ $item->eselon_id == $e->id ? 'selected' : '' }}>{{ $e->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="edit-parent_id-{{ $item->id }}" class="form-label">Atasan
                                    Langsung</label>
                                <select class="form-select" id="edit-parent_id-{{ $item->id }}" name="parent_id">
                                    <option value="">Tidak Ada</option>
                                    @foreach ($data->where('id', '!=', $item->id) as $jabatan)
<option value="{{ $jabatan->id }}" {{ $item->parent_id == $jabatan->id ? 'selected' : '' }}>{{ $jabatan->name }}</option>
@endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

@push('scripts')
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }

        // Dynamic select2 for parent selection
        $(document).ready(function() {
            $('#parent_id').select2({
                placeholder: 'Pilih Atasan Langsung',
                dropdownParent: $('#createModal')
            });

            // For edit modals
            @foreach ($data as $item)
                $('#edit-parent_id-{{ $item->id }}').select2({
                    placeholder: 'Pilih Atasan Langsung',
                    dropdownParent: $('#editModal-{{ $item->id }}')
                });
            @endforeach
        });
    </script>
@endpush
@endsection)
