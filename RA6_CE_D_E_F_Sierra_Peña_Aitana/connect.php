<?php
function getConexion()
{

       $conexion = new mysqli("localhost", "root", "", "aplicaciones");

    if ($conexion->connect_errno) {
        echo "Error al conectar con la base de datos: " . $conexion->connect_error;
        return false;
    }

    return $conexion;
}

function usuarioCorrecto($usuario, $password)
{
    $conexion = getConexion();

    if (!$conexion) {
        return false;
    }

    $sql = "SELECT * FROM logins WHERE usuario='$usuario' AND passwd='$password'";
    $resultado = $conexion->query($sql);

    if ($resultado && $resultado->num_rows > 0) {
        return true;
    } else {
        return false;
    }
}

function registrarUsuario($usuario, $password)
{
      $conexion = getConexion();

    if (!$conexion) {
        return false;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $sqlreg = "INSERT INTO logins (usuario, passwd) VALUES ('$usuario', '$password')";

        if ($conexion->query($sqlreg)) {
            return true;
        } else {
            echo "Error al registrar usuario: " . $conexion->error;
        }
    }
        
}
function insertarAplicacion($nombre, $descripcion)
{
    $conexion = getConexion();

    if (!$conexion) {
        return false;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $sqlreglib = "INSERT INTO aplicaciones (nombre, descripcion) VALUES ('$nombre', '$descripcion')";

        if ($conexion->query($sqlreglib)) {
            echo "Aplicacion registrada correctamente";
            return true;
        } else {
            echo "Error al registrar aplicacion: " . $conexion->error;
            return false;
        }
    }
}
function getAplicaciones()
{
	$conexion = getConexion();

    if (!$conexion) {
        return false;
    }

    $consulta = "SELECT * FROM aplicaciones";
    $datos = $conexion->query($consulta);

    if ($datos) {
        $aplicaciones = [];
        while ($fila = $datos->fetch_object()) {
            $aplicaciones[] = $fila;
        }
        return $aplicaciones;
    }

    return false;
}

function borraraplicacion($nombre)
{
   $conexion = getConexion();

    if (!$conexion) {
        return false;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $sql = "DELETE FROM aplicaciones WHERE nombre='$nombre'";

        if ($conexion->query($sql)) {
            $mensaje = "Aplicacion borrada correctamente";
            return $mensaje;
        } else {
            echo "Error al borrar la aplicacion: " . $conexion->error;
            return false;
        }
    }
    
   
}

?>