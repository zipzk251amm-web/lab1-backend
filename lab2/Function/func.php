<?php
// Функція для обчислення факторіалу (x!)
function factorial($n) {
    if ($n < 0) return null;
    if ($n == 0 || $n == 1) return 1;
    $result = 1;
    for ($i = 2; $i <= $n; $i++) {
        $result *= $i;
    }
    return $result;
}

// Власна функція тангенса (my_tg)
function my_tg($x) {
    return tan($x);
}

// Функція синуса
function my_sin($x) {
    return sin($x);
}

// Функція косинуса
function my_cos($x) {
    return cos($x);
}

// Функція тангенса (стандартна)
function my_tan($x) {
    return tan($x);
}
?>