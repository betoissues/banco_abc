<!DOCTYPE html>
<html>
<head>
    <?php include('include/head.php');
    include('conexion.php');
    include('gestion.php');
    session_start();
    if(!isset($_SESSION["usuario"])){
        header("Location: index.php");
    }
    ?>
    <title>Dashboard | E Bank</title>
</head>
<body class="blue-grey lighten-5">
    <?php include('include/menu.php'); ?>
    <main>
        <div class="container">
            <?php  // Dashboard

            $ncuenta=$_SESSION['usuario']->getncuenta();
            $totalcredito=0;
            $totaldebito=0;
            $totaltransferencia=0;
            $totalintereses=0;
            $saldocapital=$_SESSION['usuario']->getsaldo();

            //Consulta para saber total de credito, debito y transferencias
            $sql= "SELECT * FROM  transaccion WHERE id_cuenta='$ncuenta'";
            $consulta=$connection->query($sql);
            while($registros= $consulta->fetch_assoc())
            {
                if($registros['nombre']=="Retiro")
                {
                    $totaldebito=$totaldebito+$registros['monto'];
                }
                elseif ($registros['nombre']=="Transferencia")
                {
                    $totaltransferencia=$totaltransferencia+$registros['monto'];
                }
                elseif ($registros['nombre']=="Deposito")
                {
                    $totalcredito=$totalcredito+$registros['monto'];
                }
            }
            //Consulta multitabla transaccion y deposito
            $sql= "SELECT * FROM  transaccion t , deposito d WHERE t.id_cuenta='$ncuenta ' AND  t.nombre='Deposito' AND t.id_trans=d.id_trans ";

            $consulta=$connection->query($sql);
            while($registros= $consulta->fetch_assoc())
            {
                $totalintereses=$totalintereses+$registros['interes'];
            }
            ?>
            <div class="row">
                    <b>Hora del Servidor: </b><?php echo date('Y-m-d h:i:s'); ?>
            </div>
            <div class="card-panel blue-grey lighten-5">
                <span class="blue-text text-darken-1"><b># de Cuenta:</b> <?php echo $ncuenta; ?></span>
            </div>
            <?php
            echo "<table class='striped bordered'>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>Total Crédito</th>";
            echo "<th>Total Débito</th>";
            echo "<th>Total de Transferencias</th>";
            echo "<th>Total Intereses Ganados</th>";
            echo "<th>Saldo Capital</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tr>";
            echo "<td>".number_format($totalcredito, 2)."</td>";
            echo "<td>".number_format($totaldebito, 2)."</td>";
            echo "<td>".number_format($totaltransferencia, 2)."</td>";
            echo "<td>".number_format($totalintereses, 2)."</td>";
            echo "<td>".number_format($saldocapital, 2)."</td>";
            echo "</tr>";
            echo "</table>";

            ?>
        </div>
    </main>
    <?php include('include/footer.php'); ?>
</body>
</html>
