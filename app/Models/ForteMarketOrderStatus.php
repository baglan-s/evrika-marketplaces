<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderStatus;

class ForteMarketOrderStatus extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    const ACCEPTED = 1;
    const GIVE_AWAY = 2;
    const CANCELLED = 3;

    public function orderStatuses()
    {
        return $this->hasMany(OrderStatus::class);
    }
}
