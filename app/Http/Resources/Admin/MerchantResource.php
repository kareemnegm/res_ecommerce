<?php

namespace App\Http\Resources\Admin;

use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\CountryResource;
use App\Http\Resources\ImageResource;
use Illuminate\Http\Resources\Json\JsonResource;

class MerchantResource extends JsonResource
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
            'shop_name_en' => $this->getTranslation('shop_name', 'en'),
            'shop_name_ar' => $this->getTranslation('shop_name', 'ar'),
            'description_en' => $this->getTranslation('description', 'en'),
            'description_ar' => $this->getTranslation('description', 'ar'),
            'email' => $this->email,
            'mobile' => $this->country_code . $this->mobile,
            'approved' => $this->approved,
            'country' => new CountryResource($this->country),
            'shop_logo' => new ImageResource($this->getFirstMedia('shop_logo')) ?? null,
            'category' =>  CategoryResource::collection($this->category),
            'admin_id' => $this->admin_id
        ];
    }
}
