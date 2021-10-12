<?php

namespace App\Http\Resources\V1\JobBoard;

use App\Http\Resources\V1\Core\Catalogues\CatalogueResource;
use Illuminate\Http\Resources\Json\JsonResource;

class LanguageResource extends JsonResource
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
            'idiom' => CatalogueResource::make($this->idiom),
            'writtenLevel' => CatalogueResource::make($this->writtenLevel),
            'spokenLevel' => CatalogueResource::make($this->spokenLevel),
            'readLevel' => CatalogueResource::make($this->readLevel),
            'createdAt'=>$this->created_at,
            'updatedAt'=>$this->updated_at,
        ];
    }
}
