<?php

namespace App\Http\Controllers\Backside\AssessmentInformation;

use App\Http\Controllers\Controller;
use App\Http\Requests\AsmntGroup\AsmntGroupStoreRequest;
use App\Http\Requests\AsmntGroup\AsmntGroupUpdateRequest;
use App\Models\AsmntCertificateSetting;
use App\Models\AsmntGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AssessmentGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $assessment_groups = AsmntGroup::latest()->get();

        return view('backside.page.assessment-information.assessment-group.index', compact('assessment_groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $certificates = AsmntCertificateSetting::latest()->get();

        return view('backside.page.assessment-information.assessment-group.create', compact('certificates'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AsmntGroupStoreRequest $request)
    {
        $process = app('CreateAsmntGroup')->execute([
            'uuid' => Str::uuid(),
            'certificate_setting_id' => $request->certificate_setting_id,
            'name' => $request->name,
        ]);

        return redirect()->route('assessment-information.assessment-group.index')->with('success', $process['message']);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $certificate_setting_uuid
     * @return \Illuminate\Http\Response
     */
    public function showCertificateConfig($certificate_setting_uuid)
    {
        $process = app('FindCertificate')->execute(['certificate_uuid' => $certificate_setting_uuid]);

        return view('backside.page.assessment-information.assessment-group.certificate-config', [
            'certificate' => $process['data'],
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $uuid
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid)
    {
        $asmnt_group = AsmntGroup::where('uuid', $uuid)->first();
        $certificates = AsmntCertificateSetting::latest()->get();

        return view('backside.page.assessment-information.assessment-group.edit', [
            'asmnt_group' => $asmnt_group,
            'certificates' => $certificates,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $uuid
     * @return \Illuminate\Http\Response
     */
    public function update(AsmntGroupUpdateRequest $request, $uuid)
    {
        $process = app('UpdateAsmntGroup')->execute([
            'asmnt_group_uuid' => $uuid,
            'certificate_setting_id' => $request->certificate_setting_id,
            'name' => $request->name,
        ]);

        return redirect()->route('assessment-information.assessment-group.index')->with('success', $process['message']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $uuid
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
        $process = app('DeleteAsmntGroup')->execute(['asmnt_group_uuid' => $uuid]);

        return response()->json(['success' => $process['message']], 200);
    }
}
