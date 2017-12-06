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
    <title>Promociones | E Bank </title>
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

    <div class="container">
        <div class="col s12"><h3 class="center-align">Promociones</h1></div>
        <img class="responsive-img" src="img/smile.jpg" width="100%" height="auto">

        <div class="col s12">
            <h2 class="center-align">Plazo Fijo</h2>
            <p class="center-align">
                Si usted quiere aplicar para un depósito a plazo fijo, debe cumplir con los siguientes requerimientos:
            </p>
                <ul class="center-align">
                    <li>Tener una cuenta de ahorro con nosotros.</li>
                    <li>Hacer un depósito mínimo de $10 000.00.</li>
                    <li>Tener por lo menos un año afiliado con nosotros.</li>
                </ul>
            <p class ="center-align">
                Si usted cumple con los tres requerimientos, debe acercarse a una de nuestras instalaciones para llenar el formulario de solicitud. 
                <br><br>
                Ofrecemos un interés anual de 10% para cualquier depósito entre $10 000.00 y $30 000.00, y un interés anual de 5% para cualquier depósito superior a las cantidades mencionadas previamente.

            </p>
        </div>
        <br><br><br>
        <div class="col s12">
        <img class="responsive-img" src="img/bugatti.jpg" width="100%" height="auto">
            <h2 class="center-align">Préstamos de Carro</h2>

            <p class="center-align">
                Si usted alguna vez soñó con tener su carro ideal, ahora le damos la oportunidad de volver ese sueño realidad. 
                <br><br>
                Con nuestros préstamos de carro con intereses simples y económicos, le garantizamos un proceso de pago cómodo para
                que usted pueda tener el carro de sus sueños.

                Si usted quiere aplicar para un préstamo de carro, debe cumplir con los siguientes requerimientos:
                <ul class="center-align">
                    <li>Tener una cuenta de ahorro con nosotros.</li>
                    <li>Tener buen credito.</li>
                    <li>Tener por lo menos un año afiliado con nosotros.</li>
                </ul>
            </p>

            <p class ="center-align">
                Si usted cumple con los tres requerimientos, debe acercarse a una de nuestras instalaciones para llenar el formulario de solicitud. 
                <br><br>
                Dependiendo de su crédito, la cantidad de pagos y el monto del préstamo, se determinará su mensualidad. Las cantidades
                de pago son negociables. 
            </p>
        </div>
        <br><br><br>
        <div class="col s12">
        <img class="responsive-img" src="img/pymes.jpg" width="100%" height="auto">
            <h2 class="center-align">Préstamos a las PyMEs</h2>
            
            <p class="center-align">
                No es fácil iniciar una nueva empresa, pero nosotros confiamos en usted y sus ideas. 
                <br><br>
                Con nuestros paquetes de préstamos dirigidos a las pequeñas y medianas empresas, le brindamos la oportunidad de concretizar 
                sus ideas, de modo que no tenga que preocuparse tanto por el financiamiento. 

                Si usted quiere aplicar para un paquete de préstamo para las PyMEs, debe cumplir con los siguientes requerimientos:
                <ul class="center-align">
                    <li>Tener una cuenta de negocios con nosotros.</li>
                    <li>Tener buen credito.</li>
                    <li>Ser una empresa con menos de 3 años fiscales.</li>
                    <li>Tener por lo menos un año afiliado con nosotros.</li>
                </ul>
            </p>

            <p class ="center-align">
                Si usted cumple con los cuatro requerimientos, debe acercarse a una de nuestras instalaciones para llenar el formulario de solicitud. 
                <br><br>
                Ofrecemos préstamos de hasta $50 000.00 a las empresas, dependiendo del crédito y de la relevancia y rentabilidad del negocio,
                con un interés fijo del 5%. 
            </p>

        </div>
        <br><br><br>
        <div class="col s12">
        <img class="responsive-img" src="img/house.jpeg" width="100%" height="auto">
            <h2 class="center-align">Préstamos Hipotecarios</h2>

            
            <p class="center-align">
                Todos soñamos con tener nuestro propio hogar en donde iniciar nuestras propias familias. 
                <br><br>
                Con nuestros préstamos hipotecarios con intereses simples y económicos, le garantizamos un proceso de pago cómodo para
                que usted pueda tener la casa de sus sueños.

                Si usted quiere aplicar para un depósito hipotecario, debe cumplir con los siguientes requerimientos:
                <ul class="center-align">
                    <li>Tener una cuenta de ahorro con nosotros.</li>
                    <li>Tener buen credito.</li>
                    <li>Tener por lo menos un año afiliado con nosotros.</li>
                </ul>
            </p>

            <p class ="center-align">
                Si usted cumple con los tres requerimientos, debe acercarse a una de nuestras instalaciones para llenar el formulario de solicitud. 
                <br><br>
                Dependiendo de su crédito, la cantidad de pagos y el monto del préstamo, se determinará su mensualidad. Las cantidades
                de pago son negociables. 
                <br><br><br><br><br>
            </p>
        </div>
    </div>

    
</main>
    <?php include('include/footer.php'); ?>
</body>
</html>
