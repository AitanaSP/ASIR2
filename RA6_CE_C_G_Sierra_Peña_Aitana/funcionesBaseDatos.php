<?php

include_once 'constantes.php';

function getConexionPDO()
{
    try{
        $conexionPDO = new PDO('mysql:host=localhost;dbname=libros2','root','');
        return $conexionPDO;

    } catch (PDOException $e) {
        echo "Error al conectar con la base de datos: " . $e->getMessage();
        return false;
    }
}

function getConexionPDO_sin_bbdd()
{
        try{
        $conexionPDO = new PDO('mysql:host=localhost;dbname=','root','');
        return $conexionPDO;

    } catch (PDOException $e) {
        echo "Error al conectar con la base de datos: " . $e->getMessage();
        return false;
    }
}

function getConexionMySQLi()
{
       $conexion = new mysqli("localhost", "root", "", "libros2");

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

    // Crear la base de datos
    $sql = "CREATE DATABASE IF NOT EXISTS $basedatos";
    $resultado = $conexion->query($sql);

    if (!$resultado) {
        echo "Error al crear la base de datos: " . $conexion->error;
        return false;
    }

    return true;
}

function crearTablas_MySQLi($basedatos){
  
      $sqlarchivo = file_get_contents('RA6_CE_C_G_Sierra_Peña_Aitana/bbdd/libros.sql');

    if ($sqlarchivo === false) {
        return false;
    }

    if ($conexion->multi_query($sqlarchivo)) {

        while ($conexion->more_results() && $conexion->next_result()) {
        }

        return true;

    } else {
        echo "Error al ejecutar el archivo SQL: " . $conexion->error;
        return false;
    }
}

function crearBBDD($basedatos) {

    $conexionPDO = getConexionPDO();

     $sql = "CREATE DATABASE IF NOT EXISTS $basedatos";
     $resultado = $conexionPDO->query($sql);
}

