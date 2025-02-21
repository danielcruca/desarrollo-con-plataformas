<?php
// Nombre o ID del Pokémon que deseas buscar
$pokemonName = "pikachu";
// URL de la API de Pokémon
$url = "https://pokeapi.co/api/v2/pokemon/{$pokemonName}";

// Realizar la solicitud GET usando file_get_contents
$response = file_get_contents($url);

// Verificar si la solicitud fue exitosa
if ($response !== FALSE) {
    // Decodificar la respuesta JSON
    $data = json_decode($response, true);

    // Verificar si la decodificación fue exitosa
    if ($data) {
        // Obtener la información del Pokémon
        $name = $data['name'];
        $id = $data['id'];
        $height = $data['height'];
        $weight = $data['weight'];
        $types = array_map(function($type) {
            return $type['type']['name'];
        }, $data['types']);

        // Mostrar la información del Pokémon
        echo "Información de {$name}:\n";
        echo "ID: {$id}\n";
        echo "Altura: {$height} dm\n";
        echo "Peso: {$weight} hg\n";
        echo "Tipos: " . implode(", ", $types) . "\n";
    } else {
        echo "Error al decodificar los datos del Pokémon.\n";
    }
} else {
    echo "Error al obtener los datos del Pokémon.\n";
}
?>
