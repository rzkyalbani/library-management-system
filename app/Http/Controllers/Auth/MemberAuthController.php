<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberAuthController extends Controller
{
    public function show()
    {
        return view('auth.member-login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('member')->attempt($credentials)) {
            return redirect()->intended('/member/dashboard');
        }

        return back()->withErrors([
            'email' => 'Login gagal, cek email/password.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('member')->logout();
        return redirect('/member/login');
    }
}
