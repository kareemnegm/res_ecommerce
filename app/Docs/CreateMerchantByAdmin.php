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
     * @OA\Property(
     *     title="full_name",
     *     description="full_name",
     *     format="string",
     *     example="new merchant"
     * )
     *
     * @var string
     */
    public $full_name;
     /**
     * @OA\Property(
     *     title="id_number",
     *     description="id_number",
     *     format="string",
     *     example="12345678944"
     * )
     *
     * @var string
     */
    public $id_number;
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
     * @OA\Property(
     *     title="password_confirmation",
     *     description="select password confirmation",
     *     format="password",
     *     example=12345678
     * )
     *
     * @var string
     */
    public $password_confirmation;

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
