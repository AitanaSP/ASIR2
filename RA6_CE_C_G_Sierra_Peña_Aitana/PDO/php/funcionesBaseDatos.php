<?php

include_once 'constantes.php';


function getConexionPDO()
{
    try{
        $conexionPDO = new PDO("mysql:host=localhost;dbname=libros2",'root','');
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



function crearBBDD($basedatos) {


    $conexionPDO = getConexionPDO();


     $sql = "CREATE DATABASE IF NOT EXISTS `$basedatos`
            CHARACTER SET utf8mb4
            COLLATE utf8mb4_general_ci";

    $conexionPDO->exec($sql);

    echo "Base de datos '$basedatos' creada correctamente<br>";
}

function crearTablas($basedatos) {
  
    $conexionPDO = getConexionPDO();

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

if (!$conexionPDO->query($sql)) {
    die("Error creando tabla libros: " . $conexionPDO->error);

    $sql = "
    INSERT INTO libros (titulo, anyo_edicion, precio, fecha_adquisicion)
    VALUES 
        ('Harry', 2000, 6.00, '2022-09-06'),
        ('Nieves', 1983, 200.00, '2022-12-01');
";

if (!$conexionPDO->query($sql)) {
    die("Error insertando libros: " . $conexionPDO->error);
}
}



$sql = "
    CREATE TABLE IF NOT EXISTS logins (
        usuario VARCHAR(50) NOT NULL,
        passwd CHAR(32) NOT NULL,
        PRIMARY KEY (usuario)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
";

if (!$conexionPDO->query($sql)) {
    die("Error creando tabla logins: " . $conexionPDO->error);
    $sql = "
    INSERT INTO logins (usuario, passwd)
    VALUES
        ('david', '172522ec1028ab781d9dfd17eaca4427'),
        ('aitana', 'aitana'),
        ('nieves', 'c45f3fc0f92e983dea35e4b15213e6d7');
";

if (!$conexionPDO->query($sql)) {
    die("Error insertando logins: " . $conexionPDO->error);
}
    
}
return 1;
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
