<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
public function create()
    {
        // Jika user sudah login, langsung redirect ke travelinkclub
        if (Auth::check()) {
            return redirect()->route('travelinkclub');
        }
        // Jika tidak, redirect ke travelinkclub (atau bisa tampilkan modal login di halaman tersebut)
        return redirect()->route('travelinkclub');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);


        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            $user = auth()->user();
            // Jika admin, redirect ke dashboard admin
            if ($user->role === 'admin') {
                return redirect()->intended('/travelinkcenter');
            }
            // Jika user biasa, redirect ke travelinkclub dan pastikan tidak bisa akses dashboard admin
            if ($user->role === 'user') {
                return redirect()->intended(route('travelinkclub'));
            }
            // Jika role tidak dikenali, logout dan tolak akses
            Auth::logout();
            return back()->withErrors([
                'email' => 'Unauthorized access.'
            ]);
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('travelinkclub');
    }
}