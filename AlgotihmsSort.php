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
$unsorted_array = [3, 4, 1, 0, 0, 4, 3, 2, 99 , 0 ,999999 ,957 , 433 ,7 , 4, 1 ,2221 ,1203359 ];

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

/**
 * Tree sort
 *
 * @param array $array The array to be sorted
 * @return array The sorted array
 */

class Tree_node {
    public $key ;
    public $left ;
    public $right ;
    function __construct($key)
    {
        $this->key = $key ;
        $this->left = null ;
        $this->right = null ;
    }

public function insert(Tree_node $node): void
{
    if ($node->key < $this->key)
    {
        if ($this->left !== null)
        {
            $this->left->insert($node);
        } else
        {
            $this->left = $node ;
        }
    } else
    {
        if ($this->right !== null)
        {
            $this->right->insert($node);
        } else
        {
            $this->right = $node ;
        }
    }
}
public function traverse(callable $visitor): void
{
    $this->left?->traverse($visitor);
    $visitor($this) ;
    $this->right?->traverse($visitor);
}
}
class Tree_sort
{
    public static function sort(array $array): array
    {
        if (empty($array)) {
            return [];
        }

        $root = new Tree_node($array[0]);
        for ($i = 1; $i < count($array); $i++) {
            $root->insert(new Tree_node($array[$i]));
        }
        $sorted_array = [];
        $root->traverse(function ($node) use (&$sorted_array) {
            $sorted_array[] = $node->key;
        });
        return $sorted_array;
    }
}

$sortedArray = Tree_sort::sort($unsorted_array);
print_r($sortedArray);