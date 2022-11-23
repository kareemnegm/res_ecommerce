<?php
namespace App\Docs;

/**
 * @OA\Schema(
 *     description="Some simple request login merchant",
 *     type="object",
 *     title=" merchant sign in request",
 * )
 */
class MerchantLogin
{
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
     *     format="string",
     *     example=12345678
     * )
     *
     * @var string
     */
    public $password;
}
