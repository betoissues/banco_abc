<!DOCTYPE html>
<html>
<head>
    <?php
    include('include/head.php');
    include("conexion.php");
    include('gestion.php');
    session_start();
    if(!isset($_SESSION["usuario"])){
        header('Location: index.php');
    }
    ?>
    <title>Retiro | Banco ABC</title>
</head>
<body class="blue-grey lighten-5">
    <?php include('include/menu.php'); ?>
    <main>
    <div class="container">
        <section>
            <div class="row">
                <form class="col s12" method="post">
                    <h2>Retirar</h2>
                    <div class="row">
                        <div class="input-field col s12 m6">
                            <input type="text" id="saldo" name="saldo" value="<?php echo $_SESSION["usuario"]->oportunidadesRetiro(); ?>" disabled>
                            <label for="saldo">Retiros Diarios Disponibles</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12 m6">
                            <i class="material-icons prefix">monetization_on</i>
                            <input id="retirar" name="retirar" type="text">
                            <label for="retirar">Monto</label>
                        </div>
                    </div>
                    <button class="btn waves-effect waves-light" type="submit" name="enviar" value="Retirar">
                        <i class="material-icons right">send</i>Retirar
                    </button>
                </form>
            </div>
            <?php


            if(isset($_POST['retirar']) && !empty($_POST['retirar']) )
            {
                if($_POST["retirar"]<0)
                {
                    echo "<h3>Información de Transacción</h3>";
                    echo "<div class='card-panel red darken-2 white-text'>No se pueden retirar valores negativos.</div>";
                }
                else
                {
                    $monto_retirar=$_POST['retirar'];

                    if($_SESSION["usuario"]->validarRetiro($monto_retirar)=='menosque100' or $_SESSION["usuario"]->validarRetiro($monto_retirar)=='limitetransacciones' )
                    {
                        if($_SESSION["usuario"]->validarRetiro($_POST["retirar"])=='menosque100')// Menor que $100
                        {
                            echo "<h3>Información de Transacción</h3>";
                            echo "<div class='card-panel red darken-2 white-text'>El saldo final de la cuenta no puede ser menor a 100.00 balboas.</div>";
                        }
                        else
                        {
                            echo "<h3>Informacion de Transacción</h3>";
                            echo "<div class='card-panel red darken-2 white-text>Solo se pueden realizar un máximo de 4 retiros por día.</div>";
                        }
                    }
                    else
                    {
                        $_SESSION["usuario"]->retiro($_POST["retirar"]);
                        $numC=$_SESSION['usuario']->getncuenta();
                        $sql="SELECT saldo,id_cuenta FROM cuenta WHERE id_cuenta='$numC'";
                        $consulta=$connection->query($sql);
                        $consulta=$consulta->fetch_assoc();

                        echo "<h3>Información de Transacción</h3>";
                        echo "<div class='card-panel green darken-1 white-text'>Se han retirado ".$_POST["retirar"]." con éxito.</div>";
                        echo "<table>";
                        echo "<thead>";
                        echo "<tr>";
                        echo "<th>Saldo Final</th>";
                        echo "</tr>";
                        echo "</thead>";
                        echo "<tr>";
                        echo "<td>".$consulta['saldo']."</td>";
                        echo "</tr>";
                        echo "</table>";
                    }
                }
            }
            ?>
        </section>
    </div>
</main>
    <?php include('include/footer.php'); ?>
</body>
</html>
