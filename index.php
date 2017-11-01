<!DOCTYPE html>
<html>
    <head>
        <!--Import Google Icon Font-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Import materialize.css-->
        <link type="text/css" rel="stylesheet" href="css/materialize.css"  media="screen,projection"/>

        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <title>ABC - Inicio</title>
    </head>

    <body>
        <header>
            <div class="navbar-fixed">
                <nav>
                    <div class="nav-wrapper blue darken-2">
                        <a href="#!" class="brand-logo center"><img src="img/logo.png"></a>
                    </div>
                </nav>
            </div>
        </header>

        <div class="parallax-container">
            <div class="section no-pad-bot">
                <div class="container">
                    <br><br><br><br>
                    <div class="row center valign-wrapper">
                        <h5 class="header col white-text s12 light">Bienvenido al Banco ABC</h5>
                    </div>
                    <div class="row center">
                        <a id="download-button" data-target="login" class="btn-large modal-trigger waves-effect waves-light blue lighten-1">Inicia Sesión</a>
                    </div>
                    <br><br>
                </div>
            </div>
            <div class="parallax"><img src="img/landpage_bg.jpg"></div>
        </div>

        <!-- Modal Trigger -->
        <!-- Modal Structure -->
        <div id="login" class="modal modal-fixed-footer">
            <div class="modal-content">
                <div class="row">
                    <form class="col s12" action="checklogin.php" method="post">
                        <h4>Inicia Sesión</h4>
                        <div class="row">
                            <div class="input-field col s8 offset-s2">
                                <input id="user" type="text" class="validate">
                                <label for="user">Usuario</label>
                            </div>
                        </div>
                        <div class="row center">
                            <div class="input-field col s8 offset-s2">
                                <input id="password" type="password" class="validate">
                                <label for="password">Contraseña</label>
                            </div>
                        </div>
                        <div class="row center">
                            <div class="input-field col s4 offset-s4">
                                <input class="btn waves-effect waves-light" type="submit" name="enviarlogin" value="Iniciar Sesión">
                            </div>
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Cancelar</a>
            </div>
        </div>

        <footer class="page-footer blue darken-4">
            <div class="footer-copyright">
                <div class="container">
                    © 2017 Todos los derechos reservados. | Banco ABC
                </div>
            </div>
        </footer>
        <!--Import jQuery before materialize.js-->
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="js/materialize.min.js"></script>
        <script type="text/javascript" src="js/init.js"></script>
    </body>
</html>
