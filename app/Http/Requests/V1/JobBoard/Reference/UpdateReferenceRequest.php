<?php

namespace App\Http\Requests\V1\JobBoard\Reference;

use App\Http\Requests\V1\JobBoard\JobBoardFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class UpdateReferenceRequest extends FormRequest
{
    private $regularExpresionEmail = '/^(([^<>()\[\]\\.,;:\s@”]+(\.[^<>()\[\]\\.,;:\s@”]+)*)|(“.+”))@((\[[0–9]{1,3}\.[0–9]{1,3}\.[0–9]{1,3}\.[0–9]{1,3}])|(([a-zA-Z\-0–9]+\.)+[a-zA-Z]{2,}))$/';

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
            'institution' => [
                'required',
                'min:5',
                'max:30',
            ],
            'position' => [
                'required',
            ],
            'contactName' => [
                'required',
                'max:30',
            ],
            'contactPhone' => [
                'required',
                'numeric',
            ],
            'contactEmail' => [
                'required',
                'regex:'.$this->regularExpresionEmail,
            ]
        ];

        return JobBoardFormRequest::rules($rules);
    }

    public function attributes()
    {
        $attributes = [
            'institution' => 'institución',
            'position' => 'cargo que ocupó',
            'contactName' => 'nombre de contacto',
            'contactPhone' => 'teléfono de contacto',
            'contactEmail' => 'email de contacto',
        ];
        return JobBoardFormRequest::attributes($attributes);
    }
}
