<?php
namespace App\Delivery;

interface DeliveryChargeInterface
{
 public function calculate(float $subtotal): float;
}
