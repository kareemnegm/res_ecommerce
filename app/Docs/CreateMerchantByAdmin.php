<?php

namespace App\Docs;

/**
 * @OA\Schema(
 *     description="Some simple request create Merchant",
 *     type="object",
 *     title=" Merchant create request",
 * )
 */
class CreateMerchantByAdmin
{
    /**
     *@OA\Property(
     *     title="shop_name",
     *     description="shop name text field",
     *     format="string",
     *     example={"en":"shopname1", "ar":"سياسيا1"}
     * )
     *
     * @var object
     */
    public $shop_name;

    /**
     * * @OA\Property(
     *     title="description",
     *     description="Some text field",
     *     format="string",
     *     example={"en":"qqq", "ar":"سياسيا"}
     * )
     *
     * @var object
     */
    public $description;

    /**
     *    @OA\Property(
     *   property="category_id",
     *   description="category ID",
     *   format="array",
     * example={2,3})
     *
     * @var object
     */
    public $category_id;

    /**
     * @OA\Property(
     *     title="email",
     *     description="email",
     *     format="string",
     *     example="usertest2@test.com"
     * )
     *
     * @var string
     */
    public $email;

    /**
     * @OA\Property(
     *     title="password",
     *     description="select password",
     *     format="password",
     *     example=12345678
     * )
     *
     * @var string
     */
    public $password;

    /**
     * @var string
     */

    /**
     * @OA\Property(
     *     title="mobile",
     *     description="user mobile",
     *     format="string",
     *     example=01011233344
     * )
     *
     * @var string
     */
    public $mobile;

    /**
     * @OA\Property(
     *     title="country_id",
     *     description="country id",
     *     format="integer",
     *     example="1"
     * )
     *
     * @var string
     */
    public $country_id;

    /**
     * @OA\Property(
     *     title="country_code",
     *     description="country code ",
     *     format="string",
     *     example="+966"
     * )
     *
     * @var string
     */
    public $country_code;
}
