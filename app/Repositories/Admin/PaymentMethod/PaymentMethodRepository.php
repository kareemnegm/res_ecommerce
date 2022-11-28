<?php

namespace App\Repositories\Admin\PaymentMethod;

use App\Interfaces\Admin\PaymentMethod\PaymentMethodInterface;
use App\Models\PaymentMethod;

class PaymentMethodRepository implements PaymentMethodInterface
{

    public function index()
    {
        return PaymentMethod::all();
    }


    public function store($PaymentData)
    {
        $paymentMethod = PaymentMethod::create($PaymentData);
        if (isset($PaymentData['payment_logo']) && !empty($PaymentData['payment_logo'])) {
            $paymentMethod->saveFiles($PaymentData['payment_logo'], 'payment_logo');
        }
        return $paymentMethod;
    }

    public function update($PaymentData, $id)
    {
        $paymentMethod = PaymentMethod::where('id', $id)->first();

        if (!empty($PaymentData['payment_logo'])) {
            $paymentMethod->updateFile($PaymentData['payment_logo'], 'payment_logo');
        }

        $paymentMethod->update($PaymentData);
    }

    public function delete($id)
    {
        $paymentMethod = PaymentMethod::findOrFail($id);
        $paymentMethod->delete();
    }

    public function show($id)
    {
        return PaymentMethod::findOrFail($id);
    }
}
