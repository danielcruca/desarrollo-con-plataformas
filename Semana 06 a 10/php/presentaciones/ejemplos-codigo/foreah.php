<!DOCTYPE html>
<html>

<head>
</head>

<body>
    <?php
    // Arreglo asociativo
    $persona = array(
        'nombre' => 'Juan',
        'edad' => 25,
        'ciudad' => 'Madrid'
    );
    ?>

    <ul>
        <?php foreach ($persona as $llave => $valor) : ?>
            <li><?php echo ($llave); ?> - <?php echo $valor; ?></li>
        <?php endforeach; ?>
    </ul>
</body>

</html>