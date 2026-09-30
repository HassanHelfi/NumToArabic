<?php

namespace Hassanhelfi\NumberToArabic;

class NumToArabic
{
    /**
     * @deprecated Legacy digit table kept for backwards compatibility.
     */
    protected static array $digit = [
        ['صفر', 'واحد', 'اثنان', 'ثلاثة', 'أربعة', 'خمسة', 'ستة', 'سبعة', 'ثمانية', 'تسعة'],
        ['أحد عشر', 'اثنا عشر', 'ثلاثة عشر', 'أربعة عشر', 'خمسة عشر', 'ستة عشر', 'سبعة عشر', 'ثمانية عشر', 'تسعة عشر'],
        ['عشرة', 'عشرون', 'ثلاثون', 'أربعون', 'خمسون', 'ستون', 'سبعون', 'ثمانون', 'تسعون'],
        ['مائة', 'مئتان', 'ثلاثمائة', 'أربعمائة', 'خمسمائة', 'ستمائة', 'سبعمائة', 'ثمانمائة', 'تسعمائة'],
        ['', 'ألف', 'مليون', 'مليار', 'تريليون', 'كوادريليون', 'كوينتليون', 'سكستليون'],
        ['آلاف', 'ملايين', 'ات', 'ين', ' و']
    ];

    /**
     * Units in nominative case (مرفوع)
     */
    protected static array $units = [
        0 => 'صفر',
        1 => 'واحد',
        2 => 'اثنان',
        3 => 'ثلاثة',
        4 => 'أربعة',
        5 => 'خمسة',
        6 => 'ستة',
        7 => 'سبعة',
        8 => 'ثمانية',
        9 => 'تسعة',
    ];

    /**
     * Units in accusative/genitive case (منصوب / مجرور)
     */
    protected static array $unitsAccusative = [
        0 => 'صفر',
        1 => 'واحد',
        2 => 'اثنين',
        3 => 'ثلاثة',
        4 => 'أربعة',
        5 => 'خمسة',
        6 => 'ستة',
        7 => 'سبعة',
        8 => 'ثمانية',
        9 => 'تسعة',
    ];

    /**
     * Teens 11 - 19 in nominative case
     */
    protected static array $teens = [
        11 => 'أحد عشر',
        12 => 'اثنا عشر',
        13 => 'ثلاثة عشر',
        14 => 'أربعة عشر',
        15 => 'خمسة عشر',
        16 => 'ستة عشر',
        17 => 'سبعة عشر',
        18 => 'ثمانية عشر',
        19 => 'تسعة عشر',
    ];

    /**
     * Teens 11 - 19 in accusative/genitive case
     */
    protected static array $teensAccusative = [
        11 => 'أحد عشر',
        12 => 'اثني عشر',
        13 => 'ثلاثة عشر',
        14 => 'أربعة عشر',
        15 => 'خمسة عشر',
        16 => 'ستة عشر',
        17 => 'سبعة عشر',
        18 => 'ثمانية عشر',
        19 => 'تسعة عشر',
    ];

    /**
     * Tens (عقود) in nominative case
     */
    protected static array $tens = [
        1 => 'عشرة',
        2 => 'عشرون',
        3 => 'ثلاثون',
        4 => 'أربعون',
        5 => 'خمسون',
        6 => 'ستون',
        7 => 'سبعون',
        8 => 'ثمانون',
        9 => 'تسعون',
    ];

    /**
     * Tens (عقود) in accusative/genitive case
     */
    protected static array $tensAccusative = [
        1 => 'عشرة',
        2 => 'عشرين',
        3 => 'ثلاثين',
        4 => 'أربعين',
        5 => 'خمسين',
        6 => 'ستين',
        7 => 'سبعين',
        8 => 'ثمانين',
        9 => 'تسعين',
    ];

    /**
     * Hundreds (مئات) in nominative case
     */
    protected static array $hundreds = [
        1 => 'مائة',
        2 => 'مئتان',
        3 => 'ثلاثمائة',
        4 => 'أربعمائة',
        5 => 'خمسمائة',
        6 => 'ستمائة',
        7 => 'سبعمائة',
        8 => 'ثمانمائة',
        9 => 'تسعمائة',
    ];

