<?php

namespace App\Services\Answer;

use App\Base\BaseImplement;
use App\Base\BaseInterface;
use App\Models\AsmntQuestionAnswer;
use Illuminate\Support\Str;

class CreateAnswer extends BaseImplement implements BaseInterface
{
    public function process($dto)
    {
        $data = [
            'uuid' => $dto['uuid'],
            'asmnt_question_id' => $dto['asmnt_question_id'],
            'alphabet' => $dto['alphabet'], // array of alphabet
            'answer' => $dto['answer'], // array of answers
            'is_correct' => $dto['is_correct'],
            'score' => $dto['score'], // array of scores
        ];

        $mapped_answer = collect(array($data))->mapWithKeys(function ($item, $key) {

            $res = array();

            foreach($item['answer'] as $answer_key => $answer) {

                $item['uuid'] = Str::uuid();

                $res[] = [
                    'uuid' => $item['uuid'],
                    'asmnt_question_id' => $item['asmnt_question_id'],
                    'alphabet' => $item['alphabet'][$answer_key],
                    'answer' => $answer,
                    'is_correct' => !is_null($item['is_correct'])
                        ? (($item['is_correct'][$answer_key] == 1) ? true : false)
                        : null,
                    'score' => $item['score'][$answer_key] ?? null,
                ];
            }

            return $res;
        });

        $mapped_answer->each(fn ($answer) =>  AsmntQuestionAnswer::create($answer));

        $this->results['response_code'] = 200;
        $this->results['success'] = true;
        $this->results['message'] = "Answer Created Successfully";
        $this->results['data'] = $mapped_answer->toArray();
    }
}
