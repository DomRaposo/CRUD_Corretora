<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Routing\Exceptions\UrlGenerationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register()
    {
        // Parâmetro ausente na rota
        $this->renderable(function (UrlGenerationException $e, $request) {
            return response()->view('errors.custom', [
                'message' => 'Parâmetro ausente na rota. Verifique a URL ou o formulário.'
            ], 400);
        });

        // Rota não encontrada (erro 404)
        $this->renderable(function (NotFoundHttpException $e, $request) {
            return response()->view('errors.custom', [
                'message' => 'Página não encontrada. Verifique o endereço digitado.'
            ], 404);
        });

        // Método não permitido
        $this->renderable(function (MethodNotAllowedHttpException $e, $request) {
            return response()->view('errors.custom', [
                'message' => 'Método HTTP não permitido para esta rota.'
            ], 405);
        });

        // Erro genérico
        $this->renderable(function (Throwable $e, $request) {
            return response()->view('errors.custom', [
                'message' => 'Ocorreu um erro inesperado. Por favor, tente novamente mais tarde.'
            ], 500);
        });
    }
}
