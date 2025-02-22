<?php

// Operador de Asignación
$numero_asignado = 10;

// Operador de Igualdad
$valor_1 = 5;
$valor_2 = "5";

if ($valor_1 == $valor_2) {
    echo "Igualdad en valor usando ==.<br>";
} else {
    echo "Desigualdad en valor usando ==.<br>";
}

// Operador de Identidad
$numero_1 = 8;
$numero_2 = "8";

if ($numero_1 === $numero_2) {
    echo "Igualdad en valor y tipo usando ===.<br>";
} else {
    echo "Desigualdad en valor y tipo usando ===.<br>";
}

?>
