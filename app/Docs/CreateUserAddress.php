<?php

namespace App\Docs;

/**
 * @OA\Schema(
 *     description="Some simple request Create user address",
 *     type="object",
 *     title=" user address request",
 * )
 */
class CreateUserAddress
{
    /**
     *@OA\Property(
     *     title="address",
     *     description="address text field",
     *     format="string",
     *     example="address details"
     * )
     *
     * @var object
     */
    public $address;

    /**
     * * @OA\Property(
     *     title="street",
     *     description="street text field",
     *     format="string",
     *     example="street_details"
     * )
     *
     * @var object
     */
    public $street;

    /**
     * @OA\Property(
     *     title="nearest_landmark",
     *     description="nearest_landmark field",
     *     format="string",
     *     example="nearest_landmark details "
     * )
     *
     * @var string
     */
    public $nearest_landmark;

    /**
     * @OA\Property(
     *     title="notes",
     *     description="notes field",
     *     format="string",
     *     example="notes details "
     * )
     *
     * @var string
     */
    public $notes;

    /**
     * @var string
     */

    /**
     * @OA\Property(
     *     title="longitude",
     *     description="longitude ",
     *     format="float",
     *     example=30.445
     * )
     *
     * @var string
     */
    public $longitude;

    /**
     * @OA\Property(
     *     title="latitude",
     *     description="latitude ",
     *     format="float",
     *     example=30.145
     * )
     *
     * @var string
     */
    public $latitude;

    /**
     * @OA\Property(
     *     title="mobile",
     *     description="mobile",
     *     format="integer",
     *     example=01066558412
     * )
     *
     * @var string
     */
    public $mobile;

    /**
     * @OA\Property(
     *     title="is_default",
     *     description="is_default",
     *     format="integer",
     *     example=1
     * )
     *
     * @var string
     */
    public $is_default;
}
