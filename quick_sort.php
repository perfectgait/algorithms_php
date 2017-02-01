<?php

/**
 * The running time of quick sort is O(n log n)
 */

/**
 * Quick sort works by first examining the inputs to see if the base case is met.  The base case occurs when the range
 * of the $left and $right values is 0 or 1.  If so the array range either has 0 or 1 entries and is sorted trivially.
 * In the non-base case a pivot index is chosen and then the element at the pivot index and the element at the left
 * index are swapped.  Next the input array is partitioned between the left and right indexes.  After partitioning is
 * done, the element at the pivot index is in its final place.  Since the element at the pivot index is in its final
 * place, quick sort gets called again on the left and right halves (around the pivot index).  This continues
 * recursively until the input array is sorted.
 *
 * i.e.
 * If the input array is: [5, 7, 1, 2]
 *
 * $input = [5, 7, 1, 2]
 * $left = 0
 * $right = 3
 * Is $right(3) - $left(0) <= 0? No
 * $pivotIndex = 0
 * $input = [5, 7, 1, 2] after swapping $input[$left] with $input[$pivotIndex]
 * $partition = 2
 * $input = [2, 1, 5, 7] after partition() call
 *
 *      <<< RECURSIVE CALL TO quickSort(0, 1) BEGIN >>>
 *
 *      Is $right(1) - $left(0) <= 0? No
 *      $pivotIndex = 0
 *      $input = [2, 1, 5, 7] after swapping $input[$left] with $input[$pivotIndex]
 *      $partition = 1
 *      $input = [1, 2, 5, 7] after partition() call
 *
 *          <<< RECURSIVE CALL TO quickSort(0, 0) BEGIN >>>
 *
 *          Is $right(0) - $left(0) <= 0? Yes
 *          return
 *
 *          <<< RECURSIVE CALL TO quickSort(0, 0) TERMINATION >>>
 *
 *          <<< RECURSIVE CALL TO quickSort(2, 1) BEGIN >>>
 *
 *          Is $right(1) - $left(2) <= 0? Yes
 *          return
 *
 *          <<< RECURSIVE CALL TO quickSort(2, 1) TERMINATION >>>
 *
 *      <<< RECURSIVE CALL TO quickSort(0, 1) TERMINATION >>>
 *
 *      <<< RECURSIVE CALL TO quickSort(3, 3) BEGIN >>>
 *
 *      Is $right(3) - $left(3) <= 0? Yes
 *      return
 *
 *      <<< RECURSIVE CALL TO quickSort(3, 3) TERMINATION >>>
 *
 * Final Value: [1, 2, 5, 7]
 *
 * @param SplFixedArray $input
 * @param int $left
 * @param int $right
 * @see https://en.wikipedia.org/wiki/Quicksort
 */
function quickSort(\SplFixedArray &$input, $left, $right)
{
    // Base case
    if ($right - $left <= 0) {
        return;
    }

    $pivotIndex = choosePivotIndex($input, $left, $right);
    $temp = $input[$left];
    $input[$left] = $input[$pivotIndex];
    $input[$pivotIndex] = $temp;

    $partition = partition($input, $left, $right);
    quickSort($input, $left, $partition - 1);
    quickSort($input, $partition + 1, $right);
}

/**
 * Chose the pivot index for the quick sort method using the median-of-three method.  This compares the left, middle and
 * right values to see which one is the median.  The index that is returned references the median value.
 *
 * i.e.
 * If the $left is 6, the $middle is 3 and the $right is 9 then $left will be used.
 *
 * @param SplFixedArray $input
 * @param int $left
 * @param int $right
 * @return int
 * @see http://stackoverflow.com/questions/7559608/median-of-three-values-strategy
 */
