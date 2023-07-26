<?php

namespace App\Services\Answer;

use App\Base\BaseImplement;
use App\Base\BaseInterface;
use App\Models\AsmntQuestionAnswer;

class DeleteAnswer extends BaseImplement implements BaseInterface
{
    public function process($dto)
    {
        $answer = AsmntQuestionAnswer::where('uuid', $dto['asmnt_question_answer_uuid'])->first();

        if (!empty($answer)) {
            $answer->delete();

            $this->results['response_code'] = 200;
            $this->results['success'] = true;
            $this->results['message'] = "Answer Successfully Deleted";
            $this->results['data'] = $answer->fresh();
        } else {
            $this->results['response_code'] = 404;
            $this->results['success'] = false;
            $this->results['message'] = "Answer Not Found";
            $this->results['data'] = [];
        }
    }
}
