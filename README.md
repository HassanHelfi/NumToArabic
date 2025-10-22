# NumToArabic
Convert numbers to Arabic words in PHP

## Installation

```bash
composer require hassanhelfi/number-to-arabic
```

## Usage


> [!IMPORTANT]
> Use string data type to use numbers.


```php

<?php

use Hassanhelfi\NumberToArabic\NumToArabic;

// Integer numbers
$arabic_num = NumToArabic::number2Word('1045568'); 
//ملیون وخمسة وأربعین الف وخمسمائة وثمانية وستین

// Floating point numbers
$arabic_decimal = NumToArabic::number2Word('3.5');
//ثلاثة فاصلة خمسة

$arabic_decimal = NumToArabic::number2Word('10.25');
//عشرة فاصلة إثنان خمسة
?>
```

## Features

- Convert integer numbers to Arabic words
- Convert floating point/decimal numbers to Arabic words
- Support for numbers up to 24 groups (very large numbers)
- Input validation for floating point numbers

## تحويل الأرقام إلى ما يقابلها كتابة بالعربية

استخدم السلاسل النصية (string) عند استعمال ألارقام
