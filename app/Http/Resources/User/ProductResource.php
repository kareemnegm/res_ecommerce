<?php

namespace App\Http\Resources\User;

use App\Http\Resources\ImageResource;
use App\Http\Resources\Merchant\MerchantCategoryResource;
use App\Http\Resources\TagsResource;
use App\Http\Resources\User\Product\ProductVariantWithValuesResource;
use App\Http\Resources\User\Product\ProductVariationCombinationResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'merchant_id' => $this->merchant_id,
            'name_en' => $this->getTranslation('name', 'en'),
            'name_ar' => $this->getTranslation('name', 'ar'),
            'description_en' => $this->getTranslation('description', 'en'),
            'description_ar' => $this->getTranslation('description', 'ar'),
            'price' => $this->price,
            'offer_price' => $this->offer_price,
            'stock_quantity' => $this->stock_quantity,
            'is_published' => $this->is_published,
            'category' => new MerchantCategoryResource($this->merchantCategory),
            'tags' => TagsResource::collection($this->tags),
            'product_images' => ImageResource::collection($this->getMedia('product_images')) ?? null,
            'order' => $this->order,
            'variants' => ProductVariantWithValuesResource::collection($this->variant)
        ];
    }
}
