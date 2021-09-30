<?php

namespace App\Http\Resources\V1\LicenseWork\Reasons;

use Illuminate\Http\Resources\Json\JsonResource;

class ReasonResource extends JsonResource
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
                  'name'=>$this->name,
                  'descriptionOne'=>$this->description_one,
                  'descriptionTwo'=>$this->description_two,
                  'discountableHolidays'=>$this->discountable_holidays,
                  'daysMin'=>$this->days_min,
                  'daysMax'=>$this->days_max,
                  
               ]
        ];
    }
}
