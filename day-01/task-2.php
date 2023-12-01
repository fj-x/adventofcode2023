<?php
/*
--- Part Two ---

Your calculation isn't quite right. It looks like some of the digits are actually spelled out with letters: one, two, three, four, five, six, seven, eight, and nine also count as valid "digits".

Equipped with this new information, you now need to find the real first and last digit on each line. For example:

two1nine
eightwothree
abcone2threexyz
xtwone3four
4nineeightseven2
zoneight234
pqreighthreeststeen

In this example, the calibration values are 29, 83, 13, 24, 42, 14, and 83. Adding these together produces 288.

What is the sum of all of the calibration values?
*/

// Read the data
$file = fopen('day1-input.csv', 'r');
$array = [];
while (!feof($file)) {
    $read = fgetcsv($file);
    if (!$read) {
        break;
    }
    $array[] = $read[0];
}
fclose($file);

$str = ['one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine'];

// Calculate sum
$sum = 0;
foreach ($array as $key => $value) {
    preg_match_all('!\d|(?=(one|two|three|four|five|six|seven|eight|nine))!', $value, $matches);

    $result = array_filter($matches[0]) + array_filter($matches[1]);
    ksort($result);

    $first = $result[array_key_first($result)];
    $last =  $result[array_key_last($result)];

    if (!is_numeric($first)) {
        $first = array_search($first, $str) + 1;
    }
    if (!is_numeric($last)) {
        $last = array_search($last, $str) + 1;
    }

    $num = (int) ($first . '' . $last);

    $sum = $sum + $num;
}

print_r($sum);
