@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="container" style="max-width:480px; margin-top:120px; margin-bottom:100px;">
    <h2>Create an Account</h2>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" class="form-control" value="{{ old('username') }}" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
        </div>
        <div class="form-group">
            <label for="facebook_link">Facebook username (optional, for buyers to reach you)</label>
            <input type="text" id="facebook_link" name="facebook_link" class="form-control" value="{{ old('facebook_link') }}">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" class="form-control" required minlength="8">
        </div>
        <div class="form-group">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required minlength="8">
        </div>
        <button type="submit" class="btn btn-success btn-block">Register</button>
    </form>
    <p class="mt-3">Already have an account? <a href="{{ route('login') }}">Login here</a>.</p>
</div>
@endsection