function crearTablas($basedatos) {
  
    $conexionPDO = getConexionPDO();

    $sqlarchivo = file_get_contents('RA6_CE_C_G_Sierra_Peña_Aitana\bbdd\libros.sql');

    $conexionPDO->exec($sqlarchivo);

    $resultado = $conexionPDO->query($sqlarchivo);
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

function usuarioCorrecto($usuario, $password)
{

    $conexionPDO = getConexionPDO();
    if($_SERVER["REQUEST_METHOD"] == "POST"){

    $sql = "SELECT usuario, passwd FROM logins WHERE usuario = '$usuario' AND passwd = '$password'";

     $resultado = $conexionPDO->query($sql);


    if ($resultado && $resultado->rowCount() > 0) {
        return true;
}
}
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

function registrarUsuario($usuario, $password)
{
    $conexionPDO = getConexionPDO();
    if($_SERVER["REQUEST_METHOD"] == "POST"){

    $sqlreg = "INSERT INTO logins VALUES ('$usuario', '$password')";
    if ($conexionPDO->query($sqlreg)) {
        echo "Usuario registrado correctamente";
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


function insertarLibro($titulo, $anyo, $precio, $fechaAdquisicion)
{
    $conexionPDO = getConexionPDO();
    if($_SERVER["REQUEST_METHOD"] == "POST"){

    $sqlreglib = "INSERT INTO  libros (titulo, anyo_edicion, precio, fecha_adquisicion) VALUES ('$titulo', '$anyo', '$precio', '$fechaAdquisicion')";
    if ($conexionPDO->query($sqlreglib)) {
        echo "Libro registrado correctamente";
        return true;
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

function getLibros()
{
    $conexionPDO = getConexionPDO();

    
    $consulta = "SELECT numero_ejemplar, titulo, anyo_edicion, precio, fecha_adquisicion FROM libros";
    $datos = $conexionPDO->query($consulta);

    if($datos){
        $libro = $datos->fetchAll(PDO::FETCH_OBJ);
        return $libro;
    }
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

function getLibrosTitulo()
{
    $conexionPDO = getConexionPDO();

    
    $consulta = "SELECT titulo, numero_ejemplar FROM libros";
    $datos = $conexionPDO->query($consulta);

    if($conexionPDO->query($consulta)){
        $libro = $datos->fetchAll(PDO::FETCH_COLUMN);
        return $libro;
    }
}



function borrarLibro($numero_ejemplar)
{
    $conexionPDO = getConexionPDO();
    if($_SERVER["REQUEST_METHOD"] == "POST"){

    $libro = $numero_ejemplar;
        $mensaje = getLibrosPrecio($libro);

    $sql = "DELETE FROM libros WHERE numero_ejemplar = '$numero_ejemplar'";
    if ($conexionPDO->query($sql)) {
        echo "Libro borrado correctamente";
        return $mensaje;

    }
}
}

function borrarLibro_MySQLi($numeroEjemplar)
{
   $conexion = getConexionMySQLi();

    if (!$conexion) {
        return false;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $libro = $numero_ejemplar;
        $mensaje = getLibrosPrecio($libro);

        $sql = "DELETE FROM libros WHERE numero_ejemplar = '$numero_ejemplar'";

        if ($conexion->query($sql)) {
            echo "Libro borrado correctamente";
            return $mensaje;
        } else {
            echo "Error al borrar libro: " . $conexion->error;
            return false;
        }
    }
    
   
}

function modificarLibro_MySQLi($numero_ejemplar,$precio)
{
   
}


function modificarLibroAnyo_MySQLi($numero_ejemplar,$anyo_edicion)
{
       $conexion = getConexionMYSQLI();

    if (!$conexion) {
        return false;
    }

    if (is_array($anyo_edicion)) {
        $anyo_edicion = $anyo_edicion[0];
    }
    if (is_array($numero_ejemplar)) {
        $numero_ejemplar = $numero_ejemplar[0];
    }

    $consulta = "UPDATE libros SET anyo_edicion = $anyo_edicion WHERE numero_ejemplar = $numero_ejemplar";

    if ($conexion->query($consulta)) {

        return [
            'consulta' => $consulta,
            'libro_anyo' => $anyo_edicion
        ];
    } else {
        echo "Error al modificar el libro: " . $conexion->error;
        return false;
    }
}

function arrayFlotante($array) {
   
}


function modificarLibro($numero_ejemplar, $precio)
{

}



function modificarLibroAnyo($numero_ejemplar, $anyo_edicion)
{
{
    $conexionPDO = getConexionPDO();

    if (is_array($anyo_edicion)) {
        $anyo_edicion = $anyo_edicion[0];
    }
    if (is_array($numero_ejemplar)) {
        $numero_ejemplar = $numero_ejemplar[0];
    }
  
    $consulta = "UPDATE libros SET anyo_edicion = $anyo_edicion WHERE numero_ejemplar = $numero_ejemplar";
     if ($conexionPDO->query($consulta)) {

       $librosanyos = $consulta;
       $libroanyo = $anyo_edicion;
        return $librosanyos;
        return $libroanyo;
     }
}
}

function getLibrosPrecio_MySQLi($libro)
{
   $conexion = getConexionMySQLi();

    if (!$conexion) {
        return false;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $numero_ejemplar = $libro;

        $sql = "SELECT precio FROM libros WHERE numero_ejemplar = '$numero_ejemplar'";
        $resultado = $conexion->query($sql);

        if ($resultado) {
            $fila = $resultado->fetch_row();
            if ($fila) {
                return $fila[0];
            }
        }
    }

    return false;
}

function getLibrosAnyo_MySQLi($libro)
{
    $conexion = getConexionMySQLi();

    if (!$conexion) {
        return false;
    }

    $consulta = "SELECT numero_ejemplar, titulo, anyo_edicion FROM libros WHERE titulo = '$libro'";
    $datos = $conexion->query($consulta);

    if ($datos) {
        $librosanyo = [];
        while ($fila = $datos->fetch_object()) {
            $librosanyo[] = $fila;
        }
        return $librosanyo;
    }

    return false;
  
}


function getLibrosPrecio($libro)
{
    $conexionPDO = getConexionPDO();
    if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    $numero_ejemplar = $libro;
    
    $sql = "SELECT precio FROM libros WHERE numero_ejemplar = '$numero_ejemplar'";
    $resultado = $conexionPDO->query($sql);

    if ($resultado) {
        $precio = $resultado->fetchColumn();

        
    }
return $precio;
}
}

function getLibrosAnyo($libro)
{
 $conexionPDO = getConexionPDO();

    
$consulta = "SELECT numero_ejemplar, titulo, anyo_edicion FROM libros WHERE titulo = '$libro'";
$datos = $conexionPDO->query($consulta);

    if($datos){
        $libroanyo = $datos;
        return $libroanyo;
    }
}


?>
