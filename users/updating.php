<?php
	session_start();

	include_once($_SERVER['DOCUMENT_ROOT'] . '/' . 'config/functions.php');
	
	$usuarioActual = $_SESSION['login'];

	if(isset($_POST['updatingAvatar-submit'])){
		/* Declaración de variables del directorio de subida y de la ruta inicial donde se va a subir */
		$dir_subida = 'img/avatars/';
		$fichero_subido = $dir_subida . basename($_FILES['updatingAvatar-img']['name']);

		/* Le pone el nombre nuevo que será: id.extensión */
		$imageName = $usuarioActual . "." . pathinfo($_FILES['updatingAvatar-img']['name'], PATHINFO_EXTENSION);
		
		/* Composición de la ruta final */
		$avatar = $dir_subida . $imageName;

		/* Sube el fichero con su nombre temporal y luego lo mueve con el nuevo nombre de arriba */
		move_uploaded_file($_FILES['updatingAvatar-img']['tmp_name'], ('../' . $avatar));

		$query = "UPDATE $tableNameUsers SET Avatar='$avatar' WHERE Login='$usuarioActual'";

		$datos = mysqli_query($databaseConnection, $query);

		$consulta = "SELECT * FROM $tableNameUsers WHERE Login='$usuarioActual'";
		$datos = mysqli_query($databaseConnection, $consulta);
		$fila=mysqli_fetch_array($datos, MYSQLI_ASSOC);
		$_SESSION['avatar'] = $fila['Avatar'];
	}

	if(isset($_POST['updatingNombre-submit'])){
		$nuevoNombre = $_POST['updatingNombre-nombre'];

		$query = "UPDATE $tableNameUsers SET `First Name`='$nuevoNombre' WHERE Login='$usuarioActual'";

		$datos = mysqli_query($databaseConnection, $query);
	}

	if(isset($_POST['updatingPassword-submit'])){
		$nuevaPassword = mysqli_real_escape_string($databaseConnection, $_POST['updatingPassword-newPassword']);

		$query = "UPDATE $tableNameUsers SET Password=PASSWORD('$nuevaPassword') WHERE Login='$usuarioActual'";

		$datos = mysqli_query($databaseConnection, $query);

	}

	$query = "SELECT * FROM $tableNameUsers WHERE Login='$usuarioActual'";

	$datos = mysqli_query($databaseConnection, $query);

	$fila = mysqli_fetch_array($datos, MYSQLI_ASSOC);

	$_SESSION['login'] = $fila['Login'];
	$_SESSION['avatar'] = $fila['Avatar'];
	$_SESSION['showName'] = $fila['First Name'];

	header("Location: ./index.php");
?>