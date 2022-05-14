<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'     => 'required|min:3',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:4'
        ];
    }

    public function messages()
    {
        return [
            'name.required'     => 'name is required',
            'name.min'          => 'name is invalid',
            'email.required'    => 'email is required',
            'email.email'       => 'email is invalid',
            'email.min'         => 'email is invalid',
            'password.required' => 'password is required',
            'password.min'      => 'password is invalid'
        ];
    }
}
