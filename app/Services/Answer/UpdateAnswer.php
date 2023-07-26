<?php

namespace App\Services\Answer;

use App\Base\BaseImplement;
use App\Base\BaseInterface;
use App\Models\AsmntQuestion;
use App\Models\AsmntQuestionAnswer;
use Illuminate\Support\Str;

class UpdateAnswer extends BaseImplement implements BaseInterface
{
    public function process($dto)
    {
        $answers_model = new AsmntQuestionAnswer();

        if ($answers_model->whereIn('uuid', array_value_recursive('uuid', $dto['asmnt_question_answer_uuid']))->count() > 0) {

            $data = [
                'asmnt_question_answer_uuid' => $dto['asmnt_question_answer_uuid'], // array of asmnt question answer uuid
                'alphabet' => $dto['alphabet'], // array of alphabet
                'answer' => $dto['answer'], // array of answers
                'is_correct' => $dto['is_correct'],
                'score' => $dto['score'], // array of scores
            ];

            $mapped_answer = collect(array($data))->mapWithKeys(function ($item, $key) {

                $res = array();

                foreach($item['answer'] as $answer_key => $answer) {

                    $res[] = [
                        'uuid' => $item['asmnt_question_answer_uuid'][$answer_key]['uuid'] ?? null,
                        'alphabet' => $item['alphabet'][$answer_key],
                        'answer' => $answer,
                        'is_correct' => $item['is_correct'],
                        'score' => $item['score'][$answer_key],
                    ];
                }

                return $res;
            });

            $new_answer_input_data = array();
            $old_answer_input_data = array();

            foreach ($mapped_answer as $answer) {
                array_push($new_answer_input_data, array_filter(array($answer), function ($item) {
                    return $item['uuid'] == null;
                }, ARRAY_FILTER_USE_BOTH));

                array_push($old_answer_input_data, array_filter(array($answer), function ($item) {
                    return $item['uuid'] != null;
                }, ARRAY_FILTER_USE_BOTH));
            }

            $old_answer_data = array();
            $new_answer_data = array();
            $removed_answer_data = array_splice($data['asmnt_question_answer_uuid'], count($data['answer']));

            // Update Answers
            foreach (array_filter($old_answer_input_data, fn($item) => $item !== []) as [$item]) {
                array_push($old_answer_data, $item);
                $answers_model->where('uuid', $item['uuid'])->update($item);
            }

            // Create if there is new answer input data
            if (count($new_answer_input_data) > 0) {
                foreach (array_filter($new_answer_input_data, fn($item) => $item !== []) as [$item]) {
                    $item['uuid'] = Str::uuid();
                    $item['asmnt_question_id'] = AsmntQuestion::where('uuid', $dto['asmnt_question_uuid'])->first()->id;
                    array_push($new_answer_data, $item);
                    $answers_model->create($item);
                }
            }

            // Delete if there is a deleted answer
            if (count($removed_answer_data) > 0) {
                foreach ($removed_answer_data as $removed_answer) {
                    $answers_model->where('uuid', $removed_answer['uuid'])->delete();
                }
            }

            $this->results['response_code'] = 200;
            $this->results['success'] = true;
            $this->results['message'] = "Answer Successfully Updated";
            $this->results['data'] = [
                'edited_answer' => $old_answer_data,
                'new_answer' => $new_answer_data,
                'removed_answer' => $removed_answer_data,
            ];
        } else {
            $this->results['response_code'] = 404;
            $this->results['success'] = false;
            $this->results['message'] = "Answer Not Found";
            $this->results['data'] = [];
        }
    }
}
