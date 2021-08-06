<?php

namespace App\Http\Requests\V1\Images;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\V1\AppFormRequest;

class IndexImageRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'id' => [
                'required',
                'integer',
            ],
        ];
        return AppFormRequest::rules($rules);
    }

    public function attributes()
    {
        $attributes = [
            'id' => 'ID',
        ];
        return AppFormRequest::attributes($attributes);
    }
}
