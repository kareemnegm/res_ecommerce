<?php

namespace App\Repositories\User;

use App\Http\Controllers\Controller;
use App\Interfaces\User\OrderInterface;
use App\Models\Order;
use App\Models\Product;
use App\Models\UserCart;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class orderRepository extends Controller implements OrderInterface
{

    public function placeOrder($orderDetails)
    {
        $cart = UserCart::where('user_id', $orderDetails['user_id'])->get();
        if ($this->productsAreNoLongerAvailable($cart)) {
            return $this->errorResponseWithMessage('Sorry! One of the items in your cart is no longer available.', 422);
        }

        $date = Carbon::now();
        $total_items = $cart->count();
        $cartItemsPrice = $cart->sum(function ($product) {
            return $product->product->price * $product->quantity;
        });
        dd($cartItemsPrice);
    }



    /**
     * Check If Products available With Stock function
     *
     * @return object
     */
    protected function productsAreNoLongerAvailable($products)
    {

        foreach ($products as $item) {
            $product = Product::find($item->product_id);
            if ($product->stock_quantity < $item->quantity) {
                return true;
            }
        }

        return false;
    }


    /**
     * Main Order Created function
     *
     * @param [type] $orderData
     * @return object
     */
    private function mainOrderDetails($orderData)
    {
        $orderCount = Order::count();
        $orderData['order_number'] = '#' . str_pad($orderCount + 1, 8, "0", STR_PAD_LEFT);

        $createOrder = Order::create($orderData);
        return $createOrder;
    }
}
