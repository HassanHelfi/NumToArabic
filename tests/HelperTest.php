<?php

namespace HassanHelfi\NumberToArabic\Tests;

use PHPUnit\Framework\TestCase;

class HelperTest extends TestCase
{
    public function testNumToArabicWithSingleGroup()
    {
        $result = num_to_arabic('123');
        $this->assertEquals('مائة وثلاثة وعشرین', $result);
    }

    public function testNumToArabicWithMultipleGroups()
    {
        $result = num_to_arabic('123456789');
        $this->assertEquals('مائة وثلاثة وعشرین ملیون وأربعمائة وستّة وخمسین الف وسبعمائة وتعسة وثمانین', $result);
    }
    
    public function testNumToArabicWithDecimal()
    {
        $result = num_to_arabic('3.5');
        $this->assertEquals('ثلاثة فاصلة خمسة', $result);
    }
    
    public function testNumToArabicWithComplexDecimal()
    {
        $result = num_to_arabic('10.25');
        $this->assertEquals('عشرة فاصلة إثنان خمسة', $result);
    }
}