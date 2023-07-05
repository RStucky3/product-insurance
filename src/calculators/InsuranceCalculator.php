<?php

namespace App\calculators;

use App\interfaces\InsuranceCalculatorInterface;

class InsuranceCalculator implements InsuranceCalculatorInterface
{
    public function calculateInsuranceCost(int $productSalesPrice, int $productTypeId): int
    {
        $insurancePrice = 0;

        $laptopProductTypeId = 21;
        $smartphoneProductTypeId = 32;

        // If product Type is Laptops (21) or if the product type is Smartphones (32) 500,- insurance is added.
        if ($productTypeId === $laptopProductTypeId || $productTypeId === $smartphoneProductTypeId) {
            $insurancePrice+= 500;
        }

        if ($productSalesPrice < 500) {
            return $insurancePrice;
        }
        else if ($productSalesPrice < 2000) {
            return $insurancePrice+=1000;
        }
        else {
            return $insurancePrice+=2000;
        }
    }
}