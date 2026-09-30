<?php

if (! function_exists('num_to_arabic')) {
    /**
     * Convert a number to Arabic words.
     *
     * @param string|int|float $number
     * @param string $decimalMode
     * @param string $grammarCase
     * @return string
     */
    function num_to_arabic($number, string $decimalMode = 'parts', string $grammarCase = 'nominative'): string
    {
        return \Hassanhelfi\NumberToArabic\NumToArabic::number2Word($number, $decimalMode, $grammarCase);
    }
}

if (! function_exists('num_to_arabic_currency')) {
    /**
     * Convert currency amount to Arabic words.
     *
     * @param string|int|float $number
     * @param string $currency
     * @param string $subCurrency
     * @param string $grammarCase
     * @return string
     */
    function num_to_arabic_currency($number, string $currency = 'ريال', string $subCurrency = 'هللة', string $grammarCase = 'nominative'): string
    {
        return \Hassanhelfi\NumberToArabic\NumToArabic::currency2Word($number, $currency, $subCurrency, $grammarCase);
    }
}