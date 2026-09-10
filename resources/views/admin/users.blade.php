@extends('layouts.app')

@section('title', 'User Approvals')

@section('content')
<div class="container" style="margin-top:130px; margin-bottom:80px;">
    <a href="{{ route('admin.dashboard') }}">&larr; Back to Admin Dashboard</a>
    <h3 class="mt-3">User Login Approval</h3>
    <table class="table table-striped">
        <thead>
            <tr><th>Username</th><th>Email</th><th>Status</th><th>Action</th></tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
                <tr>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->email }}</td>
                    <td>Pending</td>
                    <td>
                        <form method="POST" action="{{ route('admin.users.approve', $user) }}" style="display:inline;">
                            @csrf
                            <input type="hidden" name="approve" value="1">
                            <button type="submit" class="btn btn-success btn-sm">Approve</button>
                        </form>
                        <form method="POST" action="{{ route('admin.users.approve', $user) }}" style="display:inline;" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            <input type="hidden" name="approve" value="0">
                            <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4">No pending users.</td></tr>
            @endforelse
        </tbody>
    </table>
    {{ $users->links() }}
</div>
@endsection
