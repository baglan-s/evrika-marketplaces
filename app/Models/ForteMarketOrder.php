<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ForteMarketOrderStatus;

class ForteMarketOrder extends Model
{
    use HasFactory;

    protected $fillable = ['forte_market_order_status_id', 'guid', 'is_sent'];

    public function status()
    {
        return $this->belongsTo(ForteMarketOrderStatus::class);
    }
}
