<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PickupPoint;

class PickupPointSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            "8578fdfd-c438-11eb-80cc-bc97e145c062" => "PP1",
            "9397f229-c438-11eb-80cc-bc97e145c062" => "PP10",
            "a15055fd-c438-11eb-80cc-bc97e145c062" => "PP11",
            "b4092525-c438-11eb-80cc-bc97e145c062" => "PP2",
            "c132702f-c438-11eb-80cc-bc97e145c062" => "PP25",
            "e7fd82d3-c438-11eb-80cc-bc97e145c062" => "PP28",
            "03b3dea7-c439-11eb-80cc-bc97e145c062" => "PP3",
            "0e7a6c31-c820-11eb-80cd-bc97e145c062" => "PP32",
            "8d01cc68-c820-11eb-80cd-bc97e145c062" => "PP34",
            "1113e228-c439-11eb-80cc-bc97e145c062" => "PP4",
            "25d90084-c439-11eb-80cc-bc97e145c062" => "PP5",
            "37215747-c439-11eb-80cc-bc97e145c062" => "PP6",
            "46fc476a-c439-11eb-80cc-bc97e145c062" => "PP7",
            "58b19480-c439-11eb-80cc-bc97e145c062" => "PP8",
            "68351c90-c439-11eb-80cc-bc97e145c062" => "PP9",
        ];

        foreach ($data as $key => $value) {
            PickupPoint::create([
                'market_code' => $value,
                'guid' => $key,
            ]);
        }
    }
}
