<?php
include('Number2ArabicWord.php');
$number_class = new Number2WordArabic;

$number = "100566165681004001025636652298641351";
$number = "1045568";
echo $number_class->number2Word($number);
