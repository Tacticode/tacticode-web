<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserRequest extends Request
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
        $rules = [
            'login' => 'required|min:3|max:20|unique_if_different_than_user|alpha_dash',
            'email' => 'required|email|unique_if_different_than_user',
            'password' => 'required|min:3|max:50'
        ];

        if (Request::segment(1) == 'user')
        {
            unset($rules['password']);
        }

        return $rules;
    }
}
