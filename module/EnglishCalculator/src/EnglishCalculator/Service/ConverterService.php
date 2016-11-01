<?php

namespace EnglishCalculator\Service;

use EnglishCalculator\Exception\InvalidArgumentException;

/**
 * Class ConverterService
 * @package EnglishCalculator\Service
 */
class ConverterService implements ConverterServiceInterface
{

    /**
     * @param string $words
     * @return integer
     */
    public function convertWordToNumber($words)
    {
        if (!$words) {
            return 0;
        }

        $words = trim($words);
        $words .= ' ';

        $number = 0;

        $singles = ["zero", "one", "two", "three", "four", "five", "six", "seven", "eight", "nine"];
        $teens = ["ten", "eleven", "twelve", "thirteen", "fourteen", "fifteen", "sixteen", "seventeen", "eighteen", "nineteen"];
        $tens = ["", "", "twenty", "thirty", "forty", "fifty", "sixty", "seventy", "eighty", "ninety"];
        $powers = ["", "thousand", "million", "billion", "trillion", "quadrillion", "quintillion"];

        for ($i = count($powers) - 1; $i >= 0; $i--) {
            $thisPower = $powers[$i];
            if ($powers[$i]) {
                $index = strpos($words, $powers[$i]);

                if ($index !== false && $index >= 0 && $words[$index + strlen($powers[$i])] == ' ')
                {
                    $count = $this->convertWordToNumber(substr($words, 0, $index));
                    $number += $count * pow(1000, $i);
                    $words = substr($words, $index);
                }
            }
        }

        {
            $index = strpos($words, "hundred");

            if ($index !== false && $index >= 0 && $words[$index + strlen("hundred")] == ' ')
            {
                $count = $this->convertWordToNumber(substr($words, 0, $index));
                $number += $count * 100;
                $words = substr($words, $index);
            }
        }

        for ($i = count($tens) - 1; $i >= 0; $i--)
        {
            $thisTen = $tens[$i];
            if ($tens[$i])
            {
                $index = strpos($words, $tens[$i]);

                if ($index !== false && $index >= 0 && $words[$index + strlen($tens[$i])] == ' ')
                {
                    $number += ($i * 10);
                    $words = substr($words, $index);
                }
            }
        }

        for ($i = count($teens) - 1; $i >= 0; $i--)
        {
            $thisTeen = $teens[$i];
            if ($teens[$i])
            {
                $index = strpos($words, $teens[$i]);

                if ($index !== false && $index >= 0 && $words[$index + strlen($teens[$i])] == ' ')
                {
                    $number += ($i + 10);
                    $words = substr($words, $index);
                }
            }
        }

        for ($i = count($singles) - 1; $i >= 0; $i--)
        {
            $thisSingle = $singles[$i];
            if ($singles[$i])
            {
                $index = strpos($words, $singles[$i] . ' ');

                if ($index !== false && $index >= 0 && $words[$index + strlen($singles[$i])] == ' ')
                {
                    $number += ($i);
                    $words = substr($words, $index);
                }
            }
        }

        return $number;
    }

    /**
     * @param integer $number
     * @return string
     */
    public function convertNumberToWord($number)
    {
        // TODO: Implement convertNumberToWord() method.
    }
}