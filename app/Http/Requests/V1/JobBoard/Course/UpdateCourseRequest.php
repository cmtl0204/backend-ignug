<?php

namespace App\Http\Requests\V1\JobBoard\Course;

use App\Http\Requests\V1\JobBoard\JobBoardFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCourseRequest extends FormRequest
{
    public function authorize()
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
                'min:10',
            ],
            'startAt' => [
                'required',
                'date',
            ],
            'endAt' => [
                'required',
                'date',
                'after_or_equal:startDate'
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
            'endAt' => 'fecha de fin',
            'hours' => 'horas',
            'institution' => 'institución',
            'name' => 'nombre del evento',
            'startAt' => 'fecha de inicio',
            'type.id' => 'tipo de evento',
        ];
        return JobBoardFormRequest::attributes($attributes);
    }
}