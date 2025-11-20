@extends('layouts.admin_app')

@section('content')
<div class="container mt-4">
    <h3>Activity Logs</h3>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>User</th>
                <th>Action</th>
                <th>Target</th>
                <th>Description</th>
                <th>Date & Time</th>
            </tr>
        </thead>
        <tbody>
            @forelse($logs as $log)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $log->user?->name ?? 'System' }}</td>
                <td>{{ ucfirst($log->action) }}</td>
                <td>{{ class_basename($log->target_type) }} #{{ $log->target_id ?? '-' }}</td>
                <td>{{ $log->description }}</td>
                <td>{{ $log->created_at->format('d-M-Y H:i') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">No activity found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
