<?php

namespace App\Http\Requests\V1\JobBoard\Course;

use Illuminate\Foundation\Http\FormRequest;

class DestroysCourseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'ids' => ['required'],
        ];
    }

    public function attributes(): array
    {
        return [
            'ids' => 'ID`s de los cursos',
        ];
    }
}
