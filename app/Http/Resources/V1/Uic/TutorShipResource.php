<?php

namespace App\Http\Resources\V1\Uic;

use Illuminate\Http\Resources\Json\JsonResource;

class TutorShipResource extends JsonResource
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
            'tutor' => TutorResource::make($this->tutor),
            'enrollment' => EnrollmentResource::make($this->enrollment),
            'topics' =>$this->topics,
            'startedAt' =>$this->started_at,
            'timeStartedAt' =>$this->time_started_at,
            'timeEndedAt' =>$this->time_ended_at,
            'duration' =>$this->duration,
            'duration' =>$this->duration,
        ];
    }
}
