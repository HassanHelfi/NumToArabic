<?php

namespace HassanHelfi\NumberToArabic\Tests;

use PHPUnit\Framework\TestCase;

class HelperTest extends TestCase
{
    public function testNumToArabicWithSingleGroup()
    {
        $result = num_to_arabic('123');
        $this->assertEquals('مائة وثلاثة وعشرون', $result);
    }

    public function testNumToArabicWithMultipleGroups()
    {
        $result = num_to_arabic('123456789');
        $this->assertEquals('مائة وثلاثة وعشرون مليون وأربعمائة وستة وخمسون ألف وسبعمائة وتسعة وثمانون', $result);
    }

    public function testNumToArabicWithFloat()
    {
        $result = num_to_arabic('3162.50');
        $this->assertEquals('ثلاثة آلاف ومائة واثنان وستون وخمسون من مائة', $result);

        $resultComma = num_to_arabic('3162.50', 'comma');
        $this->assertEquals('ثلاثة آلاف ومائة واثنان وستون فاصلة خمسون', $resultComma);
    }

    public function testNumToArabicCurrency()
    {
        $result = num_to_arabic_currency('3162.50', 'ريال', 'هللة');
        $this->assertEquals('ثلاثة آلاف ومائة واثنان وستون ريال وخمسون هللة فقط لا غير', $result);
    }
}