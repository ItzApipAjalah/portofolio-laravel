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
        $statusCode = $exception->getStatusCode();
        $codes = [
            400 => 'Bad Request',
            401 => 'Authorization Required',
            402 => 'Payment Required',
            403 => 'Forbidden',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            406 => 'Not Acceptable',
            407 => 'Proxy Authentication Required',
            408 => 'Request Timeout',
            409 => 'Conflict',
            410 => 'Gone',
            411 => 'Length Required',
            412 => 'Precondition Failed',
            413 => 'Request Entity Too Large',
            414 => 'Request URI Too Large',
            415 => 'Unsupported Media Type',
            416 => 'Request Range Not Satisfiable',
            417 => 'Expectation Failed',
            422 => 'Unprocessable Entity',
            423 => 'Locked',
            424 => 'Failed Dependency',
            500 => 'Internal Server Error',
            501 => 'Not Implemented',
            502 => 'Bad Gateway',
            503 => 'Service Unavailable',
            504 => 'Gateway Timeout',
            505 => 'HTTP Version Not Supported',
            506 => 'Variant Also Negotiates',
            507 => 'Insufficient Storage',
            510 => 'Not Extended',
            666 => 'Custom Error'
        ];

        $descriptions = [
            400 => 'The server could not understand the request due to invalid syntax.',
            401 => 'The client must authenticate itself to get the requested response.',
            402 => 'This request requires payment to proceed.',
            403 => 'You do not have permission to access this resource.',
            404 => 'The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.',
            405 => 'The request method is not supported for the requested resource.',
            406 => 'The requested resource is not capable of generating content acceptable according to the Accept headers sent in the request.',
            407 => 'You must authenticate with a proxy server before this request can be fulfilled.',
            408 => 'The server timed out waiting for the request.',
            409 => 'The request could not be completed due to a conflict with the current state of the target resource.',
            410 => 'The requested resource is no longer available at the server and no forwarding address is known.',
            411 => 'The server refuses to accept the request without a defined Content-Length.',
            412 => 'The server does not meet one of the preconditions that the requester put on the request.',
            413 => 'The request entity is larger than the server is willing or able to process.',
            414 => 'The URI requested by the client is longer than the server is willing to interpret.',
            415 => 'The media format of the requested data is not supported by the server.',
            416 => 'The range specified by the Range header field in the request cannot be fulfilled.',
            417 => 'The server cannot meet the requirements of the Expect request-header field.',
            422 => 'The request was well-formed but was unable to be followed due to semantic errors.',
            423 => 'The resource that is being accessed is locked.',
            424 => 'The request failed due to failure of a previous request.',
            500 => 'The server has encountered a situation it does not know how to handle.',
            501 => 'The request method is not supported by the server and cannot be handled.',
            502 => 'The server, while acting as a gateway or proxy, received an invalid response from the upstream server.',
            503 => 'The server is not ready to handle the request.',
            504 => 'The server, while acting as a gateway or proxy, did not get a response in time from the upstream server.',
            505 => 'The HTTP version used in the request is not supported by the server.',
            506 => 'The server has an internal configuration error.',
            507 => 'The server is unable to store the representation needed to complete the request.',
            510 => 'Further extensions to the request are required for the server to fulfill it.',
            666 => 'What are you doing here?'
        ];

        if (basename($request->getPathInfo()) === 'error.php') {
            $statusCode = 666;
        }

        if (array_key_exists($statusCode, $codes) && is_numeric($statusCode)) {
            $message = "{$codes[$statusCode]}";
            $description = $descriptions[$statusCode];
        } else {
            $statusCode = 520; // Unknown Error
            $message = 'Unknown Error';
            $description = 'An unknown error has occurred.';
        }

        return response()->view('error', [
            'code' => $statusCode,
            'title' => $message,
            'description' => $description
        ], $statusCode);
    }
}
