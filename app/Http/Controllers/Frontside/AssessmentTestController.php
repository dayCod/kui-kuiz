<?php

namespace App\Http\Controllers\Frontside;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class AssessmentTestController extends Controller
{
    /*
    |---------------------------------------------------------------------------
    | Participant Function for Preparing The Assessment Test | Middleware Guest
    |---------------------------------------------------------------------------
    */
    public function participantAuthenticationPage(): View
    {
        return view('frontside.pages.participant-auth');
    }

    public function participantAuthentication(LoginRequest $request): RedirectResponse
    {
        $user = User::where('email', $request->email)->where('role', 'participant')->first();

        if (empty($user)) return redirect()->back()->with('fail', 'Participant Not Found');

        $process = app('Login')->execute([
            'email' => $request->email,
            'password' => $request->password,
            'is_login' => true,
        ]);

        if ($process['success']) {
            $request->session()->regenerate();

            return redirect()->route('assessment-test.participant-page')->with('success', $process['message']);
        } else {
            return redirect()->back()->with('fail', $process['message']);
        }
    }


    /*
    |---------------------------------------------------------------------------------
    | Participant Page Before Start The Assessment Test | Middleware Auth Participant
    |---------------------------------------------------------------------------------
    */
    public function participantPage(): View
    {
        $participant = auth()->user();

        return view('frontside.pages.participant-page', compact('participant'));
    }

    public function welcomePage(): View
    {
        return view('frontside.pages.welcome');
    }

    public function assessmentTestPage(): View
    {
        return view('frontside.pages.assessment-test-page');
    }


    /*
    |--------------------------------------------------------------------------
    | Form Inquiries | Response JSON
    |--------------------------------------------------------------------------
    */



}
