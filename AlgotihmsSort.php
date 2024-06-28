<?php
/**
 * This file demonstrates various sort algorithms implemented in PHP.
 * The sort algorithm - time complexity:
 * 1. Bubble sort - O(n^2)
 * 2. Selection sort - O(n^2)
 * 3. Tree sort - O(n log(n))
 * 4. Quick sort - O(n log(n))
 * 5. Merge sort - O(n log(n))
 */

// Common unsorted array
$unsorted_array = [3, 4, 1, 0, 0, 4, 3, 2, 99];

/**
 * Optimized Bubble Sort function
 *
 * @param array $array The array to be sorted
 * @return array The sorted array
 */
function optimized_bubble_sort(array $array): array {
    $n = count($array);
    for ($i = 0; $i < $n - 1; $i++) {
        $swapped = false;
        for ($j = 0; $j < $n - $i - 1; $j++) {
            if ($array[$j] > $array[$j + 1]) {
                $temp = $array[$j];
                $array[$j] = $array[$j + 1];
                $array[$j + 1] = $temp;
                $swapped = true;
            }
        }
        if (!$swapped) {
            break;
        }
    }
    return $array;
}

// Example usage
//print_r(optimized_bubble_sort($unsorted_array));

/**
 * Selection Sort function
 *
 * @param array $array The array to be sorted
 * @return array The sorted array
 */
function selection_sort(array $array): array
{
    $times = count($array) ;
    for ($i = 0; $i < $times - 1; $i++)
    {
        $min = $i;
        for ($j = $i + 1; $j < $times; $j++)
        {
            if ($array[$j]< $array[$min])
            {
                $min = $j ;
            }
        }
        if ($min != $i)
        {
            $temp = $array[$i];
            $array[$i] = $array[$min] ;
            $array[$min] = $temp;
        }
    }
    return $array;
};
//print_r(selection_sort($unsorted_array));