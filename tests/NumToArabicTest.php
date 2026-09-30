<?php

namespace Hassanhelfi\NumberToArabic\Tests;

use Hassanhelfi\NumberToArabic\NumToArabic;
use PHPUnit\Framework\TestCase;

class NumToArabicTest extends TestCase
{
    /**
     * Test issue #1: Floating numbers (e.g. 3162.50)
     */
    public function testFloatingNumberIssue3162_50()
    {
        // 3162.50 in standard Arabic formal math fraction (parts)
        $this->assertEquals(
            'ثلاثة آلاف ومائة واثنان وستون وخمسون من مائة',
            NumToArabic::number2Word('3162.50')
        );

        // 3162.5 (one decimal place)
        $this->assertEquals(
            'ثلاثة آلاف ومائة واثنان وستون وخمسة من عشرة',
            NumToArabic::number2Word('3162.5')
        );

        // 3162.05 (two decimal places, value 5)
        $this->assertEquals(
            'ثلاثة آلاف ومائة واثنان وستون وخمسة من مائة',
            NumToArabic::number2Word('3162.05')
        );

        // 3162.005 (three decimal places, value 5)
        $this->assertEquals(
            'ثلاثة آلاف ومائة واثنان وستون وخمسة من ألف',
            NumToArabic::number2Word('3162.005')
        );

        // 3162.50 with 'comma' (فاصلة) mode
        $this->assertEquals(
            'ثلاثة آلاف ومائة واثنان وستون فاصلة خمسون',
            NumToArabic::number2Word('3162.50', 'comma')
        );

        // 3162.50 with 'both' mode
        $this->assertEquals(
            'ثلاثة آلاف ومائة واثنان وستون فاصلة خمسون من مائة',
            NumToArabic::number2Word('3162.50', 'both')
        );

        // 3162.50 with accusative case
        $this->assertEquals(
            'ثلاثة آلاف ومائة واثنين وستين وخمسين من مائة',
            NumToArabic::number2Word('3162.50', 'parts', 'accusative')
        );

        // Numeric float and int types
        $this->assertEquals(
            'ثلاثة آلاف ومائة واثنان وستون وخمسة من عشرة',
            NumToArabic::number2Word(3162.5)
        );
        $this->assertEquals(
            'ثلاثة آلاف ومائة واثنان وستون',
            NumToArabic::number2Word(3162)
        );
    }

    public function testZeroAndPureDecimals()
    {
        $this->assertEquals('صفر', NumToArabic::number2Word('0'));
        $this->assertEquals('صفر', NumToArabic::number2Word(0));
        $this->assertEquals('صفر', NumToArabic::number2Word('0.00'));
        $this->assertEquals('خمسة من عشرة', NumToArabic::number2Word('0.5'));
        $this->assertEquals('خمسة من مائة', NumToArabic::number2Word('0.05'));
        $this->assertEquals('خمسون من مائة', NumToArabic::number2Word('0.50'));
        $this->assertEquals('خمسة وعشرون من مائة', NumToArabic::number2Word('0.25'));
        $this->assertEquals('واحد من ألف', NumToArabic::number2Word('0.001'));
        $this->assertEquals('خمسة من مائة ألف', NumToArabic::number2Word('0.00005'));
        $this->assertEquals('خمسة من مليون', NumToArabic::number2Word('0.000005'));
    }

    public function testNegativeNumbers()
    {
        $this->assertEquals('سالب خمسة', NumToArabic::number2Word('-5'));
        $this->assertEquals('سالب مائة', NumToArabic::number2Word('-100'));
        $this->assertEquals(
            'سالب ثلاثة آلاف ومائة واثنان وستون وخمسون من مائة',
            NumToArabic::number2Word('-3162.50')
        );
    }

    public function testSingleGroupNumbers()
    {
        $this->assertEquals('صفر', NumToArabic::number2Word('0'));
        $this->assertEquals('واحد', NumToArabic::number2Word('1'));
        $this->assertEquals('اثنان', NumToArabic::number2Word('2'));
        $this->assertEquals('ثلاثة', NumToArabic::number2Word('3'));
        $this->assertEquals('أربعة', NumToArabic::number2Word('4'));
        $this->assertEquals('خمسة', NumToArabic::number2Word('5'));
        $this->assertEquals('ستة', NumToArabic::number2Word('6'));
        $this->assertEquals('سبعة', NumToArabic::number2Word('7'));
        $this->assertEquals('ثمانية', NumToArabic::number2Word('8'));
        $this->assertEquals('تسعة', NumToArabic::number2Word('9'));
        $this->assertEquals('عشرة', NumToArabic::number2Word('10'));
        $this->assertEquals('أحد عشر', NumToArabic::number2Word('11'));
        $this->assertEquals('اثنا عشر', NumToArabic::number2Word('12'));
        $this->assertEquals('عشرون', NumToArabic::number2Word('20'));
        $this->assertEquals('واحد وعشرون', NumToArabic::number2Word('21'));
        $this->assertEquals('تسعة وتسعون', NumToArabic::number2Word('99'));
        $this->assertEquals('مائة', NumToArabic::number2Word('100'));
        $this->assertEquals('مائة وواحد', NumToArabic::number2Word('101'));
        $this->assertEquals('مائة واثنان', NumToArabic::number2Word('102'));
        $this->assertEquals('مائة وثلاثة وعشرون', NumToArabic::number2Word('123'));
        $this->assertEquals('مئتان', NumToArabic::number2Word('200'));
        $this->assertEquals('مئتان وواحد', NumToArabic::number2Word('201'));
    }

