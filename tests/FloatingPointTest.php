<?php

namespace Hassanhelfi\NumberToArabic\Tests;

use Hassanhelfi\NumberToArabic\NumToArabic;
use PHPUnit\Framework\TestCase;

class FloatingPointTest extends TestCase
{
    public function testSimpleDecimal()
    {
        $result = NumToArabic::number2Word('3.5');
        $this->assertEquals('ثلاثة فاصلة خمسة', $result);
    }
    
    public function testDecimalWithMultipleDigits()
    {
        $result = NumToArabic::number2Word('10.25');
        $this->assertEquals('عشرة فاصلة إثنان خمسة', $result);
    }
    
    public function testDecimalWithZeroInteger()
    {
        $result = NumToArabic::number2Word('0.5');
        $this->assertEquals('صفر فاصلة خمسة', $result);
    }
    
    public function testDecimalWithLargeInteger()
    {
        $result = NumToArabic::number2Word('123.45');
        $this->assertEquals('مائة وثلاثة وعشرین فاصلة أربعة خمسة', $result);
    }
    
    public function testDecimalWithSingleDigitAfterPoint()
    {
        $result = NumToArabic::number2Word('5.7');
        $this->assertEquals('خمسة فاصلة سبعة', $result);
    }
    
    public function testDecimalWithZeroInDecimalPart()
    {
        $result = NumToArabic::number2Word('12.05');
        $this->assertEquals('اثنا عشر فاصلة صفر خمسة', $result);
    }
    
    public function testDecimalWithThreeDigitsAfterPoint()
    {
        $result = NumToArabic::number2Word('7.125');
        $this->assertEquals('سبعة فاصلة وا حد إثنان خمسة', $result);
    }
    
    public function testInvalidDecimalNoDigitsAfterPoint()
    {
        $result = NumToArabic::number2Word('5.');
        $this->assertEquals('رقم عشري غير صالح', $result);
    }
    
    public function testInvalidDecimalNoDigitsBeforePoint()
    {
        $result = NumToArabic::number2Word('.5');
        $this->assertEquals('رقم عشري غير صالح', $result);
    }
    
    public function testInvalidDecimalMultiplePoints()
    {
        $result = NumToArabic::number2Word('5.5.5');
        $this->assertEquals('رقم عشري غير صالح', $result);
    }
    
    public function testBackwardCompatibilityInteger()
    {
        $result = NumToArabic::number2Word('123');
        $this->assertEquals('مائة وثلاثة وعشرین', $result);
    }
}
