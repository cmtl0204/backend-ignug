<?php

namespace App\Http\Resources\V1\Uic;

use Illuminate\Http\Resources\Json\JsonResource;

class ProjectPlanResource extends JsonResource
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
            'title' =>$this->title,
            'description' =>$this->description,
            'actCode' =>$this->act_code,
            'approvedAt' =>$this->approved_at,
            'approved' =>$this->approved,
            'observations' =>$this->observations,
        ];
    }
}
