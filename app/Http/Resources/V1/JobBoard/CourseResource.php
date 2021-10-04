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
            'startedAt' => Carbon::create(strval($this->started_at))->format('Y-m-d'),
//            'startedAt' => Carbon::create(strval($this->started_at))->toDayDateTimeString(),
            'endedAt' => Carbon::create(strval($this->ended_at))->format('Y-m-d'),
//            'endDate' => Carbon::create(strval($this->ended_at))->toDayDateTimeString(),
            'hours' => $this->hours,
            'institution' => $this->institution,
            'createdAt'=>$this->created_at,
            'updatedAt'=>$this->updated_at,
        ];
    }
}
