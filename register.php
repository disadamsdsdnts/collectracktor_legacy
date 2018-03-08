<?php
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

		$actualLoginFromUser = $_POST['login'];

		$sql = "SELECT * FROM $tableNameUsers WHERE $usersColumnLogin='$actualLoginFromUser'";

		$query = mysqli_query($databaseConnection, $sql) or die(mysqli_error());

		if(mysqli_num_rows($query)==1){
			$login_ya_registrado = true;
		} else if (mysqli_num_rows($query) == 0) {
			$addLogin = $_POST['login'];
			$addPassword = $_POST['password'];
			$addFirstName = $_POST['firstName'];
			$addLastName = $_POST['lastName'];
			$addEmail = $_POST['email'];
			$addBirthDate = date("Y-m-d", strtotime($_POST['birthdate']));
			$addRol = 'registered';

			$code = rand(1000, 9999);

			$addAvatar = "";

			if(is_uploaded_file($_FILES['fileToUpload']['name'])){
				/* Declaración de variables del directorio de subida y de la ruta inicial donde se va a subir */
				$dir_subida = 'img/avatars/';
				$fichero_subido = $dir_subida . basename($_FILES['fileToUpload']['name']);

				/* Le pone el nombre nuevo que será: id.extensión */
				$imageName = $login . "." . pathinfo($_FILES['fileToUpload']['name'], PATHINFO_EXTENSION);
				
				/* Composición de la ruta final */
				$addAvatar = $dir_subida . $imageName;

				/* Sube el fichero con su nombre temporal y luego lo mueve con el nuevo nombre de arriba */
				move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $addAvatar);
			} else {
				$random = rand(1,5);
				$addAvatar = "img/avatars/bear" . $random . ".png";
			}

			$sql = "INSERT INTO $tableNameUsers ($usersColumnLogin, $usersColumnPassword, $usersColumnFirstName, $usersColumnLastName, $usersColumnEmail, $usersColumnBirthDate, $usersColumnRol, $userColumnAvatar, $userColumnActivationCode) VALUES ('$addLogin', PASSWORD('$addPassword'), '$addFirstName', '$addLastName', '$addEmail', '$usersColumnBirthDate', '$addRol', '$addAvatar', '$code')";

			$query = mysqli_query($databaseConnection, $sql);

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

	<link rel="stylesheet" href="./css/bootstrap.min.css">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>

<body>
	<?php include_once './navigator.php'; ?>

	<link rel="stylesheet" type="text/css" href="./js/login.js">

	<?php
		/* Mensajes de comprobación de que el registro ha sido completado o si hay algún fallo */
		if($registro_completado){
			echo "<div class='container'>";
				echo "<div class='alert alert-success'>";
					echo "El registro ha sido satisfactorio. Te redigiremos al inicio en 5 segundos.";
				echo "</div>";
			echo "</div>";
		} else if (!$registro_completado && !$primera_vez){
			echo "<div class='container'>";
				echo "<div class='alert alert-danger'>";
					echo "No se ha completado el registro. Algo ha fallado en la base de datos.";
				echo "</div>";
			echo "</div>";
		}

		/* Mensaje al usuario para comunicar que el login ya está registrado*/
		if($login_ya_registrado){
			echo "<div class='container'>";
				echo "<div class='alert alert-danger'>";
					echo "No se ha completado el registro. El login ya está siendo utilizado por otro usuario.";
				echo "</div>";
			echo "</div>";
		}
	?>

	<br>

	<div class="container">
		<div class="row">
			<div class="col-12">
				<form action="" method="POST" onsubmit="return validarRegistro(this);" id="registerForm" enctype="multipart/form-data">
					<div class="container">
						<div >
							<h5 class="d-flex justify-content-center" style="color: black;">
								Datos de la cuenta
							</h5>

							<div class="row d-flex justify-content-center">
								<input class="form-control"  type="text" name="login" id="login" placeholder="Login">
							</div>

							<div class="row d-flex justify-content-center">
								<input class="form-control"  type="password" name="password" id="password" placeholder="Contraseña">
							</div>
						</div>

						<hr>

						<div>
							<h5 class="d-flex justify-content-center" style="color: black;">
								Datos del usuario
							</h5>

							<div class="row d-flex justify-content-center">
								<input class="form-control" type="text" name="firstName" placeholder="Nombre real">

								<input class="form-control" type="text" name="lastName" placeholder="Apellidos reales">

								<input class="form-control" type="text" name="email" id="email" placeholder="Correo electrónico">

								<input class="form-control" type="date" name="birthdate" placeholder="Fecha de nacimiento">
							</div>

							<hr>

							<div class="row d-flex justify-content-center">
								<label for="avatar" class="text-center"><h5>Tu avatar</h5></label><br>
								<input form="registerForm" class="form-control" type="file" name="fileToUpload" id="fileToUpload" placeholder="Tu avatar"><br/>
							</div>
						</div>

						<hr>
						
						<div>
							<div class="row d-flex justify-content-center">
								<input type="submit" name="submit" value="Crear usuario" class="btn btn-secondary">						
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
		mysqli_close($databaseConnection);
		unset($databaseConnection);
	}
?>