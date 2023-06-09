<?php

namespace App\Exceptions;

use App\Traits\ResponseAPI;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Illuminate\Validation\UnauthorizedException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    use ResponseAPI;

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
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $e)
    {
        if($request->wantsJson() && ! $e instanceof ValidationException) {
            if($e instanceof UnauthorizedException || $e instanceof UnauthorizedHttpException || $e instanceof AuthorizationException) {
                return $this->error($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);

            } else if($e instanceof CartException) {
                return $this->error($e->getMessage(), Response::HTTP_BAD_REQUEST);
            }

        }

        return parent::render($request, $e);
    }
}
