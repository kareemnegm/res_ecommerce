<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use App\Http\Requests\Merchant\MerchantCategoryFormRequest;
use App\Http\Requests\Merchant\ShopCategory\ShopCategoryIdValidation;
use App\Http\Requests\Merchant\ShopIdRequestValidation;
use App\Http\Requests\Merchant\UpdateMerchantCategoryFormRequest;
use App\Http\Resources\Merchant\MerchantCategoryResource;
use App\Interfaces\Merchant\MerchantCategoryInterface;
use Illuminate\Http\Request;

class MerchantCategoryController extends Controller
{
    private MerchantCategoryInterface $MerchantCategoryRepository;

    public function __construct(MerchantCategoryInterface $MerchantCategoryRepository)
    {
        $this->MerchantCategoryRepository = $MerchantCategoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Get(
     *      path="/api/merchant/category",
     *      operationId="MerchantCategoryList",
     *      tags={"merchantCategory"},
     *      summary="merchant categories",
     *      description="Returns merchant categories",
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
    public function index(ShopIdRequestValidation $request,$id)
    {
        $categories = $this->MerchantCategoryRepository->index($id);

        return $this->paginateCollection(MerchantCategoryResource::collection($categories), $request->limit, 'categories');
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
     *      path="/api/merchant/category",
     *      operationId="MerchantCreateCategory",
     *      tags={"merchantCategory"},
     *      summary="create new merchant category",
     *      description="Returns category data",
     *       security={{"Bearer": {}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/CreateMerchantCategory")
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
    public function store(MerchantCategoryFormRequest $request)
    {
        $categoryData = $request->validated();
        $result = $this->MerchantCategoryRepository->create($categoryData);
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
     *      path="/api/merchant/category/{id}",
     *      operationId="getMerchantCategory",
     *      tags={"merchantCategory"},
     *      summary="get category",
     *      description="Returns single category  data",
     *      security={{"Bearer": {}}},
     *     @OA\MediaType(mediaType="application/json"),
     *      @OA\Parameter(
     *          name="id",
     *          description="category id",
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
    public function show(ShopCategoryIdValidation $shopCategory)
    {
        $result = $this->MerchantCategoryRepository->show($shopCategory->validated());
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
     *      path="/api/merchant/category/{id}",
     *      operationId="MerchantUpdateCategory",
     *      tags={"merchantCategory"},
     *      summary="update merchant category",
     *      description="Returns category data",
     *       security={{"Bearer": {}}},
     *  *   @OA\Parameter(
     *          name="id",
     *          description="category id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          ),
     * ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/UpdateMerchantCategory")
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

    public function update(MerchantCategoryFormRequest $request)
    {
        $categoryData = $request->validated();
       $result= $this->MerchantCategoryRepository->update($categoryData);
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
     *      path="/api/merchant/category/{id}",
     *      operationId="deleteMerchantCategory",
     *      tags={"merchantCategory"},
     *      summary="Delete category",
     *      description="Deletes a record and returns successfully",
     *      security={{"Bearer": {}}},
     *       @OA\Parameter(
     *          name="id",
     *          description="category id",
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
    public function destroy($id)
    {
        $this->MerchantCategoryRepository->delete($id, auth('merchant')->user()->id);

        return $this->successResponse('deleted successful', 200);
    }
}
