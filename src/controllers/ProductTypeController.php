<?php

namespace controllers;

use ProductTypeRepositoryInterface;

class ProductTypeController
{
    private $productTypeRepository;

    public function __construct(ProductTypeRepositoryInterface $productTypeRepository)
    {
        $this->productTypeRepository = $productTypeRepository;
    }

    public function getProductTypeById($productTypeId)
    {
        // Call the repository method to retrieve the product information
        // Return the productType information
        return $this->productTypeRepository->getProductTypeById($productTypeId);
    }
}