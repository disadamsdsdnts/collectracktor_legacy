<?php
	include_once($_SERVER['DOCUMENT_ROOT'] . '/' . 'config/functions.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Colec-track-tor</title>
</head>
<body>

	<meta charset="utf-8">
	<script type="text/javascript" src="<?= DOMAIN_PATH; ?>js/jquery-3.2.1.slim.min.js"></script>
	<script type="text/javascript" src="<?= DOMAIN_PATH; ?>js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="<?= DOMAIN_PATH; ?>js/popper.min.js"></script>
	<script type="text/javascript" src="<?= DOMAIN_PATH; ?>js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="<?= DOMAIN_PATH; ?>css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?= DOMAIN_PATH; ?>css/general.css">
	<script type="text/javascript" src="<?= DOMAIN_PATH; ?>js/login.js"></script>

	<nav id="navigation-bar" class="navbar navbar-dark bg-dark">
	  <a class="navbar-brand" href="<?= DOMAIN_PATH; ?>index.php">Colec-track-tor</a>
	</nav>

	<br><hr><br>

	<div class="container">
		<div class="row">
			<div class="col-12 text-center">
				<h1>🚜 Colec-track-tor 📇</h1>
			</div>
		</div>

		<br>

		<h1>Paso 1. </h1><h3>Seleccione el estilo de instalación</h3>

		<br>

		<div class="row">
			<div class="col-6">
				<a href="<?= DOMAIN_PATH; ?>install/insert/step2.php" style="text-decoration: none;">
				<div class="card">
					<div class="card-header bg-dark text-white">
						<strong>Tengo una base de datos y quiero crear las tablas dentro.</strong>
					</div>
					<div class="card-body">
						<span class="text-justify font-italic">
							Introducirá el nombre de la BD, la conexión y el usuario/password que administrará las tablas que, por seguridad, deberá solo tener permisos para los datos de esas tablas y no de otras.
						</span>
					</div>
				</div>
				</a>
			</div>

			<div class="col-6">
				<a href="<?= DOMAIN_PATH; ?>install/create/step2.php" style="text-decoration: none;">
				<div class="card">
					<div class="card-header bg-dark text-white">
						<strong>No tengo una base de datos, pero tengo permisos para poder crearla.</strong>
					</div>
					<div class="card-body">
						<span class="text-justify font-italic">
							Introducirá sus credenciales de administrador para crear la base de datos, las tablas y el usuario que manejará la información y conexión. Sus credenciales serán usadas y borradas una vez se haya completado el proceso. <span class="font-weight-bold" style="color: red;">Se borrarán todos los datos</span>.
						</span>
					</div>
				</div>
				</a>
			</div>
		</div>
	</div>
</body>
</html>
