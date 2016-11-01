<?php

namespace EnglishCalculator\Service;

/**
 * Class CalculatorService
 * @package EnglishCalculator\Service
 */
class CalculatorService implements CalculatorServiceInterface
{

    /**
     * @param integer $x
     * @param integer $y
     * @return integer
     * @return integer
     */
    public function sum($x, $y)
    {
        return $x + $y;
    }
}