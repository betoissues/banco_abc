<!DOCTYPE html>
<html>
<head>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.css"  media="screen,projection"/>

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <?php include('include/head.php');
    include('conexion.php');
    include('gestion.php');
    session_start();
    if(!isset($_SESSION["usuario"])){
        header("Location: index.php");
    }
    ?>
    <title>Dashboard | Banco ABC </title>
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
        ?>
    </div>
    
</main>
    <?php include('include/footer.php'); ?>
</body>
</html>
