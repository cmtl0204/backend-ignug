<?php

namespace App\Http\Requests\V1\JobBoard\Offer;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\V1\JobBoard\JobBoardFormRequest;

class GetProfessionalOfferRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
        ];
        return JobBoardFormRequest::rules($rules);
    }

    public function attributes()
    {
        $attributes = [
        ];
        return JobBoardFormRequest::attributes($attributes);
    }
}
