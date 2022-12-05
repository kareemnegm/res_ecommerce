<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Http\Resources\Category\CategoryResource;
use App\Interfaces\Admin\Category\CategoryInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private CategoryInterface $CategoryRepository;

    public function __construct(CategoryInterface $CategoryRepository)
    {
        $this->CategoryRepository = $CategoryRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * @OA\Get(
     *      path="/api/category",
     *      operationId="CategoryIndexHome",
     *      tags={"category"},
     *      summary="system categories",
     *      description="Returns system categories",
     *     @OA\MediaType(mediaType="application/json"),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */
    public function index(Request $request)
    {
        $categories = $this->CategoryRepository->index();

        return $this->paginateCollection(CategoryResource::collection($categories), $request->limit, 'categories');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Get(
     *      path="/api/category/{id}",
     *      operationId="getCategoryIdHome",
     *      tags={"category"},
     *      summary="get category",
     *      description="Returns single category  data",
     *     @OA\MediaType(mediaType="application/json"),
     *      @OA\Parameter(
     *          name="id",
     *          description="category id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */
    public function show($id)
    {
        return $this->dataResponse(['category' => new CategoryResource($this->CategoryRepository->show($id))], 'success', 200);
    }
}
