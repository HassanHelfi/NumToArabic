<?php

namespace Hassanhelfi\NumberToArabic;

class NumToArabic
{
    protected static $digit = [
        ['صفر', 'وا حد', 'إثنان', 'ثلاثة', 'أربعة', 'خمسة', 'ستّة', 'سبعة', 'ثمانية', 'تعسة'],
        ['أحد عشر', 'اثنا عشر', 'ثلاثة عشر', 'أربعة عشر', 'خمسة عشر', 'ستة عشر', 'سبعة عشر', 'ثمانية عشر', 'تسعة عشر'],
        ['عشرة', 'عشرین', 'ثلاثین', 'أربعین', 'خمسین', 'ستین', 'سبعین', 'ثمانین', 'تسعین'],
        ['مائة', 'مئتان', 'ثلاثمائة', 'أربعمائة', 'خمسمائة', 'ستمائة', 'سبعمائة', 'ثمانمائة', 'تسعمائة'],
        ['', 'الف', 'ملیون', 'ملیار', 'بلیون', 'بلیار', 'تریلیون', 'كوادريليون', 'كوينتليون', 'سكستليون', 'سبتيلليون', 'أوكتيليون', 'نونيلليون', 'دشيليون', 'أوندشيلليون', 'دودشيليون', 'تريدشيليون', 'كواتوردشيليون', 'كويندشيليون', 'سكسدشيليون', 'سبتندشيليون', 'أوكتودشيليون', 'نوفمدشيليون', 'فجنتليون'],
        ['الاف', 'ملایین', 'ات', 'ین', ' و']
    ];

    /**
     * @param String $number
     * @return string
     */
    public static function number2Word(string $number): string
    {
        $groups = static::format($number);
        $groups_count = count($groups);
        if ($groups_count == 1) return static::one($groups);
        elseif ($groups_count <= 24) return static::other($groups);
        else return "لايمكن تحويل هذا الرقم";
    }

    /**
     * @param string $number
     * @return array
     */
    private static function format(string $number): array
    {
        $number = str_replace([' ', '.'], ['', ''], $number);
        $groups = str_split(strrev($number), 3);
        return array_map("strrev", $groups);
    }

    /**
     * @param $groups
     * @return string
     */
    private static function other($groups): string
    {
        for ($i = count($groups) - 1; $i >= 1; $i--) {
            $num = ltrim($groups[$i], '0');
            $num_count = strlen($num);
            $other_array = $groups;
            array_pop($other_array);
            $other_number = (string)str_replace(',', '', implode(',', array_reverse($other_array)));
            list($groups, $part) = static::part($groups, $i);
            $and = ($groups[$i - 1] == 0) ? '' : static::$digit[5][4];
            $other = ($other_number == 0) ? '' : $and . static::number2Word($other_number);
            if ($num_count == 1) {
                if ($num == 1) $num2word = static::$digit[4][$i] . $other;
                if ($num == 2) $num2word = static::$digit[4][$i] . static::$digit[5][3] . $other;
                if ($num > 2) $num2word = static::one([$groups[$i]]) . ' ' . $part . $other;
            } else {
                $num2word = static::one([$groups[$i]]) . ' ' . $part . $other;
            }
            return $num2word;
        }
    }

    /**
     * @param array $group
     * @return string
     */
    private static function one(array $group): string
    {
        if ($group[0] == 0) $num2word = '';
        $num = ltrim($group[0], '0');
        $num_count = strlen($num);
        $num_arr = array_map('intval', str_split($num));
        if ($num_count == 1) {
            $num2word = static::$digit[0][$num];
        } elseif ($num_count == 2) {
            if ($num_arr[1] == 0 && $num_arr[0] > 0) $num2word = static::$digit[2][$num_arr[0] - 1];
            if ($num_arr[1] > 0 && $num_arr[0] == 1) $num2word = static::$digit[1][$num_arr[1] - 1];
            if ($num_arr[1] > 0 && $num_arr[0] > 1) $num2word = static::$digit[0][$num_arr[1]] . static::$digit[5][4] . static::$digit[2][$num_arr[0] - 1];
        }
        if ($num_count == 3) {
            if ($num_arr[0] > 0 && $num_arr[1] == 0 && $num_arr[2] == 0) {
                $num2word = static::$digit[3][$num_arr[0] - 1];
            } else {
                $num2word = static::$digit[3][$num_arr[0] - 1] . static::$digit[5][4] . static::one([$num_arr[1] . $num_arr[2]]);
            }
        }
        return $num2word;
    }

    /**
     * @param $groups
     * @param int $i
     * @return array
     */
    private static function part(array $groups, int $i): array
    {
        for ($j = 1; $j <= 2; $j++) {
            if (isset($groups[$j])) {
                $part = static::$digit[4][$i];
                if ($groups[$j] <= 10 && $groups[$j] != 0) $part = static::$digit[5][$j - 1];
                elseif ($groups[$i] <= 10 && $groups[$i] != 0) $part = static::$digit[4][$i] . static::$digit[5][2];
            }
        }
        if ($groups[$i] == 0) $part = '';
        return array($groups, $part);
    }
}
