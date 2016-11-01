<?php

namespace EnglishCalculator\Service;
use EnglishCalculator\Exception\InvalidArgumentException;

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
        if (!is_int($x) || !is_int($y)) {
            throw new InvalidArgumentException('Arguments must be integers');
        }
        return $x + $y;
    }
}