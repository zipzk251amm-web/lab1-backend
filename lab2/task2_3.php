<?php
function createArray() {
    $length = rand(3, 7);
    $arr = [];
    for ($i = 0; $i < $length; $i++) {
        $arr[] = rand(10, 20);
    }
    return $arr;
}

function processArrays($arr1, $arr2) {
    $merged = array_merge($arr1, $arr2);
    $unique = array_unique($merged);
    sort($unique);
    return $unique;
}

$arr1 = createArray();
$arr2 = createArray();
$result = processArrays($arr1, $arr2);

echo "Масив 1: " . implode(', ', $arr1) . "<br>";
echo "Масив 2: " . implode(', ', $arr2) . "<br>";
echo "Результат: " . implode(', ', $result);
?>