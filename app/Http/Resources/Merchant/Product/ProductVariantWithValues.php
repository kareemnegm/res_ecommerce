<?php

namespace App\Http\Resources\Merchant\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductVariantWithValues extends JsonResource
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
