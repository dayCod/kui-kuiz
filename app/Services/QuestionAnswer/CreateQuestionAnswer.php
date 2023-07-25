<?php

namespace App\Services\QuestionAnswer;

use App\Base\BaseImplement;
use App\Base\BaseInterface;

class CreateQuestionAnswer extends BaseImplement implements BaseInterface
{
    public function process($dto)
    {
        $question = app('CreateQuestion')->execute([
            'uuid' => $dto['asmnt_question_uuid'],
            'asmnt_id' => $dto['asmnt_id'],
            'question' => $dto['question'],
        ]);

        $answers = app('CreateAnswer')->execute([
            'uuid' => $dto['asmnt_question_answer_uuid'],
            'asmnt_question_id' => $question['data']['id'],
            'alphabet' => $dto['alphabet'],
            'answer' => $dto['answer'],
            'is_correct' => $dto['is_correct'],
            'score' => $dto['score'],
        ]);

        $this->results['response_code'] = 200;
        $this->results['success'] = true;
        $this->results['message'] = "Question and Answer Created Successfully";
        $this->results['data'] = [
            'question' => $question,
            'answers' => $answers,
        ];

    }
}
