<?php
namespace Hassanhelfi\NumberToArabic\tests;

use Hassanhelfi\NumberToArabic\NumToArabic;
use PHPUnit\Framework\TestCase;

class Number2ArabicWordTest extends TestCase
{
    public function testNumber2WordWithSingleGroup()
    {
        $number = '123';
        $expectedResult = 'مائة وثلاثة وعشرین';
        $result = NumToArabic::number2Word($number);
        $this->assertEquals($expectedResult, $result);
    }

    public function testNumber2WordWithMultipleGroups()
    {
        $number = '123456789';
        $expectedResult = 'مائة وثلاثة وعشرین ملیون وأربعمائة وستّة وخمسین الف وسبعمائة وتعسة وثمانین';
        $result = NumToArabic::number2Word($number);
        $this->assertEquals($expectedResult, $result);
    }

    public function testNumber2WordWithInvalidNumber()
    {
        $number = '1234567890123456789012345667766767676767676767766767676767676712345678901234567890123456677667676767676767677667676767676767';
        $expectedResult = 'لايمكن تحويل هذا الرقم';
        $result = NumToArabic::number2Word($number);
        $this->assertEquals($expectedResult, $result);
    }

    public function testComplexNumbers()
    {
        $this->assertEquals('وا حد', NumToArabic::number2Word('1'));
        $this->assertEquals('إثنان', NumToArabic::number2Word('2'));
        $this->assertEquals('ثلاثة', NumToArabic::number2Word('3'));
        $this->assertEquals('أربعة', NumToArabic::number2Word('4'));
        $this->assertEquals('خمسة', NumToArabic::number2Word('5'));
        $this->assertEquals('ستّة', NumToArabic::number2Word('6'));
        $this->assertEquals('سبعة', NumToArabic::number2Word('7'));
        $this->assertEquals('ثمانية', NumToArabic::number2Word('8'));
        $this->assertEquals('تعسة', NumToArabic::number2Word('9'));
        $this->assertEquals('عشرة', NumToArabic::number2Word('10'));
        $this->assertEquals('أحد عشر', NumToArabic::number2Word('11'));
        $this->assertEquals('اثنا عشر', NumToArabic::number2Word('12'));
        $this->assertEquals('مائة', NumToArabic::number2Word('100'));
        $this->assertEquals('مائة ووا حد', NumToArabic::number2Word('101'));
        $this->assertEquals('مائة وعشرین', NumToArabic::number2Word('120'));
        $this->assertEquals('مائة وثلاثین', NumToArabic::number2Word('130'));
        $this->assertEquals('مائة وأربعین', NumToArabic::number2Word('140'));
        $this->assertEquals('مائة وخمسین', NumToArabic::number2Word('150'));
        $this->assertEquals('مائة وستین', NumToArabic::number2Word('160'));
        $this->assertEquals('مائة وسبعین', NumToArabic::number2Word('170'));
        $this->assertEquals('مائة وثمانین', NumToArabic::number2Word('180'));
        $this->assertEquals('مائة وتسعین', NumToArabic::number2Word('190'));
        $this->assertEquals('مائة وتعسة', NumToArabic::number2Word('109'));
        $this->assertEquals('مائة وثمانية', NumToArabic::number2Word('108'));
        $this->assertEquals('مائة وسبعة', NumToArabic::number2Word('107'));
        $this->assertEquals('مائة وستّة', NumToArabic::number2Word('106'));
        $this->assertEquals('مائة وخمسة', NumToArabic::number2Word('105'));
        $this->assertEquals('مائة وأربعة', NumToArabic::number2Word('104'));
        $this->assertEquals('مائة وثلاثة', NumToArabic::number2Word('103'));
        $this->assertEquals('مائة وإثنان', NumToArabic::number2Word('102'));
        $this->assertEquals('ملیون وخمسة وأربعین الف وخمسمائة وثمانية وستین', NumToArabic::number2Word('1045568'));
    }
}