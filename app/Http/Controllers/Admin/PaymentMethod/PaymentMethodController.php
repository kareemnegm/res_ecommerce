<?php

namespace App\Http\Controllers\Admin\PaymentMethod;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PaymentMethodFromRequest;
use App\Http\Requests\Admin\PaymentMethodUpdateFormRequest;
use App\Http\Resources\PaymentMethodResource;
use App\Interfaces\Admin\PaymentMethod\PaymentMethodInterface;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    private PaymentMethodInterface $PaymentMethodRepository;
    public function __construct(PaymentMethodInterface $PaymentMethodRepository)
    {
        $this->PaymentMethodRepository = $PaymentMethodRepository;
    }

    public function store(PaymentMethodFromRequest $request)
    {
        $paymentMethod = $this->PaymentMethodRepository->store($request->validated());
        return $this->dataResponse(['payment_method' => new PaymentMethodResource($paymentMethod)], 'success', 201);
    }


    public function show($id)
    {
        $paymentMethod = $this->PaymentMethodRepository->show($id);
        return $this->dataResponse(['payment_method' => new PaymentMethodResource($paymentMethod)], 'success', 201);
    }


    public function index(Request $request)
    {
        $paymentMethods = $this->PaymentMethodRepository->index();
        return $this->paginateCollection(PaymentMethodResource::collection($paymentMethods), $request->limit, 'payment_methods');
    }



    public function update(PaymentMethodUpdateFormRequest $request, $id)
    {
         $this->PaymentMethodRepository->update($request->validated(), $id);
        return $this->successResponse('updated success', 200);
    }


    public function destroy($id)
    {
        $this->PaymentMethodRepository->delete($id);
        return $this->successResponse('deleted success', 200);
    }
}
