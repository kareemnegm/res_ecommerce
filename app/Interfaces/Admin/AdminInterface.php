<?php

namespace App\Interfaces\Admin;

use Illuminate\Support\Collection;

interface AdminInterface
{

    /**
     * list merchants function
     *
     *
     * @return void
     */
    public function merchantsList($request);

    public function approveMerchant($id);

    public function createMerchant(Collection $data);
}
