<?php

namespace App\Http\Requests\V1\JobBoard\Language;

use App\Http\Requests\V1\JobBoard\JobBoardFormRequest;
use Illuminate\Foundation\Http\FormRequest;


class UpdateLanguageRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'idiomId' => [
                'required',

            ],
            'writtenLevelId' => [
                'required',

            ],
            'spokenLevelId' => [
                'required',

            ],
            'readLevelId' => [
                'required',

            ]
        ];
        return JobBoardFormRequest::rules($rules);
    }


    public function attributes()
    {
        $attributes = [

            'idiomId' => 'idioma-ID',
            'writtenLevelId' => 'nivel escritura-ID',
            'spokenLevelId' => 'nivel hablado-ID',
            'readLevelId' => 'nivel lectura-ID',
        ];
        return JobBoardFormRequest::attributes($attributes);
    }
}
