<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Interfaces\User\OrderInterface;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private OrderInterface $OrderRepository;
    public function __construct(OrderInterface $OrderRepository)
    {
        $this->OrderRepository = $OrderRepository;
    }

    public function placeOrder(Request $request)
    {
        $data['user_id'] = auth('user')->user()->id;
        $this->OrderRepository->placeOrder($data);
    }
}
