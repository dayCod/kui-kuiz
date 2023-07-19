<?php

namespace App\Services\CertificateConfig;

use App\Base\BaseImplement;
use App\Base\BaseInterface;
use App\Functions\Images;
use App\Models\AsmntCertificateSetting;

class FindCertificate extends BaseImplement implements BaseInterface
{
    public function process($dto)
    {
        $certificate = AsmntCertificateSetting::where('uuid', $dto['certificate_uuid'])->first();

        if (empty($certificate)) {
            $this->results['response_code'] = 404;
            $this->results['success'] = false;
            $this->results['message'] = "Certificate Not Found";
            $this->results['data'] = [];
        } else {
            $this->results['response_code'] = 200;
            $this->results['success'] = true;
            $this->results['message'] = "Certificate Found";
            $this->results['data'] = $certificate->toArray();
        }
    }
}


