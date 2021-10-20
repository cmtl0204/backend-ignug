<?php

namespace App\Http\Resources\V1\Uic;

use Illuminate\Http\Resources\Json\JsonResource;

class MeshStudentRequerimentResource extends JsonResource
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
            'meshStudent' =>  MeshStudentResource::make($this->mesh_Student),
            'requirement' =>  RequirementResource::make($this->requirement),
            'approved' =>$this->approved,
            'observations' =>$this->observations,
        ];
    }
}
