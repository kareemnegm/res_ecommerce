<?php

namespace App\Http\Resources\Merchant\Product;

use App\Models\ProductCombination;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductVariantWithVAluesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $combination = ProductCombination::where('product_id', $this->product_id)->value('combination_string');
        $variantExploded = explode("-", $combination);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'product_id' => $this->product_id,
            'variant_values' => VariantValueResource::collection($this->value()->whereNotIn('name',$variantExploded)->get())
        ];
    }
}
