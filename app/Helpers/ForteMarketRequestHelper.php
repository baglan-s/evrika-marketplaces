<?php

namespace App\Helpers;


class ForteMarketRequestHelper
{

    private $config;

    private $headers;

    public function __construct()
    {
        $this->config = config('marketplace.forte_market');
        $this->setHeaders([
            'API-KEY' => $this->config['api_key'],
            'Content-Type' => 'application/json'
        ]);
    }

    public function getConfig() : array
    {
        return $this->config;
    }

    /**
     * @return mixed
     */
    public function getHeaders() : array
    {
        return $this->headers;
    }

    /**
     * @param array $headers
     */
    public function setHeaders($headers = []) : void
    {
        $this->headers = $headers;
    }
}