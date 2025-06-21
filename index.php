<?php declare(strict_types=1);
require __DIR__ . '/vendor/autoload.php';

use App\Basket\Basket;
use App\Catalogue\Catalogue;
use App\Delivery\DeliveryCharge;
use App\Offer\RedWidgetOffer;

$catalogue = new Catalogue();
$delivery = new DeliveryCharge([
    ['threshold' => 50, 'cost' => 4.95],
    ['threshold' => 90, 'cost' => 2.95],
]);
$offers = [new RedWidgetOffer()];

$basket = new Basket($catalogue, $delivery, $offers);
$basket->add('R01');
$basket->add('R01');
echo $basket->total();
