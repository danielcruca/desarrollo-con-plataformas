<?php
// Arreglo indexado
// Recordar que los arreglos inician desde 0
$frutas = array('manzana', 'naranja', 'uva');

// Acceso a elementos por índice
echo $frutas[0];  // manzana
echo $frutas[1];  // plátano
echo $frutas[2];  // uva
echo $frutas[2];  // uva
?>


<?php
// Arreglo asociativo
$persona = array(
    'nombre' => 'Juan',
    'edad' => 25,
    'ciudad' => 'Madrid'
);

// Acceso a elementos por clave
echo $persona['nombre'];  // Juan
echo $persona['edad'];    // 25
echo $persona['ciudad'];  // Madrid
?>