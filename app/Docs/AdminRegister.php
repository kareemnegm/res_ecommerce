<?php

namespace App\Docs;

/**
 * @OA\Schema(
 *     description="Some simple request Register admin",
 *     type="object",
 *     title=" admin Register request",
 * )
 */
class AdminRegister
{
    /**
     *@OA\Property(
     *     title="name",
     *     description="admin name text field",
     *     format="string",
     *     example="admin"
     * )
     *
     * @var object
     */
    public $name;

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
     *     format="password",
     *     example=12345678
     * )
     *
     * @var string
     */
    public $password;
}
