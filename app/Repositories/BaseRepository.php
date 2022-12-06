<?php

namespace App\Repositories;


use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

abstract class BaseRepository
{
    public function __construct(protected array $result = [])
    {
    }

    /**
     * Handle Success Cases and responses
     *
     * @param  int  $statusCode
     * @param  array  $data
     * @param  int  $code
     * @param  string  $hint
     * @return array
     */
    public function success(int $statusCode, array $data, int $code = 1022, string $hint = 'Process successfully'): array
    {
        if ($statusCode == 201) {
            $code = 1021;
            $hint = 'Resource created successfully';
        }

        $this->result['status_code'] = $statusCode;
        $this->result['code'] = $code;
        $this->result['hint'] = $hint;
        $this->result['success'] = true;
        $this->result['data'] = $data;

        return $this->result;
    }

    /**
     * Handle failed Cases and responses
     *
     * @param  int  $statusCode
     * @param  array  $errors
     * @param  int  $code
     * @param  string  $hint
     * @return array
     */
    public function failed(int $statusCode, array $errors, int $code = 1040, $hint = ''): array
    {
        switch ($statusCode) {
            case 401:
                $code = 1041;
                $hint = 'Unauthenticated';
                break;
            case 403:
                $code = 1043;
                $hint = 'Forbidden';
                break;
            case 404:
                $code = 1044;
                $hint = 'Resource not found';
                break;
            case 409:
                $code = 1049;
                $hint = 'Method Not Allowed';
                break;
            case 422:
                $code = 1422;
                $hint = 'Unprocessable Entity';
                break;
            case 500:
                $code = 1050;
                $hint = 'Server error';
                break;
            default:
                $code = $code;
                $hint = $hint;
                break;
        }

        $this->result['status_code'] = $statusCode;
        $this->result['code'] = $code;
        $this->result['hint'] = $hint;
        $this->result['success'] = false;
        $this->result['errors'] = $errors;

        return $this->result;
    }

    /**
     * Handles Exceptions Fails
     *
     * @param  Exception  $e
     * @return array
     */
    public function failedWithException(Exception $e): array
    {
        return $this->failed(500, [
            'error' => __('common.something_went_wrong'),
            'description' => [
                'code' => $e->getCode(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'message' => $e->getMessage(),
            ],
        ]);
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
