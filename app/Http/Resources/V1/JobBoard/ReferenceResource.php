<?php

namespace App\Http\Resources\V1\JobBoard;

use Illuminate\Http\Resources\Json\JsonResource;

class ReferenceResource extends JsonResource
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
            'contactName' => $this->contact_name,
            'contactPhone' => $this->contact_phone,
            'contactEmail' => $this->contact_email,
            'institution' => $this->institution,
            'position' => $this->position,
            'createdAt'=>$this->created_at,
            'updatedAt'=>$this->updated_at,
        ];
    }
}
