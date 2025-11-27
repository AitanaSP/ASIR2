<?php

include_once 'constantes.php';

function getConexionMySQLi()
{
    $basedatos = 'libros4';

       $conexion = new mysqli("localhost", "root", "", $basedatos);

    if ($conexion->connect_errno) {
        echo "Error al conectar con la base de datos: " . $conexion->connect_error;
        return false;
    }

    return $conexion;
}
function getConexionMySQLi_sin_bbdd()
{
     $conexion = new mysqli("localhost", "root", "", "");

    if ($conexion->connect_errno) {
        echo "Error al conectar con la base de datos: " . $conexion->connect_error;
        return false;
    }

    return $conexion;
}


function crearBBDD_MySQLi($basedatos){
   
    $conexion = getConexionMySQLi();

    if (!$conexion) {
        return false;
    }


    $sql = "CREATE DATABASE IF NOT EXISTS $basedatos";
    $resultado = $conexion->query($sql);

    if (!$resultado) {
        echo "Error al crear la base de datos: " . $conexion->error;
        return false;
    }

    return 0;
}

function crearTablas_MySQLi($basedatos){
 $conexion = getConexionMySQLi();

if (!$conexion) {
    die("No hay conexión con la base de datos.");
}


$sql = "
    CREATE TABLE IF NOT EXISTS libros (
        numero_ejemplar INT(11) NOT NULL AUTO_INCREMENT,
        titulo VARCHAR(50) NOT NULL,
        anyo_edicion INT(11) NOT NULL,
        precio DECIMAL(10,2) NOT NULL,
        fecha_adquisicion DATE NOT NULL,
        PRIMARY KEY (numero_ejemplar)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
";

if (!$conexion->query($sql)) {
    die("Error creando tabla libros: " . $conexion->error);

    $sql = "
    INSERT INTO libros (titulo, anyo_edicion, precio, fecha_adquisicion)
    VALUES 
        ('Harry', 2000, 6.00, '2022-09-06'),
        ('Nieves', 1983, 200.00, '2022-12-01');
";

if (!$conexion->query($sql)) {
    die("Error insertando libros: " . $conexion->error);
}
}



$sql = "
    CREATE TABLE IF NOT EXISTS logins (
        usuario VARCHAR(50) NOT NULL,
        passwd CHAR(32) NOT NULL,
        PRIMARY KEY (usuario)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
";

if (!$conexion->query($sql)) {
    die("Error creando tabla logins: " . $conexion->error);
    $sql = "
    INSERT INTO logins (usuario, passwd)
    VALUES
        ('david', '172522ec1028ab781d9dfd17eaca4427'),
        ('aitana', 'aitana'),
        ('nieves', 'c45f3fc0f92e983dea35e4b15213e6d7');
";

if (!$conexion->query($sql)) {
    die("Error insertando logins: " . $conexion->error);
}
}




$conexion->close();
 return 1;
}

function usuarioCorrecto_MySQLi($usuario, $password)
{
    $conexion = getConexionMySQLi();

    if (!$conexion) {
        return false;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $sql = "SELECT usuario, passwd FROM logins WHERE usuario = '$usuario' AND passwd = '$password'";

        $resultado = $conexion->query($sql);

        if ($resultado && $resultado->num_rows > 0) {
            return true;
        }
    }

    return false;
}

function registrarUsuario_MySQLi($usuario, $password)
{
      $conexion = getConexionMySQLi();

    if (!$conexion) {
        return false;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $sqlreg = "INSERT INTO logins VALUES ('$usuario', '$password')";

        if ($conexion->query($sqlreg)) {
            echo "Usuario registrado correctamente";
        } else {
            echo "Error al registrar usuario: " . $conexion->error;
        }
    }
        
}


function insertarLibro_MySQLi($titulo, $anyo, $precio, $fechaAdquisicion)
{
    $conexion = getConexionMySQLi();

    if (!$conexion) {
        return false;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $sqlreglib = "INSERT INTO libros (titulo, anyo_edicion, precio, fecha_adquisicion) 
                      VALUES ('$titulo', '$anyo', '$precio', '$fechaAdquisicion')";

        if ($conexion->query($sqlreglib)) {
            echo "Libro registrado correctamente";
            return true;
        } else {
            echo "Error al registrar libro: " . $conexion->error;
            return false;
        }
    }
}



function getLibros_MySQLi()
{
	$conexion = getConexionMySQLi();

    if (!$conexion) {
        return false;
    }

    $consulta = "SELECT numero_ejemplar, titulo, anyo_edicion, precio, fecha_adquisicion FROM libros";
    $datos = $conexion->query($consulta);

    if ($datos) {
        // Convertir el resultado a array de objetos (equivalente a FETCH_OBJ)
        $libros = [];
        while ($fila = $datos->fetch_object()) {
            $libros[] = $fila;
        }
        return $libros;
    }

    return false;
}


function getLibrosTitulo_MySQLi()
{
    $conexion = getConexionMySQLi();

    if (!$conexion) {
        return false;
    }

    $consulta = "SELECT titulo, numero_ejemplar FROM libros";
    $datos = $conexion->query($consulta);

    if ($datos) {

        $libros = [];
        while ($fila = $datos->fetch_row()) {
            $libros[] = $fila[0];
        }

        return $libros;
    }

    return false;
    
}

function borrarLibro_MySQLi($numero_ejemplar)
{
   $conexion = getConexionMySQLi();

    if (!$conexion) {
        return false;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $libro = getLibros_MySQLi(); 
        $mensaje = getLibrosPrecio_MySQLi($numero_ejemplar);

        $sql = "DELETE FROM libros WHERE numero_ejemplar = $numero_ejemplar";

        if ($conexion->query($sql)) {
            return $mensaje;
        } else {
            echo "Error al borrar libro: " . $conexion->error;
            return false;
        }
    }
    
   
}

function modificarLibro_MySQLi($numero_ejemplar,$precio)
{
     $conexion = getConexionMySQLi();

    if (!$conexion) {
        return false;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $sql = "UPDATE libros SET precio = $precio WHERE numero_ejemplar = $numero_ejemplar";
        $resultado = $conexion->query($sql);

        return true;

        
}
}

function modificarLibroAnyo_MySQLi($numero_ejemplar,$anyo_edicion)
{
       $conexion = getConexionMYSQLI();
 

    if (is_array($anyo_edicion)) {
        $anyo_edicion = $anyo_edicion[0];
    }
    if (is_array($numero_ejemplar)) {
        $numero_ejemplar = $numero_ejemplar[0];
    }
  
    $consulta = "UPDATE libros SET anyo_edicion = $anyo_edicion WHERE numero_ejemplar = $numero_ejemplar";
     if ($conexion->query($consulta)) {

       $librosanyos = $consulta;
       $libroanyo = $anyo_edicion;
        return $librosanyos;
        return $libroanyo;
     }
}


function arrayFlotante($array) {
   
}




function getLibrosPrecio_MySQLi($libro)
{
   $conexion = getConexionMySQLi();

    if (!$conexion) {
        return false;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {


        $sql = "SELECT precio FROM libros WHERE numero_ejemplar = $libro";
        $resultado = $conexion->query($sql);

    $fila = $resultado->fetch_assoc();

    if ($fila) {
        return $fila['precio'];
    }

    return false; 
    }

}


function getLibrosAnyo_MySQLi($libro)
{
    $conexion = getConexionMySQLi();

    if (!$conexion) {
        return [];
    }

    $consulta = "SELECT numero_ejemplar, titulo, anyo_edicion FROM libros WHERE titulo = '$libro'";
    $datos = $conexion->query($consulta);

    if ($datos) {
        while ($fila = $datos->fetch_array(MYSQLI_ASSOC)) {
            $librosanyos[] = $fila;
        }
        return $librosanyos;
    }

    return false;
  
}


?>
