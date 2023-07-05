<?php

namespace tests\unit;

use App\controllers\ProductController;
use App\interfaces\InsuranceCalculatorInterface;
use App\Interfaces\ProductRepositoryInterface;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../../vendor/autoload.php';

class ProductControllerTest extends TestCase
{
    private ProductRepositoryInterface $productRepository;
    private ProductController $productController;

    protected function setUp(): void
    {
        $this->productRepository = $this->createMock(ProductRepositoryInterface::class);
        $insuranceCalculator = $this->createMock(InsuranceCalculatorInterface::class);
        $this->productController = new ProductController($this->productRepository, $insuranceCalculator);
    }

    public function testShouldReturnTheGivenProductBasedOnProductTypeId(): void
    {
        $productId = 123;
        $product = [
            'id' => $productId,
            'name' => 'Test Product',
            'salesPrice' => 100,
            'productTypeId' => 456
        ];

        $this->productRepository->expects($this->once())
            ->method('getProductById')
            ->with($productId)
            ->willReturn($product);

        $result = $this->productController->getProductById($productId);

        $this->assertEquals($product, $result);
    }

    public function testShouldReturnInsuranceCost(): void
    {
        $product = (object)[
            'id' => 123,
            'name' => 'Test Product',
            'salesPrice' => 100,
            'productTypeId' => 456
        ];

        $productType = (object)[
            'id' => 1,
            'name' => 'Laptops',
            'canBeInsured' => true
        ];

        $result = $this->productController->getProductInsurance($product, $productType);

        $this->assertEquals(0, $result);
    }

    public function testShouldReturn500WhenSmartphoneProductTypeIdIsGiven(): void
    {
        $product = (object)[
            'id' => 123,
            'name' => 'Test Product',
            'salesPrice' => 700,
            'productTypeId' => 456
        ];

        $productType = (object)[
            'id' => 32,
            'name' => 'smartphones',
            'canBeInsured' => true
        ];

        $result = $this->productController->getProductInsurance($product, $productType);

        $this->assertEquals(500, $result);
    }
}