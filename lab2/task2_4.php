<?php
$users = [
    'Андрій' => 25,
    'Максим' => 30,
    'Олена' => 22,
];

function sortArray($array, $by) {
    if ($by === 'name') {
        ksort($array);
    } elseif ($by === 'age') {
        asort($array);
    }
    return $array;
}

$byName = sortArray($users, 'name');
$byAge = sortArray($users, 'age');

echo "Сортування за ім'ям:<br>";
print_r($byName);
echo "<br>Сортування за віком:<br>";
print_r($byAge);
?>