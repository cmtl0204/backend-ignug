<?php

namespace App\Http\Requests\V1\Authentications;

use Illuminate\Foundation\Http\FormRequest;

class PasswordForgotAuthRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'username' => ['required'],
        ];
    }

    public function attributes()
    {
       return  [
            'username' => 'nombre de usuario',
        ];

    }
}
