<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OrderStatus;
use App\Models\ForteMarketOrderStatus;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OrderStatus::create(['name' => 'Новый', 'forte_market_order_status_id' => ForteMarketOrderStatus::ACCEPTED]);
        OrderStatus::create(['name' => 'Завершен', 'forte_market_order_status_id' => ForteMarketOrderStatus::GIVE_AWAY]);
        OrderStatus::create(['name' => 'Отменен', 'forte_market_order_status_id' => ForteMarketOrderStatus::CANCELLED]);
        OrderStatus::create(['name' => 'Принят', 'forte_market_order_status_id' => ForteMarketOrderStatus::ACCEPTED]);
        OrderStatus::create(['name' => 'Самовывоз', 'forte_market_order_status_id' => ForteMarketOrderStatus::GIVE_AWAY]);
        OrderStatus::create(['name' => 'На доставке', 'forte_market_order_status_id' => ForteMarketOrderStatus::GIVE_AWAY]);
        OrderStatus::create(['name' => 'Не принят, свяжитесь с нами по телефону', 'forte_market_order_status_id' => ForteMarketOrderStatus::CANCELLED]);
        OrderStatus::create(['name' => 'Одобрен Банком', 'forte_market_order_status_id' => ForteMarketOrderStatus::ACCEPTED]);
        OrderStatus::create(['name' => 'Отказано Банком', 'forte_market_order_status_id' => ForteMarketOrderStatus::CANCELLED]);
        OrderStatus::create(['name' => 'Отменен клиентом', 'forte_market_order_status_id' => ForteMarketOrderStatus::CANCELLED]);
        OrderStatus::create(['name' => 'Частично одобрен, есть долг', 'forte_market_order_status_id' => ForteMarketOrderStatus::ACCEPTED]);
    }
}
