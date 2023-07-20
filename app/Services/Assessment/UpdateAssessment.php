<?php

namespace App\Services\Assessment;

use App\Base\BaseImplement;
use App\Base\BaseInterface;
use App\Models\Assessment;
use Carbon\Carbon;

class UpdateAssessment extends BaseImplement implements BaseInterface
{
    public function process($dto)
    {
        $assessment = Assessment::where('uuid', $dto['assessment_uuid'])->first();

        if (!empty($assessment)) {
            $assessment->update([
                'asmnt_group_id' => $dto['asmnt_group_id'],
                'asmnt_setting_id' => $dto['asmnt_setting_id'],
                'asmnt_name' => $dto['asmnt_name'],
                'time_open' => Carbon::parse($dto['time_open'])->format('Y-m-d H:i:s'),
                'time_close' => Carbon::parse($dto['time_close'])->format('Y-m-d H:i:s'),
                'asmnt_time_test' => $dto['asmnt_time_test'],
            ]);

            $this->results['response_code'] = 200;
            $this->results['success'] = true;
            $this->results['message'] = 'Assessment Successfully Updated';
            $this->results['data'] = $assessment->toArray();
        } else {
            $this->results['response_code'] = 404;
            $this->results['success'] = false;
            $this->results['message'] = 'Assessment Not Found';
            $this->results['data'] = [];
        }
    }
}
