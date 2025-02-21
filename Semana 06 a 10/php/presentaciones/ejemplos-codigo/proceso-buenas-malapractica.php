<?php

// ----------------------------------------------------------------------------------------------------
// Buena practica al declarar variables
// ----------------------------------------------------------------------------------------------------
$userId = 123;
$userName = "lbonilla";

// ----------------------------------------------------------------------------------------------------
// mala practica al declarar variables
// ----------------------------------------------------------------------------------------------------
$user = 123;
$a  = "Cartago";






// ----------------------------------------------------------------------------------------------------
// Buena practica al implementar codigo
// ----------------------------------------------------------------------------------------------------

// Declarar variables al principio e inicializada.
$resultado = 0;

// Realizar la operación
switch ($operacion) {
    case 'suma':
        $resultado = $numero1 + $numero2;
        break;
    case 'resta':
        $resultado = $numero1 - $numero2;
        break;
        // Otros casos de operación aquí

    default:
        // Mensaje por defecto si la operación no es reconocida
        echo "Operación no válida";
        break;
}


// Ejemplo de uso
echo $resultado;


// ----------------------------------------------------------------------------------------------------
// mala practica al implementar codigo
// ----------------------------------------------------------------------------------------------------

// Ejemplo mala pratica.

$a=10;$b=5;$operacion='suma';$resultado=0;switch($operacion){case'suma':$resultado=$a+$b;break;case'resta':$resultado=$a-$b;break;default:echo"Operación no válida";break;}echo $resultado;







// ----------------------------------------------------------------------------------------------------
// IF buena practica
// ----------------------------------------------------------------------------------------------------


// Declarar variables al principio
$edad = 25;

// Utilizar if con formato claro y legible
if ($edad >= 18) {
    echo "Eres mayor de edad.";
} else {
    echo "Eres menor de edad.";
}


// ----------------------------------------------------------------------------------------------------
// IF MALA practica
// ----------------------------------------------------------------------------------------------------

$edad=25;if($edad>=18){echo"Eres mayor de edad.";}else{echo"Eres menor de edad.";}




?>