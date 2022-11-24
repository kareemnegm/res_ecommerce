<?php

namespace App\Docs;

/**
 * @OA\Schema(
 *     description="Some simple request update User",
 *     type="object",
 *     title=" User update request",
 * )
 */
class  UserUpdate
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
     *
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
     *     title="date_of_birth",
     *     description="date of birth",
     *     format="string",
     *     example="1998-01-27"
     * )
     *
     * @var string
     */
    public $date_of_birth;


}
