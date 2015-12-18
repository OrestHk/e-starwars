<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ContactFormRequest extends Request
{
    /**
     * Define custom error messages
     */
    public function messages(){
        return [
            'required' => 'This field is required',
            'email' => 'Not a valid mail format'
        ];
    }
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
            'email'     => 'required|email',
            'message'   => 'required'
        ];
    }
}
