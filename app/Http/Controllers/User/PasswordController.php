<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ForgetPasswordRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Interfaces\User\PasswordInterface;
use Illuminate\Http\JsonResponse;

class PasswordController extends Controller
{
    public function __construct(private PasswordInterface $passwordRepository) {
    }

     /**
     * @OA\Post(
     *
     *      path="/api/user/forget-password",
     *      operationId="forgetpassword",
     *      tags={"authentication"},
     *      summary="forget user password",
     *      description="return otp code",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/ForgetPassword")
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
    public function forgetPassword(ForgetPasswordRequest $request): JsonResponse
    {
        $result = $this->passwordRepository->forgetPassword($request->collect());
        return response()->json($result, $result['status_code']);
    }

     /**
     * @OA\Post(
     *
     *      path="/api/user/verify-code",
     *      operationId="verifycode",
     *      tags={"authentication"},
     *      summary="verify user code",
     *      description="return verifying response",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/VerifyCode")
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
    public function verifyCode(Request $request): JsonResponse
    {
        $result = $this->passwordRepository->verifyCode($request->collect());
        return response()->json($result, $result['status_code']);
    } 
      /**
     * @OA\Post(
     *
     *      path="/api/user/reset-password",
     *      operationId="resetpassword",
     *      tags={"authentication"},
     *      summary="reset user password",
     *      description="return user token and user resource",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/ResetPassword")
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
    public function resetPassword(ResetPasswordRequest $request): JsonResponse
    {
        $result = $this->passwordRepository->resetPassword($request->collect());
        return response()->json($result, $result['status_code']);
    }

    
}
