<?php


namespace App\Interfaces;


interface MarketService
{
    public function getOrders(array $filter = []) : array;

    public function getOrder($order_id) : array;
}