<?php

namespace App\Http\Controllers\Backside\AssessmentInformation;

use App\Http\Controllers\Controller;
use App\Http\Requests\AsmntGroup\AsmntGroupStoreRequest;
use App\Http\Requests\AsmntGroup\AsmntGroupUpdateRequest;
use App\Models\AsmntCertificateSetting;
use App\Models\AsmntGroup;
use App\Traits\UserLogging;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AssessmentGroupController extends Controller
{
    use UserLogging;

    /**
     * display the assessment group resource for assessment group page.
     *
     * @return View
     */
    public function index(): View
    {
        $assessment_groups = AsmntGroup::latest()->get();

        return view('backside.page.assessment-information.assessment-group.index', compact('assessment_groups'));
    }

    /**
     * show the form page of assessment group.
     *
     * @return View
     */
    public function create(): View
    {
        $certificates = AsmntCertificateSetting::latest()->get();

        return view('backside.page.assessment-information.assessment-group.create', compact('certificates'));
    }

    /**
     * Store a newly created assessment group resource in to database.
     *
     * @param $request
     * @return RedirectResponse
     */
    public function store(AsmntGroupStoreRequest $request): RedirectResponse
    {
        $process = app('CreateAsmntGroup')->execute([
            'uuid' => Str::uuid(),
            'certificate_setting_id' => $request->certificate_setting_id,
            'name' => $request->name,
        ]);

        $this->createLog(auth()->id(), 'Was Create the Assessment Group', true);

        return redirect()->route('assessment-information.assessment-group.index')->with('success', $process['message']);
    }

    /**
     * show certificate configuration page.
     *
     * @param string $certificate_setting_uuid
     * @return View
     */
    public function showCertificateConfig($certificate_setting_uuid): View
    {
        $process = app('FindCertificate')->execute(['certificate_uuid' => $certificate_setting_uuid]);

        return view('backside.page.assessment-information.assessment-group.certificate-config', [
            'certificate' => $process['data'],
        ]);
    }

    /**
     * show the form page of edit assessment group.
     *
     * @param string $uuid
     * @return View
     */
    public function edit($uuid): View
    {
        $asmnt_group = AsmntGroup::where('uuid', $uuid)->first();
        $certificates = AsmntCertificateSetting::latest()->get();

        return view('backside.page.assessment-information.assessment-group.edit', [
            'asmnt_group' => $asmnt_group,
            'certificates' => $certificates,
        ]);
    }

    /**
     * Update the specified assessment group resource in to database.
     *
     * @param $request
     * @param string  $uuid
     * @return RedirectResponse
     */
    public function update(AsmntGroupUpdateRequest $request, $uuid): RedirectResponse
    {
        $process = app('UpdateAsmntGroup')->execute([
            'asmnt_group_uuid' => $uuid,
            'certificate_setting_id' => $request->certificate_setting_id,
            'name' => $request->name,
        ]);

        $this->createLog(auth()->id(), 'Was Update the Assessment Group', true);

        return redirect()->route('assessment-information.assessment-group.index')->with('success', $process['message']);
    }

    /**
     * Remove the specified assessment group resource from databse.
     *
     * @param  string  $uuid
     * @return JsonResponse
     */
    public function destroy($uuid): JsonResponse
    {
        $process = app('DeleteAsmntGroup')->execute(['asmnt_group_uuid' => $uuid]);

        $this->createLog(auth()->id(), 'Was Delete the Assessment Group', true);

        return response()->json(['success' => $process['message']], 200);
    }
}
