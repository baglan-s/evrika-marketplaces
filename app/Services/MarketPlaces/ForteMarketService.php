<?php


namespace App\Services\MarketPlaces;


use App\Interfaces\MarketService;
use App\Loggers\ErrorLogger;
use Illuminate\Support\Facades\Http;
use App\Loggers\ForteMarketDataLogger;
use App\Helpers\ForteMarketRequestHelper;
use Exception;

class ForteMarketService implements MarketService
{
    private $request_helper;

    public $data_helper;

    public function __construct()
    {
        $this->request_helper = new ForteMarketRequestHelper();
    }

    public function getOrders(array $filter = ['size' => '15']) : array
    {
        try {
            $response = Http::withHeaders($this->request_helper->getHeaders())
                ->post($this->request_helper->getConfig()['endpoint'] . '/filter/', $filter);

            if (!$response->ok()) {
                ForteMarketDataLogger::write($response);
                return [];
            }

            return json_decode($response->body(), true);

        } catch (Exception $e) {
            ErrorLogger::write($e);
        }

        return [];
    }

    public function getOrder($order_id) : array
    {
        try {
            $response = Http::withHeaders($this->request_helper->getHeaders())
                ->post($this->request_helper->getConfig()['endpoint'] . "/$order_id", ['from' => 0]);

            if (!$response->ok()) {
                ForteMarketDataLogger::write($response);
                return [];
            }

            return json_decode($response->body(), true);

        } catch (Exception $e) {
            ErrorLogger::write($e);
        }

        return [];
    }
}