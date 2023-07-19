<?php

namespace App\Services\CertificateConfig;

use App\Base\BaseImplement;
use App\Base\BaseInterface;
use App\Functions\Images;
use App\Models\AsmntCertificateSetting;

class UpdateCertificate extends BaseImplement implements BaseInterface
{
    public function process($dto)
    {
        $find_certificate = app('FindCertificate')->execute([
            'certificate_uuid' => $dto['certificate_uuid'],
        ]);

        if ($find_certificate['success']) {
            $init_model_attribute = AsmntCertificateSetting::where('uuid', $dto['certificate_uuid'])->first()->fill([
                'page_orientation' => $dto['page_orientation'],
                'heading' => $dto['heading'],
                'description' => $dto['description'],
                'sigantured_by' => $dto['signatured_by'],
                'certi_background_img' => $find_certificate['data']['certi_background_img'],
                'signature_img' => $find_certificate['data']['signature_img'],
            ]);

            if (!is_null($dto['certi_background_img'])) {
                if ($dto['page_orientation'] == "potrait") {
                    $images = new Images('background-img', 'certificate/background', 2480, 3508);
                    $init_model_attribute['certi_background_img'] = $images->storeToStorage($dto['certi_background_img'], $find_certificate['data']['certi_background_img']);
                }

                if ($dto['page_orientation'] == "landscape") {
                    $images = new Images('background-img', 'certificate/background', 3508, 2480);
                    $init_model_attribute['certi_background_img'] = $images->storeToStorage($dto['certi_background_img'], $find_certificate['data']['certi_background_img']);
                }
            }

            if (!is_null($dto['signature_img'])) {
                $init_model_attribute['signature_img'] = (new Images('signature-img', 'certificate/signature', 120, 120))->storeToStorage($dto['signature_img'], $find_certificate['data']['signature_img']);
            }

            $init_model_attribute->save();

            $this->results['response_code'] = 200;
            $this->results['success'] = true;
            $this->results['message'] = 'Certificate Successfully Updated';
            $this->results['data'] = $init_model_attribute->toArray();

        } else {
            $this->results['response_code'] = 404;
            $this->results['success'] = false;
            $this->results['message'] = 'Certificate Not Found';
            $this->results['data'] = [];
        }
    }
}
