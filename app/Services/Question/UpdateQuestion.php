<?php

namespace App\Services\Question;

use App\Base\BaseImplement;
use App\Base\BaseInterface;
use App\Models\AsmntQuestion;

class UpdateQuestion extends BaseImplement implements BaseInterface
{
    public function process($dto)
    {
        $question = AsmntQuestion::where('uuid', $dto['asmnt_question_uuid'])->first();

        if (!empty($question)) {
            $question->update([
                'question' => $dto['question'],
            ]);

            $this->results['response_code'] = 200;
            $this->results['success'] = true;
            $this->results['message'] = "Question Updated Successfully";
            $this->results['data'] = $question;

        } else {
            $this->results['response_code'] = 404;
            $this->results['success'] = false;
            $this->results['message'] = "Question Not Found";
            $this->results['data'] = [];
        }
    }
}
