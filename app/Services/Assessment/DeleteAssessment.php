<?php

namespace App\Services\Assessment;

use App\Base\BaseImplement;
use App\Base\BaseInterface;
use App\Models\Assessment;

class DeleteAssessment extends BaseImplement implements BaseInterface
{
    public function process($dto)
    {
        $assessment = Assessment::where('uuid', $dto['assessment_uuid'])->first();

        if (!empty($assessment)) {
            $assessment->delete();

            $this->results['response_code'] = 200;
            $this->results['success'] = true;
            $this->results['message'] = 'Assessment Successfully Deleted';
            $this->results['data'] = $assessment->toArray();
        } else {
            $this->results['response_code'] = 404;
            $this->results['success'] = false;
            $this->results['message'] = 'Assessment Not Found';
            $this->results['data'] = [];
        }
    }
}
