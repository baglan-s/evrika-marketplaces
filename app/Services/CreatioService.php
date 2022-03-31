<?php

namespace App\Services;

use App\Helpers\CreatioRequestHelper;
use Illuminate\Support\Facades\Http;
use App\Loggers\ErrorLogger;
use App\Loggers\CreatioDataLogger;
use App\Interfaces\CreatioDataAdapter;
use Exception;

class CreatioService
{

    public $request_helper;

    public $data_helper;

    public function __construct(CreatioDataAdapter $data_helper)
    {
        $this->request_helper = new CreatioRequestHelper();
        $this->data_helper = $data_helper;
    }

    public function authorize() : bool
    {
        try {
            $response = Http::withHeaders($this->request_helper->getHeaders())
                ->post($this->request_helper->getConfig()['auth_link'], [
                    'UserName' => $this->request_helper->getConfig()['login'],
                    'UserPassword' => $this->request_helper->getConfig()['password'],
                ]);

            if (!$response->ok()) {
                CreatioDataLogger::write($response);
                return false;
            }

            if (isset($response->cookies) && !empty($response->cookies)) {
                foreach ($response->cookies()->toArray() as $cookie) {
                    $this->request_helper->addCookies([$cookie['Name'] => $cookie['Value']]);

                    if ($cookie['Name'] === 'BPMCSRF') {
                        $this->request_helper->setToken($cookie['Name'], $cookie['Value']);
                        $this->request_helper->addHeaders([$cookie['Name'] => $cookie['Value']]);
                    }
                }

                if (!empty($this->request_helper->getToken())) {
                    return true;
                }
            }

        } catch (Exception $e) {
            ErrorLogger::write($e);
        }

        return false;
    }

    public function send(array $data) //: bool
    {
        try {
            $prepared_data = $this->data_helper->processDataForCreatio($data);

            $response = Http::withHeaders($this->request_helper->getHeaders())
                ->withCookies($this->request_helper->getCookies(), $this->request_helper->getConfig()['domain'])
                ->post($this->request_helper->getConfig()['order_link'], $prepared_data);

            CreatioDataLogger::write($response, ['sent_data' => serialize($prepared_data)]);

            if (!$response->ok()) {
                return false;
            }


        } catch (Exception $e) {
            ErrorLogger::write($e);
        }

        return false;
    }
}