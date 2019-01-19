<?php
	/* Añadimos los datos de configuración de conexión */
	include_once($_SERVER['DOCUMENT_ROOT'] . '/' . 'config/functions.php');

	/* Iniciamos sesión */
	session_start();

	/* Variable de control para mostrar un mensaje de error si no se ha logeado */
	$error = false;

	/* Comprueba los datos enviados del formulario de inicio de sesión */
	if(isset($_SESSION['login'])){
		header('Location:./index.php');
	}else if(isset($_POST['loginsubmit'])){
		$checkUserLogin = mysqli_real_escape_string($databaseConnection, $_POST['login']);
		$checkUserPass = mysqli_real_escape_string($databaseConnection, $_POST['password']);

		$consulta = "SELECT * FROM $tableNameUsers WHERE login='$checkUserLogin' AND password=PASSWORD('$checkUserPass')";

		$datos = mysqli_query($databaseConnection, $consulta) or die(mysqli_error($databaseConnection));

		if (mysqli_num_rows($datos) == 1){
			$fila=mysqli_fetch_array($datos, MYSQLI_ASSOC);

			$_SESSION['login'] = $fila['Login'];
			$_SESSION['rol'] = $fila['Rol'];
			$_SESSION['activated'] = $fila["$userColumnActivatedAccount"];
			$_SESSION['avatar'] = $fila['Avatar'];
			$_SESSION['showName'] = $fila['First Name'];

			header('Location: ./index.php');
		}
	}

	/* Si no se ha iniciado sesión, continua en esta página mostrando para iniciar sesión y el error de inicio de sesión */
	$error = true;
?>

<!DOCTYPE html>
<html>
<head>
	<title>Inicio de sesión</title>
</head>
<body>
	<?php include_once './navigator.php'; ?>
	<link rel="stylesheet" type="text/css" href="./js/login.js">

	<br>

	<div class="container cajon-blanco">
		<?php 
			if ($error){
				?>
				<div class='alert alert-danger'>
					Los creedenciales para el inicio de sessión son incorrectos, vuelva a intentarlo.
				</div>

				<div>
					<form id='formLogin' method='POST' action='./login.php' onsubmit='return validarLogin(this);'>
						<input type='text' name='login' placeholder='Login' class="input-group"><br>
						<input type='password' name='password' placeholder='Password' class="input-group"><br>
						<input type='submit' name='loginsubmit' value='Logueate' class="btn btn-secondary"></input>
					</form>
				</div>
				<?php
			}
		?>
	</div>

</body>
</html>

<?php
	/* Cerramos conexión */
	mysqli_close($databaseConnection);
	unset($databaseConnection);
?>