<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordFormRequest;
use App\Http\Requests\Merchant\LoginFormRequest;
use App\Http\Requests\Merchant\RegisterFormRequest;
use App\Http\Requests\Merchant\UpdateFormRequest;
use App\Http\Resources\Merchant\MerchantResource;
use App\Interfaces\Merchant\AuthInterface;
use App\Models\Merchant;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    private AuthInterface $AuthRepository;
    public function __construct(AuthInterface $AuthRepository)
    {
        $this->AuthRepository = $AuthRepository;
    }

   
    /**
     * @OA\Put(
     *
     *      path="/api/merchant/profile",
     *      operationId="Update merchant",
     *      tags={"merchants"},
     *      summary="Update merchant",
     *  security={{"Bearer": {}}},
     *      description="Returns success response ",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/MerchantUpdate")
     *     ),
     *      @OA\Response(
     *          response=200,
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
     *      )
     * )
     */
    public function update(UpdateFormRequest $request)
    {
        $merchantData = $request->validated();
        $merchantData['id'] = auth('merchant')->user()->id;
        $this->AuthRepository->update($merchantData);
        return $this->successResponse('profile updated success', 200);
    }
    /**
     * @OA\Get(
     *      path="/api/merchant/profile",
     *      operationId="myProfile",
     *      tags={"merchants"},
     *      summary="merchant profile ",
     *      security={{"Bearer": {}}},
     *      description="Returns merchant data",
     *     @OA\MediaType(mediaType="application/json"),

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

    public function myProfile()
    {
        $merchant = $this->AuthRepository->myProfile(auth('merchant')->user()->id);
        return $this->dataResponse(['merchant' => new MerchantResource($merchant)], 'success', 200);
    }
}
