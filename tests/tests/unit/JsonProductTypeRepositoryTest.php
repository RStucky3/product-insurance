<?php

namespace tests\unit;

use App\Repositories\JsonProductTypeRepository;
use PHPUnit\Framework\TestCase;

class JsonProductTypeRepositoryTest extends TestCase
{
    private JsonProductTypeRepository $repository;

    protected function setUp(): void
    {
        $this->repository = new JsonProductTypeRepository('../../../data/productTypes.json');
    }

    public function testShouldGetProductTypeById(): void
    {
        $productType = $this->repository->getProductTypeById(21);
        $this->assertEquals(21, $productType->getId());
        $this->assertEquals('Laptops', $productType->getName());
        $this->assertTrue($productType->getCanBeInsured());
    }

    public function testShouldReturnNullWhenNotExistingProductTypeIdIsGiven(): void
    {
        $productType = $this->repository->getProductTypeById(9999);
        $this->assertNull($productType);
    }
}