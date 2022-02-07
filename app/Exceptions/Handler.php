<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Spatie\Multitenancy\Exceptions\NoCurrentTenant;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

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
        $this->renderable(function (Throwable $exception, $request) {
            if ($exception instanceof NoCurrentTenant) {
                return response()->json(['message' => 'No existe inquilino.'], Response::HTTP_CONFLICT);
            }

            if ($exception instanceof ModelNotFoundException) {
                return response()->json(['message' => 'No existe instancia para este modelo.'], Response::HTTP_NOT_FOUND);
            }

            if ($exception instanceof NotFoundHttpException) {
                $code = $exception->getStatusCode();
                return response()->json(['message' => 'No se ha encontrado el recurso.'], $code);
            }

            if ($exception instanceof MethodNotAllowedHttpException) {
                return response()->json(['message' => 'Método no permitido.'], Response::HTTP_METHOD_NOT_ALLOWED);
            }

            if ($exception instanceof ValidationException) {
                $errors = $exception->validator->errors()->all();
                return response()->json(['message' => 'Han ocurrido algunos errores.', 'detail' => $errors], Response::HTTP_BAD_REQUEST);
            }

            if (config('app.debug')) {
                return response()->json(['message' => $exception->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
            }

            return response()->json(['message' => 'Error interno del servidor.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        });
    }
}
