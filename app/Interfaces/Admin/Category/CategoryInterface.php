<?php

namespace App\Interfaces\Admin\Category;

interface CategoryInterface
{

    /**
     * index Category
     *
     * @param [type] $request
     * @param [type]
     * @return void
     */
    public function index();
    /**
     * create Category
     *
     * @param [type] $request
     * @param [type]
     * @return void
     */
    public function create($categoryData);
    /**
     * update Category
     *
     * @param [categoryData] $request
     * @param [id] $id
     * @return void
     */
    public function update($categoryData,$id);
     /**
     * delete Category
     *
     * @param [id] $id
     * @return void
     */
    public function delete($id);
     /**
     * show Category
     *
     * @param [id] $id
     * @return void
     */
    public function show($id);
      /**
     * show subCategory
     *
     * @param [id] categoryId
     * @return void
     */
    public function showSubcategories($categoryId);
}