    /**
     * Hundreds (مئات) in accusative/genitive case
     */
    protected static array $hundredsAccusative = [
        1 => 'مائة',
        2 => 'مئتين',
        3 => 'ثلاثمائة',
        4 => 'أربعمائة',
        5 => 'خمسمائة',
        6 => 'ستمائة',
        7 => 'سبعمائة',
        8 => 'ثمانمائة',
        9 => 'تسعمائة',
    ];

    /**
     * Scales: [singular, dual nominative, dual accusative, plural (3-10)]
     */
    protected static array $scales = [
        0 => ['', '', '', ''],
        1 => ['ألف', 'ألفان', 'ألفين', 'آلاف'],
        2 => ['مليون', 'مليونان', 'مليونين', 'ملايين'],
        3 => ['مليار', 'ملياران', 'مليارين', 'مليارات'],
        4 => ['تريليون', 'تريليونان', 'تريليونين', 'تريليونات'],
        5 => ['كوادريليون', 'كوادريليونان', 'كوادريليونين', 'كوادريليونات'],
        6 => ['كوينتليون', 'كوينتليونان', 'كوينتليونين', 'كوينتليونات'],
        7 => ['سكستليون', 'سكستليونان', 'سكستليونين', 'سكستليونات'],
        8 => ['سبتيلليون', 'سبتيلليونان', 'سبتيلليونين', 'سبتيلليونات'],
        9 => ['أوكتيليون', 'أوكتيليونان', 'أوكتيليونين', 'أوكتيليونات'],
        10 => ['نونيلليون', 'نونيلليونان', 'نونيلليونين', 'نونيلليونات'],
        11 => ['دشيليون', 'دشيليونان', 'دشيليونين', 'دشيليونات'],
    ];

    /**
     * Decimal places (منازل الأجزاء العشرية)
     */
    protected static array $decimalPlaces = [
        1 => 'من عشرة',
        2 => 'من مائة',
        3 => 'من ألف',
        4 => 'من عشرة آلاف',
        5 => 'من مائة ألف',
        6 => 'من مليون',
        7 => 'من عشرة ملايين',
        8 => 'من مائة مليون',
        9 => 'من مليار',
        10 => 'من عشرة مليارات',
        11 => 'من مائة مليار',
        12 => 'من تريليون',
    ];

    /**
     * Convert a number to Arabic words.
     *
     * @param string|int|float $number The number to convert.
     * @param string $decimalMode Format for decimals:
     *                            - 'parts' (default): فصيح ریاضی (e.g. وخمسون من مائة)
     *                            - 'comma' or 'fasila': مع فاصلة (e.g. فاصلة خمسون)
     *                            - 'both': مع فاصلة والمنزلة (e.g. فاصلة خمسون من مائة)
     * @param string $grammarCase Grammatical case:
     *                            - 'nominative' (default): المرفوع (عشرون، اثنان، ألفان)
     *                            - 'accusative' or 'genitive': المنصوب والمجرور (عشرين، اثنين، ألفين)
     * @return string
     */
    public static function number2Word($number, string $decimalMode = 'parts', string $grammarCase = 'nominative'): string
    {
        $parsed = self::parseNumber($number);
        if ($parsed === null) {
            return 'لايمكن تحويل هذا الرقم';
        }

        $isNegative = $parsed['isNegative'];
        $integerPart = $parsed['integer'];
        $decimalPart = $parsed['decimal'];

        $integerWord = self::convertInteger($integerPart, $grammarCase);
        if ($integerWord === 'لايمكن تحويل هذا الرقم') {
            return 'لايمكن تحويل هذا الرقم';
        }

        // If no decimal fraction exists or it's all zeros
        $trimmedDecimal = rtrim($decimalPart, '0');
        if ($decimalPart === '' || $trimmedDecimal === '') {
            return ($isNegative && $integerWord !== 'صفر' ? 'سالب ' : '') . $integerWord;
        }

        // Convert decimal fraction
        $decimalLen = strlen($decimalPart);
        $decimalNum = ltrim($decimalPart, '0');
        $decimalWord = self::convertInteger($decimalNum, $grammarCase);

        $placeName = self::$decimalPlaces[$decimalLen] ?? ('من ' . self::convertInteger('1' . str_repeat('0', $decimalLen), $grammarCase));

        if ($decimalMode === 'comma' || $decimalMode === 'fasila') {
            $decimalFull = 'فاصلة ' . $decimalWord;
            $result = ($integerPart === '0' ? 'صفر ' : $integerWord . ' ') . $decimalFull;
        } elseif ($decimalMode === 'both') {
            $decimalFull = 'فاصلة ' . $decimalWord . ' ' . $placeName;
            $result = ($integerPart === '0' ? 'صفر ' : $integerWord . ' ') . $decimalFull;
        } else {
            // 'parts' - الفصيح الرياضي المعتمد
            $decimalFull = $decimalWord . ' ' . $placeName;
            if ($integerPart === '0') {
                $result = $decimalFull;
            } else {
                $result = $integerWord . ' و' . $decimalFull;
            }
        }

        return ($isNegative ? 'سالب ' : '') . $result;
    }

