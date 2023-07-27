<?php

namespace App\Services\UserAssessmentTest;

use App\Base\BaseImplement;
use App\Base\BaseInterface;
use App\Models\AssessmentTest;
use App\Models\UserAssessmentTest;

class CreateUserAssessmentTest extends BaseImplement implements BaseInterface
{
    public function process($dto)
    {
        $assessment_test = AssessmentTest::create([
            'uuid' => $dto['assessment_test_uuid'],
            'assessment_id' => $dto['assessment_id'],
        ]);

        $user_assessment_test = UserAssessmentTest::create([
            'uuid' => $dto['user_assessment_test_uuid'],
            'user_id' => $dto['user_participant_id'],
            'assessment_test_id' => $assessment_test['id']
        ]);

        $this->results['response_code'] = 200;
        $this->results['success'] = true;
        $this->results['message'] = 'User Assessment Test Successfully Created';
        $this->results['data'] = [
            'assessment_test' => $assessment_test,
            'user_assessment_test' => $user_assessment_test,
        ];
    }
}
