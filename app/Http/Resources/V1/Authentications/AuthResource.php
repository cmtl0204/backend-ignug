<?php

namespace App\Http\Resources\V1\Authentications;

use App\Http\Resources\V1\Catalogues\CatalogueResource;
use App\Http\Resources\V1\Users\EmailResource;
use App\Http\Resources\V1\Users\PhoneResource;
use App\Http\Resources\V1\Users\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthResource extends JsonResource
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
            'roles' => RoleResource::collection($this->roles),
            'user' => UserResource::make($this->resource),
        ];
    }
}
