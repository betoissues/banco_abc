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
    <title>Promociones | E Bank </title>
</head>

<body class="blue-grey lighten-5">
    <?php include('include/menu.php'); ?>
    <main>
        <div class="container">
            <h2>Promociones</h2>
            <div class="row">
                <div class="card small col s12 m5 offset-m1">
                    <div class="card-image waves-effect waves-block waves-light">
                        <img class="activator" src="img/smile.jpg">
                    </div>
                    <div class="card-content">
                        <span class="card-title activator grey-text text-darken-4">Plazo Fijo</span>
                    </div>
                    <div class="card-reveal">
                        <span class="card-title grey-text text-darken-4">Plazo Fijo</span>
                        <p>
                            Si usted quiere aplicar para un depósito a plazo fijo, debe cumplir con los siguientes requerimientos:
                        </p>
                        <ul>
                            <li>Tener una cuenta de ahorro con nosotros.</li>
                            <li>Hacer un depósito mínimo de $10 000.00.</li>
                            <li>Tener por lo menos un año afiliado con nosotros.</li>
                        </ul>
                        <p>
                            Si usted cumple con los tres requerimientos, debe acercarse a una de nuestras instalaciones para llenar el formulario de solicitud.
                        </p>
                        <p>
                            Ofrecemos un interés anual de 10% para cualquier depósito entre $10 000.00 y $30 000.00, y un interés anual de 5% para cualquier depósito superior a las cantidades mencionadas previamente.
                        </p>
                    </div>
                </div>
                <div class="card small col s12 m5 offset-m1">
                    <div class="card-image waves-effect waves-block waves-light">
                        <img class="activator" src="img/bugatti.jpg">
                    </div>
                    <div class="card-content">
                        <span class="card-title activator grey-text text-darken-4">Préstamos para Autos</span>
                    </div>
                    <div class="card-reveal">
                        <span class="card-title grey-text text-darken-4">Préstamos para Autos</span>
                        <p>
                            Si usted alguna vez soñó con tener su carro ideal, ahora le damos la oportunidad de volver ese sueño realidad.
                        </p>
                        <p>
                            Con nuestros préstamos de carro con intereses simples y económicos, le garantizamos un proceso de pago cómodo para que usted pueda tener el carro de sus sueños.
                        </p>
                        <p>
                            Si usted quiere aplicar para un préstamo de carro, debe cumplir con los siguientes requerimientos:
                            <ul>
                                <li>Tener una cuenta de ahorro con nosotros.</li>
                                <li>Tener buen credito.</li>
                                <li>Tener por lo menos un año afiliado con nosotros.</li>
                            </ul>
                        </p>
                        <p>
                            Si usted cumple con los tres requerimientos, debe acercarse a una de nuestras instalaciones para llenar el formulario de solicitud.
                        </p>
                        <p>
                            Dependiendo de su crédito, la cantidad de pagos y el monto del préstamo, se determinará su mensualidad. Las cantidades
                            de pago son negociables.
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="card small col s12 m5 offset-m1">
                    <div class="card-image waves-effect waves-block waves-light">
                        <img class="activator" src="img/house.jpeg">
                    </div>
                    <div class="card-content">
                        <span class="card-title activator grey-text text-darken-4">Préstamos Hipotecarios</span>
                    </div>
                    <div class="card-reveal">
                        <span class="card-title grey-text text-darken-4">Préstamos Hipotecarios</span>
                        <p>
                            Todos soñamos con tener nuestro propio hogar en donde iniciar nuestras propias familias.
                        </p>
                        <p>
                            Con nuestros préstamos hipotecarios con intereses simples y económicos, le garantizamos un proceso de pago cómodo para  que usted pueda tener la casa de sus sueños.
                        </p>
                        <p>
                            Si usted quiere aplicar para un depósito hipotecario, debe cumplir con los siguientes requerimientos:
                            <ul>
                                <li>Tener una cuenta de ahorro con nosotros.</li>
                                <li>Tener buen credito.</li>
                                <li>Tener por lo menos un año afiliado con nosotros.</li>
                            </ul>
                        </p>
                        <p>
                            Si usted cumple con los tres requerimientos, debe acercarse a una de nuestras instalaciones para llenar el formulario de solicitud.
                        </p>
                        <p>
                            Dependiendo de su crédito, la cantidad de pagos y el monto del préstamo, se determinará su mensualidad. Las cantidades
                            de pago son negociables.
                        </p>
                    </div>
                </div>
                <div class="card small col s12 m5 offset-m1">
                    <div class="card-image waves-effect waves-block waves-light">
                        <img class="activator" src="img/pymes.jpg">
                    </div>
                    <div class="card-content">
                        <span class="card-title activator grey-text text-darken-4">Préstamos para PyMEs</span>
                    </div>
                    <div class="card-reveal">
                        <span class="card-title grey-text text-darken-4">Préstamos para PyMEs</span>
                        <p>
                            No es fácil iniciar una nueva empresa, pero nosotros confiamos en usted y sus ideas.
                        </p>
                        <p>
                            Con nuestros paquetes de préstamos dirigidos a las pequeñas y medianas empresas, le brindamos la oportunidad de concretizar sus ideas, de modo que no tenga que preocuparse tanto por el financiamiento.
                        </p>
                        <p>
                            Si usted quiere aplicar para un paquete de préstamo para las PyMEs, debe cumplir con los siguientes requerimientos:
                            <ul>
                                <li>Tener una cuenta de negocios con nosotros.</li>
                                <li>Tener buen credito.</li>
                                <li>Ser una empresa con menos de 3 años fiscales.</li>
                                <li>Tener por lo menos un año afiliado con nosotros.</li>
                            </ul>
                        </p>
                        <p>
                            Si usted cumple con los cuatro requerimientos, debe acercarse a una de nuestras instalaciones para llenar el formulario de solicitud.
                        </p>
                        <p>
                            Ofrecemos préstamos de hasta $50 000.00 a las empresas, dependiendo del crédito y de la relevancia y rentabilidad del negocio,
                            con un interés fijo del 5%.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include('include/footer.php'); ?>
</body>
</html>
