<?php

namespace App\Http\Requests\V1\JobBoard\Offer;

use App\Http\Requests\V1\JobBoard\JobBoardFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class StoreOfferRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'contactName' => [
                'required',
                'min:4',
                'max:250',
            ],
            'contactEmail' => [
                'required',
                'min:10',
                'max:100',
                'email',
            ],
            'contactPhone' => [
                'required_without:offer.contact_cellphone',
            ],
            'contactCellphone' => [
                'required_without:offer.contact_phone',
            ],
            'startedAt' => [
                'required',
                'date',
            ],
            'activities' => [
                'required',
                'array',
            ],
            'requirements' => [
                'required',
                'array',
            ],
            'location.id' => [
                'required',
                'integer',
            ],
            'contractType.id' => [
                'required',
                'integer',
            ],
            'position.id' => [
                'required',
                'integer',
            ],
            'sector.id' => [
                'required',
                'integer',
            ],
            'workingDay.id' => [
                'required',
                'integer',
            ],
            'experienceTime.id' => [
                'required',
                'integer',
            ],
            'trainingHours.id' => [
                'required',
                'integer',
            ],
            'status.id' => [
                'required',
                'integer',
            ],
        ];
        return JobBoardFormRequest::rules($rules);
    }

    public function attributes()
    {
        $attributes = [
            'contactName' => 'nombre-contacto',
            'contactEmail' => 'email-contacto',
            'contactPhone' => 'telefono-contacto',
            'contactCellphone' => 'celular-contacto',
            'startedAt' => 'fecha-inicio',
            'activities' => 'actividades',
            'requirements' => 'requerimientos',
            'location.id' => 'locacion-id',
            'contractType.id' => 'tipo-contrato-id',
            'position.id' => 'posicion-id',
            'sector.id' => 'sector-id',
            'workingDay.id' => 'dia-trabajo-id',
            'experienceTime.id' => 'tiempo-expreriencia-id',
            'trainingHours.id' => 'horas-entrenamiento-id',
            'status.id' => 'estado-id',
        ];
        return JobBoardFormRequest::attributes($attributes);
    }
}
