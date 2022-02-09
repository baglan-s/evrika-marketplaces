<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ForteMarketOrderStatus;

class OrderStatus extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'forte_market_order_status_id'];

    public function forteMarketOrderStatus()
    {
        return $this->belongsTo(ForteMarketOrderStatus::class);
    }
}
