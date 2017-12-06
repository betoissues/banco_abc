<!DOCTYPE html>
<html>
<head>
	<?php
	include("conexion.php");
	include("gestion.php");
	session_start();
	if(!isset($_SESSION["usuario"])){
		header('Location: index.php');
	}
	include('include/head.php'); ?>
	<title>Reporte | E Bank</title>
</head>
<body class="blue-grey lighten-5">
	<?php include('include/menu.php');
	$ncuenta=$_SESSION['usuario']->getncuenta();
	?>
	<main>
	<div class="container">
		<section>
			<div class="row">
				<form class="col s12" method="post">
					<div class="row">
						<div class="input-field s12 m6">
							<input type="date" class="datepicker" name="fechainicial">
							<label for="fechainicial">Fecha inicial</label>
						</div>
					</div>
					<div class="row">
						<div class="input-field s12 m6">
							<input type="date" name="fechafinal" class="datepicker">
							<label for="fechafinal">Fecha final</label>
						</div>
					</div>
					<div class="row">
						<div class="input-field col s12 m2">
							<button class="btn waves-effect waves-light" name="porfecha" type="submit">Buscar</button>
						</div>
						<div class="input-field col s12 m4">
							<button class="btn waves-effect waves-light" name="todos" type="submit">Todas</button>
						</div>
					</div>
				</form>
			</div>
			<?php
			echo "<h3>Historial de Transacciones</h3>";

			if( isset($_POST['todos']))
			{
				echo '<table class="bordered highlight">';
				echo "<thead>";
				echo "<tr>";
				echo "<th>ID</th> ";
				echo "<th>Nombre</th>";
				echo "<th>Fecha</th>";
				echo "<th>Monto</th>";
				echo "</tr>";
				echo "</thead>";
				$sql = "SELECT id_trans,nombre,fecha,monto from transaccion WHERE id_cuenta='$ncuenta' order by fecha";
				$consulta=$connection->query($sql);
				while($tds = $consulta->fetch_assoc())
				{
					echo "<tr>";
					echo '<td>'.$tds['id_trans'].'</td>';
					echo '<td>'.$tds['nombre'].'</td>';
					echo '<td>'.$tds['fecha'].'</td>';
					echo '<td>'.number_format($tds['monto'], 2).'</td>';
					echo "</tr>";
				}
				echo "</table>";
			}
			elseif (isset($_POST['porfecha']))
			{
				echo '<table class="bordered highlight">';
				echo "<thead>";
				echo "<tr>";
				echo "<th>ID</th> ";
				echo "<th>Nombre</th>";
				echo "<th>Fecha</th>";
				echo "<th>Monto</th>";
				echo "</tr>";
				echo "</thead>";
				$inicio=$_POST['fechainicial'];
				$final=$_POST['fechafinal'];
				$sql = "SELECT id_trans,nombre,fecha,monto from transaccion WHERE id_cuenta='$ncuenta' AND cast(fecha as date) BETWEEN '$inicio' AND '$final' order by fecha ";
				$consulta=$connection->query($sql);
				while($tds = $consulta->fetch_assoc())
				{
					echo "<tr>";
					echo '<td>'.$tds['id_trans'].'</td>';
					echo '<td>'.$tds['nombre'].'</td>';
					echo '<td>'.$tds['fecha'].'</td>';
					echo '<td>'.number_format($tds['monto'], 2).'</td>';
					echo "</tr>";
				}
				echo "</table>";
			}
			?>

		</section>
	</div>
</main>
	<?php include('include/footer.php'); ?>
</body>
</html>
