@extends('layouts.app')

@section('title', 'My Profile')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/profile.css') }}">
@endpush

@section('content')
<div class="container" style="margin-top:130px; margin-bottom:80px;">
    <h2>Welcome, {{ $user->username }}!</h2>
    <p>{{ $user->email }}</p>

    <h4 class="mt-4">Change Password</h4>
    <form method="POST" action="{{ route('profile.password') }}" style="max-width:400px;">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="current_password">Current Password</label>
            <input type="password" id="current_password" name="current_password" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="new_password">New Password</label>
            <input type="password" id="new_password" name="new_password" class="form-control" minlength="8" required>
        </div>
        <div class="form-group">
            <label for="new_password_confirmation">Confirm New Password</label>
            <input type="password" id="new_password_confirmation" name="new_password_confirmation" class="form-control" minlength="8" required>
        </div>
        <button type="submit" class="btn btn-primary">Change Password</button>
    </form>

    <h4 class="mt-5">My Listings</h4>
    <table class="table table-striped">
        <thead>
            <tr><th>Item</th><th>Price</th><th>Status</th><th>Approval</th><th></th></tr>
        </thead>
        <tbody>
            @forelse ($items as $item)
                <tr>
                    <td>{{ $item->item_name }}</td>
                    <td>₱{{ number_format($item->price, 2) }}</td>
                    <td>{{ $item->is_sold }}</td>
                    <td>{{ $item->item_is_approved }}</td>
                    <td><a href="{{ route('items.show', $item) }}">View</a></td>
                </tr>
            @empty
                <tr><td colspan="5">You haven't listed anything yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
