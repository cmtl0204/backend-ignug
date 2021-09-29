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
            'area' => CatalogueResource::make($this->resource),
            'activities' => $this->activities,
            'endDate' => $this->end_date,
            'position' => $this->position,
            'reasonLeave' => $this->reason_leave,
            'startDate' => $this->start_date,
            'worked' => $this->worked,
            'createdAt'=>$this->created_at,
            'updatedAt'=>$this->updated_at,
        ];
    }
}
