<!DOCTYPE html>
<html>
<head>
	<?php
	include('include/head.php');
	include("conexion.php");
	include("gestion.php");
	session_start();
	if(!isset($_SESSION["usuario"])){
		header('Location: index.php');
	}
	?>
	<title>Transferencia | E Bank</title>

</head>
<body class="blue-grey lighten-5">
	<?php include('include/menu.php'); ?>
	<main>
		<div class="container">
			<section>
				<div class="row">
					<form class="col s12" method="post">
						<h2>Transferencia</h2>
						<div class="row">
							<div class="input-field col s12 m6">
								<input type="text" name="transferencias" value="	<?php echo $_SESSION["usuario"]->oportunidadesTransferencia(); ?>" disabled>
								<label for="transferencias">Transferencias diarias disponibles</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12 m6">
								<input type="number" step="0.01" min="0" class="validate" name="transferir" required>
								<label for="transferir" data-error="Ingrese un valor válido. Hasta dos (2) decimales.">Monto</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12">
								<input type="number" name="numc" class="validate" required>
								<label for="numc">N° de Cuenta</label>
							</div>
						</div>
						<button class="btn waves-effect waves-light" type="submit" id="boton" name="enviar"><i class="material-icons right">send</i>Transferir</button>
					</form>
				</div>
				<?php
				if(isset($_POST['transferir']) && !empty($_POST['transferir']) && isset($_POST['numc']) && !empty($_POST['numc']) )
				{
					if($_POST["transferir"]<0)
					{
						echo "<h3>Información de Transacción</h3>";
						echo "<div class='card-panel red darken-2 white-text'>No se pueden transferir valores negativos.</div>";
					}
					else
					{
						$monto_transferir=$_POST['transferir'];
						$numc_transferir=$_POST['numc'];

						if($_SESSION["usuario"]->validarTransferencia($monto_transferir)=='menosque100' or $_SESSION["usuario"]->validarTransferencia($numc_transferir)=='limitetransacciones' )
						{
							if($_SESSION["usuario"]->validarTransferencia($_POST["transferir"])=='menosque100')// Menor que $100
							{
								echo "<h3>Información de Transacción</h3>";
								echo "<div class='card-panel red darken-2 white-text'>El saldo final de la cuenta no puede ser menor a 100.00 balboas.</div>";
							}
							else
							{
								echo "<h3>Información de Transacción</h3>";
								echo "<div class='card-panel red darken-2 white-text'>Solo se pueden realizar un máximo de 3 transferencias por día.</div>";
							}
						}
						else
						{
							$_SESSION["usuario"]->transferencia($_POST["transferir"],$_POST["numc"]);
							$numC=$_SESSION['usuario']->getncuenta();
							$sql="SELECT saldo,id_cuenta FROM cuenta WHERE id_cuenta='$numC'";
							$consulta=$connection->query($sql);
							$consulta=$consulta->fetch_assoc();

							echo "<h3>Información de Transacción</h3>";
							echo "<div class='card-panel green darken-1 white-text'>Se han transferido ".number_format($_POST["transferir"], 2)." con éxito.</div>";
							echo "<table>";
							echo "<thead>";
							echo "<tr>";
							echo "<th>Saldo Final</th>";
							echo "</tr>";
							echo "</thead>";
							echo "<tr>";
							echo "<td>".number_format($consulta['saldo'], 2)."</td>";
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
