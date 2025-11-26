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

}

function getConexionMySQLi()
{

}
function getConexionMySQLi_sin_bbdd()
{

}


function crearBBDD_MySQLi($basedatos){
   
    
}

function crearTablas_MySQLi($basedatos){
  
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

        echo "Base de datos, tablas y datos creados correctamente.";



    $resultado = $conexionPDO->query($sql);
}


function usuarioCorrecto_MySQLi($usuario, $password)
{

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
  
    
   
}


function modificarLibro_MySQLi($numero_ejemplar,$precio)
{
   
}


function modificarLibroAnyo_MySQLi($numero_ejemplar,$anyo_edicion)
{
   
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
   
}

function getLibrosAnyo_MySQLi($libro)
{
    
  
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
