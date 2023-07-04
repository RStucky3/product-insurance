<?php

use controllers\ProductTypeController;
use PHPUnit\Framework\TestCase;

require_once '../../interfaces/ProductTypeRepositoryInterface.php';
require_once '../../controllers/ProductTypeController.php';
class ProductTypeControllerTest extends TestCase
{
    private $productTypeRepository;
    private $productTypeController;

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