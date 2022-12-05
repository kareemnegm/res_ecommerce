<?php

namespace App\Docs;

/**
 * @OA\Schema(
 *     description="Some simple request Register User",
 *     type="object",
 *     title=" User Register request",
 * )
 */
class UserRegister
{
    /**
     * @OA\Property(
     *     title="full_name",
     *     description="Some text field",
     *     format="string",
     *     example="user"
     * )
     *
     * @var string
     */
    public $full_name;

    /**
     * @OA\Property(
     *     title="email",
     *     description="email",
     *     format="string",
     *     example="usertest@test.com"
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
     *     example=01011223344
     * )
     *
     * @var string
     */
    public $mobile;

    /**
     * @OA\Property(
     *     title="gender",
     *     description="user gender",
     *     format="male or female",
     *     example="male"
     * )
     *
     * @var string
     */
    public $gender;

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
