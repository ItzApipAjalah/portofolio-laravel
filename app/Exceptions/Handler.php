<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
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
        if ($this->isHttpException($exception)) {
            $statusCode = $exception->getStatusCode();
            $message = $this->getErrorMessage($statusCode);
            $path = $request->path();
            if (view()->exists("error")) {
                return response()->view("error", [
                    'statusCode' => $statusCode,
                    'message' => $message,
                    'path' => $path
                ], $statusCode);
            }
        }
        return parent::render($request, $exception);
    }

    protected function getErrorMessage($statusCode)
    {
        switch ($statusCode) {
            case 404:
                return "you_spelt_it_wrong";
            case 403:
                return "do_not_have_permission";
            case 500:
                return "unexpected_error_has_occurred_on_the_server.";
            case 405:
                return "the_requested_method_is_not_allowed.";
            default:
                return "an_error_has_occurred.";
        }
    }
}
