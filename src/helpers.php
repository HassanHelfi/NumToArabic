<?php

if (! function_exists('num_to_arabic')) {
    function num_to_arabic(string $number)
    {
        return \Hassanhelfi\NumberToArabic\NumToArabic::number2Word($number);
    }
}