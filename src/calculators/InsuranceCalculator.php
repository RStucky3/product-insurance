<?php

namespace calculators;

use InsuranceCalculatorInterface;

class InsuranceCalculator implements InsuranceCalculatorInterface
{
    public function calculateInsuranceCost($productSalesPrice) {
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