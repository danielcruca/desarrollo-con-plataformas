<?php
// http://localhost/libreria/api/v1/public/index.php/libros
// http://localhost/libreria/api/v1/public/index.php/holamundo
// http://localhost/libreria/api/v1/public/index.php/holamundo?nombre=Messi
require_once 'controllers/LibrosController.php';
// Obtener el método de la solicitud
$method = $_SERVER['REQUEST_METHOD'];

// Obtener la ruta solicitada y quitar 'public' si es necesario
$requestUri = trim(str_replace('/libreria/api/v1/public', '', $_SERVER['REQUEST_URI']), '/');

// Separar la ruta en segmentos
// Quitar los parámetros de la URL para que no interfieran con la ruta
$requestUriWithoutQuery = strtok($requestUri, '?');
$segments = explode('/', $requestUriWithoutQuery);


// Obtener parámetros de la URL (si los hay)
$queryString = $_SERVER['QUERY_STRING'] ?? '';
parse_str($queryString, $queryParams); // CONVIERTE LOS QUERY STRING EN UN ARRAY.
$nombre = $queryParams['nombre'] ?? null;


if (isset($segments[1]) && $segments[1] == "libro") {

    switch ($method) {
        case 'GET':

            $libros = new  LibrosController();
            $libros->ObtenerTodos();
            
            
            $libros1 = new  LibrosController();
            $libros1->ObtenerTodos();
           
            break;

            case 'POST':
              
                    echo json_encode(value: ['Alert' => 'llamando al POST en libro']);
                break;
        default:
            // Método no permitido
            header('HTTP/1.1 405 Method Not Allowed');
            echo json_encode(['error' => 'Método no permitido']);
            break;
    }
}



// Manejo de la ruta "holamundo"
if (isset($segments[1]) && $segments[1] == "holamundo") {

    switch ($method) {
        case 'GET':
            if ($nombre != "") {
                echo json_encode(['Alert' => 'Hola: ' . $nombre]);
            } else {
                echo json_encode(['Alert' => 'Llamando GET sin parámetros']);
            }
            break;

            case 'POST':
              
                    echo json_encode(value: ['Alert' => 'llamando al POST']);
                break;
        default:
            // Método no permitido
            header('HTTP/1.1 405 Method Not Allowed');
            echo json_encode(['error' => 'Método no permitido']);
            break;
    }
} 




