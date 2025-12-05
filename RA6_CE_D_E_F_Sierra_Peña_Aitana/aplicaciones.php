<?php
require_once 'connect.php';
session_start();
if(!isset($_SESSION["usuario"]) || $_SESSION["usuario"]==null){
    header("Location: principal.php");
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Aplicaciones</title>
</head>
<?php
if(isset($_POST['borrar'])	)
{
	$mensaje = borraraplicacion($_POST['aplicacion']);

}

if(isset($_POST['guardar'])	)
{
	$nombre = $_POST['nombre'];
	$descripcion = $_POST['descripcion'];
if(insertaraplicacion($nombre, $descripcion)){
		echo "<div class='aviso'>Datos guardados correctamente</div>";
	}else{
		echo "<div class='error'>No se ha podido insertar</div>";
}
}
?>
<body>
<h1>Gestion de Aplicaciones</h1>
<table class="tabla">
	<tr>
		<th>Aplicación</th>
		<th>Descripcion</th>
		<th>
			
		</th>
        </form>
		</tr>
<?php
$aplicaciones = getAplicaciones();
foreach($aplicaciones as $aplicacion)
{
	echo "<tr>\n";
	echo "<td>{$aplicacion->nombre}</td>";
	echo "<td>{$aplicacion->descripcion}</td>";
	echo "<td><form method='post'>
			<input type='hidden' name='aplicacion' value='{$aplicacion->nombre}'>
			<input type='submit' name='borrar' value='Borrar'>
			</form>
			</td>";
	echo "</tr>\n";
}
?>
</table><br>
<h2>Nueva Aplicación:</h2>
<form method="post">
	<label for="nombre">Nombre de la aplicación:</label><br>
	<input type="text" id="nombre" name="nombre" required><br>
	<label for="descripcion">Descripción:</label><br>
	<input type="text" id="descripcion" name="descripcion" required><br><br>
	<input type="submit" name="guardar" value="Guardar">

</body>
</html>
