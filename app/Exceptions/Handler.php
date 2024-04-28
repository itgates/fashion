<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
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
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $e)
    {
        if ($e instanceof ValidationException) {
            $error_message = $e->validator->getMessageBag()->first();
            return response()->json(['error' => $error_message], 422);
        }
        if ($e instanceof ModelNotFoundException) {
            $model_name = str(class_basename($e->getModel()))->lower();
            return response()->json(['error' => 'You are trying to get ' . $model_name . ' that does not exist.'], 404);
        }
        if ($e instanceof AuthenticationException) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }
        if ($e instanceof AuthorizationException) {
            return response()->json(['error' => $e->getMessage()], 401);
        }
        if ($e instanceof NotFoundHttpException) {
            return response()->json(['error' => 'The requested URL could not be retrieved.'], 404);
        }
        if ($e instanceof MethodNotAllowedHttpException) {
            return response()->json(['error' => 'The specified method for the request is invalid .'], 405);
        }
        if ($e instanceof HttpException) {
            return response()->json(['error' => $e->getMessage()], $e->getStatusCode());
        }

        if ($e instanceof \Exception) {
            return response()->json(['error' => config('app.debug') ?$e->getMessage():'Server Error'], 500);
        }
        return parent::render($request, $e);
    }
}
