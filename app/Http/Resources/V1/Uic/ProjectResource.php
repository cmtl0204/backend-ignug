<?php

namespace App\Http\Resources\V1\Custom;

use Illuminate\Http\Resources\Json\JsonResource;

class ExampleResource extends JsonResource
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
            'enrollment' => EnrollmentResource::make($this->enrollment),
            'projectPlan' => ProjectPlanResource::make($this->projectPlan),
            'title'=>$this->title,
            ''=>$this->title,
            'title'=>$this->title,
            'title'=>$this->title,
            'title'=>$this->title,
        ];
    }
}
