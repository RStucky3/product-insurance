<?php

namespace tests\unit;

use App\Repositories\JsonProductTypeRepository;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../../vendor/autoload.php';

class JsonProductTypeRepositoryTest extends TestCase
{
    private JsonProductTypeRepository $repository;

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