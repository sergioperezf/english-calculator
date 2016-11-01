<?php

namespace EnglishCalculatorTest\Service;

use EnglishCalculator\Service\CalculatorService;
use EnglishCalculator\Exception\InvalidArgumentException;
use PHPUnit\Framework\TestCase;

/**
 * Class CalculatorServiceTest
 * @package EnglishCalculatorTest\Service
 */
class CalculatorServiceTest extends TestCase
{
    /**
     * @var CalculatorService
     */
    private $calculatorService;

    public function setUp()
    {
        $this->calculatorService = new CalculatorService();
    }

    public function testSum()
    {
        $this->assertEquals(8, $this->calculatorService->sum(5, 3));
        $this->assertEquals(0, $this->calculatorService->sum(0, 0));
        $this->assertEquals(-8, $this->calculatorService->sum(10, -18));
        $this->assertEquals(-54, $this->calculatorService->sum(-50, -4));
    }

    public function testOnlyNumbersFirstNull()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->calculatorService->sum(null, 2);
    }

    public function testOnlyNumbersSecondNull()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->calculatorService->sum(5, null);
    }

    public function testOnlyNumbersBothNull()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->calculatorService->sum(null, null);
    }

    public function testOnlyNumbersFirstString()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->calculatorService->sum('Not a number', 2);
    }

    public function testOnlyNumbersSecondString()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->calculatorService->sum(2, '8');
    }

    public function testOnlyNumbersBothString()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->calculatorService->sum('4', '5');
    }
}