<?php


namespace App\Helpers;
use App\Interfaces\CreatioDataAdapter;


class TestDataHelper implements CreatioDataAdapter
{
    public function processDataForCreatio(array $data) : array
    {
        return [
            'code' => 0,
            'message' => 'Test Test',
            'data' => [
                'riostat' => '',
                'cartAmount' => 61980,
                'orderNumber' => 500612,
                'creditCode' => 'test_express',
                'creditCodeId' => 'credit',
                'counterparty_bank_in_1c' => '',
                'deliveryType' =>  'Самовывоз',
                'deliveryTypeId' => 2,
                'deliveryCity' => 'Шымкент',
                'deliveryAddress' => 0,
                'deliveryStreet' => 0,
                'deliveryBuilding' => '',
                'deliveryFlatNumber' => 0,
                'pickupPointName' => 'Жангельдина 18',
                'pickupPointCode' => '',
                'is_preorder' => 0,
                'payment_type' => '',
                'client' => [
                    'fio' => 'Магжан Юнусов',
                    'mobile' => '87024441411',
                    'email' => 'magzhanyunusov@mail.com',
                    'birthDate' => '',
                    'city' => 'Шымкент',
                    'childQnty' => 0,
                ],
                'goods' => [
                    [
                        'price' => 25990,
                        'name' => 'Пылесос Dauscher BVC-4600',
                        'group' => '',
                        'brand' => 'Dauscher',
                        'article' => 76000004728,
                        'isService' => false,
                        'quantity' => 2,
                    ]
                ],
            ]
        ];
    }

    public function getDeliveryInfo(array $data) : array
    {
        $delivery_info = [];

        if (isset($data['delivery_types']) && $data['delivery_types'] !== 'pickup') {
            $delivery_info['delivery_city'] = $data['receiver_contacts']['city'] ?? '';
            $delivery_info['delivery_address'] = $data['receiver_contacts']['address'] ?? 0;
            $delivery_info['delivery_street'] = $data['receiver_contacts']['address'] ?? 0;
            $delivery_info['delivery_building'] = $data['receiver_contacts']['house_number'] ?? '';
            $delivery_info['delivery_flat_number'] = $data['receiver_contacts']['flat_number'] ?? 0;
        }

        return $delivery_info;
    }

    public function getPickupPointName(array $data) : string
    {
        $pickupCity = $data['items'][0]['pickup_address']['regionId'] ?? '';
        $pickupStreet = $data['items'][0]['pickup_address']['street'] ?? '';
        $pickupStreetNumber = $data['items'][0]['pickup_address']['streetNum'] ?? '';

        return "$pickupCity $pickupStreet $pickupStreetNumber";
    }

    public function getOrderProducts(array $data) : array
    {
        $products = [];

        if (isset($data['items']) && !empty($data['items'])) {
            foreach ($data['items'] as $item) {
                $products[] = [
                    'price' => $item['price'],
                    'name' => $item['name'],
                    'group' => '',
                    'brand' => $item['vendor'],
                    'article' => $item['articul'],
                    'isService' => false,
                    'quantity' => $item['amount'],
                ];
            }
        }

        return $products;
    }
}