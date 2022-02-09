<?php

namespace App\Console;

use App\Helpers\ForteMarketDataHelper;
use App\Services\CreatioService;
use App\Services\MarketPlaces\ForteMarketService;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();

        $schedule->call(function () {
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
        })->hourly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
