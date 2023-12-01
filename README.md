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

$arabic_num = NumToArabic::number2Word('1045568'); 
//ملیون وخمسة وأربعین الف وخمسمائة وثمانية وستین
?>
```

## تحويل الأرقام إلى ما يقابلها كتابة بالعربية

استخدم السلاسل النصية (string) عند استعمال ألارقام
