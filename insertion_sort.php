<?php

/**
 * The running time of insertion sort is O(n^2)
 */

/**
 * Insertion sort works by using an outer iterator to look at each value and then using an inner iterator to put the
 * value in the correct spot.  First, the outer iterator looks at each element, starting at the second one (the first
 * element is trivially sorted).  The inner iterator then looks at all previous elements, comparing them to the element
 * on their left.  If the element to the left is greater than the current element, they are swapped.  When the outer
 * iterator finishes, the input array is sorted.
 *
 * i.e.
 * If the input array is: [5, 7, 1, 2]
 *
 * <<< OUTER FOR LOOP BEGIN >>>
 *
 * Iteration 1:
 * $i = 1;
 * $j = 1
 *
 *      <<< INNER FOR LOOP BEGIN >>>
 *
 *      <<< INNER FOR LOOP TERMINATION: 5 is less than 7, nothing happens >>>
 *
 * Iteration 2:
 * $i = 2
 * $j = 2
 *
 *      <<< INNER FOR LOOP BEGIN >>>
 *
 *      Iteration 1:
 *      $temp = 1
 *      $input = [5, 7, 7, 2]
 *      $input = [5, 1, 7, 2]
 *      $j = 1
 *
 *      Iteration 2:
 *      $temp = 1
 *      $input = [5, 5, 7, 2]
 *      $input = [1, 5, 7, 2]
 *      $j = 0
 *
 *      <<< INNER FOR LOOP TERMINATION: $j == 0 >>>
 *
 * Iteration 3:
 * $i = 3
 * $j = 3
 *
 *      <<< INNER FOR LOOP BEGIN >>>
 *
 *      Iteration 1:
 *      $temp = 2
 *      $input = [1, 5, 7, 7]
 *      $input = [1, 5, 2, 7]
 *      $j = 2
 *
 *      Iteration 2:
 *      $temp = 2
 *      $input = [1, 5, 5, 7]
 *      $input = [1, 2, 5, 7]
 *      $j = 1
 *
 *      <<< INNER FOR LOOP TERMINATION: 1 is not greater than 2 >>>
 *
 * <<< OUTER FOR LOOP TERMINATION: $i == 4 >>>
 *
 * @param SplFixedArray $input
 * @see https://en.wikipedia.org/wiki/Insertion_sort
 */
function insertionSort(\SplFixedArray &$input)
{
    if (count($input) <= 0) {
        throw new \InvalidArgumentException('The input array cannot be empty');
    }

    if (count($input) === 1) {
        return;
    }

    for ($i = 1; $i < count($input); $i++) {
        $j = $i;

        while ($j > 0 && $input[$j - 1] > $input[$j]) {
            $temp = $input[$j];
            $input[$j] = $input[$j - 1];
            $input[$j - 1] = $temp;
            $j--;
        }
    }
}

$array1 = \SplFixedArray::fromArray([10, 9, 8, 7, 6, 5, 4, 3, 2, 1]);
$array2 = \SplFixedArray::fromArray([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);
$array3 = \SplFixedArray::fromArray(array_fill(0, 10, 1));

printf('$array1 prior to insertion sort: ' . json_encode($array1));
print PHP_EOL;
insertionSort($array1);
printf('$array1 after insertion sorting: ' . json_encode($array1));
print PHP_EOL;

printf('$array2 prior to insertion sort: ' . json_encode($array2));
print PHP_EOL;
insertionSort($array2);
printf('$array2 after insertion sorting: ' . json_encode($array2));
print PHP_EOL;

printf('$array3 prior to insertion sort: ' . json_encode($array3));
print PHP_EOL;
insertionSort($array3);
printf('$array3 after insertion sorting: ' . json_encode($array3));
print PHP_EOL;