    public function testThousandsAndMillions()
    {
        $this->assertEquals('ألف', NumToArabic::number2Word('1000'));
        $this->assertEquals('ألف وواحد', NumToArabic::number2Word('1001'));
        $this->assertEquals('ألفان', NumToArabic::number2Word('2000'));
        $this->assertEquals('ألفان واثنان', NumToArabic::number2Word('2002'));
        $this->assertEquals('ثلاثة آلاف', NumToArabic::number2Word('3000'));
        $this->assertEquals('عشرة آلاف', NumToArabic::number2Word('10000'));
        $this->assertEquals('أحد عشر ألف', NumToArabic::number2Word('11000'));
        $this->assertEquals('عشرون ألف', NumToArabic::number2Word('20000'));
        $this->assertEquals('مائة ألف', NumToArabic::number2Word('100000'));
        $this->assertEquals('مئتا ألف', NumToArabic::number2Word('200000'));
        $this->assertEquals('مليون', NumToArabic::number2Word('1000000'));
        $this->assertEquals('مليونان', NumToArabic::number2Word('2000000'));
        $this->assertEquals('مئتا مليون', NumToArabic::number2Word('200000000'));
        $this->assertEquals('ثلاثة ملايين', NumToArabic::number2Word('3000000'));
        $this->assertEquals('مليار', NumToArabic::number2Word('1000000000'));
        $this->assertEquals('تريليون', NumToArabic::number2Word('1000000000000'));
        $this->assertEquals(
            'مليون وخمسة وأربعون ألف وخمسمائة وثمانية وستون',
            NumToArabic::number2Word('1045568')
        );
        $this->assertEquals(
            'مائة وثلاثة وعشرون مليون وأربعمائة وستة وخمسون ألف وسبعمائة وتسعة وثمانون',
            NumToArabic::number2Word('123456789')
        );
    }

    public function testEasternNumeralsAndFormatting()
    {
        // Persian / Arabic numerals
        $this->assertEquals(
            'ثلاثة آلاف ومائة واثنان وستون وخمسون من مائة',
            NumToArabic::number2Word('٣١٦٢.٥٠')
        );

        // Arabic decimal separator (٫) and thousand commas
        $this->assertEquals(
            'ثلاثة آلاف ومائة واثنان وستون وخمسون من مائة',
            NumToArabic::number2Word('3,162٫50')
        );

        // European / French format with comma (3162,50)
        $this->assertEquals(
            'ثلاثة آلاف ومائة واثنان وستون وخمسون من مائة',
            NumToArabic::number2Word('3162,50')
        );

        // European dot as thousand and comma as decimal (3.162,50)
        $this->assertEquals(
            'ثلاثة آلاف ومائة واثنان وستون وخمسون من مائة',
            NumToArabic::number2Word('3.162,50')
        );
    }

    public function testCurrencyConversion()
    {
        $this->assertEquals(
            'ثلاثة آلاف ومائة واثنان وستون ريال وخمسون هللة فقط لا غير',
            NumToArabic::currency2Word('3162.50', 'ريال', 'هللة')
        );

        $this->assertEquals(
            'خمسمائة دولار واثنان سنت فقط لا غير',
            NumToArabic::currency2Word('500.02', 'دولار', 'سنت')
        );

        $this->assertEquals(
            'صفر ريال فقط لا غير',
            NumToArabic::currency2Word('0', 'ريال', 'هللة')
        );
    }

    public function testInvalidNumber()
    {
        $this->assertEquals('لايمكن تحويل هذا الرقم', NumToArabic::number2Word('abc'));
        $this->assertEquals('لايمكن تحويل هذا الرقم', NumToArabic::number2Word(''));
        $this->assertEquals('لايمكن تحويل هذا الرقم', NumToArabic::number2Word('-'));
        $this->assertEquals('لايمكن تحويل هذا الرقم', NumToArabic::number2Word('.'));
    }
}
