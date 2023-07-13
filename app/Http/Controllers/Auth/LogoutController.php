<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function logout(Request $request)
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
