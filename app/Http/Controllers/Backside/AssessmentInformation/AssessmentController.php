<?php

namespace App\Http\Controllers\Backside\AssessmentInformation;

use App\Http\Controllers\Controller;
use App\Http\Requests\Assessment\AssessmentStoreRequest;
use App\Http\Requests\Assessment\AssessmentUpdateRequest;
use App\Models\AsmntGroup;
use App\Models\AsmntSetting;
use App\Models\Assessment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AssessmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $assessments = Assessment::latest()->get();

        return view('backside.page.assessment-information.assessment.index', compact('assessments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $asmnt_groups = AsmntGroup::latest()->get();
        $asmnt_settings = AsmntSetting::latest()->get();

        return view('backside.page.assessment-information.assessment.create', compact('asmnt_groups', 'asmnt_settings'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AssessmentStoreRequest $request)
    {
        $process = app('CreateAssessment')->execute([
            'uuid' => Str::uuid(),
            'asmnt_group_id' => $request->asmnt_group_id,
            'asmnt_setting_id' => $request->asmnt_setting_id,
            'asmnt_serial_number' => getAsmntSerialNumber(),
            'asmnt_name' => $request->asmnt_name,
            'time_open' => $request->time_open,
            'time_close' => $request->time_close,
            'asmnt_time_test' => $request->asmnt_time_test,
        ]);

        return redirect()->route('assessment-information.manage-assessment.index')->with('success', $process['message']);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $uuid
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $uuid
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid)
    {
        $asmnt_groups = AsmntGroup::latest()->get();
        $asmnt_settings = AsmntSetting::latest()->get();
        $assessment = Assessment::where('uuid', $uuid)->first();

        return view('backside.page.assessment-information.assessment.edit', compact('assessment', 'asmnt_groups', 'asmnt_settings'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $uuid
     * @return \Illuminate\Http\Response
     */
    public function update(AssessmentUpdateRequest $request, $uuid)
    {
        $process = app('UpdateAssessment')->execute([
            'assessment_uuid' => $uuid,
            'asmnt_group_id' => $request->asmnt_group_id,
            'asmnt_setting_id' => $request->asmnt_setting_id,
            'asmnt_name' => $request->asmnt_name,
            'time_open' => $request->time_open,
            'time_close' => $request->time_close,
            'asmnt_time_test' => $request->asmnt_time_test,
        ]);

        return redirect()->route('assessment-information.manage-assessment.index')->with('success', $process['message']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $uuid
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
        $process = app('DeleteAssessment')->execute(['assessment_uuid' => $uuid]);

        return response()->json(['success' => $process['message']], 200);
    }
}
