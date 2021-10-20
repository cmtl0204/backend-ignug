<?php

namespace App\Http\Requests\V1\Uic\TutorShips;

use App\Http\Requests\V1\Uic\UicFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTutorShipRequest extends FormRequest
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
            'tutor.id' => [
                'required'
            ],

            'enrollment.id' => [
                'required'
            ],

            'topics' => [
                'required'
            ],

            'startedAt' => [
                'required'
            ],

            'timeStartedAt' => [
                'required'
            ],

            'timeEndedAt' => [
                'required'
            ],

            'duration' => [
                'required'
            ],

            'percentageAdvance' => [
                'required'
            ],

        ];

        return UicFormRequest::rules($rules);
    }

    public function attributes(): array
    {
        $attributes = [
            'tutor.id' => 'Tutor',
            'enrollment.id' => 'Inscripción',
            'topics' => 'Temas tratados',
            'startedAt' => 'Fecha de la tutoría',
            'timeStartedAt' => 'Hora de inicio de la tutorían',
            'timeEndedAt' => 'Hora en que terminó latutoría',
            'duration' => 'Duración de la tutoría',
            'percentageAdvance' => 'Porcentaje de avance',
        ];

        return UicFormRequest::attributes($attributes);
    }
}
