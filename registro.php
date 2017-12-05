<!DOCTYPE html>
<html>
<head>
    <?php include("include/head.php"); ?>
    <title>Registro | E Bank</title>
    <meta charset="utf-8">
</head>
<body>
    <header>
        <div class="navbar-fixed">
            <nav>
                <div class="nav-wrapper blue darken-2">
                    <a href="index.php" class="brand-logo center"><img src="img/logo.png"></a>
                </div>
            </nav>
        </div>
    </header>
    <main>
        <div class="container">
            <div class="row">
                <form class="col s12" method="POST" name="formulario">
                    <div class="row">
                        <div class="input-field col s12 m6">
                        <i class="material-icons prefix">account_circle</i>
                            <input id="Nombre" class="validate" type="text" name="Nombre" required>
                            <label for="Nombre">Nombre</label>
                        </div>
                        <div class="input-field col s12 m5">
                            <input id="Apellido" class="validate" type="text" name="Apellido" required>
                            <label for="Apellido">Apellido</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12 m5">
                            <i class="material-icons prefix">credit_card</i>
                            <input type="text" name="Cedula" id="Cedula" class="validate" required>
                            <label for="Cedula">Cédula</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12 m5">
                            <i class="material-icons prefix">phone</i>
                            <input type="tel" name="Telefono" class="validate">
                            <label for="Telefono">Teléfono</label>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="input-field col s12 m5">
                            <input type="text" name="Usuario" class="validate" required>
                            <label for="Usuario">Usuario</label>
                        </div>
                        <div class="input-field col s12 m5">
                            <input type="password" name="Contra" class="validate" required>
                            <label for="Contra">Contraseña</label>
                        </div>
                    </div>
                    <button class="btn waves-effect waves-light" type="submit" name="botonGuardar"><i class="material-icons right">send</i>Registrar</button>
                </form>
            </div>
        </div>
    </main>
    <?php include("include/footer.php"); ?>

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
            echo "Cédula ya ha sido utilizada.";
        }
        elseif ($gestion->validarusuario()==false)
        {
            echo "Usuario ya ha sido utilizado.";
        }
    }
    else
    {
        // Llamar metodos para crear numero de cuenta, numero de cliente y registrar todos los datos
        $gestion->numcuenta();
        $gestion->numcliente();
        $gestion->registrar();
        header("Location: index.php");
    }
}
?>
