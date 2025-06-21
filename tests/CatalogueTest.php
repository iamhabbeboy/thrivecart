<?php

use PHPUnit\Framework\TestCase;
use App\Catalogue\Catalogue;
use App\Product\Product;
use InvalidArgumentException;

class CatalogueTest extends TestCase
{
    private Catalogue $catalogue;

    protected function setUp(): void
    {
        $this->catalogue = new Catalogue();
    }

    public function testGetProductReturnsValidProduct(): void
    {
        $product = $this->catalogue->getProduct('R01');

        $this->assertInstanceOf(Product::class, $product); // @phpstan-ignore-line
        $this->assertSame('R01', $product->code); // @phpstan-ignore-line
        $this->assertSame('Red Widget', $product->name); // @phpstan-ignore-line
        $this->assertSame(32.95, $product->price); // @phpstan-ignore-line
    }

    public function testGetProductThrowsExceptionForInvalidCode(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Product code X99 not found.');
        $this->catalogue->getProduct('X99');
    }
}
