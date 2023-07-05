<?php

namespace App\calculators;

use App\interfaces\InsuranceCalculatorInterface;

class InsuranceCalculator implements InsuranceCalculatorInterface
{
    public function calculateInsuranceCost(int $productSalesPrice): int
    {
        if ($productSalesPrice < 500) {
            return 0;
        }
        else if ($productSalesPrice < 2000) {
            return 1000;
        }
        else {
            return 2000;
        }
    }
}