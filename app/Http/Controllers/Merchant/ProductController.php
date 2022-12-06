<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use App\Http\Requests\Merchant\Product\ProductFormRequest;
use App\Http\Requests\Merchant\Product\ProductIdMerchantFormRequest;
use App\Http\Requests\Merchant\Product\ProductVairantRequest;
use App\Http\Requests\Merchant\Product\ProductVariantCombinationValidation;
use App\Http\Requests\Merchant\Product\ProductVariantValuesRequest;
use App\Http\Requests\Merchant\Product\ShopProductIdFormRequest;
use App\Http\Requests\Merchant\Product\UpdateProductFormRequest;
use App\Http\Requests\Merchant\Product\VariantCombinationFormRequest;
use App\Http\Requests\Merchant\Product\VariantFormRequest;
use App\Http\Resources\Merchant\Product\ProductCombinationResource;
use App\Http\Resources\Merchant\Product\ProductsResource;
use App\Http\Resources\Merchant\Product\ProductVariantResource;
use App\Http\Resources\Merchant\Product\SingleProductResource;
use App\Http\Resources\Merchant\Product\VariantValueResource;
use App\Interfaces\Merchant\ProductInterface;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private ProductInterface $ProductRepository;

    public function __construct(ProductInterface $ProductRepository)
    {
        $this->ProductRepository = $ProductRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Get(
     *      path="/api/merchant/product",
     *      operationId="MerchantProductList",
     *      tags={"merchantProducts"},
     *      summary="merchant products",
     *      description="Returns merchant products",
     *  security={{"Bearer": {}}},
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
    public function index(Request $request,$shopId)
    {
        return $this->paginateCollection(ProductsResource::collection($this->ProductRepository->index($shopId)), $request->limit, 'products');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    /**
     * @OA\Post(
     *
     *      path="/api/merchant/product",
     *      operationId="MerchantCreateProduct",
     *      tags={"merchantProducts"},
     *      summary="create new merchant product",
     *      description="Returns product data",
     *       security={{"Bearer": {}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/CreateProduct")
     *     ),
     *      @OA\Response(
     *          response=201,
     *          description="Success",
     *
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
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Validation error"
     *      )
     * )
     */
    public function store(ProductFormRequest $request)
    {
        $productData = $request->validated();
        $result = $this->ProductRepository->create($productData);
        return response()->json($result, $result['status_code']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Get(
     *      path="/api/merchant/Product/{id}",
     *      operationId="getMerchantProduct",
     *      tags={"merchantProducts"},
     *      summary="get Product",
     *      description="Returns single Product  data",
     *      security={{"Bearer": {}}},
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
    public function show($id)
    {
        $result = $this->ProductRepository->show($id);
        return response()->json($result, $result['status_code']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Put(
     *
     *      path="/api/merchant/product/{id}",
     *      operationId="MerchantUpdateProduct",
     *      tags={"merchantProducts"},
     *      summary="update merchant product",
     *      description="Returns success response",
     *       security={{"Bearer": {}}},
     *  *   @OA\Parameter(
     *          name="id",
     *          description="product id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          ),
     * ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/UpdateProduct")
     *     ),
     *      @OA\Response(
     *          response=201,
     *          description="Success",
     *
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
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Validation error"
     *      )
     * )
     */

    public function update(UpdateProductFormRequest $request)
    {
        $productData = $request->validated();
        $result = $this->ProductRepository->update($productData);
        return response()->json($result, $result['status_code']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Delete(
     *      path="/api/merchant/product/{id}",
     *      operationId="deleteMerchantProduct",
     *      tags={"merchantProducts"},
     *      summary="Delete product",
     *      description="Deletes a record and returns successfully",
     *      security={{"Bearer": {}}},
     *       @OA\Parameter(
     *          name="id",
     *          description="product id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          ),
     * ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     */
    public function destroy(ShopProductIdFormRequest $request)
    {
        $result = $this->ProductRepository->deleteProduct($request->validated());
        return response()->json($result, $result['status_code']);
    }

    /**
     * @OA\Post(
     *
     *      path="/api/merchant/product_variant",
     *      operationId="createProductVariant",
     *      tags={"merchantProducts"},
     *      summary="create new merchant product variant",
     *      description="Returns product variant  data",
     *       security={{"Bearer": {}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/ProductVariant")
     *     ),
     *      @OA\Response(
     *          response=201,
     *          description="Success",
     *
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
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Validation error"
     *      )
     * )
     */
    public function productVariants(VariantFormRequest $request)
    {
        $result = $this->ProductRepository->CreateProductVariant($request->validated('variants'), $request->product_id);
        return response()->json($result, $result['status_code']);
    }

    // public function productVariantCombination(VariantCombinationFormRequest $request)
    // {
    //     $combination = $this->ProductRepository->productVariantCombination($request->validated());
    //     return $this->dataResponse(['product_variant_combination' => new ProductCombinationResource($combination)], 'success', 201);
    // }

    /**
     * @OA\get(
     *      path="/api/merchant/product/{id}/product_variants",
     *      operationId="getProductVariants",
     *      tags={"merchantProducts"},
     *      summary="product variants ",
     *      description="get product variants  ",
     *      security={{"Bearer": {}}},
     *       @OA\Parameter(
     *          name="id",
     *          description="product id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          ),
     * ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     */

    public function getProductVariant($productId)
    {
        $result = $this->ProductRepository->getProductVariants($productId);
        return response()->json($result, $result['status_code']);
    }

    /**
     * @OA\get(
     *
     *      path="/api/merchant/product_variant_values",
     *      operationId="getProductVariantValues",
     *      tags={"merchantProducts"},
     *      summary="product variant values ",
     *      description="get product variants  ",
     *      security={{"Bearer": {}}},
     *       @OA\Parameter(
     *          name="product_id",
     *          description="product id",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          ),
     * ),
     *       @OA\Parameter(
     *          name="variant_id",
     *          description="variant id",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          ),
     * ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     */
    public function getProductVariantValues(ProductVariantValuesRequest $request)
    {
        $values = $this->ProductRepository->getProductVariantValues($request->validated());

        return $this->paginateCollection(VariantValueResource::collection($values), $request->limit, 'values');
    }



    // public function getProductVariantCombinations($id)
    // {
    //     $merchant_id = auth('merchant')->user()->id;
    //     return $this->dataResponse(['product_combinations' => ProductCombinationResource::collection($this->ProductRepository->getProductVariantCombinations($id, $merchant_id))], 'success', 200);
    // }


    // public function updateProductVariantCombination(ProductVariantCombinationValidation $request)
    // {
    //     $this->ProductRepository->updateProductVariantCombinations($request->validated());
    //     return $this->successResponse('updated success', 200);
    // }
}
