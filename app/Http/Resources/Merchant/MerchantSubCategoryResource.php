<?php

namespace App\Http\Resources\Merchant;

use Illuminate\Http\Resources\Json\JsonResource;

class MerchantSubCategoryResource extends JsonResource
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
            'name_en' => $this->name,
            'subCategory' => MerchantSubCategoryResource::collection($this->subs),
            'shop_id' => $this->shop_id

        ];
    }
}
