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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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

    public function prepareForAssessmentTest(Request $request): RedirectResponse
    {
        $process = ['success' => false, 'message' => 'Throwed Exception'];

        $assessment = Assessment::where('uuid', $request->assessment)->first();

        DB::beginTransaction();

        try {

            $process = app('CreateUserAssessmentTest')->execute([
                'assessment_test_uuid' => Str::uuid(),
                'assessment_id' => $assessment->id,
                'user_assessment_test_uuid' => Str::uuid(),
                'user_participant_id' => auth()->id(),
            ]);

            DB::commit();

        } catch (\Exception $err) { DB::rollBack(); }

        return redirect()->route('assessment-test.welcome-page')->with((($process['success']) ? 'success' : 'fail'), $process['message']);
    }

    public function welcomePage(): View
    {
        $user_assessment_test = User::where('id', auth()->id())->first()->userAssessmentTest()->latest()->first();

        $assessment_collection = [
            'assessment_test_id' => $user_assessment_test->id,
            'user_participant_id' => auth()->id(),
            'question_answer_data' => array(),
        ];

        foreach ($user_assessment_test->assessment->asmntQuestion as $question) {
            $assessment_collection['question_answer_data'][] = [
                'question_id' => $question->id,
                'user_participant_answer_id' => null,
                'user_participant_answer_alphabet' => null,
                'answer_score' => null,
                'is_correct_answer' => null,
            ];
        }

        return view('frontside.pages.welcome', [
            'user_assessment_test' => $user_assessment_test,
            'asmnt_group' => $user_assessment_test->assessment->asmntGroup,
            'assessment' => $user_assessment_test->assessment,
            'total_assessment_question' => $user_assessment_test->assessment->asmntQuestion->count(),
            'assessment_collection' => json_encode($assessment_collection),
        ]);
    }

    public function generateAssessmentSetup(Request $request)
    {
        cache()->remember('assessment-test:'.auth()->id(), 60*60*24, function () use ($request) {
            return (array)json_decode($request->assessment_collection);
        });

        return redirect()->route('assessment-test.assessment-test-page');
    }

    public function assessmentTestPage(): View
    {
        $user_assessment_test = User::where('id', auth()->id())->first()
            ->userAssessmentTest()->latest()->first()
            ->assessment->asmntQuestion()->paginate(1)->toArray();

        $assessment_test = cache()->get('assessment-test:'.auth()->id());

        // dd($user_assessment_test, $assessment_test);

        return view('frontside.pages.assessment-test-page', compact('user_assessment_test', 'assessment_test'));
    }

    private function collectQuestionAnswer($request)
    {
        $result = ['is_changes' => false];
        $assessment_test = cache()->get('assessment-test:'.auth()->id());
        $decodeAnswerCollection = json_decode($request->answer_collection);

        if (!empty((array)$decodeAnswerCollection)) {
            if ($request->page) {
                $assessment_test['question_answer_data'][($request->page == 1) ? 0: $request->page - 1] = (object)[
                    "question_id" => (int)$request->question_id,
                    "user_participant_answer_id" => $decodeAnswerCollection->answerId,
                    "user_participant_answer_alphabet" => $decodeAnswerCollection->answerAlphabet,
                    "answer_score" => empty($decodeAnswerCollection->answerScore) ? null : $decodeAnswerCollection->answerScore,
                    "is_correct_answer" => empty($decodeAnswerCollection->answerCorrect) ? null : $decodeAnswerCollection->answerCorrect,
                ];
            }
            cache()->put('assessment-test:'.auth()->id(), $assessment_test);

            return $result['is_changes'] = true;
        }

        return $result['is_changes'];
    }

    public function appendQuestionAnswer(Request $request)
    {
        $collectQuestionAnswer = $this->collectQuestionAnswer($request);

        return redirect($request->next_page_url)->with('success', ($collectQuestionAnswer)
            ? 'Previous Answer Was Successfully Recorded'
            : 'There Is No Changes with Your Previous Answers');
    }

    public function submitQuestionAnswer(Request $request)
    {
        $collectQuestionAnswer = $this->collectQuestionAnswer($request);
        $assessment_test = cache()->get('assessment-test:'.auth()->id());

        $process = app('UpdateUserAssessmentTest')->execute([
            'assessment_test_id' => $assessment_test['assessment_test_id'],
            'total_is_correct' => is_null($assessment_test['question_answer_data'][0]->is_correct_answer)
                    ? null
                    : collect($assessment_test['question_answer_data'])->pluck('is_correct_answer')->filter(fn ($item) => $item === true)->count(),
            'total_score' => is_null($assessment_test['question_answer_data'][0]->answer_score)
                    ? null
                    : collect($assessment_test['question_answer_data'])->pluck('answer_score')->sum(),
        ]);

        cache()->forget('assessment-test:'.auth()->id());

        $this->logoutParticipant($request);

        return redirect()->route('assessment-test.participant-authentication-page')->with('success', 'Thanks For Using This App');

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
