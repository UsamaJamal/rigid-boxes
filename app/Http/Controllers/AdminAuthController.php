<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        if (session('admin_logged_in') || Auth::check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // First attempt standard Laravel Auth
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            session(['admin_logged_in' => true, 'admin_email' => Auth::user()->email, 'admin_name' => Auth::user()->name]);
            return redirect()->intended(route('admin.dashboard'))->with('success', 'Welcome back, Administrator!');
        }

        // Fallback default admin credentials if DB user is not yet created
        $defaultEmail = 'admin@rigidboxes.com';
        $defaultPass = 'admin123';

        if (strtolower($request->email) === $defaultEmail && $request->password === $defaultPass) {
            // Auto-create or ensure the default admin user exists in DB
            $user = User::firstOrCreate(
                ['email' => $defaultEmail],
                [
                    'name' => 'Administrator',
                    'password' => Hash::make($defaultPass),
                ]
            );
            Auth::login($user, $request->boolean('remember'));
            $request->session()->regenerate();
            session(['admin_logged_in' => true, 'admin_email' => $user->email, 'admin_name' => $user->name]);
            return redirect()->intended(route('admin.dashboard'))->with('success', 'Welcome back, Administrator!');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->forget(['admin_logged_in', 'admin_email', 'admin_name']);
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('success', 'You have been logged out successfully.');
    }
}
