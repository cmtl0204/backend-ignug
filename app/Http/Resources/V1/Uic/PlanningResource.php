<?php

namespace App\Http\Resources\V1\Uic;

use Illuminate\Http\Resources\Json\JsonResource;

class PlanningResource extends JsonResource
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
            'career' => CareerResource::make($this->career),
            'name' =>$this->name,
            'description' =>$this->description,
            'startedAt' =>$this->started_at,
            'endedAt' =>$this->ended_at,
        ];
    }
}
