<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var string[]
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var string[]
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
        if ($request->is('api/*')) {
            if ($exception instanceof AuthenticationException) {
                // 未認証
                return response()->json([
                    'success' => false,
                    'message' => '認証エラーが発生しました。再度ログインしなおしてください。'
                ], 401);
            } else if ($exception instanceof ModelNotFoundException) {
                // Route Model Binding でデータが見つからない
                return response()->json([
                    'success' => false,
                    'message' => 'Route Model Not found'
                ], 404);
            } else if ($exception instanceof NotFoundHttpException) {
                // Route が存在しない
                return response()->json([
                    'success' => false,
                    'message' => 'Route Not found'
                ], 404);
            } else {
                return parent::render($request, $exception);
            }
        } else {
            return parent::render($request, $exception);
        }
    }
}


