<?php

namespace controllers;

use InsuranceCalculatorInterface;
use ProductRepositoryInterface;

class ProductController
{
    private $productRepository;
    private $insuranceCalculator;

    public function __construct(
        ProductRepositoryInterface $productRepository,
        InsuranceCalculatorInterface $insuranceCalculator
    )
    {
        $this->productRepository = $productRepository;
        $this->insuranceCalculator = $insuranceCalculator;
    }

    public function getProductById($productId)
    {
        // Call the repository method to retrieve the product information
        // Return the product information
        return $this->productRepository->getProductById($productId);
    }

    public function getProductInsurance($product, $productType): int
    {
        // Check if the product can be insured
        if ($productType->canBeInsured === false) {
            return -1;
        }

        // Get the product sales price
        $productSalesPrice = $product->salesPrice;

        // Get the insurance information
        $insurancePrice = $this->insuranceCalculator->calculateInsuranceCost($productSalesPrice);

        $laptopProductTypeId = 21;
        $smartphoneProductTypeId = 32;

        // If product Type is Laptops (21) or if the product type is Smartphones (32) 500,- insurance is added.
        if ($productType->id === $laptopProductTypeId || $productType->id === $smartphoneProductTypeId) {
            $insurancePrice+= 500;
        }

        // Return the insurance information
        return $insurancePrice;
    }
}