<?php

namespace App\Services\Question;

use App\Base\BaseImplement;
use App\Base\BaseInterface;
use App\Models\AsmntQuestion;

class CreateQuestion extends BaseImplement implements BaseInterface
{
    public function process($dto)
    {
        $question = AsmntQuestion::create([
            'uuid' => $dto['uuid'],
            'asmnt_id' => $dto['asmnt_id'],
            'question' => $dto['question'],
        ]);

        $this->results['response_code'] = 200;
        $this->results['success'] = true;
        $this->results['message'] = "Question Created Successfully";
        $this->results['data'] = $question;
    }
}
