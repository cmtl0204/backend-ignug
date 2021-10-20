<?php

namespace App\Http\Resources\V1\Uic;

use Illuminate\Http\Resources\Json\JsonResource;

class EnrollmentResource extends JsonResource
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
            'modality' =>  ModalityResource::make($this->modality),
            'schoolPeriod' =>  SchoolPeriodResource::make($this->school_period),
            'meshStudent' =>  MeshStudentResource::make($this->mesh_student),
            'state' =>  StateResource::make($this->state),
            'planning' =>  PlanningResource::make($this->planning),
            'registeredAt' => $this->registered_at,
            'code' => $this->code,
            'observations' => $this->observations,
        ];
    }
}
