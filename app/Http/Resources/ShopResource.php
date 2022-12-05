<?php

namespace App\Http\Resources;

use App\Http\Resources\Category\CategoryResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ShopResource extends JsonResource
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
            'id' => $this->getId(),
            'shop_name' => $this->getShopName(),
            'description' => $this->getDescription(),
            'shop_logo' => new ImageResource($this->getFirstMedia('shop_logo')) ?? null,
            'category' =>  CategoryResource::collection($this->category),
        ];
    }
}
