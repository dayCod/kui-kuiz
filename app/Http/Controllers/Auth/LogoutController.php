<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\UserLogging;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    use UserLogging;

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

            $this->createLog(auth()->id(), 'Was Logout', true);

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            return redirect()->route('auth.login')->with('success', $process['message']);
        } else {
            return redirect()->back()->with('fail', $process['message']);
        }

    }
}
