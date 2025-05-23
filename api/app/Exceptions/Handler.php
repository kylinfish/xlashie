<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\AuthenticationException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    private $status_messages = [
        100 => "Continue",
        101 => "Switching Protocols",
        102 => "Processing",
        200 => "OK",
        201 => "Created",
        202 => "Accepted",
        203 => "Non-Authoritative Information",
        204 => "No Content",
        205 => "Reset Content",
        206 => "Partial Content",
        207 => "Multi-Status",
        300 => "Multiple Choices",
        301 => "Moved Permanently",
        302 => "Found",
        303 => "See Other",
        304 => "Not Modified",
        305 => "Use Proxy",
        306 => "(Unused)",
        307 => "Temporary Redirect",
        308 => "Permanent Redirect",
        400 => "Bad Request",
        401 => "Unauthorized",
        402 => "Payment Required",
        403 => "Forbidden",
        404 => "Not Found",
        405 => "Method Not Allowed",
        406 => "Not Acceptable",
        407 => "Proxy Authentication Required",
        408 => "Request Timeout",
        409 => "Conflict",
        410 => "Gone",
        411 => "Length Required",
        412 => "Precondition Failed",
        413 => "Request Entity Too Large",
        414 => "Request-URI Too Long",
        415 => "Unsupported Media Type",
        416 => "Requested Range Not Satisfiable",
        417 => "Expectation Failed",
        418 => "I'm a teapot",
        419 => "Authentication Timeout",
        420 => "Enhance Your Calm",
        422 => "Unprocessable Entity",
        423 => "Locked",
        424 => "Failed Dependency",
        424 => "Method Failure",
        425 => "Unordered Collection",
        426 => "Upgrade Required",
        428 => "Precondition Required",
        429 => "Too Many Requests",
        431 => "Request Header Fields Too Large",
        444 => "No Response",
        449 => "Retry With",
        450 => "Blocked by Windows Parental Controls",
        451 => "Unavailable For Legal Reasons",
        494 => "Request Header Too Large",
        495 => "Cert Error",
        496 => "No Cert",
        497 => "HTTP to HTTPS",
        499 => "Client Closed Request",
        500 => "Internal Server Error",
        501 => "Not Implemented",
        502 => "Bad Gateway",
        503 => "Service Unavailable",
        504 => "Gateway Timeout",
        505 => "HTTP Version Not Supported",
        506 => "Variant Also Negotiates",
        507 => "Insufficient Storage",
        508 => "Loop Detected",
        509 => "Bandwidth Limit Exceeded",
        510 => "Not Extended",
        511 => "Network Authentication Required",
        598 => "Network read timeout error",
        599 => "Network connect timeout error"
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Exception $e)
    {
        parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Exception
     */
    public function render($request, Exception $e)
    {
        if ($request->ajax()) {
            return $this->renderWitthApi($request, $e);
        }
        return parent::render($request, $e);
    }

    private function renderWitthApi($request, $e)
    {
        if (isset($_GET['e']) and env('APP_DEBUG')) {
            if ($e instanceof ValidationException) {
                return $this->responseError(422, $e->errors());
            }
            dd($e->getMessage());
        }

        // URI doesn't match handler.
        if ($e instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException) {
            return $this->responseError(404);
        }

        // Handle Validation Error
        if ($e instanceof ValidationException) {
            return $this->responseError(422, $e->errors());
        }

        // Handle non match status type
        $http_status_code = $e->getCode();

        // Handle MethodNotAllowedHttpException
        if ($e instanceof MethodNotAllowedHttpException) {
            $http_status_code = 405;
        }

        if (!isset($this->status_messages[$http_status_code])) {
            return $this->responseError(500, "Something Wrong, Request Debug Mmode to dig");
        }

        // Response by exception information
        $message = $e->getMessage() ?: $this->status_messages[$http_status_code];

        return $this->responseError($http_status_code, $message);
    }

    /**
     * responseError
     *
     * @param int $code
     * @param mixed $message
     * @return json
     */
    private function responseError($code, $message = null)
    {
        $message = is_null($message) ? $this->status_messages[$code] : $message;
        return response()->json([
            'error' => true,
            'status_code' => $code,
            'message' => $message,
        ], $code);
    }

    /**
     * Convert an authentication exception into a response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return $request->expectsJson()
                    ? response()->json(['message' => $exception->getMessage()], 401)
                    : redirect()->guest($exception->redirectTo() ?? route('auth.login'));
    }
}
