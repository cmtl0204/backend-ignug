<?php

namespace App\Http\Resources\V1\JobBoard;

use App\Http\Resources\V1\Core\Catalogues\CatalogueResource;
use Illuminate\Http\Resources\Json\JsonResource;

class   AcademicFormationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'professionalDegree' => CategoryResource::make($this->professionalDegree),
            'registrationDate' => $this->registration_date,
            'senescytCode' => $this->senescyt_code,
            'certificated' => $this->certificated,
        ];
    }
}
