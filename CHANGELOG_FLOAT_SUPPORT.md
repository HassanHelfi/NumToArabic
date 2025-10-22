# Changelog: Floating Point Number Support

## Summary
Added support for converting floating point/decimal numbers to Arabic text while maintaining full backward compatibility with integer conversion.

## Changes Made

### 1. Core Implementation (`src/NumToArabic.php`)

#### New Methods Added:
- `hasDecimal(string $number): bool` - Checks if a number contains a decimal point
- `convertDecimal(string $number): string` - Main method to convert decimal numbers to Arabic text
- `isValidDecimal(string $number): bool` - Validates decimal number format
- `convertDecimalDigits(string $digits): string` - Converts decimal digits individually to Arabic words

#### Modified Methods:
- `number2Word(string $number): string` - Updated to detect and handle decimal numbers before processing

#### Implementation Details:
- Decimal numbers are split into integer and decimal parts
- Integer part is converted using existing logic
- Decimal digits are converted individually (e.g., .25 → "إثنان خمسة")
- Parts are joined with "فاصلة" (Arabic for "point/comma")
- Validation ensures proper format (e.g., rejects "5.", ".5", "5.5.5")

### 2. Tests (`tests/FloatingPointTest.php` - New File)

Added comprehensive test coverage:
- Simple decimals (3.5)
- Multiple decimal digits (10.25)
- Zero integer part (0.5)
- Large integer with decimals (123.45)
- Zeros in decimal part (12.05)
- Multiple decimal digits (7.125)
- Invalid formats (5., .5, 5.5.5)
- Backward compatibility verification

### 3. Helper Function Tests (`tests/HelperTest.php`)

Added tests to verify the helper function `num_to_arabic()` also supports decimals:
- Basic decimal (3.5)
- Complex decimal (10.25)

### 4. Documentation (`README.md`)

Updated with:
- Examples of floating point number conversion
- New features list highlighting decimal support
- Usage examples showing both integer and decimal conversion

## Examples

### Before (Integers Only)
```php
NumToArabic::number2Word('123'); 
// Output: مائة وثلاثة وعشرین
```

### After (Integers + Decimals)
```php
// Integers still work (backward compatible)
NumToArabic::number2Word('123');
// Output: مائة وثلاثة وعشرین

// Decimals now supported
NumToArabic::number2Word('3.5');
// Output: ثلاثة فاصلة خمسة

NumToArabic::number2Word('10.25');
// Output: عشرة فاصلة إثنان خمسة

NumToArabic::number2Word('0.5');
// Output: صفر فاصلة خمسة
```

## Backward Compatibility

✅ All existing integer conversion functionality remains unchanged
✅ All existing tests continue to pass
✅ Integer numbers without decimal points follow the exact same code path as before
✅ The helper function automatically supports decimals without any changes needed

## Validation

The implementation includes proper validation:
- Requires at least one digit before and after the decimal point
- Rejects multiple decimal points
- Returns error message in Arabic: "رقم عشري غير صالح" (Invalid decimal number)

## Edge Cases Handled

- Leading zeros in integer part (03.5 → treated as 3.5)
- Trailing zeros in decimal part (3.50 → reads as "five zero")
- Zero integer part (0.5 → "صفر فاصلة خمسة")
- Whitespace (trimmed automatically)
