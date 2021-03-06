<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderStatus;
use App\Services\MarketPlaces\ForteMarketService;
use App\Loggers\ErrorLogger;

class ForteMarketController extends Controller
{
    public function changeOrderStatus(Request $request)
    {
        try {
            if ($request->has(['order_id', 'status_id'])) {
                $order_status = OrderStatus::findOrFail($request->status_id);
                $forte_market_service = new ForteMarketService();

                return response()->json([
                    'success' => $forte_market_service->changeStatus($request->order_id, $order_status->forteMarketOrderStatus->name)
                ], '200');
            }
        } catch (\Exception $e) {
            ErrorLogger::write($e);
        }

        return response()->json(['success' => false], '404');
    }
}
