<?php

namespace App\Http\Controllers;

use App\Helpers\TestDataHelper;
use App\Services\CreatioService;
use Illuminate\Http\Request;
use App\Services\MarketPlaces\ForteMarketService;
use App\Helpers\ForteMarketDataHelper;

class TestController extends Controller
{
    public function index()
    {
        $forte_market_service = new ForteMarketService();
        $creatio_service = new CreatioService(new ForteMarketDataHelper());

        if ($creatio_service->authorize()) {
            $forte_market_orders = $forte_market_service->getOrders([
                'from' => 0,
                'size' => 15,
                'scope' => 'fortemarket',
                'order_status' => ['pending_approve', 'filled_not_approved'],
                'city_id' => '',
                'sort' => 'updated_on_DESC',
            ]);

            if (isset($forte_market_orders['orders']) && !empty($forte_market_orders['orders'])) {
                foreach ($forte_market_orders['orders'] as $order) {
                    $order_with_details = $forte_market_service->getOrder($order['uid']);
                    $creatio_service->send($order_with_details);
                }
            }
        }

    }
}
