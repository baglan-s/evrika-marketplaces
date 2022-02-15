<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\ForteMarketOrderStatusSeeder;
use Database\Seeders\OrderStatusSeeder;
use Database\Seeders\PickupPointSeeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            ForteMarketOrderStatusSeeder::class,
            OrderStatusSeeder::class,
            PickupPointSeeder::class,
        ]);
    }
}
