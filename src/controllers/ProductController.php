<?php

namespace App\controllers;

use App\interfaces\InsuranceCalculatorInterface;
use App\Interfaces\ProductRepositoryInterface;
use App\Utils\HttpStatus;

class ProductController
{
    private ProductRepositoryInterface $productRepository;

    public function __construct(
        ProductRepositoryInterface $productRepository,
    )
    {
        $this->productRepository = $productRepository;
    }

    public function getProductById($productId): int
    {
        // Call the repository method to retrieve the product information
        // Return the product information
        $product = $this->productRepository->getProductById($productId);

        if ($product) {
            // Return the response
            echo $product->__toString();

            return HttpStatus::ACCEPTED;
        } else {
            // Handle product not found
            echo 'Product not found';

            return HttpStatus::NOT_FOUND;
        }
    }
}