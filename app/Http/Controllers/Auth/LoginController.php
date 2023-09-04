<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Traits\UserLogging;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use UserLogging;

    /**
     * login page for admin and supervisor.
     *
     * @return View
     */
    public function login(): View
    {
        return view('auth.login');
    }

    /**
     * authentication process for authenticate the granted users.
     *
     * @param $request
     * @return RedirectResponse
     */
    public function authenticate(LoginRequest $request): RedirectResponse
    {
        $process = app('Login')->execute([
            'email' => $request->email,
            'password' => $request->password,
            'is_login' => true,
        ]);

        if ($process['success']) {
            $request->session()->regenerate();

            $this->createLog(auth()->id(), 'Was Login', true);

            return redirect()->route('dashboard.index')->with('success', $process['message']);
        } else {
            return redirect()->back()->with('fail', $process['message']);
        }
    }
}
