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
        return $this->convertNumber((string)$number);
    }

    /**
     * English Number Converter - Collection of PHP functions to convert a number
     *                            into English text.
     *
     * This exact code is licensed under CC-Wiki on Stackoverflow.
     * http://creativecommons.org/licenses/by-sa/3.0/
     *
     * @link     http://stackoverflow.com/q/277569/367456
     * @question Is there an easy way to convert a number to a word in PHP?
     *
     * This file incorporates work covered by the following copyright and
     * permission notice:
     *
     *   Copyright 2007-2008 Brenton Fletcher. http://bloople.net/num2text
     *   You can use this freely and modify it however you want.
     *
     * @param string $integer
     * @return string
     */
    private function convertNumber($integer)
    {
        $output = "";

        if ($integer{0} == "0")
        {
            $output .= "zero";
        }
        else
        {
            $integer = str_pad($integer, 36, "0", STR_PAD_LEFT);
            $group   = rtrim(chunk_split($integer, 3, " "), " ");
            $groups  = explode(" ", $group);

            $groups2 = array();
            foreach ($groups as $g)
            {
                $groups2[] = $this->convertThreeDigit($g{0}, $g{1}, $g{2});
            }

            for ($z = 0; $z < count($groups2); $z++)
            {
                if ($groups2[$z] != "")
                {
                    $output .= $groups2[$z] . $this->convertGroup(11 - $z) . (
                        $z < 11
                        && !array_search('', array_slice($groups2, $z + 1, -1))
                        && $groups2[11] != ''
                        && $groups[11]{0} == '0'
                            ? " and "
                            : " "
                        );
                }
            }

            $output = rtrim($output, " ");
        }

        return $output;
    }

    private function convertGroup($index)
    {
        switch ($index)
        {
            case 11:
                return " decillion";
            case 10:
                return " nonillion";
            case 9:
                return " octillion";
            case 8:
                return " septillion";
            case 7:
                return " sextillion";
            case 6:
                return " quintrillion";
            case 5:
                return " quadrillion";
            case 4:
                return " trillion";
            case 3:
                return " billion";
            case 2:
                return " million";
            case 1:
                return " thousand";
            case 0:
                return "";
        }
    }

    private function convertThreeDigit($digit1, $digit2, $digit3)
    {
        $buffer = "";

        if ($digit1 == "0" && $digit2 == "0" && $digit3 == "0")
        {
            return "";
        }

        if ($digit1 != "0")
        {
            $buffer .= $this->convertDigit($digit1) . " hundred";
            if ($digit2 != "0" || $digit3 != "0")
            {
                $buffer .= " and ";
            }
        }

        if ($digit2 != "0")
        {
            $buffer .= $this->convertTwoDigit($digit2, $digit3);
        }
        else if ($digit3 != "0")
        {
            $buffer .= $this->convertDigit($digit3);
        }

        return $buffer;
    }

    private function convertTwoDigit($digit1, $digit2)
    {
        if ($digit2 == "0")
        {
            switch ($digit1)
            {
                case "1":
                    return "ten";
                case "2":
                    return "twenty";
                case "3":
                    return "thirty";
                case "4":
                    return "forty";
                case "5":
                    return "fifty";
                case "6":
                    return "sixty";
                case "7":
                    return "seventy";
                case "8":
                    return "eighty";
                case "9":
                    return "ninety";
            }
        } else if ($digit1 == "1")
        {
            switch ($digit2)
            {
                case "1":
                    return "eleven";
                case "2":
                    return "twelve";
                case "3":
                    return "thirteen";
                case "4":
                    return "fourteen";
                case "5":
                    return "fifteen";
                case "6":
                    return "sixteen";
                case "7":
                    return "seventeen";
                case "8":
                    return "eighteen";
                case "9":
                    return "nineteen";
            }
        } else
        {
            $temp = $this->convertDigit($digit2);
            switch ($digit1)
            {
                case "2":
                    return "twenty $temp";
                case "3":
                    return "thirty $temp";
                case "4":
                    return "forty $temp";
                case "5":
                    return "fifty $temp";
                case "6":
                    return "sixty $temp";
                case "7":
                    return "seventy $temp";
                case "8":
                    return "eighty $temp";
                case "9":
                    return "ninety $temp";
            }
        }
    }

    private function convertDigit($digit)
    {
        switch ($digit)
        {
            case "0":
                return "zero";
            case "1":
                return "one";
            case "2":
                return "two";
            case "3":
                return "three";
            case "4":
                return "four";
            case "5":
                return "five";
            case "6":
                return "six";
            case "7":
                return "seven";
            case "8":
                return "eight";
            case "9":
                return "nine";
        }
    }
}