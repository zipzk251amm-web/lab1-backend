<?php
function generateName($syllables) {
    $name = '';
    $count = rand(2, 3);
    for ($i = 0; $i < $count; $i++) {
        $name .= $syllables[array_rand($syllables)];
    }
    return ucfirst($name);
}

$syllables = ['ба', 'кс', 'му', 'р', 'зі', 'зі', 'ма', 'ля'];
echo "Ім'я для тваринки: " . generateName($syllables);
?>