@extends('layouts.main_layout')

@section('content')
<div class="pagetitle">
    <h1>Grade</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
        <li class="breadcrumb-item">Referensi</li>
        <li class="breadcrumb-item active">Grade</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <div class="card" style="width: 100%;">
  <div class="card-body">
      <div class="d-flex">
          <h5 class="card-title">Grade</h5>
          <button type="button" class="btn btn-success ms-auto mt-3" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah data</button>

      </div>
      <h6 class="card-subtitle mb-2 text-body-secondary">Grade</h6>
      
  </div>
</div>

  <!-- Grades Table -->
   <div class="table-responsive">
     <table class="table table-bordered">
       <thead>
         <tr>
          <th>No</th>
           <th>Name</th>
           <th>Value</th>
           <th>Jabatan Fungsional</th>
           <th>Jabatan Struktural</th>
           <th>Pendidikan</th>
           <th>Kelompok Pegawai</th>
           <th>Unit Kerja</th>
           <th>Actions</th>
         </tr>
       </thead>
       <tbody>
         @foreach($data as $index => $item)
         <tr>
            <td>{{$index+1}}</td>
           <td>{{ $item->name }}</td>
           <td>{{ $item->value }}</td>
           <td>{{ $item->jabatanFungsional->name }}</td>
           <td>{{ $item->jabatanStruktural->name }}</td>
           <td>{{ $item->pendidikan->name }}</td>
           <td>{{ $item->kelompokPegawai->name }}</td>
           <td>{{ $item->unitKerja->name }}</td>
           <td>
             <!-- Edit Button -->
             <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editGradeModal{{ $item->id }}">
               Edit
             </button>
   
             <!-- Delete Button -->
             <form action="{{ route('grade.destroy', $item->id) }}" method="POST" style="display:inline;">
               @csrf
               @method('DELETE')
               <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this item?');">Delete</button>
             </form>
           </td>
         </tr>
   
         <!-- Edit Grade Modal -->
         <div class="modal fade" id="editGradeModal{{ $item->id }}" tabindex="-1" aria-labelledby="editGradeModalLabel{{ $item->id }}" aria-hidden="true">
           <div class="modal-dialog">
             <div class="modal-content">
               <div class="modal-header">
                 <h1 class="modal-title fs-5" id="editGradeModalLabel{{ $item->id }}">Edit Grade</h1>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <form action="{{ route('grade.update', $item->id) }}" method="POST">
                 @csrf
                 @method('PUT')
                 <div class="modal-body">
                   <div class="mb-3">
                     <label for="name{{ $item->id }}" class="form-label">Name</label>
                     <input type="text" class="form-control" id="name{{ $item->id }}" name="name" value="{{ $item->name }}" required>
                   </div>
                   <div class="mb-3">
                     <label for="value{{ $item->id }}" class="form-label">Value</label>
                     <input type="text" class="form-control" id="value{{ $item->id }}" name="value" value="{{ $item->value }}" required>
                   </div>
                   <div class="mb-3">
                     <label for="jabatan_fungsional_id{{ $item->id }}" class="form-label">Jabatan Fungsional</label>
                     <select class="form-select" id="jabatan_fungsional_id{{ $item->id }}" name="jabatan_fungsional_id" required>
                       @foreach($jabatanFungsional as $jf)
                       <option value="{{ $jf->id }}" {{ $item->jabatan_fungsional_id == $jf->id ? 'selected' : '' }}>
                         {{ $jf->name }}
                       </option>
                       @endforeach
                     </select>
                   </div>
                   <div class="mb-3">
                     <label for="jabatan_struktural_id{{ $item->id }}" class="form-label">Jabatan Struktural</label>
                     <select class="form-select" id="jabatan_struktural_id{{ $item->id }}" name="jabatan_struktural_id" required>
                       @foreach($jabatanStruktural as $js)
                       <option value="{{ $js->id }}" {{ $item->jabatan_struktural_id == $js->id ? 'selected' : '' }}>
                         {{ $js->name }}
                       </option>
                       @endforeach
                     </select>
                   </div>
                   <div class="mb-3">
                     <label for="pendidikan_id{{ $item->id }}" class="form-label">Pendidikan</label>
                     <select class="form-select" id="pendidikan_id{{ $item->id }}" name="pendidikan_id" required>
                       @foreach($pendidikan as $pd)
                       <option value="{{ $pd->id }}" {{ $item->pendidikan_id == $pd->id ? 'selected' : '' }}>
                         {{ $pd->name }}
                       </option>
                       @endforeach
                     </select>
                   </div>
                   <div class="mb-3">
                     <label for="kelompok_pegawai_id{{ $item->id }}" class="form-label">Kelompok Pegawai</label>
                     <select class="form-select" id="kelompok_pegawai_id{{ $item->id }}" name="kelompok_pegawai_id" required>
                       @foreach($kelompokPegawai as $kp)
                       <option value="{{ $kp->id }}" {{ $item->kelompok_pegawai_id == $kp->id ? 'selected' : '' }}>
                         {{ $kp->name }}
                       </option>
                       @endforeach
                     </select>
                   </div>
                   <div class="mb-3">
                     <label for="unit_kerja_id{{ $item->id }}" class="form-label">Unit Kerja</label>
                     <select class="form-select" id="unit_kerja_id{{ $item->id }}" name="unit_kerja_id" required>
                       @foreach($unitKerja as $uk)
                       <option value="{{ $uk->id }}" {{ $item->unit_kerja_id == $uk->id ? 'selected' : '' }}>
                         {{ $uk->name }}
                       </option>
                       @endforeach
                     </select>
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
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Grade</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('grade.store') }}" method="POST">
        @csrf
        <div class="modal-body">
          <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
          </div>
          <div class="mb-3">
            <label for="value" class="form-label">Value</label>
            <input type="text" class="form-control" id="value" name="value" required>
          </div>
          <div class="mb-3">
            <label for="jabatan_fungsional_id" class="form-label">Jabatan Fungsional</label>
            <select class="form-select" id="jabatan_fungsional_id" name="jabatan_fungsional_id" required>
              @foreach($jabatanFungsional as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label for="jabatan_struktural_id" class="form-label">Jabatan Struktural</label>
            <select class="form-select" id="jabatan_struktural_id" name="jabatan_struktural_id" required>
              @foreach($jabatanStruktural as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label for="pendidikan_id" class="form-label">Pendidikan</label>
            <select class="form-select" id="pendidikan_id" name="pendidikan_id" required>
              @foreach($pendidikan as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label for="kelompok_pegawai_id" class="form-label">Kelompok Pegawai</label>
            <select class="form-select" id="kelompok_pegawai_id" name="kelompok_pegawai_id" required>
              @foreach($kelompokPegawai as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label for="unit_kerja_id" class="form-label">Unit Kerja</label>
            <select class="form-select" id="unit_kerja_id" name="unit_kerja_id" required>
              @foreach($unitKerja as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
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

@endsection