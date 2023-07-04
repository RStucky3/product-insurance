<?php

namespace controllers;

use ProductRepositoryInterface;

class ProductController
{
    private $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getProductById($productId)
    {
        // Call the repository method to retrieve the product information
        // Return the product information
        return $this->productRepository->getProductById($productId);
    }
}