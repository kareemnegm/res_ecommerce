<?php

namespace App\Http\Resources\Merchant\Product;

use App\Http\Resources\ImageResource;
use App\Http\Resources\Merchant\MerchantCategoryResource;
use App\Http\Resources\TagsResource;
use Illuminate\Http\Resources\Json\JsonResource;

class SingleProductResource extends JsonResource
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
            'merchant_id'=>$this->merchant_id,
            'name' => $this->name,
            'description_en' => $this->description,
            'price' => $this->price,
            'offer_price' => $this->offer_price,
            'stock_quantity' => $this->stock_quantity,
            'is_published' => $this->is_published,
            'category' => new MerchantCategoryResource($this->merchantCategory),
            'tags' => TagsResource::collection($this->tags),
            'product_images' => ImageResource::collection($this->getMedia('product_images')) ?? null,
            'order' => $this->order,
            'variant'=> ProductVariantWithValues::collection($this->variant)

        ];
    }
}