    /**
     * Convert currency amount to Arabic words (Tafqeet / تفقيط العملات).
     *
     * @param string|int|float $number Amount to convert.
     * @param string $currency Primary currency unit (e.g. 'ريال', 'جنيه', 'دينار', 'درهم', 'دولار').
     * @param string $subCurrency Sub-unit of currency (e.g. 'هللة', 'قرش', 'فلس', 'سنت').
     * @param string $grammarCase 'nominative' (default) or 'accusative'.
     * @return string
     */
    public static function currency2Word($number, string $currency = 'ريال', string $subCurrency = 'هللة', string $grammarCase = 'nominative'): string
    {
        $parsed = self::parseNumber($number);
        if ($parsed === null) {
            return 'لايمكن تحويل هذا الرقم';
        }

        $integerPart = $parsed['integer'];
        $decimalPart = $parsed['decimal'];

        $integerWord = self::convertInteger($integerPart, $grammarCase);
        $trimmedDecimal = rtrim($decimalPart, '0');

        $result = '';
        if ($integerPart !== '0') {
            $result .= $integerWord . ' ' . $currency;
        }

        if ($decimalPart !== '' && $trimmedDecimal !== '') {
            $decimalNum = ltrim($decimalPart, '0');
            $decimalWord = self::convertInteger($decimalNum, $grammarCase);

            if ($result !== '') {
                $result .= ' و' . $decimalWord . ' ' . $subCurrency;
            } else {
                $result = $decimalWord . ' ' . $subCurrency;
            }
        }

        if ($result === '') {
            $result = 'صفر ' . $currency;
        }

        return $result . ' فقط لا غير';
    }

    /**
     * Normalize and parse any numeric string into negative flag, integer part, and decimal part.
     *
     * @param string|int|float $number
     * @return array{isNegative: bool, integer: string, decimal: string}|null
     */
    private static function parseNumber($number): ?array
    {
        $raw = trim((string)$number);

        // Normalize Eastern Arabic and Persian numerals
        $easternDigits = ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩', '۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $westernDigits = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        $raw = str_replace($easternDigits, $westernDigits, $raw);

        // Remove spaces
        $raw = str_replace(' ', '', $raw);

        // Normalize Arabic decimal mark (٫) and slash (/)
        $raw = str_replace(['٫', '/'], '.', $raw);

        // Check negative sign
        $isNegative = false;
        if (strpos($raw, '-') === 0) {
            $isNegative = true;
            $raw = substr($raw, 1);
        }

        // Handle commas (,) and Arabic comma (،)
        $raw = str_replace('،', ',', $raw);

        $hasDot = (strpos($raw, '.') !== false);
        $hasComma = (strpos($raw, ',') !== false);

        if ($hasDot && $hasComma) {
            $lastDot = strrpos($raw, '.');
            $lastComma = strrpos($raw, ',');
            if ($lastDot > $lastComma) {
                // e.g. 3,162.50 -> comma is thousands, dot is decimal
                $raw = str_replace(',', '', $raw);
            } else {
                // e.g. 3.162,50 -> dot is thousands, comma is decimal
                $raw = str_replace('.', '', $raw);
                $raw = str_replace(',', '.', $raw);
            }
        } elseif ($hasComma) {
            $commaCount = substr_count($raw, ',');
            if ($commaCount === 1) {
                $commaPos = strpos($raw, ',');
                $afterComma = substr($raw, $commaPos + 1);
                // If not standard 3-digit thousand grouping (e.g. 3162,50 or 0,5), treat as decimal
                if (strlen($afterComma) !== 3) {
                    $raw = str_replace(',', '.', $raw);
                } else {
                    $raw = str_replace(',', '', $raw);
                }
            } else {
                // Multiple commas (e.g. 1,000,000) -> thousand separators
                $raw = str_replace(',', '', $raw);
            }
        } elseif ($hasDot) {
            $dotCount = substr_count($raw, '.');
            if ($dotCount > 1) {
                // e.g. 1.000.000 -> dot used as thousand separator
                $raw = str_replace('.', '', $raw);
            }
        }

        if ($raw === '' || !preg_match('/^\d*(\.\d+)?$/', $raw) || $raw === '.') {
            return null;
        }

        $dotPos = strpos($raw, '.');
        if ($dotPos !== false) {
            $integerPart = substr($raw, 0, $dotPos);
            $decimalPart = substr($raw, $dotPos + 1);
        } else {
            $integerPart = $raw;
            $decimalPart = '';
        }

        $integerPart = ltrim($integerPart, '0');
        if ($integerPart === '') {
            $integerPart = '0';
        }

        return [
            'isNegative' => $isNegative,
            'integer' => $integerPart,
            'decimal' => $decimalPart,
        ];
    }

