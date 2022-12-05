<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginFormRequest;
use App\Http\Requests\Admin\RegisterFormRequest;
use App\Http\Resources\Admin\AdminResource;
use App\Interfaces\Admin\AuthInterface;
use App\Models\Admin;
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
     *      path="/api/admin",
     *      operationId="registerAdmin",
     *      tags={"SystemAdmin"},
     *      summary="register new admin",
     *      description="Returns admin data and token",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/AdminRegister")
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
        $admin = $this->AuthRepository->register($request->validated());

        return $this->dataResponse(['admin' => new AdminResource($admin['admin']), 'token' => $admin['token']], 'success', 201);
    }

    /**
     * @OA\Post(
     *
     *      path="/api/admin/login",
     *      operationId="adminLogin",
     *      tags={"SystemAdmin"},
     *      summary="admin login",
     *      description="Returns admin data and token",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/AdminLogin")
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
        $adminData = $request->validated();
        $admin = Admin::where('email', $adminData['email'])->first();
        if (! $admin || ! Hash::check($adminData['password'], $admin->password)) {
            return $this->errorResponse('Credentials not match', 401);
        }
        $token = $admin->createToken('adminToken')->plainTextToken;

        return $this->dataResponse(['admin' => new AdminResource($admin), 'token' => $token], 'success', 200);
    }
}
