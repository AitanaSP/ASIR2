<?php
include_once 'connect.php';
session_start();
if(!isset($_SESSION["usuario"]) || $_SESSION["usuario"]==null){
    header("Location: index.php");
}
?>
<html>
    <head>
        <title>principal</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            body{
                text-align:center;
            }
            #menu{
                display:inline-block;
                text-align:left;
            }
            #menu li{
                margin-top:2em;
            }
        </style>
    </head>
    <body>
    
        <h1>Bienvenido a la aplicacion de gestión de permisos</h1>
        <div id="menu">
            <ul>
                <li><a href="aplicaciones.php">Gestion de Aplicaciones</a></li>
            </ul>
        </div>
    </body>
</html>
