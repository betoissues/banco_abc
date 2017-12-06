<header>
	<ul id="droptransacciones" class="dropdown-content">
		<li><a href="deposito.php">Depósito</a></li>
		<li><a href="retiro.php">Retiro</a></li>
		<li><a href="transferencia.php">Transferencias</a></li>
	</ul>
	<nav>
		<div class="nav-wrapper blue darken-2">
			<a href="index.php" class="responsive-img brand-logo left"><img src="img/logo.png"></a>
			<a href="#" data-activates="mobile-demo" class="button-collapse right"><i class="material-icons">menu</i></a>
			<ul class="right hide-on-med-and-down">
				<li>Hola, <?php echo $_SESSION['usuario']->getnombre(); ?></li>
				<li><span class="new badge green darken-1 white-text" data-badge-caption=""><?php echo number_format($_SESSION['usuario']->getsaldo(), 2)." $"; ?></span></li>
				<li><a href="index.php"><i class="material-icons">home</i></a></li>
				<!-- Dropdown Trigger -->
				<li><a class="dropdown-button" href="#!" data-activates="droptransacciones">Transacciones<i class="material-icons right">arrow_drop_down</i></a></li>
				<li><a href="reporte.php">Reporte</a></li>
				<li><a href="salir.php"><i class="material-icons right">exit_to_app</i>Salir</a></li>
			</ul>
			<ul class="side-nav" id="mobile-demo">
				<li>Hola, <?php echo $_SESSION['usuario']->getnombre(); ?></li>
				<li><span class="new badge green darken-1 white-text" data-badge-caption=""><?php echo $_SESSION['usuario']->getsaldo()." $"; ?></span></li>
				<li><a href="index.php">Inicio</a></li>
				<li><a href="deposito.php">Depósito</a></li>
				<li><a href="retiro.php">Retiro</a></li>
				<li><a href="transferencia.php">Transferencias</a></li>
				<li><a href="reporte.php">Reporte</a></li>
				<li><a href="salir.php"><i class="material-icons right">exit_to_app</i>Salir</a></li>
			</ul>
		</div>
	</nav>
</header>
