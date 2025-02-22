# Creación de una API en PHP

Este documento explica los pasos necesarios para crear una estructura básica de una API en PHP.

---

## 📂 Estructura de carpetas

1. Crear un folder llamado **libreria** en `C:\xampp\htdocs` (puede usar cualquier otro nombre).
2. Dentro de **libreria**, crear la siguiente estructura de folders:

```
C:\xampp\htdocs\libreria
├───api
│   ├───v1
│   │   ├───public
│   │   ├───index.php
│   │   └───src
│   │       ├───controllers
│   │       ├───db
│   │       └───models
```

3. Dentro de **public**, crear:
   - Un folder llamado **error**, y dentro de este, un archivo llamado `response.html`.
   - Un archivo llamado `index.php`.

4. Dentro de **src**, crear:
   - Un folder llamado **controllers**.
   - Un folder llamado **db**.
   - Un folder llamado **models**.
   - Un archivo llamado `routes.php`.

---

## 📄 Contenido de los Archivos

### 1️⃣ `libreria/api/v1/public/error/response.html`

```html
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
        <p>Revisa el URL e intenta de nuevo.</p>
    </div>
</body>
</html>
```

### 2️⃣ `public/index.php`

```php
<?php

require '../src/routes.php';

?>
```

### 3️⃣ `libreria/api/v1/src/routes.php`

```php
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

```

