<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(LoginRequest $request)
    {
        $process = app('Login')->execute([
            'email' => $request->email,
            'password' => $request->password,
            'is_login' => true,
        ]);

        if ($process['success']) {
            $request->session()->regenerate();

            return redirect()->route('dashboard.index')->with('success', $process['message']);
        } else {
            return redirect()->back()->with('fail', $process['message']);
        }

    }
}
