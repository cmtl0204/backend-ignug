<?php

namespace App\Http\Resources\V1\Uic;

use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
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
            'planning' =>  PlanningResource::make($this->planning),
            'name' =>  CatalogueResource::make($this->name),
            'startedAt' =>$this->started_at,
            'endedAt' =>$this->ended_at,
        ];
    }
}
