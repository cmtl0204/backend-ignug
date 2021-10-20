<?php

namespace App\Http\Resources\V1\Uic;

use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
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
            'enrollment' => EnrollmentResource::make($this->enrollment),
            'projectPlan' => ProjectPlanResource::make($this->project_plan),
            'title' =>$this->title,
            'description' =>$this->description,
            'tutorAsigned' =>$this->tutor_asigned,
            'totalAdvance' =>$this->total_advance,
            'score' =>$this->score,
            'approved' =>$this->approved,
            'observations' =>$this->observations,
        ];
    }
}
