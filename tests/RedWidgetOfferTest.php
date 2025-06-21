<?php

use PHPUnit\Framework\TestCase;
use App\Offer\RedWidgetOffer;
use App\Product\BasketItem;
use App\Product\Product;

class RedWidgetOfferTest extends TestCase
{
    public function testApplyWithOneRedWidgetReturnsZeroDiscount(): void
    {
        $product = new Product('R01', 'Red Widget', 32.95);
        $item = new BasketItem($product);
        $offer = new RedWidgetOffer();

        $discount = $offer->apply([$item]);

        $this->assertSame(0.0, $discount);  // @phpstan-ignore-line
    }

    public function testApplyWithTwoRedWidgetsReturnsHalfPriceDiscount(): void
    {
        $product = new Product('R01', 'Red Widget', 32.95);
        $item1 = new BasketItem($product);
        $item2 = new BasketItem($product);
        $offer = new RedWidgetOffer();

        $discount = $offer->apply([$item1, $item2]);

        $this->assertSame(16.475, $discount); // @phpstan-ignore-line
    }

    public function testApplyWithNoRedWidgetsReturnsZeroDiscount(): void
    {
        $product = new Product('G01', 'Green Widget', 24.95);
        $item = new BasketItem($product);
        $offer = new RedWidgetOffer();

        $discount = $offer->apply([$item]);

        $this->assertSame(0.0, $discount); // @phpstan-ignore-line
    }

    public function testApplyWithMultipleRedWidgetsStillReturnsSingleHalfPriceDiscount(): void
    {
        $product = new Product('R01', 'Red Widget', 32.95);
        $item1 = new BasketItem($product);
        $item2 = new BasketItem($product);
        $item3 = new BasketItem($product);
        $offer = new RedWidgetOffer();

        $discount = $offer->apply([$item1, $item2, $item3]);

        $this->assertSame(16.475, $discount); // @phpstan-ignore-line
    }
}
