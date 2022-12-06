<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use App\Http\Requests\Merchant\RegisterShopFormRequest;
use App\Http\Requests\Merchant\ShopIdRequestValidation;
use App\Http\Requests\Merchant\UpdateShopFormRequest;
use App\Http\Requests\PaymentMethod\MerchantPaymentMethodFormRequest;
use App\Http\Resources\PaymentMethodResource;
use App\Interfaces\Merchant\ShopInterface;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    private ShopInterface $ShopRepository;
    public function __construct(ShopInterface $ShopRepository)
    {
        $this->ShopRepository = $ShopRepository;
    }


    public function createShop(RegisterShopFormRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth('api')->user()->id;
        $result = $this->ShopRepository->createShop($data);
        return response()->json($result, $result['status_code']);
    }


    /***
     * update shop
     */

    public function updateShop(UpdateShopFormRequest $request)
    {
        $result = $this->ShopRepository->updateShop($request->validated());

        return response()->json($result, $result['status_code']);
    }
    /**
     * assign payment methods to shop
     */
    public function assignPaymentMethod(MerchantPaymentMethodFormRequest $request)
    {
        $data = $request->validated();
        $result=$this->ShopRepository->assignShopPaymentMethod($data);
        return response()->json($result, $result['status_code']);
    }


    public function retrievePaymentMethods(ShopIdRequestValidation $request,$id)
    {
        $paymentMethods = $this->ShopRepository->retrievePaymentMethods($id);
        return $this->paginateCollection(PaymentMethodResource::collection($paymentMethods), $request->limit, 'payment_methods');
    }
}
