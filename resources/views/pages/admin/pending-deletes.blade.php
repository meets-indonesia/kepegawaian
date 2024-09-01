@extends('layouts.main_layout')

@section('content')
    <div class="pagetitle">
        <h1>Pending Deletes</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                <li class="breadcrumb-item">Super Admin</li>
                <li class="breadcrumb-item active">Pending Deletes</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="card" style="width: 100%;">
        <div class="card-body">
            <div class="d-flex">
                <h5 class="card-title">Pending Deletes</h5>
            </div>
            <h6 class="card-subtitle mb-2 text-body-secondary">Pending Deletes</h6>
            @if (count($deletes) > 0)
                <table id="tablePagination" class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Type</th>
                            <th>Requested By</th>
                            <th>Requested At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($deletes as $delete)
                            <tr>
                                <td>{{ $delete['id'] }}</td>
                                <td>{{ $delete['type'] }}</td>
                                @if ($delete['requested_by'] == 2)
                                    <td>Admin</td>
                                @endif
                                <td>{{ \Carbon\Carbon::parse($delete['requested_at'])->format('d M Y H:i') }}</td>
                                <td>
                                    <a href="/verify-delete/{{ $delete['id'] }}" class="btn btn-success btn-sm">Approve</a>
                                    <a href="/reject-delete/{{ $delete['id'] }}" class="btn btn-danger btn-sm">Reject</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-center">No pending updates available.</p>
            @endif
        </div>
    </div>


@endsection
