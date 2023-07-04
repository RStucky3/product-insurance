<?php

use PHPUnit\Framework\TestCase;
use repositories\JsonProductRepository;

require_once '../../interfaces/ProductRepositoryInterface.php';
require_once '../../repositories/JsonProductRepository.php';

class JsonProductRepositoryTest extends TestCase
{
    private $repository;

    protected function setUp(): void
    {
        $this->repository = new JsonProductRepository('../../data/products.json');
    }

    public function testShouldGetProductById(): void
    {
        $product = $this->repository->getProductById(572770);
        $this->assertEquals(572770, $product->id);
        $this->assertEquals('Samsung WW80J6400CW EcoBubble', $product->name);
        $this->assertEquals(475, $product->salesPrice);
        $this->assertEquals(124, $product->productTypeId);
    }

    public function testShouldReturnNullWhenNotExistingProductTypeIdIsGiven(): void
    {
        $product = $this->repository->getProductById(9999);
        $this->assertNull($product);
    }
}