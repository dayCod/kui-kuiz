<?php

namespace App\Http\Requests\Assessment;

use Illuminate\Foundation\Http\FormRequest;

class AssessmentUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'asmnt_group_id' => ['required'],
            'asmnt_setting_id' => ['required'],
            'asmnt_name' => ['required', 'string', 'max:255'],
            'time_open' => ['required', 'date_format:Y-m-d\TH:i'],
            'time_close' => ['required', 'date_format:Y-m-d\TH:i', 'after:time_open'],
            'asmnt_time_test' => ['required', 'integer', 'min:1'],
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'asmnt_group_id' => 'Assessment Group',
            'asmnt_setting_id' => 'Assessment Setting',
        ];
    }
}
