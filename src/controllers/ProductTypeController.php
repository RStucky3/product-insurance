<?php

namespace App\controllers;

use App\interfaces\ProductTypeRepositoryInterface;

class ProductTypeController
{
    private ProductTypeRepositoryInterface $productTypeRepository;

    public function __construct(ProductTypeRepositoryInterface $productTypeRepository)
    {
        $this->productTypeRepository = $productTypeRepository;
    }

    public function getProductTypeById($productTypeId)
    {
        // Call the repository method to retrieve the productType information
        // Return the productType information
        return $this->productTypeRepository->getProductTypeById($productTypeId);
    }
}