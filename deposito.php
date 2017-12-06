<!DOCTYPE html>
<html>
<head>
    <?php include('include/head.php');
    include("conexion.php");
    include("gestion.php");
    session_start();
    if(!isset($_SESSION["usuario"])){
        header('Location: index.php');
    }
    ?>
    <title>Depósito | E Bank</title>
</head>
<body class="blue-grey lighten-5">
    <?php include('include/menu.php'); ?>
    <main>
        <div class="container">
            <section>
                <div class="row">
                    <form class="col s12" method="post">
                        <h2>Depósito de Fondos</h2>
                        <div class="row">
                            <div class="input-field col s12 m6">
                                <input type="number" min="0" step="0.01" name="deposito" name="saldo" class="validate" required>
                                <label for="deposito" data-error="Ingrese un valor válido. Hasta dos (2) decimales.">Monto</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <button class="btn waves-effect waves-light" type="submit" id="boton" name="enviar" value="Depositar"><i class="material-icons right">send</i>Depositar</button>
                            </div>
                        </div>


                    </form>
                    <?php
                    if(isset($_POST["deposito"]))
                    {
                        if($_POST["deposito"]<0)
                        {
                            echo "<h3>Información de Transacción</h3>";
                            echo "<div class='card-panel red darken-2 white-text'>No se pueden depositar valores negativos.</div>";
                        }
                        else
                        {
                            $_SESSION['usuario']->depositar($_POST['deposito']);
                            $numC=$_SESSION['usuario']->getncuenta();

                            $sql="SELECT saldo,id_cuenta FROM cuenta WHERE id_cuenta='$numC'";
                            $consulta=$connection->query($sql);
                            $consulta=$consulta->fetch_assoc();

                            echo "<h3>Información de Transacción</h3>";
                            echo "<div class='card-panel green darken-1 white-text'>Se han depositado ".number_format($_POST["deposito"], 2)." con éxito.</div>";
                            echo "<table>";
                            echo "<thead>";
                            echo "<tr>";
                            echo "<th>Interés Generado</th>";
                            echo "<th>Saldo final</th>";
                            echo "</tr>";
                            echo "</thead>";
                            echo "<tr>";
                            echo "<td>".number_format(($_POST["deposito"]*0.0125), 2)."</td>";
                            echo "<td>".number_format($consulta['saldo'], 2)."</td>";
                            echo "</tr>";
                            echo "</table>";
                        }
                    }
                    ?>
                </section>
            </div>
        </main>
        <?php include('include/footer.php'); ?>
    </body>
    </html>
