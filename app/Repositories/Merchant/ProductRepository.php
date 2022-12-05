<?php

namespace App\Repositories\Merchant;

use App\Interfaces\Merchant\ProductInterface;
use App\Models\Product;
use App\Models\ProductCombination;
use App\Models\productStock;
use App\Models\ProductVariant;
use App\Models\VariantValue;
use Illuminate\Support\Arr;

class ProductRepository implements ProductInterface
{
    public function create($ProductData)
    {
        $product = Product::create($ProductData);

        if (isset($ProductData['tags'])) {
            $product->attachTags($ProductData['tags']);
        }

        if (isset($ProductData['product_images']) && ! empty($ProductData['product_images'])) {
            $product->saveFiles($ProductData['product_images'], 'product_images');
        }
    }

    public function index($request)
    {
        return  Product::where('merchant_id', $request)->get();
    }

    public function update($ProductData, $id)
    {
        $product = Product::where('id', $id)->where('merchant_id', $ProductData['merchant_id'])->firstOrFail();
        $product->update($ProductData);

        $product->attachTags($ProductData['tags']);
        if (isset($ProductData['tags'])) {
            $product->attachTags($ProductData['tags']);
        }
        if (isset($ProductData['deleted_tags'])) {
            $product->detachTags($ProductData['deleted_tags']);
        }

        if (! empty($ProductData['product_images'])) {
            foreach ($ProductData['product_images'] as $productImage) {
                $product->saveFiles($productImage, 'product_images');
            }
        }

        if (! empty($ProductData['deleted_images'])) {
            foreach ($ProductData['deleted_images'] as $productImage) {
                $product->Media()->where('id', $productImage)->delete();
            }
        }
    }

    public function show($auth, $id)
    {
        return Product::where('id', $id)->where('merchant_id', $auth)->firstOrFail();
    }

    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
    }

    public function CreateProductVariant(array $variantData, $product)
    {
        foreach ($variantData as $variant => $variantValue) {
            $productVariant = ProductVariant::updateOrCreate(
                ['product_id' => $product, 'name' => $variant],
                ['product_id' => $product, 'name' => $variant]
            );

            foreach ($variantValue as $values) {
                $productVariant->value()->create($values);
            }
        }
    }

    public function productVariantCombination($variantValueData)
    {
        $productVariantsValues = VariantValue::whereIn('id', $variantValueData['variant_value'])->pluck('name');
        $product = Product::where('id', $variantValueData['product_id'])->pluck('name');
        $skuData = $product->merge($productVariantsValues);
        $sku = '';
        //to be moved to a helper function
        foreach ($skuData as $value) {
            $sku = $sku.mb_substr($value, 0, 1);
        }
        $sku = strtoupper($sku);
        $productCombinationCount = ProductCombination::count();
        $sku = $sku.str_pad($productCombinationCount + 1, 4, '0', STR_PAD_LEFT);
        $combination['combination_string'] = $productVariantsValues->implode('-');
        $combination['sku'] = $sku;
        $combination['product_id'] = $variantValueData['product_id'];
        $combinationExists = ProductCombination::where('combination_string', $combination['combination_string'])->where('product_id', $combination['product_id'])->first();
        $skuCom = isset($combinationExists) ? $combinationExists->sku : $combination['sku'];
        $combination['sku'] = $skuCom;
        $productCombination = ProductCombination::updateOrCreate(['product_id' => $combination['product_id'], 'sku' => $combination['sku']], $combination);
        $productCombination->productStock()->UpdateOrCreate(['product_combination_id' => $productCombination->id, 'stock' => $variantValueData['stock'], 'price' => $variantValueData['price']], $variantValueData);

        return $productCombination;
    }

    public function getProductVariants($product_id)
    {
        // $combination = ProductCombination::where('product_id', $this->product_id)->value('combination_string');
        // $variantExploded = explode("-", $combination);
        return ProductVariant::where('product_id', $product_id)->get();
    }

    public function getProductVariantValues($variantData)
    {
        $combination = ProductCombination::where('product_id', $variantData['product_id'])->value('combination_string');
        $variantExploded = explode('-', $combination);

        return VariantValue::where('product_variant_id', $variantData['variant_id'])->whereNotIn('name', $variantExploded)->get();
    }

    public function getProductVariantCombinations($product_id, $merchant_id)
    {
        $product = Product::where('id', $product_id)->where('merchant_id', $merchant_id)->firstOrFail();

        return $product->ProductCombination;
    }

    public function updateProductVariantCombinations($variantCombinationData)
    {
        $data = Arr::except($variantCombinationData, ['product_id']);
        productStock::where('product_combination_id', $variantCombinationData['product_combination_id'])->update($data);
    }
}
