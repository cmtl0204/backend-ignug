<?php

namespace App\Http\Resources\V1\Uic;

use Illuminate\Http\Resources\Json\JsonResource;

class MeshStudentResource extends JsonResource
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
            'student' =>  StudentResource::make($this->student),
            'mesh' =>  MeshResource::make($this->mesh),
            'startCohort' =>$this->start_cohort,
            'isGraduated' =>$this->is_graduated,
            'endCohort' =>$this->end_cohort,
        ];
    }
}
