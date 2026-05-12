<?php
function printDuplicates($arr) {
    $counts = array_count_values($arr);
    $duplicates = array_filter($counts, fn($count) => $count > 1);
    echo "Повторювані елементи: " . implode(', ', array_keys($duplicates));
}

$testArray = [1, 2, 2, 3, 4, 4, 4, 5];
printDuplicates($testArray);
?>