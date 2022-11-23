<?php

namespace App\Http\Resources\Merchant\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductCombinationResource extends JsonResource
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
            'id'=>$this->id,
            'combination_string'=>$this->combination_string,
            'sku'=>$this->sku,
            'product_id'=>$this->product_id,
            'stock'=>$this->productStock->stock,
            'price'=>$this->productStock->price,
        ];
    }
}
