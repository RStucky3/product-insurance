<?php

namespace tests\unit;

use App\Repositories\JsonProductRepository;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../../vendor/autoload.php';

class JsonProductRepositoryTest extends TestCase
{
    private JsonProductRepository $repository;

    protected function setUp(): void
    {
        $this->repository = new JsonProductRepository('../../../data/products.json');
    }

    public function testShouldGetProductById(): void
    {
        $product = $this->repository->getProductById(572770);
        $this->assertEquals(572770, $product->getId());
        $this->assertEquals('Samsung WW80J6400CW EcoBubble', $product->getName());
        $this->assertEquals(475, $product->getSalesPrice());
        $this->assertEquals(124, $product->getProductTypeId());
    }

    public function testShouldReturnNullWhenNotExistingProductTypeIdIsGiven(): void
    {
        $product = $this->repository->getProductById(9999);
        $this->assertNull($product);
    }
}