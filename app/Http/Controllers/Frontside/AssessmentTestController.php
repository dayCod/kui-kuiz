<?php

namespace App\Http\Controllers\Frontside;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\AsmntGroup;
use App\Models\Assessment;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Carbon;

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
        $asmnt_groups = AsmntGroup::latest()->get();

        return view('frontside.pages.participant-page', compact('participant', 'asmnt_groups'));
    }

    public function welcomePage(): View
    {
        return view('frontside.pages.welcome');
    }

    public function assessmentTestPage(): View
    {
        return view('frontside.pages.assessment-test-page');
    }

    public function logoutParticipant(Request $request): RedirectResponse
    {
        $process = app('Logout')->execute([
            'user_id' => auth()->id(),
        ]);

        if ($process['success']) {
            $request->session()->invalidate();

            $request->session()->regenerateToken();

            return redirect()->route('assessment-test.participant-authentication-page')->with('success', $process['message']);
        } else {
            return redirect()->back()->with('fail', $process['message']);
        }
    }


    /*
    |--------------------------------------------------------------------------
    | Form Inquiries | Response JSON
    |--------------------------------------------------------------------------
    */
    public function getAssessment($asmnt_group_uuid)
    {
        $assessments = Assessment::where(
            'asmnt_group_id', AsmntGroup::where('uuid', $asmnt_group_uuid
        )->first()->id)->latest()->get()->filter(function ($assessment) {
            return setTimestamp(now(), true) >= setTimestamp($assessment->time_open, true) && setTimestamp(now(), true) <= setTimestamp($assessment->time_close, true);
        });

        return response()->json(['data' => $assessments]);
    }



}
