<?php

// Variables de texto (string)
$nombre = "Juan";
echo  "Hola, $nombre!";

// Variables numéricas (integer y float)
$edad = 25;
$precio = 3.99;

// Variables booleanas
$esEstudiante = true;
$tieneDescuento = false;

// Arrays
$colores = array("rojo", "verde", "azul");
$numeros = [1, 2, 3, 4, 5];

// Objetos
class Persona {
    public $nombre;
    public $edad;

    public function __construct($nombre, $edad) {
        $this->nombre = $nombre;
        $this->edad = $edad;
    }
}

$juan = new Persona("Juan", 30);

// Variable nula
$variableNula = null;

// Variables superglobales
$nombreUsuario = $_POST['username']; // Accede a datos enviados por formulario
$idUsuario = $_GET['id']; // Accede a datos en la URL

// Constantes
define("PI", 3.14);
const SALUDO = "Hola, mundo!";

// Imprimir algunas variables para ver su contenido

echo "Edad: " . $edad . "<br>";
echo "Colores: " . implode(", ", $colores) . "<br>";
echo "Nombre de usuario: " . $nombreUsuario . "<br>";
echo "Valor de PI: " . PI . "<br>";
echo "Saludo constante: " . SALUDO . "<br>";
?>
