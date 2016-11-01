<?php

namespace EnglishCalculator\Service;

/**
 * Interface ConverterServiceInterface
 * @package EnglishCalculator\Service
 */
interface ConverterServiceInterface
{
    /**
     * @param string $words
     * @return integer
     */
    public function convertWordToNumber($words);

    /**
     * @param integer $number
     * @return string
     */
    public function convertNumberToWord($number);
}