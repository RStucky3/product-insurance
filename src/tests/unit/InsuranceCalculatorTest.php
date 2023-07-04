<?php

use calculators\InsuranceCalculator;
use PHPUnit\Framework\TestCase;

require_once '..\..\interfaces\InsuranceCalculatorInterface.php';
require_once '..\..\calculators\InsuranceCalculator.php';

class InsuranceCalculatorTest extends TestCase
{
    private $calculator;

    protected function setUp(): void
    {
        $this->calculator = new InsuranceCalculator();
    }

    public function testCalculateInsuranceCost()
    {
        $this->assertEquals(0, $this->calculator->calculateInsuranceCost(100));
        $this->assertEquals(1000, $this->calculator->calculateInsuranceCost(1500));
        $this->assertEquals(2000, $this->calculator->calculateInsuranceCost(2500));
    }
}