<?php
namespace App\Docs;

/**
 * @OA\Schema(
 *     description="Some simple request for reset password",
 *     type="object",
 *     title=" user reset password request",
 * )
 */
class ResetPassword
{
    /**
     * @OA\Property(
     *     title="email",
     *     description="email",
     *     format="string",
     *     example="customer@test.com"
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
    public $phone_number;
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
     /**
     * @OA\Property(
     *     title="password_confirmation",
     *     description="select password confirmation",
     *     format="string",
     *     example=12345678
     * )
     *
     * @var string
     */
    public $password_confirmation;
}
