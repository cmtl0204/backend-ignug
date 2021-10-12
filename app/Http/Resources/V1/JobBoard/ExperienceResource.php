<?php

namespace App\Http\Resources\V1\JobBoard;

use App\Http\Resources\V1\Core\Catalogues\CatalogueResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ExperienceResource extends JsonResource
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
            'area' => CatalogueResource::make($this->area),
            'activities' => $this->activities,
            'employer' => $this->employer,
            'endedAt' => $this->ended_at,
            'position' => $this->position,
            'reasonLeave' => $this->reason_leave,
            'startedAt' => $this->started_at,
            'worked' => $this->worked,
            'createdAt'=>$this->created_at,
            'updatedAt'=>$this->updated_at,
        ];
    }
}
