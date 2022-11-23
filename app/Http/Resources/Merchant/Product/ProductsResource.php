<?php

namespace App\Http\Resources\Merchant\Product;

use App\Http\Resources\ImageResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductsResource extends JsonResource
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
            'merchant_id'=>$this->merchant_id,
            'name_en' => $this->getTranslation('name', 'en'),
            'name_ar' => $this->getTranslation('name', 'ar'),
            'description_en' => $this->getTranslation('description', 'en'),
            'description_ar' => $this->getTranslation('description', 'ar'),
            'price'=>$this->price,
            'offer_price'=>$this->offer_price,
            'stock_quantity'=>$this->stock_quantity,
            'is_published'=>$this->is_published,
            'product_image'=> new ImageResource($this->getFirstMedia('product_images'))?? null,
            'order'=>$this->order

        ];
    }
}
