<?php

namespace EnglishCalculatorTest\Service;
use PHPUnit\Framework\TestCase;
use EnglishCalculator\Service\ConverterService;

/**
 * Class ConverterServiceTest
 * @package EnglishCalculatorTest\Service
 */
class ConverterServiceTest extends TestCase
{
    /**
     * @var ConverterService
     */
    private $converterService;

    public function setUp()
    {
        $this->converterService = new ConverterService();
    }

    public function testConvertWordToNumber()
    {
        $this->assertEquals(2, $this->converterService->convertWordToNumber('two'));
        $this->assertEquals(20, $this->converterService->convertWordToNumber('twenty'));
        $this->assertEquals(203, $this->converterService->convertWordToNumber('two hundred three'));
        $this->assertEquals(25, $this->converterService->convertWordToNumber('twenty five'));
        $this->assertEquals(0, $this->converterService->convertWordToNumber('zero'));
    }

    public function testConvertNumberToWord()
    {
        $this->assertEquals('four hundred', $this->converterService->convertWordToNumber(400));
        $this->assertEquals('zero', $this->converterService->convertWordToNumber(0));
        $this->assertEquals('one million six hundred thirty seven thousand two hundred fifteen', $this->converterService->convertWordToNumber(1637215));
        $this->assertEquals('eighteen', $this->converterService->convertWordToNumber(18));
        $this->assertEquals('forty', $this->converterService->convertWordToNumber(40));

    }
}