<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Response;

class AuthenticatedSessionController extends Controller
{
    public function create(): View
    {
        return view('auth.login');

    }
    public function store(Request $request): RedirectResponse
{
    $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (! Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
    $request->session()->regenerate();

    $role = Auth::user()->role;

// ✅ Redirect user based on role
switch ($role) {
    case 'admin':
        return redirect()->intended('/admin/dashboard');
    case 'cooperative':
        return redirect()->intended('/cooperative');
    case 'wholesaler':
        return redirect()->intended('/wholesaler');
    case 'retailer':
        return redirect()->intended('/retailer');
    default:
        return redirect()->intended('/customer'); 
}

}
public function destroy(Request $request): RedirectResponse
{
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
}

    }



