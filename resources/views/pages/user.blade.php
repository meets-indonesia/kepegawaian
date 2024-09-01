@extends('layouts.main_layout')

@section('content')
<div class="pagetitle">
    <h1>User</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
        <li class="breadcrumb-item">Settings</li>
        <li class="breadcrumb-item active">User</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <div class="card" style="width: 100%;">
  <div class="card-body">
      <div class="d-flex">
          <h5 class="card-title">User</h5>
          @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
            <button type="button" class="btn btn-success ms-auto mt-3" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah data</button>   
          @endif

      </div>
      <h6 class="card-subtitle mb-2 text-body-secondary">User</h6>
      
  </div>
</div>

<div class="d-flex w-100">
  @if (isset($search))
  <p class="text-dark-blue fw-bold">Searching for "{{$search}}"</p>
    
  @endif
  <form action="{{route('user.index')}}" class="w-100">
    <div class="input-group mb-3 w-50 ms-auto">
      <input type="text" class="form-control" placeholder="Search here" aria-label="Search here" aria-describedby="button-addon2" name="search">
      <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Search</button>
    </div>
  
  </form>

</div>

<div class="table-responsive">
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Username</th>
        <th>Email</th>
        <th>Role</th>
        @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
        <th>Actions</th>
          
        @endif
      </tr>
    </thead>
    <tbody>
      @foreach($data as $index => $user)
      <tr>
        <td>{{ $user->username }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->role->name }}</td>
        @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
        <td>
          <!-- Edit Button -->
          <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $user->id }}">
            Edit
          </button>
  
          <!-- Delete Button -->
          <form action="{{ route('user.destroy', $user->id) }}" method="POST" style="display:inline-block;" id="delete-form-{{ $user->id }}">
            @csrf
            @method('DELETE')
            <input type="hidden" value="{{$user->id}}" name="id" />
            <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $user->id }})">Delete</button>
          </form>
        </td>
          
        @endif
      </tr>
  
      <!-- Edit Modal -->
      <div class="modal fade" id="editModal{{ $user->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $user->id }}" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="editModalLabel{{ $user->id }}">Edit User</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('user.update', $user->id) }}" method="POST">
              @csrf
              @method('PUT')
              <div class="modal-body">
                <input type="hidden" name="id" value="{{ $user->id }}">
                <div class="mb-3">
                  <label for="username{{ $user->id }}" class="form-label">Username</label>
                  <input type="text" class="form-control" id="username{{ $user->id }}" name="username" value="{{ $user->username }}" required>
                </div>
                <div class="mb-3">
                  <label for="email{{ $user->id }}" class="form-label">Email</label>
                  <input type="email" class="form-control" id="email{{ $user->id }}" name="email" value="{{ $user->email }}" required>
                </div>
                <div class="mb-3">
                  <label for="password{{ $user->id }}" class="form-label">Password</label>
                  <input type="password" class="form-control" id="password{{ $user->id }}" name="password">
                </div>
                <div class="mb-3">
                  <label for="role_id{{ $user->id }}" class="form-label">Role</label>
                  <select class="form-select" id="role_id{{ $user->id }}" name="role_id" required>
                    @foreach($roles as $role)
                      <option value="{{ $role->id }}" @if($role->id == $user->role_id) selected @endif>{{ $role->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save Changes</button>
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
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add New User</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('user.store') }}" method="POST">
        @csrf
        <div class="modal-body">
          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" required>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
          </div>
          <div class="mb-3">
            <label for="role_id" class="form-label">Role</label>
            <select class="form-select" id="role_id" name="role_id" required>
              @foreach($roles as $role)
                <option value="{{ $role->id }}">{{ $role->name }}</option>
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
<div class="mb-3"></div>
{{ $data->links() }}
@endsection