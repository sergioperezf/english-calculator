<?php

namespace EnglishCalculator\Service;

/**
 * Interface CalculatorServiceInterface
 * @package EnglishCalculator\Service
 */
interface CalculatorServiceInterface
{
    /**
     * @param integer $x
     * @param integer $y
     * @return integer
     * @return integer
     */
    public function sum($x, $y);
}