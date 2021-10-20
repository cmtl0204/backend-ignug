<?php

namespace App\Http\Resources\V1\Uic;

use Illuminate\Http\Resources\Json\JsonResource;

class RequerimentRequestResource extends JsonResource
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
            'requirement' => RequirementResource::make($this->requirement),
            'meshStudent' => MeshStudentResource::make($this->mesh_student),
            'registeredAt' =>$this->registered_at,
            'approved' =>$this->approved,
            'observations' =>$this->observations,
        ];
    }
}
