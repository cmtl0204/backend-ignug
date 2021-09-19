<?php

namespace App\Http\Requests\V1\JobBoard\Language;

use App\Http\Requests\V1\JobBoard\JobBoardFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class StoreLanguageRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'idiom.id' => [
                'required',

            ],
            'writtenLevel.id' => [
                'required',

            ],
            'spokenLevel.id' => [
                'required',

            ],
            'readLevel.id' => [
                'required',

            ]
        ];
        return JobBoardFormRequest::rules($rules);
    }

    public function attributes()
    {
        $attributes = [
            'idiom.id' => 'idioma-ID',
            'writtenLevel.id' => 'nivel escritura-ID',
            'spokenLevel.id' => 'nivel hablado-ID',
            'readLevel.id' => 'nivel lectura-ID',

        ];
        return JobBoardFormRequest::attributes($attributes);
    }
}
