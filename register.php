<!DOCTYPE html>
<html>
<head>
	<title>Registro</title>
	<meta charset="utf-9">
</head>
<body>
 	<section id="registro">
 		<form  method="POST" name="formulario">
		    Nombre: <input type="text" name="Nombre"> <br><br>
		    Apellido: <input type="text" name="Apellido"><br><br>
		    Cedula: <input type="text" name="Cedula"> <br><br>
		    Teléfono: <input type="text" name="Telefono"><br><br>
		    Usuario:<input type="text" name="Usuario"><br><br>
		    Contraseña:<input type="text" name="Contra"><br><br>
	    <input type="submit" name="botonGuardar" value="Registrar">
	</form>
 	</section>

</body>
</html>


<?php
	include("conexion.php");
	include("gestion.php");
	//Comprobar campos vacios
	if(isset($_POST['Nombre']) && !empty($_POST['Nombre']) && isset($_POST['Apellido']) && !empty($_POST['Apellido']) &&
	isset($_POST['Telefono']) && !empty($_POST['Telefono']) &&isset($_POST['Cedula']) && !empty($_POST['Cedula']))
	{

		//Iniciar Clase
		$gestion= new GestionRegistro($_POST['Nombre'],$_POST['Apellido'],$_POST['Cedula'],$_POST['Telefono'],$_POST['Usuario'],$_POST['Contra']);

		//Validar que la cedula y el usuario no hayan sido registrados
		if($gestion->validarcedula()==false OR $gestion->validarusuario()==false)
		{

			if($gestion->validarcedula()==false)
			{
				echo "cedula ya ha sido utilizada";
			}
			elseif ($gestion->validarusuario()==false)
			{
				echo "usuario ya ha sido utilizado";
			}
		}
		else
		{
		// Llamar metodos para crear numero de cuenta, numero de cliente y registrar todos los datos
			$gestion->numcuenta();
			$gestion->numcliente();
			$gestion->registrar();
			header("location:principal.php");
	}

?>
