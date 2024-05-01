<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index', [
            'title' => 'Login',
            'active' => 'login'
        ]);
    }

    public function authenticate(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email:dns',
        'password' => 'required'
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        // Set token untuk pengguna yang berhasil login
        /** @var \App\Models\User $user **/
        $user = Auth::user();
        $user->token = Str::uuid()->toString(); // Atur token sesuai kebutuhan
        $user->save();

        return redirect()->intended('/');
    }

    return back()->with('loginError', 'Login failed');
}

    public function showLoginForm()
    {
        return view('auth.login');
    }
    
    public function logout(Request $request)
    {

        if ($request->method() == 'POST') {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect('/');
        }

        return redirect('/');
    }
}