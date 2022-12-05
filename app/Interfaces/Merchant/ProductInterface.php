<?php

namespace App\Interfaces\Merchant;

interface ProductInterface
{
    public function create($ProductData);

    public function index($request);

    public function show($auth, $id);

    public function update($ProductData, $id);

    public function deleteProduct($id);

    /**
     * variants
     */
    public function CreateProductVariant(array $variantData, $product);

    public function getProductVariants($product_id);

    public function getProductVariantValues($variant_id);

    public function productVariantCombination($variantValueData);

    public function getProductVariantCombinations($product_id, $merchant_id);

    public function updateProductVariantCombinations($variantCombinationData);
}
