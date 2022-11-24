<?php

namespace App\Repositories\User;

use App\Interfaces\User\ProductInterface;
use App\Models\Product;

class ProductRepository implements ProductInterface
{
    public function getProduct($id)
    {
        return Product::where('id', $id)->active()->firstOrFail();
    }
}
