<?php


$server = "localhost";

$user = "root";

$pass = "";

$db ="banco"; 

// Conexion a la Base de Datos

$connection = mysqli_connect($server,$user, $pass, $db);

if (!$connection) {
   die ("Error de conexion a la base de datos ... \n" . mysql_error ());
}	
//echo 'Conectado con éxito';

?>