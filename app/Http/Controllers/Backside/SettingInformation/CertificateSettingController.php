<?php

namespace App\Http\Controllers\Backside\SettingInformation;

use App\Http\Controllers\Controller;
use App\Http\Requests\Setting\Certificate\CertificateStoreRequest;
use App\Http\Requests\Setting\Certificate\CertificateUpdateRequest;
use App\Models\AsmntCertificateSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CertificateSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $certificates = AsmntCertificateSetting::latest()->get();

        return view('backside.page.setting-information.certificate-config.index', compact('certificates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backside.page.setting-information.certificate-config.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CertificateStoreRequest $request)
    {
        $process = app('CreateCertificate')->execute([
            'uuid' => Str::uuid(),
            'page_orientation' => $request->page_orientation,
            'heading' => ucfirst($request->heading),
            'description' => $request->description,
            'signatured_by' => $request->signatured_by,
            'certi_background_img' => $request->file('certi_background_img'),
            'signature_img' => $request->file('signature_img'),
        ]);

        return redirect()->route('setting-information.certificate-setting.index')->with('success', $process['message']);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $uuid
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        $process = app('FindCertificate')->execute(['certificate_uuid' => $uuid]);

        return view('backside.page.setting-information.certificate-config.detail', [
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
        $process = app('FindCertificate')->execute(['certificate_uuid' => $uuid]);

        return view('backside.page.setting-information.certificate-config.edit', [
            'certificate' => $process['data'],
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $uuid
     * @return \Illuminate\Http\Response
     */
    public function update(CertificateUpdateRequest $request, $uuid)
    {
        $process = app('UpdateCertificate')->execute([
            'certificate_uuid' => $uuid,
            'page_orientation' => $request->page_orientation,
            'heading' => $request->heading,
            'description' => $request->description,
            'signatured_by' => $request->signatured_by,
            'certi_background_img' => $request->file('certi_background_img'),
            'signature_img' => $request->file('signature_img'),
        ]);

        return redirect()->route('setting-information.certificate-setting.index')->with('success', $process['message']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $uuid
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
        //
    }
}
