<?php

namespace App\Http\Resources\V1\LicenseWork\Employees;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
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
            'data'=>[
              'id'=>$this->id,
              'user'=>$this->user,
              
           ]
    ];
    }
}
