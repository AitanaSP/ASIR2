<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Busqueda Pelis</title>
</head>
<body>
    
<?php
$nomnum_pelis = array(
    "1" => "El Padrino",
    "2" => "Titanic",
    "3" => "Avatar",
    "4" => "La Guerra de las Galaxias",
    "5" => "Jurassic Park",
    "6" => "El Señor de los Anillos",
    "7" => "Forrest Gump",
    "8" => "Matrix",
    "9" => "Gladiator",
    "10" => "Piratas del Caribe"
);

?>

<form method="post" action="">
    <label for="nombre">Introduce el titulo de la pelicula:</label>
    <input type="text" id="nombre" name="nombre" min="1" max="50" required>
    <input type="submit" value="Buscar Película">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $encontrado = false;

    foreach ($nomnum_pelis as $num => $titulo) {
        if (stripos($titulo, $nombre) !== false) {
            echo "Película encontrada: " . $titulo . " (Número: " . $num . ")<br>";
            $encontrado = true;
        }
    }

    if (!$encontrado) {
        echo "No se encontró ninguna película con ese título.";
    }
}
?>
</body>
</html>