<?php

use PHPUnit\Framework\TestCase;
use App\Delivery\DeliveryCharge;

class DeliveryChargeTest extends TestCase
{
    public function testDeliveryChargeWhenSubtotalBelowFirstThreshold(): void
    {
        $tiers = [
            ['threshold' => 50.0, 'cost' => 4.95],
            ['threshold' => 90.0, 'cost' => 2.95],
        ];
        $delivery = new DeliveryCharge($tiers);

        $this->assertSame(4.95, $delivery->calculate(30.0));  // @phpstan-ignore-line
    }

    public function testDeliveryChargeWhenSubtotalBetweenThresholds(): void
    {
        $tiers = [
            ['threshold' => 50.0, 'cost' => 4.95],
            ['threshold' => 90.0, 'cost' => 2.95],
        ];
        $delivery = new DeliveryCharge($tiers);

        $this->assertSame(2.95, $delivery->calculate(60.0));  // @phpstan-ignore-line
    }

    public function testDeliveryChargeWhenSubtotalAboveAllThresholds(): void
    {
        $tiers = [
            ['threshold' => 50.0, 'cost' => 4.95],
            ['threshold' => 90.0, 'cost' => 2.95],
        ];
        $delivery = new DeliveryCharge($tiers);

        $this->assertSame(0.0, $delivery->calculate(100.0)); // @phpstan-ignore-line
    }

    public function testDeliveryChargeWithUnsortedTiers(): void
    {
        $tiers = [
            ['threshold' => 90.0, 'cost' => 2.95],
            ['threshold' => 50.0, 'cost' => 4.95],
        ];
        $delivery = new DeliveryCharge($tiers);

        $this->assertSame(4.95, $delivery->calculate(40.0)); // @phpstan-ignore-line
        $this->assertSame(2.95, $delivery->calculate(70.0));// @phpstan-ignore-line
        $this->assertSame(0.0, $delivery->calculate(100.0)); // @phpstan-ignore-line
    }
}
