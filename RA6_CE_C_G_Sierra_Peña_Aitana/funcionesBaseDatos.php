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
   
}

function crearTablas($basedatos) {
  
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
   
}



function borrarLibro($numeroEjemplar)
{
    $conexionPDO = getConexionPDO();
    if($_SERVER["REQUEST_METHOD"] == "POST"){
    
}

    $sql = "DELETE FROM libros WHERE numero_ejemplar = '$numeroEjemplar'";
    if ($conexionPDO->query($sql)) {
        echo "Libro borrado correctamente";
       $mensaje = getLibrosPrecio($numeroEjemplar);
        return $mensaje;

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
    
 
}






function getLibrosPrecio_MySQLi($libro)
{
   
}

function getLibrosAnyo_MySQLi($libro)
{
    /*La tabla libros     * */
  
}


function getLibrosPrecio($libro)
{
    $conexionPDO = getConexionPDO();
    if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    $numero_ejemplar = $libro;
    
    $sql = "SELECT precio FROM libros WHERE numero_ejemplar = '$libro'";

     $resultado = $conexionPDO->query($sql);
    if ($conexionPDO->query($sql)) {
        $mensaje = $resultado->fetchColumn();
        return $mensaje;
}
}
}

function getLibrosAnyo($libro)
{
    
}


?>
