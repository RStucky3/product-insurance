<?php

namespace App\controllers;

use App\interfaces\InsuranceCalculatorInterface;
use App\Interfaces\ProductRepositoryInterface;
use App\interfaces\ProductTypeRepositoryInterface;
use App\Utils\HttpStatus;

class ProductInsuranceController
{
    private ProductRepositoryInterface $productRepository;
    private ProductTypeRepositoryInterface $productTypeRepository;
    private InsuranceCalculatorInterface $insuranceCalculator;

    public function __construct(
        ProductRepositoryInterface $productRepository,
        ProductTypeRepositoryInterface $productTypeRepository,
        InsuranceCalculatorInterface $insuranceCalculator
    )
    {
        $this->productRepository = $productRepository;
        $this->productTypeRepository = $productTypeRepository;
        $this->insuranceCalculator = $insuranceCalculator;
    }

    public function getProductInsurance($productId): int
    {
        $product = $this->productRepository->getProductById($productId);

        if (!$product) {
            echo 'Product not found';

            return HttpStatus::NOT_FOUND;
        }

        $productType = $this->productTypeRepository->getProductTypeById($product->productTypeId);

        if (!$productType) {
            echo 'Product type not found';

            return HttpStatus::INTERNAL_SERVER_ERROR;
        }

        if ($productType->canBeInsured === false) {
            echo 'Product can not be insured';

            return HttpStatus::ACCEPTED;
        }

        // Get the product sales price
        $productSalesPrice = $product->salesPrice;

        // Get the insurance information
        $insurancePrice = $this->insuranceCalculator->calculateInsuranceCost($productSalesPrice, $productType->id);

        // If insurance price is 0 no insurance is needed
        // If the controller sends -1 back the product can not be insured
        if ($insurancePrice === 0) {
            echo 'Product does not need to be insured due to low sales price';
        }
        else {
            echo 'The cost of the insurance is ' . $insurancePrice . '.-';
        }

        return HttpStatus::ACCEPTED;
    }
}