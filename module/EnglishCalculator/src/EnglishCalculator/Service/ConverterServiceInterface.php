<?php

namespace EnglishCalculator\Service;

/**
 * Interface ConverterServiceInterface
 * @package EnglishCalculator\Service
 */
interface ConverterServiceInterface
{
    /**
     * @param string $word
     * @return integer
     */
    public function convertWordToNumber($word);

    /**
     * @param integer $number
     * @return string
     */
    public function convertNumberToWord($number);
}