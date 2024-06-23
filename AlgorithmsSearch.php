<?php
/**
 * This file demonstrates various search algorithms implemented in PHP.
 * The search algorithm - time complexity:
 * 1. Linear search - O(n)
 * 2. Jump search - O(√n)
 * 3. Binary search - O(log n)
 * 4. Interpolation search - O(log (log n)) || O(n)
 * 5. Exponential search - O(log n)
 */

// Define a common array and the number to find:
$common_array = [1, 9, 0, 34, 22, 55, 7 , 99 , 100 , 9 , 9 , 5 ,3, 22];
$num_to_find = 22;

// Sorting function for algorithms that require sorted arrays:
$sort_array = function (array $array): array {
    $n = count($array);
    for ($i = 0; $i < $n; $i++) {
        for ($j = 0; $j < $n - 1; $j++) {
            if ($array[$j] > $array[$j + 1]) {
                $temp = $array[$j];
                $array[$j] = $array[$j + 1];
                $array[$j + 1] = $temp;
            }
        }
    }
    return $array;
};

/**
 * Linear search function
 *
 */

$linear_search = function(array $array, int $num_to_find): string
{
    foreach ($array as $key => $value) {
        if ($value == $num_to_find) {
            return "The number to find is: index: $key, value: $value";
        }
    }
    return 'Nothing matches';
};

//echo $linear_search($array, $num_to_find);

/**
 * Binary search function to find a number in an array
 * @array = [2, 9, 0, 10, 22, 55, 78]
 * Finds the number 22
 */
$sorted_array = $sort_array($common_array) ;
print_r($sorted_array);
$binary_search = function(array $array, int $num_to_find): string {

    $first = 0;
    $last = count($array) - 1;
    while ($first <= $last) {

        $middle = intdiv($first + $last, 2);

        if ($array[$middle] > $num_to_find) {

            $last = $middle - 1;
        } elseif ($array[$middle] < $num_to_find) {

            $first = $middle + 1;
        } else {

            return "The number to find is: value: $array[$middle]";
        }
    }

    return 'Nothing matches';
};
//echo $binary_search($sorted_array, $num_to_find);
/**
 * Jump search
 */
$jump_search = function(array $array, int $num_to_find): string
{
    $count = count($array);
    $step = intval(sqrt($count));
    $last = 0 ;

    while ($array[min($step , $count) - 1] < $num_to_find)
    {
        $last = $step ;
        $step += intval(sqrt($count))  ;
        if ($last >= $num_to_find)
        {
            return false;
        }
    }
    while ($array[$last] < $num_to_find)
    {
        $last++ ;
        if ($last >= min($step , $count))
        {
            return false;
        } elseif ($array[$last] == $num_to_find)
        {
            return "The number to find is: index: " . $last . ", value: " . $array[$last];
        }
    }
    return 'Nothing matches';
} ;

echo $jump_search($sorted_array, $num_to_find);