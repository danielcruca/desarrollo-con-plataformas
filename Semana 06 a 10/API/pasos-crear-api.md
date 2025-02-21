# Paso para crear API.

- Crear estructura de folders.
 1. crear un folder llamado  **libreria-api**(puede usar cualquier otro nombre) en C:\xampp\htdocs
- Crear estructura de folders iniciales.
 1. Dentro de libreria-api(o cualqueir nombre).
   Crear dentro de libreria-api lo siguientes folders:
    1. public
    2. src
- Dentro de **public** crear la siguiente estructura:
    1. error (folder)
        1. Dentro de *error* crear un archivo llamado *response.html*
    3. index.php (archivo)
- Dentro de **scr** crear la siguiente estructura de folders:
    1. controllers (folder)
    2. db (folder)
    3. models (folder)
    4. routes.php (archivo)

La estructura de archivos se deberia de ver algo asi:    

C:.
├───public
│   └───error
└───src
    ├───controllers
    ├───db
    └───models


# Contenido de archivos.

Agregar el siguiente codigo HTML dentro de public/error/response.html

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Error</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            color: #333;
            text-align: center;
            padding: 50px;
        }
        .container {
            display: inline-block;
            text-align: left;
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #e74c3c;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>ERROR</h1>
        <p>Este endpoint no existe.</p>
        <p>Revisa el URL he intente de nuevo.</p>
    </div>
</body>
</html>


Agregar dentro  *public/index.php* el siguiente contenido:

<?php

require '../scr/routes.php'

?>

Agregar dentro de  scr/routes.php  el siguiente contenido:

<?php 

//END POINT PRINCIPAL: http://localhost/libreria-api/public/index.php/holamundo
// END POINT CON UN PARAMETRO: http://localhost/libreria-api/public/index.php/holamundo?nombre=Daniel



/// AQUI EMPIEZA LA LOGICA DE LA API.
 
 

// Manejo de la ruta.
$method = $_SERVER['REQUEST_METHOD'];
//var_dump($method ); //get
// remueve / del inicio




$path = trim($_SERVER['PATH_INFO'], characters: '/');


// Divide la ruta por "/" para obtener el endpoint y el posible parámetro.
$segments = explode('/', $path);

//var_dump($_SERVER);


// Captura la cadena de consulta completa después del "?" (por ejemplo: "id=123&nombre=juan")
$queryString = $_SERVER['QUERY_STRING'];
// Parseamos la cadena de consulta a un arreglo asociativo.
parse_str($queryString, $queryParams);


// Extraemos los parámetros de la consulta
$nombre = isset($queryParams['nombre']) ? $queryParams['nombre'] : null;

var_dump($nombre);

if($path  == "holamundo") {

    switch ($method) {
        case 'GET':

            if($nombre != "")
            {
                echo json_encode(['Alert' => 'Hola: '. $nombre]);
            }
            else
            {
                echo json_encode(['Alert' => 'LLamando get sin parametros']);
            }
           
            break;
        default:
            Response::json(['error' => 'Metodo no permitido'], 405);
    }
}
else{
    include "error/response.html";
}



?>

