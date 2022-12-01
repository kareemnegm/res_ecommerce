<?php

namespace App\Http\Resources\User;

use App\Http\Resources\ImageResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
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
            'name_en' => $this->getTranslation('name', 'en'),
            'name_ar' => $this->getTranslation('name', 'ar'),
            'price' => $this->price,
            'offer_price' => $this->offer_price,
            'product_image' => new ImageResource($this->getFirstMedia('product_images')) ?? null,
            'quantity' => $this->pivot->quantity,
            'product_variant_details' => $this->cart_product_variant,

        ];
    }
}
