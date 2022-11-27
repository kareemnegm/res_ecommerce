<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof ModelNotFoundException && $request->wantsJson()) {
            return response()->json([
                'code' => 404,
                'status' => 'Failed',
                'message' => 'Resource item not found.'
            ], 404);
        }


        if ($exception instanceof NotFoundHttpException) {
            if ($request->is('api/*')) {
                return response()->json([
                    'code' => 404,
                    'status' => 'Failed',
                    'message' => 'Resource not found.'
                ], 404);
            }
        }
        if ($exception instanceof ModelNotFoundException) {
            return response()->json([
                'code' => 404,
                'status' => 'Failed',
                'message' => 'Resource item not found.'
            ], 404);
        }


        if ($exception instanceof MethodNotAllowedHttpException && $request->wantsJson()) {
            return response()->json([
                'code' => 405,
                'status' => 'Failed',
                'message' => 'Method not allowed.'
            ], 405);
        }

        if ($exception instanceof MethodNotAllowedHttpException && $request->wantsJson()) {
            return response()->json([
                'code' => 405,
                'status' => 'Failed',
                'message' => 'Method not allowed.'
            ], 405);
        }

        if ($exception instanceof TooManyRequestsHttpException && $request->wantsJson()) {
            return response()->json([
                'code' => 429,
                'status' => 'Failed',
                'message' => 'Too Many Request.'
            ], 429);
        }

        if (!\Auth::check()) {
            return response()->json([
                'code' => 401,
                'status' => 'Failed',
                'message' => 'Unauthenticated.'
            ], 401);
        }

        $statusCode = 500;
        $response = ($statusCode == 500) ? ['code'=>500,'status'=>'Failed','message'=>'internal server error','error'=>$exception->getMessage()] : $exception->getMessage();
        return response()->json($response, 500);

        return parent::render($request, $exception);
    }


    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return $request->expectsJson()
            ? response()->json(
                [
                    'code' => 401,
                    'message' => $exception->getMessage(),
                    'status' => 'Failed'
                ],
                401
            )
            : redirect()->guest($exception->redirectTo() ?? route('login'));
    }
}
