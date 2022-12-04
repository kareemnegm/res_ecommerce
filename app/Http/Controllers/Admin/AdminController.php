<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FilterMerchantFormRequest;
use App\Http\Requests\Admin\MerchantIdApprovalFormRequest;
use App\Http\Requests\Admin\MerchantRegisterFormRequest;
use App\Http\Requests\User\RegisterFormRequest;
use App\Http\Resources\Admin\MerchantResource;
use App\Interfaces\Admin\AdminInterface;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    private AdminInterface $AdminRepository;
    private $auth;
    public function __construct(AdminInterface $AdminRepository)
    {
        $this->AdminRepository = $AdminRepository;
        $this->auth = auth()->user()->id?? null;
    }


    /**
     * @OA\Get(
     *      path="/api/admin/list_merchants",
     *      operationId="listMerchants",
     *      tags={"SystemAdmin"},
     *      summary="system merchants or sshops",
     *      description="Returns system merchants",
     *      security={{"Bearer": {}}},
     *     @OA\MediaType(mediaType="application/json"),
     *  @OA\Parameter(
     *          name="limit",
     *          description="data limit for pagination",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *  @OA\Parameter(
     *          name="page",
     *          description="page number ",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *  @OA\Parameter(
     *          name="approved",
     *          description="filter merchants by approved or not takes true or false",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string",
     *               example="true",
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

    public function listMerchants(FilterMerchantFormRequest $request)
    {
        $merchants = $this->AdminRepository->merchantsList($request->validated());
        return $this->paginateCollection(MerchantResource::collection($merchants), $request->limit, 'merchants');
    }


     /**
     * @OA\Put(
     *      path="/api/admin/approve/merchant/{id}",
     *      operationId="approveMerchant",
     *      tags={"SystemAdmin"},
     *      summary="approve merchants or shops",
     *      description="Returns success response ",
     *      security={{"Bearer": {}}},
     *     @OA\MediaType(mediaType="application/json"),
     *  @OA\Parameter(
     *          name="id",
     *          description="merchant id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *
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
    public function approveMerchant(MerchantIdApprovalFormRequest $request, $id)
    {
        $this->AdminRepository->approveMerchant($id);
        return $this->successResponse('merchant approved', 200);
    }
    /**
     * @OA\Post(
     *
     *      path="/api/admin/merchant",
     *      operationId="createMerchant",
     *      tags={"SystemAdmin"},
     *      summary="create new merchant",
     *      description="Returns merchant data",
     *      security={{"Bearer": {}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/CreateMerchantByAdmin")
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
    public function createMerchant(RegisterFormRequest $request)
    {
        $result = $this->AdminRepository->createMerchant($request->collect());

        return response()->json($result, $result['status_code']);
    }
}
