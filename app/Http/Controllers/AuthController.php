<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        // Old app let people log in with either username or email.
        $field = filter_var($credentials['username'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if (!Auth::attempt([$field => $credentials['username'], 'password' => $credentials['password']], $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'username' => 'Those credentials do not match our records.',
            ]);
        }

        $user = Auth::user();

        if (!$user->isAdmin() && !$user->isApproved()) {
            Auth::logout();
            throw ValidationException::withMessages([
                'username' => $user->is_approved === User::APPROVAL_REJECTED
                    ? 'Your account was rejected. Please contact an administrator.'
                    : 'Your account is still awaiting admin approval.',
            ]);
        }

        $request->session()->regenerate();

        return redirect()->intended(route('marketplace.index'));
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request)
    {
        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'facebook_link' => $request->facebook_link,
            'role' => 'user',
            'is_approved' => User::APPROVAL_PENDING,
        ]);

        return redirect()->route('login')
            ->with('status', 'Account created! An admin needs to approve it before you can log in.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
