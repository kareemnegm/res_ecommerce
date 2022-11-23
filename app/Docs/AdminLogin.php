<?php
namespace App\Docs;

/**
 * @OA\Schema(
 *     description="Some simple request login admin",
 *     type="object",
 *     title=" admin sign in request",
 * )
 */
class AdminLogin
{
    /**
     * @OA\Property(
     *     title="email",
     *     description="email",
     *     format="string",
     *     example="admin@test.com"
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
