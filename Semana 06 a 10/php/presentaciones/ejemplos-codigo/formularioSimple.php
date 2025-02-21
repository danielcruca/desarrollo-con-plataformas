<!DOCTYPE html>
<html>
<head>
    <title>Ejemplo</title>
</head>
<body>
    <h1>Saludo a persona</h1>

    <?php


    // Verificar si se envió el formulario
    if (isset($_POST["enviar-informacion"])) {
        // Obtener el nombre enviado desde el formulario
        $nombre = $_POST['nombre'];

        // Mostrar el saludo personalizado con un html incrustado.
        echo "<p>Hola $nombre</p>";
    }
    ?>

    <form method="post" action="#">
        <label for="nombre">Ingresa tu nombre:</label>
        <input type="text" name="nombre" required>

        <button type="submit" name="enviar-informacion">Saludar</button>
    </form>
</body>
</html>
