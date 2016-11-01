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
        $this->assertEquals(203, $this->converterService->convertWordToNumber('two hundred and three'));
        $this->assertEquals(25, $this->converterService->convertWordToNumber('twenty five'));
        $this->assertEquals(112, $this->converterService->convertWordToNumber('one hundred and twelve'));
        $this->assertEquals(36000048, $this->converterService->convertWordToNumber('thirty six million and forty eight'));
        $this->assertEquals(347116, $this->converterService->convertWordToNumber('three hundred and forty seven thousand one hundred and sixteen'));
        $this->assertEquals(25000000, $this->converterService->convertWordToNumber('twenty five million'));
        $this->assertEquals(42, $this->converterService->convertWordToNumber('forty two'));
        $this->assertEquals(400002000, $this->converterService->convertWordToNumber('four hundred million two thousand'));
        $this->assertEquals(400000002, $this->converterService->convertWordToNumber('four hundred million two'));
    }

    public function testConvertNumberToWord()
    {
        $this->assertEquals('four hundred', $this->converterService->convertNumberToWord(400));
        $this->assertEquals('zero', $this->converterService->convertNumberToWord(0));
        $this->assertEquals('one million six hundred and thirty seven thousand two hundred and fifteen', $this->converterService->convertNumberToWord(1637215));
        $this->assertEquals('eighteen', $this->converterService->convertNumberToWord(18));
        $this->assertEquals('forty', $this->converterService->convertNumberToWord(40));
    }

    public function testInteroperability()
    {
        $this->assertEquals(1928793, $this->converterService->convertWordToNumber($this->converterService->convertNumberToWord(1928793)));
        $this->assertEquals(2498, $this->converterService->convertWordToNumber($this->converterService->convertNumberToWord(2498)));
        $this->assertEquals(29030, $this->converterService->convertWordToNumber($this->converterService->convertNumberToWord(29030)));
        $this->assertEquals(2001, $this->converterService->convertWordToNumber($this->converterService->convertNumberToWord(2001)));
        $this->assertEquals('one hundred and five', $this->converterService->convertNumberToWord($this->converterService->convertWordToNumber('one hundred and five')));
        $this->assertEquals('two million six hundred and fifteen thousand two hundred and seventy six', $this->converterService->convertNumberToWord($this->converterService->convertWordToNumber('two million six hundred and fifteen thousand two hundred and seventy six')));
        $this->assertEquals('four thousand and two', $this->converterService->convertNumberToWord($this->converterService->convertWordToNumber('four thousand and two')));
        $this->assertEquals('zero', $this->converterService->convertNumberToWord($this->converterService->convertWordToNumber('zero')));
    }
}