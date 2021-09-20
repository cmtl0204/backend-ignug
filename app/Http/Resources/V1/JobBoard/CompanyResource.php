<?php

namespace App\Http\Resources\V1\JobBoard;

use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
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
            'createAt'=>$this->create_at,
            'updateAt'=>$this->update_at,
        ];
    }
}
