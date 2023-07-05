<?php

namespace tests\unit;

use App\calculators\InsuranceCalculator;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../../vendor/autoload.php';

class InsuranceCalculatorTest extends TestCase
{
    private InsuranceCalculator $calculator;

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