<?php

namespace App\Http\Requests\V1\JobBoard\Course;

use App\Http\Requests\V1\JobBoard\JobBoardFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class StoreCourseRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'type.id' => [
                'required',
            ],
            'certificationType.id' => [
                'required',
            ],
            'area.id' => [
                'required',
            ],
            'name' => [
                'required',
            ],
            'description' => [
                'nullable',
                'min:10',
            ],
            'startedAt' => [
                'required',
                'date',
            ],
            'endedAt' => [
                'required',
                'date',
                'after_or_equal:startedAt'
            ],
            'hours' => [
                'required',
                'numeric'
            ],
            'institution' => [
                'required',
            ],
        ];
        return JobBoardFormRequest::rules($rules);
    }

    public function attributes(): array
    {
        $attributes = [
            'area.id' => 'area de estudios',
            'certificationType.id' => 'tipo de certificación',
            'description' => 'descripción',
            'endedAt' => 'fecha de fin',
            'hours' => 'horas',
            'institution' => 'institución',
            'name' => 'nombre del evento',
            'startedAt' => 'fecha de inicio',
            'type.id' => 'tipo de evento',
        ];
        return JobBoardFormRequest::attributes($attributes);
    }
}
