<?php

namespace App\Http\Resources\User\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductVariationCombinationResource extends JsonResource
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
            'combination_string' => $this->combination_string,
            'sku' => $this->sku,
            'stock' => new ProductStockResource($this->productStock),
        ];
    }
}
