<?php

namespace App\Http\Controllers\PaymentMethod;

use App\Http\Controllers\Controller;
use App\Http\Resources\PaymentMethodResource;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{

    
    public function PaymentMethods(Request $request)
    {
        return $this->paginateCollection(PaymentMethodResource::collection(PaymentMethod::active()->get()), $request->limit, 'payment_methods');
    }


    public function showPaymentMethod($id)
    {
        return $this->dataResponse(['payment_method' => new PaymentMethodResource(PaymentMethod::findOrFail($id))], 'success', 200);
    }
}
