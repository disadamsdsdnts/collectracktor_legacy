<?php
	include_once($_SERVER['DOCUMENT_ROOT'] . '/' . 'config/functions.php');

	session_start();

	/* Función que devuelve al index si no es administrador */
	youDontBelongHere();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Panel de control</title>
	<meta charset="utf-8">
	<script type="text/javascript" src="../js/jquery-3.2.1.slim.min.js"></script>
	<script type="text/javascript" src="../js/popper.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../css/global.css">
	<link rel="stylesheet" type="text/css" href="../css/index.css">
	<link rel="stylesheet" type="text/css" href="../css/admin.css">
</head>

<body>
	<?php 
		include_once '../navigator_inside.php';
	?>

	<br>

	<div class="card card-body" id="caridad">
		<div class="container">
			<div class="row">
				<h1>Administración</h1>
			</div>
		</div>

		<div class="container">
			<div class="d-flex justify-content-between">
				<a href="./users_list.php">
					<button class="btn btn-secondary">Lista de usuarios</button>
				</a>

				<a href="./create_admin.php">
					<button class="btn btn-secondary">Crear cuenta de administrador</button>
				</a>
			</div>
		</div>
	</div>
</body>
</html>