<?php

namespace App\Docs;

/**
 * @OA\Schema(
 *     description="Some simple request update merchant product",
 *     type="object",
 *     title=" update merchant product request",
 * )
 */
class UpdateProduct
{
 /**
     * @OA\Property(
     *     title="name",
     *     description="product name text field",
     *     format="string",
     *     example={"en":"productNameUpdated", "ar":"سياسيا1"}
     * )
     *
     *
     * @var object
     */
    public $name;
    /**
     * * @OA\Property(
     *     title="description",
     *     description="Some text field",
     *     format="string",
     *     example={"en":"description", "ar":"سياسيا"}
     * )
     *
     *
     * @var object
     */
    public $description;


    /**
     * @OA\Property(
     *     title="stock_quantity",
     *     description="stock_quantity",
     *     format="integer",
     *     example=10
     * )
     *
     * @var string
     */
    public $stock_quantity;

    /**
     * @OA\Property(
     *     title="weight",
     *     description="weight",
     *     format="integer",
     *     example=10
     * )
     *
     * @var string
     */
    public $weight;

    /**
     *    @OA\Property(
     *   property="tags",
     *   description="tags",
     *   format="array",
     * example={"tag1","tag2"})
     *
     *
     *
     * @var object
     */
    public $tags;

    /**
     *    @OA\Property(
     *   property="merchant_category_id",
     *   description="category ID",
     *   format="integer",
     * example=2)
     *
     *
     *
     * @var object
     */
    public $merchant_category_id;

     /**
     *    @OA\Property(
     *   property="order",
     *   description="order",
     *   format="integer",
     * example=1)
     *
     *
     *
     * @var object
     */
    public $order;


     /**
     *    @OA\Property(
     *   property="price",
     *   description="price",
     *   format="integer",
     * example=15)
     *
     *
     *
     * @var object
     */
    public $price;


  /**
     *    @OA\Property(
     *   property="deleted_tags",
     *   description="deleted tags",
     *   format="array",
     * example={"tag1","tag2"})
     *
     *
     *
     * @var object
     */
    public $deleted_tags;

}
