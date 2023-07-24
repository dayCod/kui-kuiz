<?php

namespace App\Http\Controllers\Backside\AssessmentInformation;

use App\Http\Controllers\Controller;
use App\Models\Assessment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AssessmentQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param string $assessment_uuid
     * @return \Illuminate\Http\Response
     */
    public function index($assessment_uuid)
    {
        return view('backside.page.assessment-information.questions.index', compact('assessment_uuid'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param string $assessment_uuid
     * @return \Illuminate\Http\Response
     */
    public function create($assessment_uuid)
    {
        $assessment = Assessment::where('uuid', $assessment_uuid)->first();

        return view('backside.page.assessment-information.questions.create', compact('assessment_uuid', 'assessment'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param string $assessment_uuid
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $assessment_uuid)
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
     * @param  string  $uuid
     * @return \Illuminate\Http\Response
     */
    public function show($assessment_uuid, $question_uuid)
    {
        return view('backside.page.assessment-information.questions.detail');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $uuid
     * @return \Illuminate\Http\Response
     */
    public function edit($assessment_uuid, $question_uuid)
    {
        return view('backside.page.assessment-information.questions.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $uuid
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $assessment_uuid, $question_uuid)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $uuid
     * @return \Illuminate\Http\Response
     */
    public function destroy($assessment_uuid, $question_uuid)
    {
        //
    }
}
