<?php

namespace tests\unit;

use App\controllers\ProductInsuranceController;
use App\interfaces\InsuranceCalculatorInterface;
use App\Interfaces\ProductRepositoryInterface;
use App\interfaces\ProductTypeRepositoryInterface;
use App\Utils\HttpStatus;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../../vendor/autoload.php';

class ProductInsuranceControllerTest extends TestCase
{
    private ProductRepositoryInterface $productRepositoryMock;
    private ProductTypeRepositoryInterface $productTypeRepositoryMock;

    protected function setUp(): void
    {
        $this->productRepositoryMock = $this->createMock(ProductRepositoryInterface::class);
        $this->productTypeRepositoryMock = $this->createMock(ProductTypeRepositoryInterface::class);
        $insuranceCalculatorMock = $this->createMock(InsuranceCalculatorInterface::class);
        $this->productInsuranceController = new ProductInsuranceController(
            $this->productRepositoryMock,
            $this->productTypeRepositoryMock,
            $insuranceCalculatorMock);
    }
    public function testShouldReturnStatusCodeBadRequestWhenProductNotFound(): void
    {
        // Configure the mock to return null for getProductById
        $this->productRepositoryMock->method('getProductById')->willReturn(null);

        // Call the method under test
        $result = $this->productInsuranceController->getProductInsurance(123);

        // Assert that the expected status code is returned
        $this->assertEquals(HttpStatus::NOT_FOUND, $result);
    }

    public function testShouldReturnStatusCodeInternalServerErrorWhenProductTypeIsNotFound(): void
    {
        // Configure the mocks to return a product, but null for getProductTypeById
        $this->productRepositoryMock->method('getProductById')->willReturn((object) ['productTypeId' => 1]);
        $this->productTypeRepositoryMock->method('getProductTypeById')->willReturn(null);

        // Call the method under test
        $result = $this->productInsuranceController->getProductInsurance(123);

        // Assert that the expected status code is returned
        $this->assertEquals(HttpStatus::INTERNAL_SERVER_ERROR, $result);
    }

    public function testShouldReturnStatusCodeAcceptedWhenTheProductCanNotBeInsured(): void
    {
        // Configure the mocks to return a product, but null for getProductTypeById
        $this->productRepositoryMock->method('getProductById')->willReturn((object) ['productTypeId' => 1]);
        $this->productTypeRepositoryMock->method('getProductTypeById')->willReturn((object) ['canBeInsured' => false]);

        // Call the method under test
        $result = $this->productInsuranceController->getProductInsurance(123);

        // Assert that the expected status code is returned
        $this->assertEquals(HttpStatus::ACCEPTED, $result);
    }

    public function testShouldReturnStatusCodeAcceptedWhenInsuranceIsCalculated(): void
    {
        // Configure the mocks to return a product, but null for getProductTypeById
        $this->productRepositoryMock->method('getProductById')->willReturn((object) ['productTypeId' => 1, 'salesPrice' => 100]);
        $this->productTypeRepositoryMock->method('getProductTypeById')->willReturn((object) ['id' => 123, 'canBeInsured' => true]);

        // Call the method under test
        $result = $this->productInsuranceController->getProductInsurance(123);

        // Assert that the expected status code is returned
        $this->assertEquals(HttpStatus::ACCEPTED, $result);
    }
}