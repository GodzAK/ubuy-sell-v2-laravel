@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="container" style="max-width:420px; margin-top:120px; margin-bottom:100px;">
    <h2>Login</h2>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group">
            <label for="username">Username or Email</label>
            <input type="text" id="username" name="username" class="form-control" value="{{ old('username') }}" required autofocus>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" class="form-control" required>
        </div>
        <div class="form-group form-check">
            <input type="checkbox" id="remember" name="remember" class="form-check-input">
            <label for="remember" class="form-check-label">Remember me</label>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Login</button>
    </form>
    <p class="mt-3">No account yet? <a href="{{ route('register') }}">Register here</a>.</p>
</div>
@endsection
