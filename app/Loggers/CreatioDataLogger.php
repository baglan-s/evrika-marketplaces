<?php


namespace App\Loggers;
use Exception;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Log;
use App\Interfaces\DataLogger;


class CreatioDataLogger implements DataLogger
{

    public static $channel = 'creatio';

    public static function write(Response $response, array $opt_params = [])
    {
        $log = [
            'status' => $response->status(),
            'body' => $response->body(),
        ];

        if (!empty($opt_params)) {
            $log = array_merge($log, $opt_params);
        }

        Log::channel(self::$channel)->info($log);
    }
}