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
     * @OA\Post(
     *
     *      path="/api/merchant/register",
     *      operationId="registerMerchant",
     *      tags={"merchants"},
     *      summary="register new merchant",
     *      description="Returns merchant data and token",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/MerchantRegister")
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
    public function register(RegisterFormRequest $request)
    {
        $this->AuthRepository->register($request->validated());

        return $this->successResponse('success', 201);
    }

    /**
     * @OA\Post(
     *
     *      path="/api/merchant/login",
     *      operationId="merchantLogin",
     *      tags={"merchants"},
     *      summary="merchant user",
     *      description="Returns user data and token",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/MerchantLogin")
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
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Validation error"
     *      )
     * )
     */
    public function login(LoginFormRequest $request)
    {
        $merchantData = $request->validated();
        $merchant = Merchant::where('email', $merchantData['email'])->first();
        if (! $merchant || ! Hash::check($merchantData['password'], $merchant->password)) {
            return $this->errorResponseWithStatus('Credentials not match', 401);
        }

        if ($merchant->approved == 0) {
            return $this->errorResponse('your account not approved', 422);
        }
        $token = $merchant->createToken('merchantToken')->plainTextToken;

        return $this->dataResponse(['merchant' => new MerchantResource($merchant), 'token' => $token], 'success', 200);
    }

    /**
     * @OA\Put(
     *      path="/api/merchant/change_password",
     *      operationId="MerchantChangePassword",
     *      tags={"merchants"},
     *      summary="merchant change password",
     *      description="change password",
     *      security={{"Bearer": {}}},
     *     @OA\MediaType(mediaType="application/json"),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/MerchantChangePassword")
     *     ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
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
    public function ChangePassword(ChangePasswordFormRequest $request)
    {
        $merchant = auth('merchant')->user();

        if (! Hash::check($request->current_password, $merchant->password)) {
            return $this->errorResponseWithMessage('Current password does not match!', 400);
        }
        $merchant->password = bcrypt($request->password);
        $merchant->save();

        return $this->successResponse('password changed success', 200);
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
