<?php

namespace App\Interfaces\Admin\PaymentMethod;

interface PaymentMethodInterface
{

    /**
     * index payment
     *
     * @param [type] $request
     * @param [type]
     * @return void
     */
    public function index();
    /**
     * create payment
     *
     * @param [type] $request
     * @param [type]
     * @return void
     */
    public function store($paymentData);
    /**
     * update payment
     *
     * @param [paymentData] $request
     * @param [id] $id
     * @return void
     */
    public function update($paymentData,$id);
     /**
     * delete payment
     *
     * @param [id] $id
     * @return void
     */
    public function delete($id);
     /**
     * show payment
     *
     * @param [id] $id
     * @return void
     */
    public function show($id);

}
