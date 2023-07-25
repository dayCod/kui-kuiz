<?php

namespace App\Services\QuestionAnswer;

use App\Base\BaseImplement;
use App\Base\BaseInterface;

class UpdateQuestionAnswer extends BaseImplement implements BaseInterface
{
    public function process($dto)
    {
        $question = app('UpdateQuestion')->execute([
            'asmnt_question_uuid' => $dto['asmnt_question_uuid'],
            'question' => $dto['question'],
        ]);

        $answers = app('UpdateAnswer')->execute([
            'asmnt_question_uuid' => $dto['asmnt_question_uuid'],
            'asmnt_question_answer_uuid' => $dto['asmnt_question_answer_uuid'], // array
            'alphabet' => $dto['alphabet'],
            'answer' => $dto['answer'],
            'is_correct' => $dto['is_correct'],
            'score' => $dto['score'],
        ]);

        $this->results['response_code'] = 200;
        $this->results['success'] = true;
        $this->results['message'] = "Question and Answer Updated Successfully";
        $this->results['data'] = [
            'question' => $question,
            'answers' => $answers,
        ];
    }
}
