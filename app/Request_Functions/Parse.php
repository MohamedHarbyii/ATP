<?php

namespace App\Request_Functions;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class Parse
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public static function parseMultipartData(Request $request) {
        
        $input = file_get_contents('php://input');
        
        // استخراج الـ Boundary من الـ Header
        preg_match('/boundary=(.*)$/', $request->header('Content-Type'), $matches);
        if (!isset($matches[1])) return;
        
        $boundary = $matches[1];
        $parts = preg_split("/-+$boundary/", $input);
        array_pop($parts); // حذف آخر عنصر فارغ

        foreach ($parts as $part) {
            if (empty($part)) continue;

            // فصل الـ Headers عن الـ Body في كل جزء
            [$rawHeaders, $body] = explode("\r\n\r\n", $part, 2);
            $body = substr($body, 0, strlen($body) - 2); // حذف الـ \r\n الأخير

            // استخراج اسم الحقل
            preg_match('/name="([^"]*)"/', $rawHeaders, $nameMatch);
            $name = $nameMatch[1] ?? null;

            if (!$name) continue;

            // هل هذا الجزء عبارة عن ملف؟
            if (str_contains($rawHeaders, 'filename=')) {
                preg_match('/filename="([^"]*)"/', $rawHeaders, $fileMatch);
                $filename = $fileMatch[1];

                // إنشاء ملف مؤقت لمحاكاة الـ UploadedFile
                $tmpPath = tempnam(sys_get_temp_dir(), 'php_put_');
                file_put_contents($tmpPath, $body);

                $file = new UploadedFile($tmpPath, $filename, null, null, true);
                $request->files->set($name, $file);
            } else {
                // بيانات عادية (Text/String)
                $request->merge([$name => $body]);
            }
        }
    }
}
