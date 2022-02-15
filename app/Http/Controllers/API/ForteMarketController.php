<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderStatus;
use App\Services\MarketPlaces\ForteMarketService;

class ForteMarketController extends Controller
{
    public function changeOrderStatus(Request $request)
    {
        if ($request->has(['order_id', 'status_id'])) {
            $order_status = OrderStatus::findOrFail($request->status_id);
            $forte_market_service = new ForteMarketService();

            return response()->json([
                'success' => $forte_market_service->changeStatus($request->order_id, $order_status->forteMarketOrderStatus->name)
            ], '200');
        }

        return response()->json(['success' => false], '404');
    }
}
