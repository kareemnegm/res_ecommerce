<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductSearchFormRequest;
use App\Http\Requests\User\CategoryIdRequest;
use App\Http\Requests\User\ShopSearch;
use App\Http\Resources\User\ProductsResource;
use App\Http\Resources\User\ShopResource;
use App\Interfaces\User\ShopInterface;
use Illuminate\Http\Request;

class ShopController extends Controller
{

    private ShopInterface $ShopRepository;
    public function __construct(ShopInterface $ShopRepository)
    {
        $this->ShopRepository = $ShopRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Get(
     *      path="/api/shops",
     *      operationId="getShops",
     *      tags={"home"},
     *      summary="get shops",
     *      description="Returns  shops  data",
     *     @OA\MediaType(mediaType="application/json"),
     *      @OA\Parameter(
     *          name="limit",
     *          description="limit pagination",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *  @OA\Parameter(
     *          name="page",
     *          description="page number ",
     *          required=true,
     *          in="query",
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

    public function shops(Request $request)
    {
        $shops = $this->ShopRepository->shops();
        return $this->paginateCollection(ShopResource::collection($shops), $request->limit, 'shops');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * @OA\Get(
     *      path="/api/category_shops",
     *      operationId="getShopsByCategories",
     *      tags={"home"},
     *      summary="get shops by category",
     *      description="Returns shops  data",
     *     @OA\MediaType(mediaType="application/json"),
     *      @OA\Parameter(
     *          name="limit",
     *          description="limit pagination",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *  @OA\Parameter(
     *          name="page",
     *          description="page number ",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *  @OA\Parameter(
     *          name="category_id",
     *          description="category field ",
     *          required=true,
     *          in="query",
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

    public function shopsByCategories(CategoryIdRequest $request)
    {
        $shops = $this->ShopRepository->shopsByCategories($request->category_id);
        return $this->paginateCollection(ShopResource::collection($shops), $request->limit, 'shops');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Get(
     *      path="/api/shop/{id}/products",
     *      operationId="getShopProducts",
     *      tags={"home"},
     *      summary="get shops products",
     *      description="Returns products for shop",
     *     @OA\MediaType(mediaType="application/json"),
     *      @OA\Parameter(
     *          name="limit",
     *          description="limit pagination",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *  @OA\Parameter(
     *          name="page",
     *          description="page number ",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *  @OA\Parameter(
     *          name="id",
     *          description="shop id field ",
     *          required=true,
     *          in="query",
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
    public function ShopProduct(Request $request, $id)
    {
        $products = $this->ShopRepository->shopProducts($id);
        return $this->paginateCollection(ProductsResource::collection($products), $request->limit, 'products');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Get(
     *      path="/api/shop/{id}",
     *      operationId="homeGetShopData",
     *      tags={"home"},
     *      summary="get single shop data ",
     *      description="Returns shop  data",
     *     @OA\MediaType(mediaType="application/json"),
     *
     *  @OA\Parameter(
     *          name="id",
     *          description="shop id field ",
     *          required=true,
     *          in="query",
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
        return $this->dataResponse(['shop' => new ShopResource($this->ShopRepository->showShop($id))], 'success', 200);
    }


    /**
     * @OA\Get(
     *      path="/api/search/shop/",
     *      operationId="searchShops",
     *      tags={"home"},
     *      summary="search for  shops",
     *      description="Returns shops based on search ",
     *     @OA\MediaType(mediaType="application/json"),
     *      @OA\Parameter(
     *          name="limit",
     *          description="limit pagination",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *  @OA\Parameter(
     *          name="page",
     *          description="page number ",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *  @OA\Parameter(
     *          name="search",
     *          description="search field ",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
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


    public function searchShop(ShopSearch $request)
    {
        $search = $this->ShopRepository->searchShop($request->validated());
        return $this->paginateCollection(ShopResource::collection($search), $request->limit, 'shop');
    }



    /**
     * @OA\Get(
     *      path="/api/product_search/shop/{id}",
     *      operationId="searchProductsInShop",
     *      tags={"home"},
     *      summary="search for products in shop",
     *      description="Returns products  based on search in a shop , filter and sort  ",
     *     @OA\MediaType(mediaType="application/json"),
     *      @OA\Parameter(
     *          name="id",
     *          description="shop id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="search",
     *          description="search field",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="filter",
     *          description="filter by name or price or order",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="sortBy",
     *          description="sort by asc or desc",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="limit",
     *          description="limit pagination",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *  @OA\Parameter(
     *          name="page",
     *          description="page number ",
     *          required=true,
     *          in="query",
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

    public function searchProductInShop(ProductSearchFormRequest $request, $id)
    {
        $products = $this->ShopRepository->searchProductInShop($request->validated(), $id);
        return $this->paginateCollection(ProductsResource::collection($products), $request->limit, 'products');
    }


    /**
     * @OA\Get(
     *      path="/api/shop/{id}/categories",
     *      operationId="shopCategories",
     *      tags={"home"},
     *      summary="get shop categories ",
     *      description="Returns shop  categories ",
     *     @OA\MediaType(mediaType="application/json"),
     *
     *  @OA\Parameter(
     *          name="id",
     *          description="shop id field ",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *  @OA\Parameter(
     *          name="limit",
     *          description="limit  field ",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *  @OA\Parameter(
     *          name="page",
     *          description="page  field ",
     *          required=true,
     *          in="query",
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
    public function shopCategories($id)
    {
        $categories = $this->ShopRepository->shopCategories($id);
        return $this->dataResponse(['shop_categories' => $categories], 'success', 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
