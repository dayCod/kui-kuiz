<?php

namespace App\Services\CertificateConfig;

use App\Base\BaseImplement;
use App\Base\BaseInterface;
use App\Functions\Images;
use App\Models\AsmntCertificateSetting;

class CreateCertificate extends BaseImplement implements BaseInterface
{
    public function process($dto)
    {
        $certificate = new AsmntCertificateSetting([
            'uuid' => $dto['uuid'],
            'page_orientation' => $dto['page_orientation'],
            'heading' => $dto['heading'],
            'description' => $dto['description'],
            'signatured_by' => $dto['signatured_by'],
            'signature_img' => (new Images('signature-img', 'certificate/signature', 120, 120))->storeToStorage($dto['signature_img']),
        ]);

        if ($dto['page_orientation'] == "potrait") {
            $images = new Images('background-img', 'certificate/background', 2480, 3508);
            $certificate['certi_background_img'] = $images->storeToStorage($dto['certi_background_img']);
        }

        if ($dto['page_orientation'] == "landscape") {
            $images = new Images('background-img', 'certificate/background', 3508, 2480);
            $certificate['certi_background_img'] = $images->storeToStorage($dto['certi_background_img']);
        }

        $certificate->save();

        $this->results['response_code'] = 200;
        $this->results['success'] = true;
        $this->results['message'] = 'Certificate Config Successfully Created';
        $this->results['data'] = $certificate;

    }
}
