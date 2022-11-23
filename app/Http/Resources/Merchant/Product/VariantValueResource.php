<?php

namespace App\Http\Resources\Merchant\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class VariantValueResource extends JsonResource
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
            'product_variant_id' => $this->product_variant_id
        ];
    }
}
