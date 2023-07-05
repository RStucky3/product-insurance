<?php

namespace tests\unit;

use App\controllers\ProductController;
use App\Interfaces\ProductRepositoryInterface;
use App\Utils\HttpStatus;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../../vendor/autoload.php';

class ProductControllerTest extends TestCase
{
    private ProductRepositoryInterface $productRepositoryMock;

    protected function setUp(): void
    {
        $this->productRepositoryMock = $this->createMock(ProductRepositoryInterface::class);
        $this->productController = new ProductController(
            $this->productRepositoryMock);
    }

    public function testShouldReturnStatusCodeNotFoundWhenProductIsNotFound(): void
    {
        $this->productRepositoryMock->method('getProductById')->willReturn(null);
        $productId = 123;

        $result = $this->productController->getProductById($productId);

        $this->assertEquals(HttpStatus::NOT_FOUND, $result);
    }

    public function testShouldReturnStatusCodeAcceptedWhenProductIsFound(): void
    {
        $productId = 123;

        $product = [
            'id' => $productId,
            'name' => 'Test Product',
            'salesPrice' => 100,
            'productTypeId' => 456
        ];

        $this->productRepositoryMock->method('getProductById')->willReturn($product);

        $result = $this->productController->getProductById($productId);

        $this->assertEquals(HttpStatus::ACCEPTED, $result);
    }
}