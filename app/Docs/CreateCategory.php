<?php

namespace App\Docs;

/**
 * @OA\Schema(
 *     description="Some simple request create category",
 *     type="object",
 *     title=" create category request",
 * )
 */
class CreateCategory
{
    /**
     *@OA\Property(
     *     title="name",
     *     description="category name  text field",
     *     format="string",
     *     example={"en":"categoryExample", "ar":"سياسيا1"}
     * )
     *
     * @var object
     */
    public $name;

    /**
     *    @OA\Property(
     *   property="category_id",
     *   description="category ID , nullable, when its available it means that this is record is subcategory for the inserted id ",
     *   format="integer",
     * example=2)
     *
     * @var object
     */
    public $category_id;
}
