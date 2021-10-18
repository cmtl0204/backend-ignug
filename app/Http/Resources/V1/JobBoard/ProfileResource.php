<?php

namespace App\Http\Resources\V1\JobBoard;

use App\Http\Resources\V1\Core\Users\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user' => UserResource::make($this->user),
            'traveled' => $this->traveled,
            'disabled' => $this->disabled,
            'familiarDisabled' => $this->familiar_disabled,
            'identificationFamiliarDisabled' => $this->identification_familiar_disabled,
            'catastrophicDiseased' => $this->catastrophic_diseased,
            'familiarCatastrophicDiseased' => $this->familiar_catastrophic_diseased,
            'aboutMe' => $this->about_me,
        ];
    }
}
