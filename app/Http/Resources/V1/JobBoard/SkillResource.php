<?php

namespace App\Http\Resources\V1\JobBoard;

use App\Http\Resources\V1\Core\Catalogues\CatalogueResource;
use Illuminate\Http\Resources\Json\JsonResource;

class SkillResource extends JsonResource
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
            'type' => CatalogueResource::make($this->type),
            'description' => $this->description,
            'createdAt'=>$this->created_at,
            'updatedAt'=>$this->updated_at,
        ];
    }
}
