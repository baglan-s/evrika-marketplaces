<?php


namespace App\Interfaces;


interface CreatioDataAdapter
{
    public function processDataForCreatio(array $data) : array;
}