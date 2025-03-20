<?php
// http://localhost/libreria/api/v1/public/index.php/libros
// http://localhost/libreria/api/v1/public/index.php/holamundo?nombre=Messi
require_once 'controllers/LibrosController.php';
require_once "utils/Auth.php";

// seguridad token
//$auth = new Auth();
//$auth->verificarToken();

// Obtener el método de la solicitud
$method = $_SERVER['REQUEST_METHOD'];

// Obtener la ruta solicitada y quitar 'public' si es necesario
$requestUri = trim(str_replace('/libreria/api/v1/public', '', $_SERVER['REQUEST_URI']), '/');

// Separar la ruta en segmentos
// Quitar los parámetros de la URL para que no interfieran con la ruta
$requestUriWithoutQuery = strtok($requestUri, '?');
$segments = explode('/', $requestUriWithoutQuery);
///var_dump($segments);

//var_dump( $_SERVER['QUERY_STRING']);

// Obtener parámetros de la URL (si los hay)
$queryString = $_SERVER['QUERY_STRING'] ?? '';
parse_str($queryString, $queryParams); // CONVIERTE LOS QUERY STRING EN UN ARRAY.
$id = $queryParams['id'] ?? null;

//var_dump($id);

if (isset($segments[1]) && $segments[1] == "libro") {

    switch ($method) {
        case 'GET':
            // ejemplo de endpoint postman.
            // http://localhost/libreria/api/v1/public/index.php/libro?id=5
            // http://localhost/libreria/api/v1/public/index.php/libro
            if ($id != null) {

                $libros = new  LibrosController();
               $libros->obtenerLibro($id);
            } 
            else{
               
                $libros = new  LibrosController();
                $libros->ObtenerTodos();
            }  
            break;

            case 'POST':
                $libros = new  LibrosController();
                $libros->crearLibro();
               // echo json_encode(value: ['Alert' => 'llamando al POST en libro']);
                break;
            case 'PUT':
                $libros = new  LibrosController();
                $libros->actualizarLibro($id);
                break;

            case 'DELETE':
                $libros = new  LibrosController();
                $libros->eliminarLibro(id: $id);
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




