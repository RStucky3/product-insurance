<?php

namespace tests\unit;

use App\controllers\ProductTypeController;
use App\interfaces\ProductTypeRepositoryInterface;
use App\Utils\HttpStatus;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../../vendor/autoload.php';

class ProductTypeControllerTest extends TestCase
{
    private ProductTypeRepositoryInterface $productTypeRepositoryMock;

    protected function setUp(): void
    {
        $this->productTypeRepositoryMock = $this->createMock(ProductTypeRepositoryInterface::class);
        $this->productTypeController = new ProductTypeController(
            $this->productTypeRepositoryMock);
    }

    public function testShouldReturnStatusCodeNotFoundWhenProductTypeIsNotFound(): void
    {
        $this->productTypeRepositoryMock->method('getProductTypeById')->willReturn(null);
        $productTypeId = 123;

        $result = $this->productTypeController->getProductTypeById($productTypeId);

        $this->assertEquals(HttpStatus::NOT_FOUND, $result);
    }

    public function testShouldReturnStatusCodeAcceptedWhenProductTypeIsFound(): void
    {
        $productTypeId = 123;

        $productType = [
            'id' => $productTypeId,
            'name' => 'Test Product Type',
            'canBeInsured' => true,
        ];

        $this->productTypeRepositoryMock->method('getProductTypeById')->willReturn($productType);

        $result = $this->productTypeController->getProductTypeById($productTypeId);

        $this->assertEquals(HttpStatus::ACCEPTED, $result);
    }
}