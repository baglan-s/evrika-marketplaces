<?php


namespace App\Helpers;
use App\Interfaces\CreatioDataAdapter;
use App\Models\PickupPoint;


class ForteMarketDataHelper implements CreatioDataAdapter
{
    public function processDataForCreatio(array $data) : array
    {
        return [
            'code' => 0,
            'message' => 'ForteMarket Test',
            'data' => [
                'roistat' => '',
                'cartAmount' => $data['common_price'] ?? 0,
                'orderNumber' => $data['uid'] ?? '',
                'creditCode' => $data['pay_types_code'] ?? '',
                'creditCodeId' => isset($data['pay_types']) && $data['pay_types'] === 'FORTE_EXPRESS' ? 3 : 2,
                'counterparty_bank_in_1c' => '760010181',
                'deliveryType' => isset($data['delivery_types']) && $data['delivery_types'] == 'pickup' ? 'Самовывоз' : 'Доставка',
                'deliveryTypeId' => isset($data['delivery_types']) && $data['delivery_types'] == 'pickup' ? 1 : 2,
                'deliveryCity' => $this->getDeliveryInfo($data)['delivery_city'] ?? '',
                'deliveryAddress' => $this->getDeliveryInfo($data)['delivery_address'] ?? 0,
                'deliveryStreet' => $this->getDeliveryInfo($data)['delivery_street'] ?? 0,
                'deliveryBuilding' => $this->getDeliveryInfo($data)['delivery_building'] ?? '',
                'deliveryFlatNumber' => $this->getDeliveryInfo($data)['delivery_flat_number'] ?? 0,
                'pickupPointName' => $this->getPickupPointName($data),
                'pickupPointCode' => $this->getPickupPointCode($data['items'][0]['pickup_point'] ?? '') ?? '',
                'is_preorder' => 0,
                'payment_type' => '',
                'client' => [
                    'fio' => $data['receiver_contacts']['name'] ?? '',
                    'mobile' => $data['receiver_contacts']['mobile'] ?? '',
                    'email' => $data['receiver_contacts']['email'] ?? '',
                    'birthDate' => '',
                    'city' => $data['receiver_contacts']['city'] ?? '',
                    'childQnty' => 0,
                    'sales_summ' => 0,
                    'sales_percent' => 0,
                    'cascade' => false,
                    'promocode' => false,
                    'product_article' => ''
                ],
                'goods' => $this->getOrderProducts($data),
                'credit' => $this->getCreditInfo($data),
                'marketplace' => [
                    'market_name' => 'fortemarket',
                    'market_delivery_mode' => isset($data['delivery_types']) && $data['delivery_types'] === 'dhl' ? 'dhl' : 'evrika',
                ],
                'promocode_name' => '',
                'order_status' => 1,
                'hook_url' => 'http://marketplaces.evrika.com/api/fortemarket/orders/change-status',
                'legal_entity' => [
                    'company_name' => '',
                    'company_address' => '',
                    'bin' => '',
                    'bik' => '',
                    'iik' => '',
                ],
                'isPhysicalPerson' => true,
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
                    'sales_summ' => 0,
                    'cascade' => false,
                    'promocode' => false,
                    'product_article' => ''
                ];
            }
        }

        return $products;
    }

    public function getPickupPointCode(string $market_code)
    {
        if ($pickupPoint = PickupPoint::where('market_code', $market_code)->first()) {
            return $pickupPoint->guid;
        }

        return null;
    }

    public function getCreditInfo(array $data) : array
    {
        if (isset($data['pay_types']) && $data['pay_types'] === 'FORTE_EXPRESS') {
            return [
                'uuid' => isset($data['items'][0]) && isset($data['items'][0]['promotions']) && isset($data['items'][0]['promotions'][0]) ? $data['items'][0]['promotions'][0]['id'] : '',
                'credit_number' => '',
                'credit_cod' => $data['pay_types_code'] ?? '',
                'period' => $this->getCreditPeriod($data),
                'credit_status' => 'paid',
                'quantum' => $data['common_price'] ?? '',
                'partner' => 'fortebank',
                'contract_date' => $data['paidDate'] ?? '',
                'point_sale' => $this->getPickupPointName($data),
            ];
        }

        return [
            'uuid' => '',
            'credit_number' => '',
            'credit_cod' => '',
            'period' => '',
            'credit_status' => '',
            'quantum' => '',
            'partner' => '',
            'contract_date' => '',
            'point_sale' => '',
        ];
    }

    private function getCreditPeriod(array $data)
    {
        $periods = [
            'FORTE_EXPRESS_0_4' => 4,
            'FORTE_EXPRESS_0_6' => 6,
            'FORTE_EXPRESS_33_6' => 6,
            'FORTE_EXPRESS_0_12' => 12,
            'FORTE_EXPRESS_33_12' => 12,
            'FORTE_EXPRESS_0_24' => 24,
            'FORTE_EXPRESS_33_24' => 24,
            'FORTE_EXPRESS_35_36' => 36,
            'FORTE_EXPRESS_35_48' => 48,
        ];

        return $periods[$data['pay_types_code']] ?? '';
    }
}