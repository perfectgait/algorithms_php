<?php

/**
 * The running time of merge sort is O(n log n)
 */

/**
 * Merge sort works by recursively sorting halves of the input array and combining the sorted halves.  When the base
 * case (an input with one element) is encountered, it is returned.  Before the first merge happens, there are two arrays
 * with one element each.  After the first merge, there is one array with 2 elements, sorted.  Before the second merge
 * happens, there are two arrays with two elements each.  After the second merge, there is one array with 4 element,
 * sorted.  And so on and so forth.
 *
 * i.e.
 * If the input array is: [5, 7, 1, 2]
 *
 * $input = [5, 7, 1, 2]
 * Is count of $input <= 1? No
 * $midway = 2
 * $left = <<< RECURSIVE CALL TO mergeSort([5, 7]) >>>
 *
 *      <<< RECURSIVE CALL TO mergeSort([5, 7]) BEGIN >>>
 *
 *      $input = [5, 7]
 *      Is count of $input <= 1? No
 *      $midway = 1
 *      $left = <<< RECURSIVE CALL TO mergeSort([5])
 *
 *          <<< RECURSIVE CALL TO mergeSort([5]) BEGIN >>>
 *
 *          $input = [5]
 *          Is count of $input <= 1? Yes
 *          return [5]
 *
 *          <<< RECURSIVE CALL TO mergeSort([5]) TERMINATION >>>
 *
 *      $left = [5] After the recursive call
 *      $right = <<< RECURSIVE CALL TO mergeSort([7])
 *
 *          <<< RECURSIVE CALL TO mergeSort([7]) BEGIN >>>
 *
 *          $input = [7]
 *          Is count of $input <= 1? Yes
 *          return [7]
 *
 *          <<< RECURSIVE CALL TO mergeSort([7]) TERMINATION >>>
 *
 *      $right = [7] After the recursive call
 *      return [5, 7] After call to mergeArrays
 *
 *      <<< RECURSIVE CALL TO mergeSort([5, 7]) TERMINATION >>>
 *
 * $left = [5, 7] After the recursive call
 * $right = <<< RECURSIVE CALL TO mergeSort([1, 2]) >>>
 *
 *      <<< RECURSIVE CALL TO mergeSort([1, 2]) BEGIN >>>
 *
 *      $input = [1, 2]
 *      Is count of $input <= 1? No
 *      $midway = 1
 *      $left = <<< RECURSIVE CALL TO mergeSort([1]) >>>
 *
 *          <<< RECURSIVE CALL TO mergeSort([1]) BEGIN >>>
 *
 *          $input = [1]
 *          Is count of $input <= 1? Yes
 *          return [1]
 *
 *          <<< RECURSIVE CALL TO mergeSort([1]) TERMINATION >>>
 *
 *      $left = [1] After the recursive call
 *      $right = <<< RECURSIVE CALL TO mergeSort([2]) >>>
 *
 *          <<< RECURSIVE CALL TO mergeSort([2]) BEGIN >>>
 *
 *          $input = [2]
 *          Is count of $input <= 1? Yes
 *          return [2]
 *
 *          <<< RECURSIVE CALL TO mergeSort([2]) TERMINATION >>>
 *
 *      $right = [2] After the recursive call
 *      return [1, 2] After call to mergeArrays
 *
 *      <<< RECURSIVE CALL TO mergeSort([1, 2]) TERMINATION >>>
 *
 * $right = [1, 2] After the recursive call
 * return [1, 2, 5, 7] After call to mergeArrays
 *
 * Final Value: [1, 2, 5, 7]
 *
 * @param int[] $input
 * @return int[]
 */
function mergeSort(array $input)
{
    // Base case
    if (count($input) <= 1) {
        return $input;
    }

    $midway = floor(count($input) / 2);
    $left = mergeSort(array_slice($input, 0, $midway));
    $right = mergeSort(array_slice($input, $midway, count($input) - $midway));

    return mergeArrays($left, $right);
}

/**
 * Merging the two sorted arrays works by initializing two loop counters to 0 and comparing the values at the loop
 * counters in each array.  The value in the array that contains the smaller value at the current loop counter is added
 * to the new, sorted array.  The loop counter associated with the array that contained the smaller value is then
 * increased by 1.  This continues until the end of one of the arrays is reached.  At this point the sorted array
 * contains all of the values from one of the arrays and none/some of the values from the other array.  All of the
 * values from the array that were not added to the sorted array are now appended to the end.
 * 
 * i.e.
 * If the input arrays are [1, 2] and [5, 7]
 * 
 * $sorted = []
 * $i = 0
 * $j = 0
 * 
 * <<< WHILE LOOP BEGIN >>>
 * 
 * Iteration 1:
 * Is $array1[$i](1) <= $array2[$j](5)? Yes
 * $sorted = [1]
 * $i = 1
 * 
 * Iteration 2:
 * Is $array1[$i](2) <= $array2[$j](5)? Yes
 * $sorted = [1, 2]
 * $i = 2
 * 
 * <<< WHILE LOOP TERMINATION: $i == count($array1) >>>
 * 
 * Is $i(2) < count($array1)(2)? No
 * 
 * <<< FOR LOOP BEGIN >>>
 * 
 * Iteration 1:
 * $k = 0
 * $sorted = [1, 2, 5]
 * 
 * Iteration 2:
 * $k = 1
 * $sorted = [1, 2, 5, 7]
 * 
 * <<< FOR LOOP TERMINATION: $k == count($array2) >>>
 * 
 * return [1, 2, 5, 7]
 * 
 * Final Value: [1, 2, 5, 7]
 *
 * @param int[] $array1
 * @param int[] $array2
 * @return int[]
 */
function mergeArrays(array $array1, array $array2)
{
    $sorted = [];
    $i = 0;
    $j = 0;

    while ($i < count($array1) && $j < count($array2)) {
        if ($array1[$i] <= $array2[$j]) {
            $sorted[] = $array1[$i];
            $i++;
        } else {
            $sorted[] = $array2[$j];
            $j++;
        }
    }

    if ($i < count($array1)) {
        for ($k = $i; $k < count($array1); $k++) {
            $sorted[] = $array1[$k];
        }
    } else {
        for ($k = $j; $k < count($array2); $k++) {
            $sorted[] = $array2[$k];
        }
    }

    return $sorted;
}

$array1 = [10, 9, 8, 7, 6, 5, 4, 3, 2, 1];
$array2 = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
$array3 = array_fill(0, 10, 1);

printf('$array1 prior to merge sort: ' . json_encode($array1));
print PHP_EOL;
$result1 = mergeSort($array1);
printf('$array1 after merge sorting: ' . json_encode($result1));
print PHP_EOL;

printf('$array2 prior to merge sort: ' . json_encode($array2));
print PHP_EOL;
mergeSort($array2);
printf('$array2 after merge sorting: ' . json_encode($array2));
print PHP_EOL;

printf('$array3 prior to merge sort: ' . json_encode($array3));
print PHP_EOL;
mergeSort($array3);
printf('$array3 after merge sorting: ' . json_encode($array3));
print PHP_EOL;
