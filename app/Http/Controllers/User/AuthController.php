<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordFormRequest;
use App\Http\Requests\User\LoginFormRequest;
use App\Http\Requests\User\RegisterFormRequest;
use App\Http\Requests\User\UpdateUserFormRequest;
use App\Http\Resources\User\UserResource;
use App\Interfaces\User\AuthInterface;
use App\Models\User;
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Post(
     *
     *      path="/api/user/register",
     *      operationId="registeruser",
     *      tags={"authentication"},
     *      summary="register new user",
     *      description="Returns user data and token",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/UserRegister")
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
        $result = $this->AuthRepository->register($request->collect());
        return response()->json($result, $result['status_code']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * @OA\Post(
     *
     *      path="/api/user/login",
     *      operationId="userLogin",
     *      tags={"authentication"},
     *      summary="Login user",
     *      description="Returns user data and token",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/UserLogin")
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
        $result = $this->AuthRepository->login($request->collect());
        return response()->json($result, $result['status_code']);

    }

    /**
     * change password.
     *
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Put(
     *      path="/api/user/change_password",
     *      operationId="changePassword",
     *      tags={"authentication"},
     *      summary="user change password",
     *      description="change password",
     *      security={{"Bearer": {}}},
     *     @OA\MediaType(mediaType="application/json"),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/UserChangePassword")
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
        $result = $this->AuthRepository->ChangePassword($request->collect());
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
     *      path="/api/user/edit",
     *      operationId="Update user",
     *      tags={"users"},
     *      summary="Update new user",
     *  security={{"Bearer": {}}},
     *      description="Returns user data and token",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/UserUpdate")
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
    public function update(UpdateUserFormRequest $request)
    {
        $result = $this->AuthRepository->updateUser($request->collect()->merge(['id' => auth()->user()->id]));

        return response()->json($result, $result['status_code']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  auth
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Delete(
     *      path="/api/user/deactivate",
     *      operationId="deleteAccount",
     *      tags={"users"},
     *      summary="Delete User",
     *      description="Deletes a record and returns successfully",
     *      security={{"Bearer": {}}},
     *      @OA\MediaType(mediaType="application/json"),
     *
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
    public function destroy()
    {
        $id = auth()->user()->id;
        $result = $this->AuthRepository->softDelete($id);
        return response()->json($result, $result['status_code']);
    }
}
