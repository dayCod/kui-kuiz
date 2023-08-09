<?php

namespace App\Http\Controllers\Backside\SettingInformation;

use App\Http\Controllers\Controller;
use App\Http\Requests\Setting\Certificate\CertificateStoreRequest;
use App\Http\Requests\Setting\Certificate\CertificateUpdateRequest;
use App\Models\AsmntCertificateSetting;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CertificateSettingController extends Controller
{
    /**
     * display the certificate setting page.
     *
     * @return View
     */
    public function index(): View
    {
        $certificates = AsmntCertificateSetting::latest()->get();

        return view('backside.page.setting-information.certificate-config.index', compact('certificates'));
    }

    /**
     * show the form page of certificate setting.
     *
     * @return View
     */
    public function create(): View
    {
        return view('backside.page.setting-information.certificate-config.create');
    }

    /**
     * Store a newly created certificate setting resource in to database.
     *
     * @param $request
     * @return RedirectResponse
     */
    public function store(CertificateStoreRequest $request): RedirectResponse
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
     * display the specified certificate setting resource.
     *
     * @param  string  $uuid
     * @return View
     */
    public function show($uuid): View
    {
        $process = app('FindCertificate')->execute(['certificate_uuid' => $uuid]);

        return view('backside.page.setting-information.certificate-config.detail', [
            'certificate' => $process['data'],
        ]);
    }

    /**
     * show the form for editing the specified certificate setting resource.
     *
     * @param  string  $uuid
     * @return View
     */
    public function edit($uuid): View
    {
        $process = app('FindCertificate')->execute(['certificate_uuid' => $uuid]);

        return view('backside.page.setting-information.certificate-config.edit', [
            'certificate' => $process['data'],
        ]);
    }

    /**
     * Update the specified certificate setting resource in to database.
     *
     * @param $request
     * @param string  $uuid
     * @return RedirectResponse
     */
    public function update(CertificateUpdateRequest $request, $uuid): RedirectResponse
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
     * Remove the specified certificate setting resource from databse.
     *
     * @param  string  $uuid
     * @return JsonResponse
     */
    public function destroy($uuid): JsonResponse
    {
        $process = app('DeleteCertificate')->execute(['certificate_uuid' => $uuid]);

        return response()->json(['success' => $process['message']], 200);
    }
}
