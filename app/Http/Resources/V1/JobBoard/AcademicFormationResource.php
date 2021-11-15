<?php

namespace App\Http\Resources\V1\JobBoard;

use App\Http\Resources\V1\Core\CareerResource;
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
            'career' => CareerResource::make($this->career),
            'institution' => CareerResource::make($this->career)->institution,
            'registeredAt' => $this->registered_at,
            'senescytCode' => $this->senescyt_code,
            'certificated' => $this->certificated,
            'createdAt'=>$this->created_at,
            'updatedAt'=>$this->updated_at,
        ];
    }
}
