<?php
/**
 * This file demonstrates my practice work on various search algorithms implemented in PHP.
 *
 * The search algorithm - time complexity:
 * 1. Linear search - O(n): Best for small or unsorted datasets.
 * 2. Jump search - O(√n): Efficient for larger sorted arrays.
 * 3. Binary search - O(log n): Requires sorted arrays, very efficient.
 * 4. Interpolation search - O(log (log n)) || O(n): Best for uniformly distributed, sorted data.
 * 5. Exponential search - O(log n): Useful for unbounded or infinite-sized arrays.
 *
 * The following examples include a simple linear search and a sorting function,
 * necessary for some search algorithms.
 */

// Define a common array and the number to find:
$common_array = [1, 9, 0, 34, 2, 55, 2, 99, 100, 9, 9, 5, 3, 22];
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
// Sorting the array for algorithms that require sorted arrays
$sorted_array = $sort_array($common_array);
print_r($sorted_array);

/**
 * Linear search function
 * Big O is O(n)
 * Linear search can be used with both sorted and unsorted arrays
 * @param array $array The array to search in
 * @param int $num_to_find The number to find
 * @return string The result of the search
 */
$linear_search = function(array $array, int $num_to_find): string {
    foreach ($array as $key => $value) {
        if ($value == $num_to_find) {
            return "The number to find is: index: $key, value: $value " ;
        }
    }
    return 'Nothing matches';
};

echo "Linear search: " . $linear_search($common_array, $num_to_find) ."\n";


/**
 * Binary search function
 * Binary search is very efficient but requires a sorted array.
 * Big O is O(log n)
 * @param array $array The array to search in
 * @param int $first The starting index
 * @param int $last The ending index
 * @param int $num_to_find The number to find
 * @return string The result of the search
 */
$binary_search = function(array $array, int $first, int $last, int $num_to_find): string {
    while ($first <= $last) {
        $middle = intdiv($first + $last, 2);

        if ($array[$middle] > $num_to_find) {
            $last = $middle - 1;
        } elseif ($array[$middle] < $num_to_find) {
            $first = $middle + 1;
        } else {
            return "The number to find is: index: $middle, value: $array[$middle]";
        }
    }

    return 'Nothing matches';
};

// Example usage of binary search
$first = 0;
$last = count($sorted_array) - 1;
echo "Binary search: " .$binary_search($sorted_array, $first, $last, $num_to_find) ."\n";

/**
 * Jump search function
 * Jump search is efficient for larger sorted arrays.
 * Big O is O(√n)
 * @param array $array The array to search in
 * @param int $num_to_find The number to find
 * @return string The result of the search
 */
$jump_search = function(array $array, int $num_to_find): string {
    $count = count($array) - 1;
    $step = intval(sqrt($count));
    $last = 0;

    while ($array[min($step, $count) - 1] < $num_to_find) {
        $last = $step;
        $step += intval(sqrt($count));
        if ($last >= $count) {
            return 'ChNothing matches';
        }
    }

    while ($array[$last] <= $num_to_find) {
        $last++;
        if ($last >= min($step, $count)) {
            return ' Nothing matches';
        } elseif ($array[$last] === $num_to_find) {
            return "The number to find is: index: $last, value: $array[$last]";
        }
    }

    return ' Nothing matches';
};

// Example usage of jump search
 echo "Jump search: " . $jump_search($sorted_array, $num_to_find) ."\n";

/**
 * Interpolation search function
 * Interpolation search is effective for uniformly distributed, sorted data.
 * Big O is O(log (log n)) for uniformly distributed arrays, otherwise O(n)
 * @param array $array The array to search in
 * @param int $low The starting index
 * @param int $high The ending index
 * @param int $num_to_find The number to find
 * @return string The result of the search
 */
function interpolation_search(array $array, int $low, int $high, int $num_to_find): string {
    if ($low <= $high && $num_to_find >= $array[$low] && $num_to_find <= $array[$high]) {
        $position = $low + (int)(($high - $low) / ($array[$high] - $array[$low]) * ($num_to_find - $array[$low]));

        if ($array[$position] == $num_to_find) {
            return "The number to find is: index: $position, value: $array[$position]";
        } elseif ($array[$position] > $num_to_find) {
            return interpolation_search($array, $low, $position - 1, $num_to_find);
        } else {
            return interpolation_search($array, $position + 1, $high, $num_to_find);
        }
    }

    return 'Nothing matches';
}

// Example usage of interpolation search
$low = 0;
$high = count($sorted_array) - 1;
echo "Interpolation search: " . interpolation_search($sorted_array, $low, $high, $num_to_find) ."\n";

/**
 * Exponential search function
 * Exponential search is useful for unbounded or infinite-sized arrays.
 * Big O is O(log n)
 * @param array $array The array to search in
 * @param callable $binary_search The binary search function
 * @param int $num_to_find The number to find
 * @return string The result of the search
 */
$exponential_search = function(array $array, callable $binary_search, int $num_to_find): string {
    if ($array[0] == $num_to_find) {
        return "The number to find is: index: 0, value: $array[0]";
    }

    $i = 1;
    while ($i < count($array) && $array[$i] <= $num_to_find) {
        $i *= 2;
    }

    return $binary_search($array, intdiv($i, 2), min($i, count($array) - 1), $num_to_find);
};

// Example usage of exponential search
echo "Exponential search: " .$exponential_search($sorted_array, $binary_search, $num_to_find)  ."\n" ;
