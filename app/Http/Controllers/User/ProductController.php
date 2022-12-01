<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\ProductResource;
use App\Interfaces\User\ProductInterface;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    private ProductInterface $ProductRepository;
    public function __construct(ProductInterface $ProductRepository)
    {
        $this->ProductRepository = $ProductRepository;
    }

       /**
     * @OA\Get(
     *      path="/api/product/{id}",
     *      operationId="getProduct",
     *      tags={"home"},
     *      summary="get single product",
     *      description="Returns single product  data",
     *     @OA\MediaType(mediaType="application/json"),
     *      @OA\Parameter(
     *          name="id",
     *          description="product id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */

    public function getProduct($id)
    {
        return $this->dataResponse(['product' => new ProductResource($this->ProductRepository->getProduct($id))], 'success', 200);
    }


}
