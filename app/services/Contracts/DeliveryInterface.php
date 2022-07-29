<?php

namespace App\services\Contracts;

interface DeliveryInterface
{
    public function setDeliveryCost($zipcode): float;
}
