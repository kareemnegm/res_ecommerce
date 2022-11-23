<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{

     /**
     * @OA\Info(title="Ecommerce Api", version="0.1")
     * @OA\SecurityScheme(
     *securityScheme="Bearer",
    *type="http",
    *scheme="bearer",
    *bearerFormat="JWT"
    *)
    */
        /*@CrossOrigin(origins = "http://127.0.0.1:8000/", maxAge = 3600)
        @RestController
    */

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function dataResponse($data, $message = null, $code = null)
    {

        $success = [
            'code' => $code ? $code : 200,
            'message' => $message ? $message : 'success',
        ];

        $success = array_merge($success, $data);

        return response()->json($success, 200);
    }

    public function successResponse($message = null, $code = null)
    {
        $success = [
            'code' => $code ? $code : 200,
            'message' => $message ? $message : 'success'
        ];

        return response()->json($success, 200);
    }

    public function errorResponse($message, $code)
    {
        $error = [
            'code' => $code,
            'message' => $message
        ];

        return response()->json($error, 401);
    }

    public function errorResponseWithstatus($message, $code)
    {
        $error = [
            'code' => $code,
            'message' => $message
        ];

        return response()->json($error, $code);
    }
    public function paginateCollection($items, $perPage ,$key , $options = [],$page = null)
{
    $key=$key?$key:'data';
    $perPage=$perPage ? $perPage:10;

	$page = $page ?: (Paginator::resolveCurrentPage() ?: 1);

	$items = $items instanceof Collection ? $items : Collection::make($items);

    $lap = new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);

    return [
        "status"=> 200,
        "message"=>"success",
        "data"=>[
            "result"=>[
        'current_page' => $lap->currentPage(),
         $key => $lap ->values(),
        'first_page_url' => $lap ->url(1),
        'from' => $lap->firstItem(),
        'last_page' => $lap->lastPage(),
        'last_page_url' => $lap->url($lap->lastPage()),
        'next_page_url' => $lap->nextPageUrl(),
        'per_page' => $lap->perPage(),
        'prev_page_url' => $lap->previousPageUrl(),
        'to' => $lap->lastItem(),
        'total' => $lap->total(),
        ]
        ]
    ];
}
}
