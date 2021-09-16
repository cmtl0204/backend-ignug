<?php

namespace App\Http\Requests\V1\JobBoard\Offer;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\V1\JobBoard\JobBoardFormRequest;

class IndexOfferRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'company_id' => [
                'integer',
            ],
        ];
        return JobBoardFormRequest::rules($rules);
    }

    public function attributes()
    {
        $attributes = [
            'company_id' => 'compania-id',
        ];
        return JobBoardFormRequest::attributes($attributes);
    }
}
