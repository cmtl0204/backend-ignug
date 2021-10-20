<?php

namespace App\Http\Resources\V1\Uic;

use Illuminate\Http\Resources\Json\JsonResource;

class TutorResource extends JsonResource
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
            'projectPlan' => ProjectPlanResource::make($this->project_plan),
            'teacher' => TeacherResource::make($this->teacher),
            'type' => CatalogueResource::make($this->type),
            'observations' =>$this->observations,
        ];
    }
}
