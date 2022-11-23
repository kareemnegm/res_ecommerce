<?php

namespace App\Repositories\Admin\Category;

use App\Interfaces\Admin\Category\CategoryInterface;
use App\Models\Category;

class CategoryRepository implements CategoryInterface
{

    public function index(){
        return Category::where('category_id',null)->get();
    }

    /**
     * create Category
     *
     * @param [type] $request
     * @param [type]
     * @return void
     */
    public function create($categoryData)
    {
        return Category::create($categoryData);
    }
    /**
     * update Category
     *
     * @param [categoryData] $request
     * @param [id] $id
     * @return void
     */
    public function update($categoryData, $id)
    {
        Category::where('id', $id)->update($categoryData);
    }
    /**
     * delete Category
     *
     * @param [id] $id
     * @return void
     */
    public function delete($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
    }
    /**
     * show Category
     *
     * @param [id] $id
     * @return void
     */
    public function show($id)
    {
        return Category::findOrFail($id);
    }
    /**
     * show subCategory
     *
     * @param [id] categoryId
     * @return void
     */
    public function showSubcategories($categoryId)
    {
    }
}