function choosePivotIndex(\SplFixedArray $input, $left, $right)
{
    // Use the median of three method
    $middleIndex = (int)floor(($right - $left) / 2);

    if (($input[$left] <= $input[$middleIndex] && $input[$middleIndex] <= $input[$right]) || ($input[$left] >= $input[$middleIndex] && $input[$middleIndex] >= $input[$right])) {
        return $middleIndex;
    }

    if (($input[$middleIndex] <= $input[$left] && $input[$left] <= $input[$right]) || ($input[$middleIndex] >= $input[$left] && $input[$left] >= $input[$right])) {
        return $left;
    }

    return $right;
}

/**
 * Partition a section of an input array.  This works by iterating over the $left+1 - $right elements in the array and
 * comparing each value to the pivot element (which is located at index $left in the array).  If the value is less than
 * the pivot index it gets swapped with the element at the current write index($i).  The write index($i) is then
 * increased by one.  After going through all of the elements the section of the array will contain, from left to right,
 * the pivot element, all elements that are less than the pivot elements and then all elements which are greater than
 * the pivot element.  The write index will also be pointing to the last found value which is less than the pivot
 * element.  The pivot element and the element at the write index are then swapped.  This guarantees that the pivot
 * element is in its final place because all elements to its left will be less than itself and all elements to the right
 * will be greater than itself.  The partition elements final resting index is returned so that the quick sort method
 * does not attempt to sort that element again.
 *
 * i.e.
 * If the input array is: [5, 7, 1, 2], $left is 0 and $right is 3
 *
 * $i = 1
 * $pivotElement = 5
 *
 * <<< FOR LOOP BEGIN >>>
 *
 * Iteration 1:
 * $j = 1
 * Is $input[$j](7) <= $pivotElement(5)? No
 *
 * Iteration 2:
 * $j = 2
 * Is $input[$j](1) <= $pivotElement(5)? yes
 * $input = [5, 1, 7, 2] after swapping $input[$i] and $input[$j]
 * $i = 2
 *
 * Iteration 3:
 * $j = 3
 * Is $input[$j](2) <= $pivotElement(5)? Yes
 * $input = [5, 1, 2, 7] after swapping $input[$i] and $input[$j]
 * $i = 3
 *
 * <<< FOR LOOP TERMINATION: $j > $right >>>
 *
 * $input = [2, 1, 5, 7] after swapping $input[$left] and $input[$i - 1]
 * As we can see, the 5 is in its final place.
 *
 * return 2
 *
 * @param SplFixedArray $input
 * @param int $left
 * @param int $right
 * @return int
 */
function partition(\SplFixedArray &$input, $left, $right)
{
    $i = $left + 1;
    $pivotElement = $input[$left];

    for ($j = $left + 1; $j <= $right; $j++) {
        if ($input[$j] < $pivotElement) {
            $temp = $input[$j];
            $input[$j] = $input[$i];
            $input[$i] = $temp;
            $i++;
        }
    }

    $input[$left] = $input[$i - 1];
    $input[$i - 1] = $pivotElement;

    return $i - 1;
}

$array1 = \SplFixedArray::fromArray([10, 9, 8, 7, 6, 5, 4, 3, 2, 1]);
$array2 = \SplFixedArray::fromArray([1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);
$array3 = \SplFixedArray::fromArray(array_fill(0, 10, 1));

printf('$array1 prior to quick sort: ' . json_encode($array1->toArray()));
print PHP_EOL;
quickSort($array1, 0, count($array1) - 1);
printf('$array1 after quick sorting: ' . json_encode($array1->toArray()));
print PHP_EOL;

printf('$array2 prior to quick sort: ' . json_encode($array2->toArray()));
print PHP_EOL;
quickSort($array2, 0, count($array2) - 1);
printf('$array2 after quick sorting: ' . json_encode($array2->toArray()));
print PHP_EOL;

printf('$array3 prior to quick sort: ' . json_encode($array3->toArray()));
print PHP_EOL;
quickSort($array3, 0, count($array3) - 1);
printf('$array3 after quick sorting: ' . json_encode($array3->toArray()));
print PHP_EOL;
