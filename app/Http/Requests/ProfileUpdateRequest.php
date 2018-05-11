<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required|string',
            'last_name'  => 'required|string',
            'occupation' => 'string|required',
            'location'   => 'string|required',
            'summary'    => 'string|nullable',
            'facebook'   => 'string|nullable',
            'upwork'     => 'string|nullable',
            'linkedin'   => 'string|nullable'
        ];
    }
}
