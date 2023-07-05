<?php

namespace App\controllers;

use App\interfaces\ProductTypeRepositoryInterface;
use App\Utils\HttpStatus;

class ProductTypeController
{
    private ProductTypeRepositoryInterface $productTypeRepository;

    public function __construct(ProductTypeRepositoryInterface $productTypeRepository)
    {
        $this->productTypeRepository = $productTypeRepository;
    }

    public function getProductTypeById($productTypeId): int
    {
        // Call the repository method to retrieve the productType information
        // Return the productType information
        $productType = $this->productTypeRepository->getProductTypeById($productTypeId);

        if ($productType) {
            // Return the response
            echo $productType->__toString();

            return HttpStatus::ACCEPTED;
        } else {
            // Handle productType not found
            echo 'Product type not found';

            return HttpStatus::NOT_FOUND;
        }
    }
}