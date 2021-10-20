<?php

namespace App\Http\Resources\V1\Uic;

use Illuminate\Http\Resources\Json\JsonResource;

class ModalityResource extends JsonResource
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
            'parent' =>  ModalityResource::make($this->parent),
            'state' =>  StateResource::make($this->state),
            'career' => CareerResource::make($this->career),
            'name' =>$this->name,
            'description' =>$this->description,
        ];
    }
}
