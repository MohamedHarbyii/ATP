<?php

use Illuminate\Http\Request;
use App\Http\Middleware\test;
use Illuminate\Foundation\Application;
use App\Http\Middleware\HandlePutFormData;
use Cloudinary\Configuration\Configuration;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias(
            [
                // 'test' => test::class,
                'update-request' => HandlePutFormData::class,
            ]
        );
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (NotFoundHttpException $e, Request $request) {

            // نتأكد إن الريكوست API (عشان منرجعش JSON لصفحات الويب العادية)
            if ($request->is('api/*')) {

                // لو الخطأ سببه إن موديل مش موجود (زي Coach مش لاقينه)
                if ($e->getPrevious() instanceof ModelNotFoundException) {
                    // دي حركة صايعة عشان تجيب اسم الموديل (Coach, Game, etc)
                    $model = class_basename($e->getPrevious()->getModel());

                    return response()->json([
                        'status' => false,
                        'message' => "{$model} not found", // هترجع Coach not found أوتوماتيك
                    ], 404);
                }

                // لو الرابط نفسه غلط (404 عادي)
                return response()->json([
                    'status' => false,
                    'message' => 'Route not found',
                ], 404);
            }
        });
    })->booted(function () {
  
    })->create();
