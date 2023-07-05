<?php

namespace App\interfaces;

interface InsuranceCalculatorInterface
{
    public function calculateInsuranceCost(int $productSalesPrice): int;
}