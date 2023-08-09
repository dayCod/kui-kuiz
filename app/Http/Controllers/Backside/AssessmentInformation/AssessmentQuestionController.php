<?php

namespace App\Http\Controllers\Backside\AssessmentInformation;

use App\Http\Controllers\Controller;
use App\Models\AsmntQuestion;
use App\Models\Assessment;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AssessmentQuestionController extends Controller
{
    /**
     * display the assessment question for assessment question page.
     *
     * @param string $assessment_uuid
     * @return View
     */
    public function index($assessment_uuid): View
    {
        $assessment = Assessment::where('uuid', $assessment_uuid)->first();
        $assessment_questions = AsmntQuestion::where('asmnt_id', $assessment->id)->withCount('hasAnswers')->get();

        return view('backside.page.assessment-information.questions.index', compact('assessment_uuid', 'assessment_questions'));
    }

    /**
     * show the form page of assessment question.
     *
     * @param string $assessment_uuid
     * @return View
     */
    public function create($assessment_uuid): View
    {
        $assessment = Assessment::where('uuid', $assessment_uuid)->first();

        return view('backside.page.assessment-information.questions.create', compact('assessment_uuid', 'assessment'));
    }

    /**
     * Store a newly created assessment question resource in to database.
     *
     * @param $request
     * @param string $assessment_uuid
     * @return RedirectResponse
     */
    public function store(Request $request, $assessment_uuid): RedirectResponse
    {
        $process = ['success' => false, 'message' => 'Throwed Exception'];

        $assessment = Assessment::where('uuid', $assessment_uuid)->first();

        DB::beginTransaction();

        try {

            $process = app('CreateQuestionAnswer')->execute([
                'asmnt_question_uuid' => Str::uuid(),
                'asmnt_id' => $assessment->id,
                'question' => $request->question,
                'asmnt_question_answer_uuid' => Str::uuid(),
                'alphabet' => $request->alphabet,
                'answer' => $request->answer,
                'is_correct' => $request->is_correct,
                'score' => $request->score,
            ]);

            DB::commit();

        } catch (\Exception $err) { DB::rollBack(); }

        return redirect()->route('assessment-information.manage-assessment.questions.index', ['assessment_uuid' => $assessment_uuid])->with((($process['success']) ? 'success' : 'fail'), $process['message']);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $assessment_uuid
     * @param  string  $question_uuid
     * @return View
     */
    public function show($assessment_uuid, $question_uuid): View
    {
        $assessment = Assessment::where('uuid', $assessment_uuid)->first();
        $assessment_question = AsmntQuestion::where('uuid', $question_uuid)->first();

        return view('backside.page.assessment-information.questions.detail', compact('assessment_uuid', 'assessment', 'assessment_question'));
    }

    /**
     * show the form page of edit assessment question.
     *
     * @param string $assessment_uuid
     * @param string $question_uuid
     * @return View
     */
    public function edit($assessment_uuid, $question_uuid): View
    {
        $assessment = Assessment::where('uuid', $assessment_uuid)->first();
        $assessment_question = AsmntQuestion::where('uuid', $question_uuid)->first();

        return view('backside.page.assessment-information.questions.edit', compact('assessment_uuid', 'question_uuid', 'assessment', 'assessment_question'));
    }

    /**
     * Update the specified assessment question resource in to database.
     *
     * @param $request
     * @param string $assessment_uuid
     * @param string $question_uuid
     * @return RedirectResponse
     */
    public function update(Request $request, $assessment_uuid, $question_uuid): RedirectResponse
    {
        $process = ['success' => false, 'message' => 'Throwed Exception'];

        $assessment_question = AsmntQuestion::where('uuid', $question_uuid)->first();

        DB::beginTransaction();

        try {

            $process = app('UpdateQuestionAnswer')->execute([
                'asmnt_question_uuid' => $question_uuid,
                'question' => $request->question,
                'asmnt_question_answer_uuid' => $assessment_question->hasAnswers->toArray(), // array
                'alphabet' => $request->alphabet,
                'answer' => $request->answer,
                'is_correct' => $request->is_correct,
                'score' => $request->score,
            ]);

            DB::commit();

        } catch (\Exception $err) { DB::rollBack(); }

        return redirect()->route('assessment-information.manage-assessment.questions.index', ['assessment_uuid' => $assessment_uuid])->with((($process['success']) ? 'success' : 'fail'), $process['message']);
    }

    /**
     * Remove the specified assessment question resource from databse.
     *
     * @param string $assessment_uuid
     * @param string $question_uuid
     * @return JsonResponse
     */
    public function destroy($assessment_uuid, $question_uuid): JsonResponse
    {
        $process = app('DeleteQuestion')->execute([
            'asmnt_question_uuid' => $question_uuid,
        ]);

        return response()->json(['success' => $process['message']], 200);
    }
}
