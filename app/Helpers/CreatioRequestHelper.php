<?php

namespace App\Helpers;


class CreatioRequestHelper
{

    private $config;

    private $headers = [];

    private $cookies = [];

    private $token;

    public function __construct()
    {
        $this->config = env('DEV_MODE') ? config('services.creatio')['test'] : config('services.creatio')['production'];
        $this->setHeaders(['Content-Type' => 'application/json']);
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

    /**
     * @param array $headers
     */
    public function addHeaders($headers = []) : void
    {
        $this->headers = array_merge($this->headers, $headers);
    }

    /**
     * @return mixed
     */
    public function getCookies(): array
    {
        return $this->cookies;
    }

    /**
     * @param mixed $cookies
     */
    public function setCookies(array $cookies) : void
    {
        $this->cookies = $cookies;
    }

    /**
     * @param mixed $cookies
     */
    public function addCookies(array $cookies) : void
    {
        $this->cookies = array_merge($this->cookies, $cookies);
    }

    /**
     * @param mixed $name
     * @param mixed $value
     */
    public function setToken($name, $value) : void
    {
        $this->token = [
            'name' => $name,
            'value' => $value,
        ];
    }

    /**
     * @return mixed
     */
    public function getToken() : array
    {
        return $this->token;
    }
}