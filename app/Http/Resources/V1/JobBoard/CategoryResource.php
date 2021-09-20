<?php

namespace App\Http\Resources\V1\JobBoard;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'parent' => CategoryResource::make($this->parent_id),
            'code' => $this->code,
            'name' => $this->name,
            'icon' => $this->icon,
            'createAt'=>$this->create_at,
            'updateAt'=>$this->update_at,
        ];
    }
}
