<?php

namespace App\Services\CertificateConfig;

use App\Functions\Images;
use App\Base\BaseImplement;
use App\Base\BaseInterface;
use App\Models\AsmntCertificateSetting;
use Illuminate\Support\Facades\Storage;

class DeleteCertificate extends BaseImplement implements BaseInterface
{
    public function process($dto)
    {
        $find_certificate = app('FindCertificate')->execute(['certificate_uuid' => $dto['certificate_uuid']]);

        if ($find_certificate['success']) {

            if (Storage::exists('/public/certificate/background/'.getFileName($find_certificate['data']['certi_background_img']))) {
                Storage::delete('/public/certificate/background/'.getFileName($find_certificate['data']['certi_background_img']));

            }

            if (Storage::exists('/public/certificate/signature/'.getFileName($find_certificate['data']['signature_img']))) {
                Storage::delete('/public/certificate/signature/'.getFileName($find_certificate['data']['signature_img']));
            }

            AsmntCertificateSetting::where('uuid', $dto['certificate_uuid'])->first()->delete();

            $this->results['response_code'] = 200;
            $this->results['success'] = true;
            $this->results['message'] = "Success, Certificate Deleted Permanently";
            $this->results['data'] = $find_certificate['data'];
        } else {
            $this->results['response_code'] = 404;
            $this->results['success'] = false;
            $this->results['message'] = "Certificate Not Found";
            $this->results['data'] = [];
        }
    }
}
