<?php

namespace tests\unit;

use App\calculators\InsuranceCalculator;
use PHPUnit\Framework\TestCase;

class InsuranceCalculatorTest extends TestCase
{
    private InsuranceCalculator $calculator;

    protected function setUp(): void
    {
        $this->calculator = new InsuranceCalculator();
    }

    public function testShouldAdd500ToInsuranceCostWhenProductTypeIs21()
    {
        $this->assertEquals(1500, $this->calculator->calculateInsuranceCost(699, 21));
    }

    public function testCalculateInsuranceCost()
    {
        $this->assertEquals(0, $this->calculator->calculateInsuranceCost(100, 1));
        $this->assertEquals(1000, $this->calculator->calculateInsuranceCost(1500, 1));
        $this->assertEquals(2000, $this->calculator->calculateInsuranceCost(2500, 1));
    }
}