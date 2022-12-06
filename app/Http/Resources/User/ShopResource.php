<?php

namespace App\Http\Resources\User;

use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\ImageResource;
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
            'id' => $this->id,
            'shop_name' => $this->shop_name,
            'description' => $this->description,
            'shop_logo' => new ImageResource($this->getFirstMedia('shop_logo')) ?? null,
            'category' => CategoryResource::collection($this->category),
        ];
    }
}
