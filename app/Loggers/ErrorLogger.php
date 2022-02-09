<?php


namespace App\Loggers;

use Illuminate\Support\Facades\Log;
use Exception;

class ErrorLogger
{
    public static function write(Exception $e)
    {
        Log::channel('single')->debug([
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'message' => $e->getMessage(),
        ]);
    }
}