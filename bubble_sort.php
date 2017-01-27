<?php

/**
 * The running time of bubble sort is O(n^2)
 */

/**
 * Bubble sort works by going through the input array and comparing side-by-side elements to each other.  If the element
 * on the left is greater than the element on the right, the elements are swapped.  At the end of each inner for loop
 * the value of $n is decreased because we know that the last $n - 1 elements are in their final place.  This process
 * continues until there are no more swaps, indicating the array is now sorted.
 *
 * i.e.
 * If the input array is: [5, 7, 1, 2]
 *
 * $n = 3
 *
 * <<< DO/WHILE LOOP BEGIN >>>
 *
 * Iteration 1:
 * $swapped = false
 *
 *      <<< FOR LOOP BEGIN >>>
 *
 *      Iteration 1:
 *      $i = 0
 *      Is $input[0](5) > $input[1](7)? No
 *
 *      Iteration 2:
 *      $i = 1
 *      Is $input[1](7) > $input[2](1)? Yes
 *      $temp = 1
 *      $input = [5, 7, 7, 2]
 *      $input = [5, 1, 7, 2]
 *      $swapped = true
 *
 *      Iteration 3:
 *      $i = 2
 *      Is $input[2](7) > $input[3](2)? Yes
 *      $temp = 2
 *      $input = [5, 1, 7, 7]
 *      $input = [5, 1, 2, 7]
 *      $swapped = true
 *
 *      <<< FOR LOOP TERMINATION: $i == $n >>>
 *
 * $swapped = false
 * $n = 2
 *
 *      <<< FOR LOOP BEGIN >>>
 *
 *      Iteration 1:
 *      $i = 0
 *      Is $input[0](5) > $input[1](1)? Yes
 *      $temp = 1
 *      $input = [5, 5, 2, 7]
 *      $input = [1, 5, 2, 7]
 *      $swapped = true
 *
 *      Iteration 2:
 *      $i = 1
 *      Is $input[1](5) > $input[2](2)? Yes
 *      $temp = 2
 *      $input = [1, 5, 5, 7]
 *      $input = [1, 2, 5, 7]
 *      $swapped = true
 *
 *      <<< FOR LOOP TERMINATION: $i == $n >>>
 *
 * $swapped = false
 * $n = 1
 *
 *      <<< FOR LOOP BEGIN >>>
 *
 *      Iteration 1:
 *      $i = 0
 *      Is $input[0](1) > $input[1](2)? No
 *
 *      <<< FOR LOOP TERMINATION: $i == $n >>>
 *
 * <<< DO/WHILE LOOP TERMINATION: $swapped is false >>>
 *
 * Final Value: [1, 2, 5, 7]
 *
 * @param SplFixedArray $input
 * @see https://en.wikipedia.org/wiki/Bubble_sort
 */
function bubbleSort(\SplFixedArray &$input)
{
    if (count($input) <= 0) {
        throw new \InvalidArgumentException('The input array cannot be empty');
    }

    if (count($input) === 1) {
        return;
    }

    $n = count($input) - 1;

    do {
        $swapped = false;

        for ($i = 0; $i < $n; $i++) {
            if ($input[$i] > $input[$i + 1]) {
                $temp = $input[$i + 1];
                $input[$i + 1] = $input[$i];
                $input[$i] = $temp;
                $swapped = true;
            }
        }

        $n--;
    } while ($swapped);
}

$array1 = \SplFixedArray::fromArray([10, 9, 8, 7, 6, 5, 4, 3, 2, 1]);
$array2 = \SplFixedArray::fromArray([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);
$array3 = \SplFixedArray::fromArray(array_fill(0, 10, 1));

printf('$array1 prior to bubble sort: ' . json_encode($array1));
print PHP_EOL;
bubbleSort($array1);
printf('$array1 after bubble sorting: ' . json_encode($array1));
print PHP_EOL;

printf('$array2 prior to bubble sort: ' . json_encode($array2));
print PHP_EOL;
bubbleSort($array2);
printf('$array2 after bubble sorting: ' . json_encode($array2));
print PHP_EOL;

printf('$array3 prior to bubble sort: ' . json_encode($array3));
print PHP_EOL;
bubbleSort($array3);
printf('$array3 after bubble sorting: ' . json_encode($array3));
print PHP_EOL;
