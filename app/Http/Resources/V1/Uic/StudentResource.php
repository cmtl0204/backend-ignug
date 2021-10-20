<?php

namespace App\Http\Resources\V1\Uic;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
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
            'meshStudent' => meshStudentResource::make($this->mesh_student),
            'observations' =>$this->observations,
        ];
    }
}
