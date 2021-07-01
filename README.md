# NumberToArabic

Convert numbers to Arabic words in PHP

## Usage

Use string data type to use numbers.
```php
<?php
    include('Number2ArabicWord.php');
    $number_class = new Number2WordArabic;
?>
```
### Example

```php
<?php
    $number = "1045568"; //ملیون وخمسة وأربعین الف وخمسمائة وثمانية وستین
    echo $number_class->number2Word($number);
?>
```
## تحويل الأرقام إلى ما يقابلها كتابة بالعربية

استخدم السلاسل النصية عند استعمال ألارقام

