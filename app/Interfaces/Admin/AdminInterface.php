<?php

namespace App\Interfaces\Admin;

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

    public function createMerchant(array $data);
}