    /**
     * Convert an integer string to Arabic words.
     */
    private static function convertInteger(string $number, string $grammarCase): string
    {
        if ($number === '0') {
            return self::$units[0];
        }

        $isAccusative = ($grammarCase === 'accusative' || $grammarCase === 'genitive');

        // Split into 3-digit groups from right to left
        $reversed = strrev($number);
        $chunks = str_split($reversed, 3);
        $groups = array_map('strrev', $chunks);
        $count = count($groups);

        if ($count > count(self::$scales)) {
            return 'لايمكن تحويل هذا الرقم';
        }

        $words = [];
        for ($i = $count - 1; $i >= 0; $i--) {
            $val = (int)$groups[$i];
            if ($val === 0) {
                continue;
            }

            $scaleIndex = $i;
            $groupWord = self::convertGroup($val, $grammarCase);

            if ($scaleIndex === 0) {
                $words[] = $groupWord;
            } else {
                $scale = self::$scales[$scaleIndex];
                if ($val === 1) {
                    $words[] = $scale[0]; // ألف، مليون، مليار
                } elseif ($val === 2) {
                    $words[] = $isAccusative ? $scale[2] : $scale[1]; // ألفان/ألفين، مليونان/مليونين
                } elseif ($val >= 3 && $val <= 10) {
                    $words[] = $groupWord . ' ' . $scale[3]; // ثلاثة آلاف، خمسة ملايين
                } else {
                    // حذف نون المثنى عند الإضافة (مئتا ألف، مئتا مليون)
                    if ($val === 200) {
                        $groupWord = $isAccusative ? 'مئتي' : 'مئتا';
                    }
                    $words[] = $groupWord . ' ' . $scale[0]; // أحد عشر ألفاً، مئتا ألف
                }
            }
        }

        return implode(' و', $words);
    }

    /**
     * Convert a 3-digit group (1 to 999).
     */
    private static function convertGroup(int $number, string $grammarCase): string
    {
        $isAccusative = ($grammarCase === 'accusative' || $grammarCase === 'genitive');
        $hundredsMap = $isAccusative ? self::$hundredsAccusative : self::$hundreds;
        $unitsMap = $isAccusative ? self::$unitsAccusative : self::$units;
        $teensMap = $isAccusative ? self::$teensAccusative : self::$teens;
        $tensMap = $isAccusative ? self::$tensAccusative : self::$tens;

        $parts = [];

        $h = intdiv($number, 100);
        $rem = $number % 100;

        if ($h > 0) {
            $parts[] = $hundredsMap[$h];
        }

        if ($rem > 0) {
            if ($rem <= 9) {
                $parts[] = $unitsMap[$rem];
            } elseif ($rem >= 11 && $rem <= 19) {
                $parts[] = $teensMap[$rem];
            } elseif ($rem % 10 === 0) {
                $parts[] = $tensMap[$rem / 10];
            } else {
                $u = $rem % 10;
                $t = intdiv($rem, 10);
                $parts[] = $unitsMap[$u] . ' و' . $tensMap[$t];
            }
        }

        return implode(' و', $parts);
    }
}
