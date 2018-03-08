<?php
	session_start();
	$alerta_desconocido = false;

	include_once './config/config.php';

	if ($_SESSION['activated'] == '1'){
		header('Location: ./index.php');
	}

	if (!isset($_SESSION['login'])){
		$alerta_desconocido = true;
	} else if (isset($_POST['submitActivationCode'])){
		$login=$_SESSION['login'];
		$code = mysqli_real_escape_string($conexion, $_POST['activationCode']);

		$consulta = "SELECT * FROM $tableNameUsers WHERE Login='$login' AND $userColumnActivatedAccount='$code'";

		$datos = mysqli_query($conexion, $consulta);

		if (mysqli_num_rows($datos) == 1){
			$consulta = "UPDATE $tableNameUsers SET $userColumnActivatedAccount=1 WHERE Login='$login'";

			$datos = mysqli_query($conexion, $consulta);

			$_SESSION['activated'] = '1';
		}
	}
?>
<?php include_once './navigator.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<div class="card-body">
		<h4 class="card-title">Malas noticias</h4>
		<p class="card-text">
			Has podido crearte una cuenta y estás ya iniciado en el sistema, pero la cuenta no se ha activado. Contacte con un administrador solicitando el código de activación.
		</p>
		<p class="card-text">
			¿Tienes el código? ¡INTRODÚCELO YA!
			<form action="./inactive.php" method="POST">
				<input type="password" name="activationCode" placeholder="Escribe el código aquí."><br/>
				<input type="submit" name="submitActivationCode" value="Enviar">
			</form>
		</p>
		<p class="card-text">
			<a href="./index.php" class="links-campo">
				Volver al inicio.
			</a>
		</p>
	</div>
</body>
</html>