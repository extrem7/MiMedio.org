<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class Handler extends ExceptionHandler
{
    protected $dontReport = [
        //
    ];

    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Render an exception into an HTTP response.
     *
     * @param Request $request
     * @throws \Exception
     */
    public function render($request, \Throwable $exception): Response
    {
        if ($this->isHttpException($exception)) {
            $isAdminRoute = strpos(request()->url(), 'admin') !== false;
            if ($exception->getStatusCode() === 404 && $isAdminRoute && \Auth::check() && \Auth::user()->is_admin) {
                return response()->view('admin.errors.404', [], 404);
            }
        }

        if ($request->ajax() && $exception instanceof ValidationException) {
            return response()->json([
                'message' => 'Validation errors',
                'errors' => $exception->validator->getMessageBag()
            ], 422);
        }

        return parent::render($request, $exception);
    }
}
