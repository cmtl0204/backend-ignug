<?php

namespace App\Http\Resources\V1\JobBoard;

use App\Http\Resources\V1\Core\Catalogues\CatalogueResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{
    /**
     * @var mixed
     */

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
             'type' => CatalogueResource::make($this->resource),
             'certificationType' => CatalogueResource::make($this->resource),
             'area' => CatalogueResource::make($this->resource),
             'name' => $this->name,
             'startDate' => $this->start_date,
             'endDate' => $this->end_date,
             'hours' => $this->hours,
        ];
    }
}
