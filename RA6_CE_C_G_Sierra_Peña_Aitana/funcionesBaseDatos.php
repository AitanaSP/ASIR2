<?php

include_once 'constantes.php';

function getConexionPDO()
{
    global $usuario, $password;
        $conexionPDO = new PDO('mysql:host=localhost;dbname=libros2', $usuario, $password);
        return $conexionPDO;
}



function getConexionPDO_sin_bbdd()
{
    $usuarioCorrectoNODB = new PDO('mysql:host=localhost', $usuario, $password);
}

function getConexionMySQLi()
{
    $usuarioCorrecto_MySQLi = new mysqli();

    $usuarioCorrecto_MySQLi->connect('localhost', 'localhost', '', 'libros2');
}
function getConexionMySQLi_sin_bbdd()
{
    $usuarioCorrecto_MySQLi = new mysqli();

    $usuarioCorrecto_MySQLi->connect('localhost', 'localhost', '');
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
 $checkusuario = getConexionPDO();
    $checkusuario = $checkusuario->query("SELECT * FROM logins WHERE usuario='$usuario'");
    if ($checkusuario->rowCount() == 1)
    {
        $
} 




function registrarUsuario_MySQLi($usuario, $password)
{

        
}

function registrarUsuario($usuario, $password)
{
  
}

function insertarLibro_MySQLi($titulo, $anyo, $precio, $fechaAdquisicion)
{
 
}


function insertarLibro($titulo, $anyo, $precio, $fechaAdquisicion)
{
   
}




function getLibros_MySQLi()
{
	
}

function getLibros()
{
    
}

function getLibrosTitulo_MySQLi()
{
   
    
}


function getLibrosTitulo()
{
   
}



function borrarLibro($numeroEjemplar)
{
   
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
    
}

function getLibrosAnyo($libro)
{
    
}


?>
