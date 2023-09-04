<?php

namespace App\Http\Controllers\Backside\AssessmentInformation;

use App\Http\Controllers\Controller;
use App\Http\Requests\Assessment\AssessmentStoreRequest;
use App\Http\Requests\Assessment\AssessmentUpdateRequest;
use App\Models\AsmntGroup;
use App\Models\AsmntSetting;
use App\Models\Assessment;
use App\Traits\UserLogging;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AssessmentController extends Controller
{
    use UserLogging;

    /**
     * display the assessment resource for assessment page.
     *
     * @return View
     */
    public function index(): View
    {
        $assessments = Assessment::latest()->get();

        return view('backside.page.assessment-information.assessment.index', compact('assessments'));
    }

    /**
     * show the form page of assessment.
     *
     * @return View
     */
    public function create(): View
    {
        $asmnt_groups = AsmntGroup::latest()->get();
        $asmnt_settings = AsmntSetting::latest()->get();

        return view('backside.page.assessment-information.assessment.create', compact('asmnt_groups', 'asmnt_settings'));
    }

    /**
     * Store a newly created assessment resource in to database.
     *
     * @param $request
     * @return RedirectResponse
     */
    public function store(AssessmentStoreRequest $request): RedirectResponse
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

        $this->createLog(auth()->id(), 'Was Create the Assessment', true);

        return redirect()->route('assessment-information.manage-assessment.index')->with('success', $process['message']);
    }

    /**
     * show the form page of edit assessment.
     *
     * @param string $uuid
     * @return View
     */
    public function edit($uuid): View
    {
        $asmnt_groups = AsmntGroup::latest()->get();
        $asmnt_settings = AsmntSetting::latest()->get();
        $assessment = Assessment::where('uuid', $uuid)->first();

        return view('backside.page.assessment-information.assessment.edit', compact('assessment', 'asmnt_groups', 'asmnt_settings'));
    }

    /**
     * Update the specified assessment resource in to database.
     *
     * @param $request
     * @param string  $uuid
     * @return RedirectResponse
     */
    public function update(AssessmentUpdateRequest $request, $uuid): RedirectResponse
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

        $this->createLog(auth()->id(), 'Was Update the Assessment', true);

        return redirect()->route('assessment-information.manage-assessment.index')->with('success', $process['message']);
    }

    /**
     * Remove the specified assessment resource from databse.
     *
     * @param  string  $uuid
     * @return JsonResponse
     */
    public function destroy($uuid): JsonResponse
    {
        $process = app('DeleteAssessment')->execute(['assessment_uuid' => $uuid]);

        $this->createLog(auth()->id(), 'Was Delete The Assessment', true);

        return response()->json(['success' => $process['message']], 200);
    }
}
