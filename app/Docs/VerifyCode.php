<?php
namespace App\Docs;

/**
 * @OA\Schema(
 *     description="Some simple request for forget password",
 *     type="object",
 *     title=" user forget password request",
 * )
 */
class VerifyCode
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
     *     title="code",
     *     description="otp code",
     *     format="string",
     *     example=0000
     * )
     *
     * @var string
     */
    public $code;
}
