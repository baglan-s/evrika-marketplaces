<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ForteMarketOrderStatus;

class ForteMarketOrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'accepted',
            'giveAway',
            'cancelled',
        ];

        foreach ($data as $datum) {
            ForteMarketOrderStatus::create(['name' => $datum]);
        }
    }
}
