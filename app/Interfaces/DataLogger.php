<?php


namespace App\Interfaces;

use Illuminate\Http\Client\Response;


interface DataLogger
{
    public static function write(Response $response, array $opt_params);
}