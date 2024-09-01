@extends('layouts.main_layout')

@section('content')
    <div class="pagetitle">
        <h1>Pending Updates</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                <li class="breadcrumb-item">Super Admin</li>
                <li class="breadcrumb-item active">Pending Updates</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="card" style="width: 100%;">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <h5 class="card-title">Pending Updates</h5>
            </div>
            <h6 class="card-subtitle mb-2 text-body-secondary">Below are the updates pending approval.</h6>

            @if (count($updates) > 0)
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Validated Data</th>
                            <th>Type</th>
                            <th>Requested By</th>
                            <th>Requested At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($updates as $update)
                            <tr>
                                <td>
                                    <ul>
                                        @foreach ($update['validated_data'] as $key => $value)
                                            <li>{{ $key }}: {{ $value }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>{{ $update['type'] }}</td>
                                @if ($update['requested_by'] == 2)
                                    <td>Admin</td>
                                @endif
                                <td>{{ \Carbon\Carbon::parse($update['requested_at'])->format('d M Y H:i') }}</td>
                                <td>
                                    <a href="/verify-update/{{ $update['id'] }}" class="btn btn-success btn-sm">Approve</a>
                                    <a href="/reject-update/{{ $update['id'] }}" class="btn btn-danger btn-sm">Reject</a>
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
