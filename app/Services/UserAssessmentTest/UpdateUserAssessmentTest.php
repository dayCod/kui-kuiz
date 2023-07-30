<?php

namespace App\Services\UserAssessmentTest;

use App\Base\BaseImplement;
use App\Base\BaseInterface;
use App\Models\AssessmentTest;

class UpdateUserAssessmentTest extends BaseImplement implements BaseInterface
{
    public function process($dto)
    {
        $assessment_test = AssessmentTest::where('id', $dto['assessment_test_id'])->first();
        if (!empty($assessment_test)) {
            $assessment_test->update([
                'total_is_correct' => $dto['total_is_correct'],
                'total_score' => $dto['total_score']
            ]);

            $this->results['response_code'] = 200;
            $this->results['success'] = true;
            $this->results['message'] = "Assessment Test Successfully Updated";
            $this->results['data'] = $assessment_test;
        } else {
            $this->results['response_code'] = 404;
            $this->results['success'] = false;
            $this->results['message'] = "Assessment Test Not Found";
            $this->results['data'] = [];
        }
    }
}
