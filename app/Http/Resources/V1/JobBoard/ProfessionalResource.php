<?php

namespace App\Http\Resources\V1\JobBoard;

use App\Http\Resources\V1\Core\Users\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfessionalResource extends JsonResource
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
            'user' => UserResource::make($this->user),
            'traveled' => $this->traveled,
            'disabled' => $this->disabled,
            'familiar_disabled' => $this->familiar_disabled,
            'identification_familiar_disabled' => $this->identification_familiar_disabled,
            'catastrophic_diseased' => $this->catastrophic_diseased,
            'familiar_catastrophic_diseased' => $this->familiar_catastrophic_diseased,
            'aboutMe' => $this->about_me,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
        ];
    }
}
