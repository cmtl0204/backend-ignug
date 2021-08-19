<?php

namespace App\Http\Requests\V1\Core\Images;

use Illuminate\Foundation\Http\FormRequest;

class DownloadImageRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'full_path' => [
                'required',
            ],
        ];
    }

    public function attributes()
    {
       return [
            'full_path' => 'ruta completa',
        ];
    }
}
