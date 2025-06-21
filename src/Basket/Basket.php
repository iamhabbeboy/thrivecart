<?php

namespace App\Basket;

use App\Catalogue\CatalogueInterface;
use App\Delivery\DeliveryChargeInterface;
use App\Offer\OfferInterface;
use App\Product\BasketItem;

class Basket
{
    /**
     * @var BasketItem[]
     */
    public array $items = [];

    /**
     * @param CatalogueInterface $catalogue
     * @param DeliveryChargeInterface $delivery
     * @param OfferInterface[] $offers
     */
    public function __construct(
        private CatalogueInterface      $catalogue,
        private DeliveryChargeInterface $delivery,
        private array                   $offers = []
    )
    {
    }

    public function add(string $productCode): void
    {
        $product = $this->catalogue->getProduct($productCode);
        $this->items[] = new BasketItem($product);
    }

    public function total(): float
    {
        $discount = array_reduce($this->offers, fn($sum, $offer) => 0 + $offer->apply($this->items), 0);

        $subtotal = array_reduce($this->items, fn($sum, $item) => $sum + $item->product->price, 0);

        $total = $subtotal - $discount;
        $delivery = $this->delivery->calculate($total);

        return (float)(bcdiv((string)($total + $delivery), '1', 2));
    }
}
