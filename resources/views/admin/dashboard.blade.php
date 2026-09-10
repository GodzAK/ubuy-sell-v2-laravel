@extends('layouts.app')

@section('title', 'Admin Dashboard')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/admin_profile.css') }}">
@endpush

@section('content')
<div class="profile-container container" style="margin-top:130px; margin-bottom:80px;">
    <h2>Admin Dashboard</h2>
    <div class="admin-toggle-container mb-4">
        <a href="{{ route('admin.users') }}" class="btn btn-outline-dark">User Login Approval</a>
        <a href="{{ route('admin.items') }}" class="btn btn-outline-dark">Seller Item Approval</a>
        <a href="{{ route('admin.history') }}" class="btn btn-outline-dark">History</a>
    </div>
    <p>Choose a section above to review pending accounts, pending item listings, or see past approval decisions.</p>
</div>
@endsection
