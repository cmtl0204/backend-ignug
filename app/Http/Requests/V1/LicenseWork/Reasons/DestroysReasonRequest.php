<?php

namespace App\Http\Requests\V1\LicenseWork\Reasons;

use Illuminate\Foundation\Http\FormRequest;

class DestroysReasonRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'ids' => ['required'],
        ];
    }

    {
        return [
            'ids' => 'ID`s de las razones',
        ];
    }
}
