<?php
namespace App\Docs;

/**
 * @OA\Schema(
 *     description="Some simple request change password user",
 *     type="object",
 *     title=" user change password request",
 * )
 */
class UserChangePassword
{
    /**
     * @OA\Property(
     *     title="current_password",
     *     description="current_password",
     *     format="string",
     *     example="12345678"
     * )
     *
     * @var string
     */
    public $current_password;
    /**
     * @OA\Property(
     *     title="password",
     *     description="enter password",
     *     format="string",
     *     example=123456789
     * )
     *
     * @var string
     */
    public $password;

    /**
     * @OA\Property(
     *     title="password_confirmation",
     *     description="password_confirmation",
     *     format="string",
     *     example=123456789
     * )
     *
     * @var string
     */
    public $password_confirmation;
}
