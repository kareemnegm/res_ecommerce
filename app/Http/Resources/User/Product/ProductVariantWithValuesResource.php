<?php

namespace App\Http\Resources\User\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductVariantWithValuesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'value' => VariantValueResource::collection($this->value),
        ];
    }
}
