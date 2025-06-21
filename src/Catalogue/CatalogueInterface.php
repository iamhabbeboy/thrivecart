<?php

namespace App\Catalogue;

use App\Product\Product;

interface CatalogueInterface
{
    public function getProduct(string $code): Product;
}
