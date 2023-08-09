<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    /**
     * logout process for destroy the authenticated users session.
     *
     * @param $request
     * @return RedirectResponse
     */
    public function logout(Request $request): RedirectResponse
    {
        $process = app('Logout')->execute([
            'user_id' => Auth::id(),
        ]);

        if ($process['success']) {
            $request->session()->invalidate();

            $request->session()->regenerateToken();

            return redirect()->route('auth.login')->with('success', $process['message']);
        } else {
            return redirect()->back()->with('fail', $process['message']);
        }

    }
}
