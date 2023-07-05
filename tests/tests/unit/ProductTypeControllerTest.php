<?php

namespace tests\unit;

use App\controllers\ProductTypeController;
use App\interfaces\ProductTypeRepositoryInterface;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../../vendor/autoload.php';

class ProductTypeControllerTest extends TestCase
{
    private ProductTypeRepositoryInterface $productTypeRepository;
    private ProductTypeController $productTypeController;

    protected function setUp(): void
    {
        $this->productTypeRepository = $this->createMock(ProductTypeRepositoryInterface::class);
        $this->productTypeController = new ProductTypeController($this->productTypeRepository);
    }

    public function testShouldReturnTheGivenProductType(): void
    {
        $productTypeId = 123;
        $productType = [
            'id' => $productTypeId,
            'name' => 'Test Product Type',
            'canBeInsured' => true,
        ];

        $this->productTypeRepository->expects($this->once())
            ->method('getProductTypeById')
            ->with($productTypeId)
            ->willReturn($productType);

        $result = $this->productTypeController->getProductTypeById($productTypeId);

        $this->assertEquals($productType, $result);
    }
}