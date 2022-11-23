<?php

namespace App\Docs;

/**
 * @OA\Schema(
 *     description="update merchant profile ",
 *     type="object",
 *     title=" merchant update request",
 * )
 */
class  MerchantUpdate
{

    /**
     *@OA\Property(
     *     title="description",
     *     description="Some text field",
     *     format="string",
     *     example={"en":"shopname2updated", "ar":"سياسياتحديث1"}
     * )
     *
     *
     * @var object
     */
    public $shop_name;

    /**
     * * @OA\Property(
     *     title="description",
     *     description="Some text field",
     *     format="string",
     *     example={"en":"description updated ", "ar":"سياسيا"}
     * )
     *
     *
     * @var object
     */
    public $description;

    /**
     * @OA\Property(
     *     title="email",
     *     description="email",
     *     format="string",
     *     example="usertest4@test.com"
     * )
     *
     * @var string
     */
    public $email;


    /**
     *
     * @var string
     */

    /**
     * @OA\Property(
     *     title="mobile",
     *     description="merchant mobile",
     *     format="string",
     *     example=01011223144
     * )
     *
     * @var string
     */
    public $mobile;

    /**
     *    @OA\Property(
     *   property="category_id",
     *   description="category ID",
     *   format="array",
     * example={4,3})
     *
     *
     *
     * @var object
     */
    public $category_id;
}
