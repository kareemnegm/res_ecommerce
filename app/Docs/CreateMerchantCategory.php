<?php

namespace App\Docs;

/**
 * @OA\Schema(
 *     description="Some simple request create merchant category",
 *     type="object",
 *     title=" create merchant category request",
 * )
 */
class  CreateMerchantCategory
{

    /**
     *@OA\Property(
     *     title="name",
     *     description="category name  text field",
     *     format="string",
     *     example={"en":"categoryExample", "ar":"سياسيا1"}
     * )
     *
     *
     * @var object
     */
    public $name;
    /**
     *    @OA\Property(
     *   property="merchant_category_id",
     *   description="category ID , nullable, when its available it means that this is record is subcategory for the inserted id ",
     *   format="integer",
     * example=2)
     *
     *
     *
     * @var object
     */
    public $merchant_category_id;


}
