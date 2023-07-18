<?php

namespace App\Http\Requests\Setting\Certificate;

use Illuminate\Foundation\Http\FormRequest;

class CertificateUpdateRequest extends FormRequest
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
            'page_orientation' => ['required'],
            'heading' => ['required', 'string', 'max:35'],
            'description' => ['required', 'string', 'max:80'],
            'signatured_by' => ['required', 'string', 'max:30'],
            'certi_background_img' => ['required', 'mimes:png,jpeg'],
            'signature_img' => ['required', 'mimes:png,jpeg'],
        ];
    }
}
