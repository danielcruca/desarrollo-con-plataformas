<?php

// usando switch
$numero = -1;

switch (true) {
    case ($numero == 0):
        echo "Numero igual a cero";
        break;
    case ($numero > 0):
        echo "Numero positivo";
        break;
    default:
        echo "Numero negativo";
        break;
}
?>


<?php

// usando if convencionales
$numero = -1;

if ($numero == 0) {
    echo "Numero igual a cero";
} elseif ($numero > 0) {
    echo "Numero positivo";
} else {
    echo "Numero negativo";
}
?>
