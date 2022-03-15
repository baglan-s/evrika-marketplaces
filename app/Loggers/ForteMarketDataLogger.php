<?php


namespace App\Loggers;
use App\Interfaces\DataLogger;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Client\Response;


class ForteMarketDataLogger implements DataLogger
{

    public static $channel = 'marketplace';

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

    public static function logInfo($data = [])
    {
        Log::channel(self::$channel)->info($data);
    }
}