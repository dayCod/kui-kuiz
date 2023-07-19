<?php

namespace App\Http\Requests\AsmntGroup;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class AsmntGroupUpdateRequest extends FormRequest
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
        $asmnt_group = DB::select("SELECT id FROM asmnt_groups WHERE uuid = ?", [request()->route()->parameter('uuid')])[0];

        return [
            'certificate_setting_id' => ['required'],
            'name' => ['required', 'string', 'max:30', Rule::unique('asmnt_groups', 'name')->ignore($asmnt_group->id)]
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
