<?php
// http://localhost/libreria/api/v1/public/index.php/holamundo
// http://localhost/libreria/api/v1/public/index.php/holamundo?nombre=Messi

// Obtener el método de la solicitud
$method = $_SERVER['REQUEST_METHOD'];

// Obtener la ruta solicitada y quitar 'public' si es necesario
$requestUri = trim(str_replace('/libreria/api/v1/public', '', $_SERVER['REQUEST_URI']), '/');
// "index.php/holamundo"
//var_dump($requestUri);


// Separar la ruta en segmentos
// Quitar los parámetros de la URL para que no interfieran con la ruta
$requestUriWithoutQuery = strtok($requestUri, '?');
$segments = explode('/', $requestUriWithoutQuery);
//  { [0]=> string(9) "index.php" [1]=> string(9) "holamundo" }
//var_dump($segments);


// Obtener parámetros de la URL (si los hay)
$queryString = $_SERVER['QUERY_STRING'] ?? '';
//"nombre=Messi"
//var_dump( $_SERVER['QUERY_STRING']);
parse_str($queryString, $queryParams); // CONVIERTE LOS QUERY STRING EN UN ARRAY.
$nombre = $queryParams['nombre'] ?? null;


// Mostrar la ruta solicitada y el parámetro 'nombre' para depuración
//print("Ruta solicitada sin parámetros: " . $requestUriWithoutQuery . "\n");
//print("Segmentos de la ruta: ");
//print_r($segments);
//print("Valor del parámetro 'nombre': " . ($nombre ?? 'No proporcionado') . "\n");

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
        default:
            // Método no permitido
            header('HTTP/1.1 405 Method Not Allowed');
            echo json_encode(['error' => 'Método no permitido']);
            break;
    }
} else {
    // Si no se encuentra la ruta, devolver 404
    http_response_code(404);
    echo json_encode(['error' => 'Ruta no encontrada']);
    exit();
}
