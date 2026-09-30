# NumToArabic

[![Latest Stable Version](https://img.shields.io/packagist/v/hassanhelfi/number-to-arabic)](https://packagist.org/packages/hassanhelfi/number-to-arabic)
[![Total Downloads](https://img.shields.io/packagist/dt/hassanhelfi/number-to-arabic)](https://packagist.org/packages/hassanhelfi/number-to-arabic)
[![PHP Version Require](https://img.shields.io/packagist/php-v/hassanhelfi/number-to-arabic)](https://packagist.org/packages/hassanhelfi/number-to-arabic)
[![License](https://img.shields.io/packagist/l/hassanhelfi/number-to-arabic)](https://packagist.org/packages/hassanhelfi/number-to-arabic)

**NumToArabic** is a lightweight, accurate PHP package to convert numbers and floating-point values into grammatically correct Arabic words (تفقيط الأرقام والأعداد العشرية باللغة العربية الفصحى).

---

## Installation

Install via Composer:

```bash
composer require hassanhelfi/number-to-arabic
```

---

## Features

- ✅ **Full Floating-Point Support:** Correctly handles decimal fractions (e.g. `3162.50`, `0.5`, `0.05`, `3,162.50`).
- ✅ **Grammatically Correct Arabic:** Proper word roots, conjunctions (`و`), and case endings (مرفوع / منصوب).
- ✅ **Flexible Decimal Modes:** Standard mathematical fractions (`من مائة`, `من عشرة`, `من ألف`) or modern colloquial (`فاصلة`).
- ✅ **Currency / Financial Tafqeet:** Built-in method for converting invoices and monetary amounts (`ريال`, `هللة`, etc.).
- ✅ **Eastern & Western Arabic Numerals:** Supports both `123` and `١٢٣` / `۱۲۳`.
- ✅ **Negative Numbers & Zero:** Full support for `-` (`سالب`) and `0` (`صفر`).
- ✅ **Laravel & Vanilla PHP Friendly:** Global helper functions `num_to_arabic()` and `num_to_arabic_currency()`.

---

## Usage

### 1. Integer Numbers (الأعداد الصحيحة)

```php
use Hassanhelfi\NumberToArabic\NumToArabic;

echo NumToArabic::number2Word('1045568');
// مليون وخمسة وأربعون ألف وخمسمائة وثمانية وستون

echo NumToArabic::number2Word('123');
// مائة وثلاثة وعشرون

echo NumToArabic::number2Word('0');
// صفر

echo NumToArabic::number2Word('-5');
// سالب خمسة
```

### 2. Floating-Point Numbers (الأعداد والكسور العشرية)

#### Mathematical / Formal Mode (الوضع الفصيح الافتراضي):
```php
echo NumToArabic::number2Word('3162.50');
// ثلاثة آلاف ومائة واثنان وستون وخمسون من مائة

echo NumToArabic::number2Word('3162.5');
// ثلاثة آلاف ومائة واثنان وستون وخمسة من عشرة

echo NumToArabic::number2Word('0.05');
// خمسة من مائة

echo NumToArabic::number2Word('0.5');
// خمسة من عشرة
```

#### Comma Mode (`فاصلة`):
```php
echo NumToArabic::number2Word('3162.50', 'comma');
// ثلاثة آلاف ومائة واثنان وستون فاصلة خمسون
```

#### Both Mode (`فاصلة` والمنزلة):
```php
echo NumToArabic::number2Word('3162.50', 'both');
// ثلاثة آلاف ومائة واثنان وستون فاصلة خمسون من مائة
```

---

### 3. Financial & Currency Conversion (تفقيط العملات والمبالغ)

Ideal for financial receipts, invoices, and contracts:

```php
echo NumToArabic::currency2Word('3162.50', 'ريال', 'هللة');
// ثلاثة آلاف ومائة واثنان وستون ريال وخمسون هللة فقط لا غير

echo NumToArabic::currency2Word('500.25', 'دولار', 'سنت');
// خمسمائة دولار وخمسة وعشرون سنت فقط لا غير
```

---

### 4. Grammar Case (حالات الإعراب)

By default, numbers are rendered in the **nominative** case (المرفوع: `ستون`, `ألفان`, `اثنان`). You can choose the **accusative/genitive** case (المنصوب والمجرور: `ستين`, `ألفين`, `اثنين`):

```php
echo NumToArabic::number2Word('3162.50', 'parts', 'accusative');
// ثلاثة آلاف ومائة واثنين وستين وخمسين من مائة
```

---

### 5. Helper Functions (الدوال المساعدة)

```php
// Convert number to Arabic words
echo num_to_arabic('3162.50');
// ثلاثة آلاف ومائة واثنان وستون وخمسون من مائة

echo num_to_arabic('3162.50', 'comma');
// ثلاثة آلاف ومائة واثنان وستون فاصلة خمسون

// Convert currency to Arabic words
echo num_to_arabic_currency('3162.50', 'ريال', 'هللة');
// ثلاثة آلاف ومائة واثنان وستون ريال وخمسون هللة فقط لا غير
```

---

## دليل الاستخدام باللغة العربية (Tafqeet Guide)

مكتبة متكاملة وسريعة لتحويل الأرقام الصحيحة والكسور العشرية والمبالغ المالية إلى كلمات مكتوبة باللغة العربية الفصحى بدقة لغوية ونحوية عالية.

* **الكسور العشرية:** تحويل دقيق حسب المنزلة (من عشرة، من مائة، من ألف...) أو باستخدام "فاصلة".
* **تفقيط العملات:** مجهزة للاستخدام المباشر في الفواتير والشيكات مع إضافة "فقط لا غير".
* **التوافق:** تدعم مشاريع Laravel ومشاريع PHP النقية بكل سهولة.

---

## License

This package is open-sourced software licensed under the [MIT license](LICENSE).
