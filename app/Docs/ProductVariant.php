<?php

namespace App\Docs;

/**
 * @OA\Schema(
 *     description="Some simple request create merchant product variant ",
 *     type="object",
 *     title=" create merchant product variant request",
 * )
 */
class ProductVariant
{
}
/**
 *    @OA\Property(
 *   property="variants",
 *   description="variants",
 *   type="array",
 *   example="[
 * ["size"][0]["name"]:"largee",
 * ["color"][0]["name"]:"yellow",
 * ]"
 *
 * @var object
 */
// public $variants;

/**
 *    @OA\Property(
 *   property="product_id",
 *   description="product ID",
 *   format="integer",
 * example=8)
 *
 * @var object
 */
// public $product_id;

// }
