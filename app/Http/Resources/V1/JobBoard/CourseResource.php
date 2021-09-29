<?php

namespace App\Http\Resources\V1\JobBoard;

use App\Http\Resources\V1\Core\Catalogues\CatalogueResource;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{
    /**
     * @var mixed
     */

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'type' => CatalogueResource::make($this->type),
            'certificationType' => CatalogueResource::make($this->certificationType),
            'area' => CatalogueResource::make($this->area),
            'name' => $this->name,
            'description' => $this->description,
            'startedDate' => Carbon::create(strval($this->started_date))->format('Y-m-d'),
//            'startDate' => Carbon::create(strval($this->start_date))->toDayDateTimeString(),
            'endedDate' => Carbon::create(strval($this->ended_date))->format('Y-m-d'),
//            'endDate' => Carbon::create(strval($this->end_date))->toDayDateTimeString(),
            'hours' => $this->hours,
            'institution' => $this->institution,
            'createdAt'=>$this->created_at,
            'updatedAt'=>$this->updated_at,
        ];
    }
}
