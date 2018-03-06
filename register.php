<?php
	include './admin/functions.php';
	include './config/config.php';

	session_start();

	/* Variable para llevar el control de que es la primera vez que entra a registrarse */
	$primera_vez = true;

	/* Variable de control de que el registro ha sido realizado */
	$registro_completado = false;

	/* Variable de control para saber si el user se ha registrado con anterioridad */
	$login_ya_registrado = false;

	/* Variable de control para saber si hay una sesión iniciada */
	$usuario_logeado = false;

	/* Si el usuario se ha logeado, mostrar mensaje de no hay necesidad de registrarse, si no se comprueba de que viene un POST con un registro nuevo */
	if(isset($_SESSION['login'])){
		$primera_vez = false;
		$usuario_logeado = true;
	} else if(isset($_POST['submit'])){
		$primera_vez = false;

		openConnection();

		$actualLoginFromUser = $_POST['login'];

		$sql = "SELECT * FROM `" . $tableNameUsers . "` WHERE $usersColumnLogin='$actualLoginFromUser'";

		$query = mysqli_query($databaseConnection, $sql) or die(mysqli_error());

		if(mysqli_num_rows($query)==1){
			$login_ya_registrado = true;
		} else if (mysqli_num_rows($query) == 0) {
			$addLogin = $_POST['login'];
			$addPassword = $_POST['password'];
			$addFirstName = $_POST['firstName'];
			$addLastName = $_POST['lastName'];
			$addEmail = $_POST['email'];
			$addBirthDate = $_POST['birthdate'];
			var_dump($addBirthDate);
			$addRol = 'registered';

			$sql = "INSERT INTO `" . $tableNameUsers . "` ($usersColumnLogin, $usersColumnPassword, $usersColumnFirstName, $usersColumnLastName, $usersColumnEmail, $usersColumnBirthDate, $usersColumnRol) VALUES ('$addLogin', PASSWORD('$addPassword'), '$addFirstName', '$addLastName', '$addEmail', '$usersColumnBirthDate', '$addRol')";

			$query = mysqli_query($databaseConnection, $sql) or die(mysqli_error($databaseConnection));

			if($query){
				$registro_completado = true;
			}
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Página de registro</title>

	<script type="text/javascript" src="./js/jquery-3.2.1.slim.min.js"></script>
	<script type="text/javascript" src="./js/popper.min.js"></script>
	<script type="text/javascript" src="./js/bootstrap.min.js"></script>
	<script type="text/javascript" src="./js/registros.js"></script>

	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="./css/registrados.css">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>

<body>
	<?php include_once './navigator.php'; ?>

	<?php
		/* Mensajes de comprobación de que el registro ha sido completado o si hay algún fallo */
		if($registro_completado){
			echo "<div class='container'>";
				echo "<div class='correcto'>";
					echo "El registro ha sido satisfactorio. Te redigiremos al inicio en 5 segundos.";
				echo "</div>";
			echo "</div>";
		} else if (!$registro_completado && !$primera_vez){
			echo "<div class='container'>";
				echo "<div class='fallo'>";
					echo "No se ha completado el registro. Algo ha fallado en la base de datos.";
				echo "</div>";
			echo "</div>";
		}

		/* Mensaje al usuario para comunicar que el login ya está registrado*/
		if($login_ya_registrado){
			echo "<div class='container'>";
				echo "<div class='fallo'>";
					echo "No se ha completado el registro. El login ya está siendo utilizado por otro usuario.";
				echo "</div>";
			echo "</div>";
		}
	?>

	<div class="container">

		<div class="row">
			<div class="col-12">
				<form action="" method="POST" onsubmit="return validarRegistro(this);">
					<div class="cajon-blanco">
						<div class="cajon-blanco-noshadow">
							<span class="d-flex justify-content-center" style="color: black;">
								Datos de la cuenta
							</span>

							<div class="row d-flex justify-content-center">
								<input type="text" name="login" id="login" placeholder="Login">
							</div>

							<div class="row d-flex justify-content-center">
								<input type="password" name="password" id="password" placeholder="Contraseña">
							</div>
						</div>

						<div class="cajon-blanco-noshadow">
							<span class="d-flex justify-content-center" style="color: black;">
								Datos del usuario
							</span>

							<div class="row d-flex justify-content-center">
								<input type="text" name="firstName" placeholder="Nombre real">
							</div>

							<div class="row d-flex justify-content-center">
								<input type="text" name="lastName" placeholder="Apellidos reales">
							</div>

							<div class="row d-flex justify-content-center">
								<input type="text" name="email" id="email" placeholder="Correo electrónico">
							</div>

							<div class="row d-flex justify-content-center">
								<input type="date" name="birthdate" placeholder="Fecha de nacimiento">
							</div>
						</div>

						<div class="cajon-blanco-noshadow">
							<div class="row d-flex justify-content-center">
								<input type="submit" name="submit" value="Crear usuario">							
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

	<?php
		/* Si el usuario tiene cuenta y está logeado, se avisa y se le redirije al index. */
		if ($usuario_logeado){
			echo "<script>";
				echo "$(document).ready(function() {";
					echo "alert('Ya estás registrado, no es necesario volverte a registrar.');";
					echo "setTimeout(function(){";
					echo "window.location.replace('./index.php');";
					echo "}, 200)";
				echo "});";
			echo "</script>";
		}

		/* Si el registro ha sido un éxito, se le redirige en 5 segundos */
		if($registro_completado){
			echo "<script type='text/javascript'>";
				echo "$(document).ready(function() {";
					echo "setTimeout(function(){";
					echo "window.location.replace('./index.php');";
					echo "}, 5000)";
				echo "});";
			echo "</script>";
		}
	?>
</body>
</html>

<?php

	if(isset($_POST['submit'])){
		/* Cerramos conexión */
		closeConnection();
	}
?>