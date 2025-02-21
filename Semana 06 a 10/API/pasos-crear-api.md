# Creación de una API en PHP

Este documento explica los pasos necesarios para crear una estructura básica de una API en PHP.

---

## 📂 Estructura de carpetas

1. Crear un folder llamado **libreria-api** en `C:\xampp\htdocs` (puede usar cualquier otro nombre).
2. Dentro de **libreria-api**, crear la siguiente estructura de folders:

```
C:.
├───public
│   └───error
└───src
    ├───controllers
    ├───db
    └───models
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

### 1️⃣ `public/error/response.html`

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

### 3️⃣ `src/routes.php`

```php
<?php

// ENDPOINTS DISPONIBLES:
// - http://localhost/libreria-api/public/index.php/holamundo
// - http://localhost/libreria-api/public/index.php/holamundo?nombre=Messi

$method = $_SERVER['REQUEST_METHOD'];
$path = trim($_SERVER['PATH_INFO'], '/');
$segments = explode('/', $path);
$queryString = $_SERVER['QUERY_STRING'];
parse_str($queryString, $queryParams);
$nombre = isset($queryParams['nombre']) ? $queryParams['nombre'] : null;

if ($path == "holamundo") {
    switch ($method) {
        case 'GET':
            if ($nombre != "") {
                echo json_encode(['Alert' => 'Hola: ' . $nombre]);
            } else {
                echo json_encode(['Alert' => 'Llamando GET sin parámetros']);
            }
            break;
        default:
            Response::json(['error' => 'Método no permitido'], 405);
    }
} else {
    include "error/response.html";
}

?>
```

