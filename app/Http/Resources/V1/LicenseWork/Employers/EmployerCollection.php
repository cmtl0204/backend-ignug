<?php

namespace App\Http\Resources\V1\LicenseWork\Employers;

use Illuminate\Http\Resources\Json\ResourceCollection;

class EmployerCollection extends ResourceCollection
{
    public $collects = EmployerResource::class;
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data'=>$this->collection,
        ];
    }
}
