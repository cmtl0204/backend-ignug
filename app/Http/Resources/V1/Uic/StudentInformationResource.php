<?php

namespace App\Http\Resources\V1\Uic;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentInformationResource extends JsonResource
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
            'student' => StudentResource::make($this->student),
            'relationLaboralCareer' => CatalogueResource::make($this->relation_laboral_career),
            'companyArea' => CatalogueResource::make($this->company_area),
            'companyPosition' => CatalogueResource::make($this->company_position),
            'companyWork' =>$this->company_work,
        ];
    }
}
