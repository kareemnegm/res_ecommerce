<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CartProductFormRequest;
use App\Http\Requests\User\FavoriteProductFormRequest;
use App\Http\Requests\User\RemoveFavoriteProductFormRequest;
use App\Http\Requests\User\RemoveProductCartFormRequest;
use App\Http\Requests\User\UserAddressFormRequest;
use App\Http\Requests\User\UserAddressUpdateFormRequest;
use App\Http\Resources\User\CartResource;
use App\Http\Resources\User\UserAddressResource;
use App\Interfaces\User\UserInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private UserInterface $UserRepository;

    private $auth;

    public function __construct(UserInterface $UserRepository)
    {
        $this->UserRepository = $UserRepository;
        $this->auth = auth('api')->user()->id?? null;
    }

    /**
     * @OA\Post(
     *
     *      path="/api/user/address",
     *      operationId="CreateUserAddress",
     *      tags={"users"},
     *      summary="user address store ",
     *      description="Returns user Address data",
     *      security={{"Bearer": {}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/CreateUserAddress")
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
    public function createAddress(UserAddressFormRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = $this->auth;
        $address = $this->UserRepository->createAddress($data);

        return $this->dataResponse(['address' => new UserAddressResource($address)], 'success', 201);
    }

    /**
     * @OA\Put(
     *
     *      path="/api/user/address/{id}",
     *      operationId="updateUserAddress",
     *      tags={"users"},
     *      summary="user address update ",
     *      description="Returns user Address data",
     *      security={{"Bearer": {}}},
     *         *  @OA\Parameter(
     *          name="id",
     *          description="address id field ",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/UpdateUserAddress")
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
    public function updateAddress(UserAddressUpdateFormRequest $request, $addressId)
    {
        $this->UserRepository->updateAddress($request->validated());

        return $this->successResponse('updated success', 200);
    }

    /**
     * @OA\Get(
     *      path="/api/user/addresses",
     *      operationId="UserAddresses",
     *      tags={"users"},
     *      summary="user Addresses ",
     *      security={{"Bearer": {}}},
     *      description="Returns user address data",
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
    public function myAddresses()
    {
        $addresses = $this->UserRepository->myAddresses($this->auth);

        return $this->dataResponse(['address' => UserAddressResource::collection($addresses)], 'success', 200);
    }

    /**
     * @OA\Post(
     *      path="/api/user/cart",
     *      operationId="addProductToCart",
     *      tags={"users"},
     *      summary="add product to user cart ",
     *      description="adds product to user cart with quantity ",
     *      security={{"Bearer": {}}},
     *     @OA\MediaType(mediaType="application/json"),
     *  @OA\Parameter(
     *          name="product_id",
     *          description="inputs product id",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *  @OA\Parameter(
     *          name="merchant_id",
     *          description="merchant id",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *  @OA\Parameter(
     *          name="quantity",
     *          description="product quantity to add",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="integer",
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
    public function addProductsToCart(CartProductFormRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = $this->auth;
       $result= $this->UserRepository->addProductsToCart($data);
       return response()->json($result, $result['status_code']);
    }

    /**
     * @OA\Delete(
     *      path="/api/user/cart/remove_product/{id}",
     *      operationId="removeProductFromCart",
     *      tags={"users"},
     *      summary="remove product from user cart ",
     *      description="removes product from user cart",
     *      security={{"Bearer": {}}},
     *     @OA\MediaType(mediaType="application/json"),
     *  @OA\Parameter(
     *          name="product_id",
     *          description="inputs product id",
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
    public function removeProductFromCart(RemoveProductCartFormRequest $request, $id)
    {
        $data['product_id'] = $id;
        $data['user_id'] = $this->auth;
        $result=$this->UserRepository->removeProductFromCart($data);
        return response()->json($result, $result['status_code']);
    }

    /**
     * @OA\Post(
     *      path="/api/user/favorite",
     *      operationId="addProductToFavorite",
     *      tags={"users"},
     *      summary="add product to user favorite ",
     *      description="adds product to user favorite ",
     *      security={{"Bearer": {}}},
     *     @OA\MediaType(mediaType="application/json"),
     *  @OA\Parameter(
     *          name="product_id",
     *          description="inputs product id",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *  @OA\Parameter(
     *          name="merchant_id",
     *          description="merchant id",
     *          required=true,
     *          in="query",
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
    public function addProductToFavorite(FavoriteProductFormRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = $this->auth;
        $this->UserRepository->addProductToFavorite($data);

        return $this->successResponse('added to favorite successful', 200);
    }

    /**
     * @OA\Delete(
     *      path="/api/user/favorite/{id}",
     *      operationId="removeProductFromFavorite",
     *      tags={"users"},
     *      summary="remove product from user favorite ",
     *      description="removes product from user favorite",
     *      security={{"Bearer": {}}},
     *     @OA\MediaType(mediaType="application/json"),
     *  @OA\Parameter(
     *          name="product_id",
     *          description="inputs product id",
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
    public function removeProductFromFavorite(RemoveFavoriteProductFormRequest $request, $id)
    {
        $data['product_id'] = $id;
        $data['user_id'] = $this->auth;
        $this->UserRepository->removeProductFromFavorite($data);

        return $this->successResponse('product removed successful', 200);
    }

     /**
     * @OA\Get(
     *      path="/api/user/cart",
     *      operationId="UserCart",
     *      tags={"users"},
     *      summary="user cart  ",
     *      security={{"Bearer": {}}},
     *      description="Returns user cart products",
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
    public function myCart(Request $request)
    {
        $cart = auth('api')->user()->product;
        return $this->paginateCollection(CartResource::collection($cart), $request->limit, 'cart_products');
    }
}
