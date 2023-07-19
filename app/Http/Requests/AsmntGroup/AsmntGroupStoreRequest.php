<?php

namespace App\Http\Requests\AsmntGroup;

use Illuminate\Foundation\Http\FormRequest;

class AsmntGroupStoreRequest extends FormRequest
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
            'certificate_setting_id' => ['required'],
            'name' => ['required', 'string', 'max:30', 'unique:asmnt_groups,name']
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
            'certificate_setting_id' => 'Certificate Setting',
        ];
    }

}
