<?php

class Arabic2Word
{
    protected $digit = [
        ['صفر', 'وا حد', 'إثنان', 'ثلاثة', 'أربعة', 'خمسة', 'ستّة', 'سبعة', 'ثمانية', 'تعسة'],
        ['أحد عشر', 'اثنا عشر', 'ثلاثة عشر', 'أربعة عشر', 'خمسة عشر', 'ستة عشر', 'سبعة عشر', 'ثمانية عشر', 'تسعة عشر'],
        ['عشرة', 'عشرین', 'ثلاثین', 'أربعین', 'خمسین', 'ستین', 'سبعین', 'ثمانین', 'تسعین'],
        ['مائة', 'مئتان', 'ثلاثمائة', 'أربعمائة', 'خمسمائة', 'ستمائة', 'سبعمائة', 'ثمانمائة', 'تسعمائة'],
        ['', 'الف', 'ملیون', 'ملیار', 'تریلیون', 'كوادريليون', 'كوينتيليون', 'سکستریلیون', 'سبتليون', 'أكتيليون', 'نونیلیون', 'دسیلیون'],
        ['الاف', 'ملایین', 'ات', 'ین', ' و']
    ];

    /**
     * @param string $number
     * @return array
     */
    public function format(string $number): array #int or string
    {
        $number = explode('.', str_replace(' ', '', $number));
        $number[0] = str_split(strrev($number[0]), 3);
        $groups = array_map("strrev", array_pop($number));
        return $groups;
    }

    /**
     * @param String $number
     * @return string
     */
    public function number2Word(string $number): string
    {
        $groups = $this->format($number);
        $groups_count = count($groups);
        if ($groups_count == 1) return $this->one($groups);#<2
        elseif ($groups_count <= 12) return $this->other($groups);
        else return "Asd";
    }

    /**
     * @param $groups
     * @return string
     */
    public function other($groups): string
    {
        for ($i = count($groups) - 1; $i >= 1; $i--) {
            $num = ltrim($groups[$i], '0');
            $num_count = strlen($num);
            $other_array = $groups;
            array_pop($other_array);
            $other_number = (string)str_replace(',', '', implode(',', array_reverse($other_array)));#int or string
            list($groups, $part) = $this->part($groups, $i);
            $and = ($groups[$i - 1] == 0) ? '' : $this->digit[5][4];
            $other = ($other_number == 0) ? '' : $and . $this->number2Word($other_number);
            if ($num_count == 1) {
                if ($num == 1) $num2word = $this->digit[4][$i] . $other;
                if ($num == 2) $num2word = $this->digit[4][$i] . $this->digit[5][3] . $other;
                if ($num > 2) $num2word = $this->one([$groups[$i]]) . ' ' . $part . $other;
            } else {
                $num2word = $this->one([$groups[$i]]) . ' ' . $part . $other;
            }
            return $num2word;
        }
    }

    /**
     * @param array $group
     * @return string
     */
    public function one(array $group): string
    {
        if ($group[0] == 0) $num2word = '';
        $num = ltrim($group[0], '0');
        $num_count = strlen($num);
        $num_arr = array_map('intval', str_split($num));
        if ($num_count == 1) {
            $num2word = $this->digit[0][$num]; #0-9
        } elseif ($num_count == 2) {
            if ($num_arr[1] == 0 && $num_arr[0] > 0) $num2word = $this->digit[2][$num_arr[0] - 1]; #10-90
            if ($num_arr[1] > 0 && $num_arr[0] == 1) $num2word = $this->digit[1][$num_arr[1] - 1]; #11-19
            if ($num_arr[1] > 0 && $num_arr[0] > 1) $num2word = $this->digit[0][$num_arr[1]] . $this->digit[5][4] . $this->digit[2][$num_arr[0] - 1]; #21-99
        }
        if ($num_count == 3) {
            if ($num_arr[0] > 0 && $num_arr[1] == 0 && $num_arr[2] == 0) {
                $num2word = $this->digit[3][$num_arr[0] - 1]; #100-200
            } else {
                $num2word = $this->digit[3][$num_arr[0] - 1] . $this->digit[5][4] . $this->one([$num_arr[1] . $num_arr[2]]); #100-999
            }
        }
        return $num2word;
    }

    /**
     * @param $groups
     * @param int $i
     * @return array
     */
    public function part(array $groups, int $i): array
    {
        for ($j = 1; $j <= 2; $j++) {
            if (isset($groups[$j])) {
                $part = $this->digit[4][$i];
                if ($groups[$j] <= 10 && $groups[$j] != 0) $part = $this->digit[5][$j - 1];
                elseif ($groups[$i] <= 10 && $groups[$i] != 0) $part = $this->digit[4][$i] . $this->digit[5][2];
            }
        }
        if ($groups[$i] == 0) $part = '';
        return array($groups, $part);
    }
}