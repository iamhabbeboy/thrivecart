<?php

namespace App\Offer;

use App\Offer\OfferInterface;
use App\Product\BasketItem;
use App\Product\Product;

class RedWidgetOffer implements OfferInterface
{
    /**
     * @param BasketItem[] $items
     */
    public function apply(array $items): float
    {
        $widgets = array_filter($items, fn($item) => $item->product->code === 'R01');

        $count = count($widgets);
        $discount = 0.0;

        $matched = current($widgets);
        if ($count > 1 && $matched instanceof BasketItem) {
            $discount = ($matched->product->price) / 2; // 50% off second item
        }

        return $discount;
    }
}
