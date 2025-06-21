<?php

namespace App\Delivery;

use App\Delivery\DeliveryChargeInterface;

class DeliveryCharge implements DeliveryChargeInterface
{
    /**
     * @var array<int, array{threshold: float, cost: float}>
     */
    private array $rules;

    /**
     * @param array<int, array{threshold: float, cost: float}> $tiers
     */
    public function __construct(array $tiers)
    {
        usort($tiers, fn($a, $b) => $a['threshold'] <=> $b['threshold']);
        $this->rules = $tiers;
    }

    public function calculate(float $subtotal): float
    {
        foreach ($this->rules as $tier) {
            ;
            if ($subtotal < $tier['threshold']) {
                return $tier['cost'];
            }
        }
        return 0.0;
    }
}
