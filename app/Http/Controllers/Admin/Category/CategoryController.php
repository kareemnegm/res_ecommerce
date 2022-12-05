<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\categoryFormRequest;
use App\Http\Requests\UpdateCategoryFormRequest;
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
     *      path="/api/admin/category",
     *      operationId="CategoryIndex",
     *      tags={"SystemAdmin"},
     *      summary="system categories",
     *      description="Returns system categories",
     *      security={{"Bearer": {}}},
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Post(
     *
     *      path="/api/admin/category",
     *      operationId="createCategory",
     *      tags={"SystemAdmin"},
     *      summary="create new category",
     *      description="Returns category data",
     *      security={{"Bearer": {}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/CreateCategory")
     *     ),
     *      @OA\Response(
     *          response=201,
     *          description="Success",
     *
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
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Validation error"
     *      )
     * )
     */
    public function store(categoryFormRequest $request)
    {
        $category = $this->CategoryRepository->create($request->validated());

        return $this->dataResponse(['category' => new CategoryResource($category)], 'success', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Get(
     *      path="/api/admin/category/{id}",
     *      operationId="getCategory",
     *      tags={"SystemAdmin"},
     *      summary="get category",
     *      description="Returns single category  data",
     * security={{"Bearer": {}}},
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * @OA\Put(
     *
     *      path="/api/admin/category/{id}",
     *      operationId="UpdateCategory",
     *      tags={"SystemAdmin"},
     *      summary="update category",
     *      description="Returns success ",
     * security={{"Bearer": {}}},
     *   @OA\Parameter(
     *          name="id",
     *          description="category id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          ),
     * ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/CreateCategory")
     *     ),
     *      @OA\Response(
     *          response=201,
     *          description="Success",
     *
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
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Validation error"
     *      )
     * )
     */
    public function update(UpdateCategoryFormRequest $request, $id)
    {
        $this->CategoryRepository->update($request->validated(), $id);

        return $this->successResponse('updated success', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Delete(
     *      path="/api/admin/category/{id}",
     *      operationId="deleteCategory",
     *      tags={"SystemAdmin"},
     *      summary="Delete category",
     *      description="Deletes a record and returns successfully",
     * security={{"Bearer": {}}},
     *       @OA\Parameter(
     *          name="id",
     *          description="category id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          ),
     * ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     */
    public function destroy($id)
    {
        $this->CategoryRepository->delete($id);

        return $this->successResponse('deleted success', 200);
    }
}
