<?php

namespace App\Catalogue;

use App\Product\Product;
use InvalidArgumentException;

class Catalogue implements CatalogueInterface
{
    /**
     * @var array<string, Product>
     */
    private array $products = [];

    public function __construct()
    {
        $this->products = [
            'R01' => new Product('R01', 'Red Widget', 32.95),
            'G01' => new Product('G01', 'Green Widget', 24.95),
            'B01' => new Product('B01', 'Blue Widget', 7.95),
        ];
    }

    public function getProduct(string $code): Product
    {
        if (!isset($this->products[$code])) {
            throw new InvalidArgumentException("Product code $code not found.");
        }
        return $this->products[$code];
    }
}
