<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Request_Functions\Parse;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class HandlePutFormData
{
    public function handle(Request $request, Closure $next)
    {
        // نتدخل فقط إذا كان الطلب PUT أو PATCH ومن نوع multipart/form-data
        if (($request->isMethod('PUT') || $request->isMethod('PATCH')) && 
            str_contains($request->header('Content-Type'), 'multipart/form-data')) {
            
            Parse::parseMultipartData($request);
        }

        return $next($request);
    }


}