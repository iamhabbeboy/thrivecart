<?php

use App\Basket\Basket;
use App\Catalogue\Catalogue;
use App\Delivery\DeliveryCharge;
use App\Offer\RedWidgetOffer;
use PHPUnit\Framework\TestCase;

class BasketTest extends TestCase
{
    private Basket $basket;

    protected function setUp(): void
    {
        $catalogue = new Catalogue();
        $delivery = new DeliveryCharge([
            ['threshold' => 50, 'cost' => 4.95],
            ['threshold' => 90, 'cost' => 2.95],
        ]);
        $offers = [new RedWidgetOffer()];

        $this->basket = new Basket($catalogue, $delivery, $offers);
    }

    public function testTotalWithBlueAndGreenWidget(): void
    {
        $this->basket->add('B01');
        $this->basket->add('G01');

        /** @phpstan-ignore-next-line */
        $this->assertEquals(37.85, $this->basket->total());
    }

    public function testTotalWithTwoRedWidgets(): void
    {
        $this->basket->add('R01');
        $this->basket->add('R01');

        /** @phpstan-ignore-next-line */
        $this->assertEquals(54.37, $this->basket->total());
    }

    public function testTotalWithRedAndGreenWidget(): void
    {
        $this->basket->add('R01');
        $this->basket->add('G01');

        /** @phpstan-ignore-next-line */
        $this->assertEquals(60.85, $this->basket->total());
    }

    public function testTotalWithMultipleItems(): void
    {
        $this->basket->add('B01');
        $this->basket->add('B01');
        $this->basket->add('R01');
        $this->basket->add('R01');
        $this->basket->add('R01');

        /** @phpstan-ignore-next-line */
        $this->assertEquals(98.27, $this->basket->total());
    }

    public function testInvalidProductThrowsError(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->basket->add('INVALID');
    }
}
