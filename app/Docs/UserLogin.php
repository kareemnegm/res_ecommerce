<?php
namespace App\Docs;

/**
 * @OA\Schema(
 *     description="Some simple request login user",
 *     type="object",
 *     title=" user sign in request",
 * )
 */
class UserLogin
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
