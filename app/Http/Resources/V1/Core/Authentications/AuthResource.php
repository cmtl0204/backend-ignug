<?php

namespace App\Http\Resources\V1\Core\Authentications;

use App\Http\Resources\V1\Core\Users\UserResource;
use App\Http\Resources\V1\JobBoard\ProfessionalResource;
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
            'permissions' => PermissionResource::collection($this->permissions),
            'user' => UserResource::make($this->resource),
            'professional' => ProfessionalResource::make($this->resource),
        ];
    }
}
