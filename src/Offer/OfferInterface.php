<?php
namespace App\Offer;

use App\Product\BasketItem;

interface OfferInterface
{
    /**
     * @param BasketItem[] $items
     * @return float
     */
 public function apply(array $items): float;
}
