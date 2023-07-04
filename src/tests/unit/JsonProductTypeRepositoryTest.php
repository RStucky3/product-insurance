<?php

use PHPUnit\Framework\TestCase;
use repositories\JsonProductTypeRepository;

require_once '../../interfaces/ProductTypeRepositoryInterface.php';
require_once '../../repositories/JsonProductTypeRepository.php';

class JsonProductTypeRepositoryTest extends TestCase
{
    private $repository;

    protected function setUp(): void
    {
        $this->repository = new JsonProductTypeRepository('../../data/productTypes.json');
    }

    public function testShouldGetProductTypeById(): void
    {
        $productType = $this->repository->getProductTypeById(21);
        $this->assertEquals(21, $productType->id);
        $this->assertEquals('Laptops', $productType->name);
        $this->assertTrue($productType->canBeInsured);
    }

    public function testShouldReturnNullWhenNotExistingProductTypeIdIsGiven(): void
    {
        $productType = $this->repository->getProductTypeById(9999);
        $this->assertNull($productType);
    }
}