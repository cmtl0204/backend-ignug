<?php

namespace App\Http\Resources\V1\LicenseWork;

use Illuminate\Http\Resources\Json\JsonResource;

class DependenceResource extends JsonResource
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
            
              'id'=>$this->id,
              'name'=>$this->name,
              'level'=>$this->level,
<<<<<<< HEAD
           ]
=======

>>>>>>> 580d584762a608b92ab41cb38fbe5b16f1d0a342
    ];
    }
}
