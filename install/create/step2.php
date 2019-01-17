<?php
	include_once (SERVER_PATH . 'config/functions.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Colec-track-tor</title>
</head>
<body>
	<meta charset="utf-8">
	<script type="text/javascript" src="<?php echo SERVER_PATH; ?>js/jquery-3.2.1.slim.min.js"></script>
	<script type="text/javascript" src="<?php echo SERVER_PATH; ?>js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="<?php echo SERVER_PATH; ?>js/popper.min.js"></script>
	<script type="text/javascript" src="<?php echo SERVER_PATH; ?>js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo SERVER_PATH; ?>css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo SERVER_PATH; ?>css/general.css">
	<script type="text/javascript" src="<?php echo SERVER_PATH; ?>js/instalar.js"></script>

	<nav id="navigation-bar" class="navbar navbar-dark bg-dark">
	  <a class="navbar-brand" href="../index.php">Colec-track-tor</a>
	</nav>

	<br>

	<div class="container">
		<h1>Paso 2. </h1><h3>Introducción de información necesaria</h3>

		<br>

		<div class="row">
			<div class="col-6">
				<div class="card">
					<div class="card-header text-white bg-dark">
						<strong>
							Datos de conexión a la base de datos
						</strong>
					</div>

					<div class="card-body form-group">
						<div class="input-group mb-3">
						  <div class="input-group-prepend">
						    <span class="input-group-text" id="installConnection">Conexión a la base de datos</span>
						  </div>
						  <input form="formInstallWA" type="text" class="form-control" placeholder="localhost" aria-label="localhost" aria-describedby="installConnection" value="localhost" name="installConnection" required>
						</div>

						<div class="input-group mb-3">
						  <div class="input-group-prepend">
						    <span class="input-group-text" id="installDatabase">Nombre de la base de datos</span>
						  </div>
						  <input form="formInstallWA" type="text" class="form-control" placeholder="Base de datos" aria-label="Base de datos" aria-describedby="installDatabase" name="installDatabase" required>
						</div>

						<div class="input-group mb-3">
						  <div class="input-group-prepend">
						    <span class="input-group-text" id="installNombre">Usuario de la base de datos</span>
						  </div>
						  <input form="formInstallWA" type="text" class="form-control" placeholder="Usuario" aria-label="Usuario" aria-describedby="installNombre" name="installNombre" required>
						</div>

						<div class="input-group mb-3">
						  <div class="input-group-prepend">
						    <span class="input-group-text" id="installPassword">Contraseña de la base de datos</span>
						  </div>
						  <input form="formInstallWA" type="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="installPassword" name="installPassword" required>
						</div>
					</div>
				</div>
			</div>

			<div class="col-6">
				<div class="card">
					<div class="card-header text-white bg-dark">
						<strong>Prefijo de tablas</strong>
					</div>
					
					<div class="card-body">
						<div class="input-group mb-3">
						  <div class="input-group-prepend">
						    <span class="input-group-text" id="installPassword">Prefijo de tablas</span>
						  </div>
						  <input form="formInstallWA" type="text" class="form-control" placeholder="Prefijo" aria-label="Prefijo" aria-describedby="installPrefix" name="installPrefix" required>
						</div>
						
						<span class="text-justify font-italic">
						  	(puede utilizar un prefijo para tener ordenada la base de datos si tiene varias aplicaciones instaladas en la misma base de datos. Deje en blanco si no desea tener prefijos.)
						</span>
					</div>
				</div>
			</div>
		</div>

		<br>

		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header text-white bg-dark">
						<strong>Cuenta de administración</strong>
					</div>

					<div class="card-body">
						<span class="font-italic text-justify">
							(esta cuenta servirá para administrar todos los apartados desde la página web a través del panel de control disponible una vez iniciada la sesión con dicha cuenta.)
						</span>

						<hr>

						<div class="input-group mb-3">
						  <div class="input-group-prepend">
						    <span class="input-group-text" id="adminAccountLogin">Usuario</span>
						  </div>
						  <input form="formInstallWA" type="text" class="form-control" placeholder="Usuario" aria-label="Usuario" aria-describedby="adminAccountLogin" name="adminAccountLogin" onsubmit="return checkForm(this);"" required>
						</div>

						<div class="input-group mb-3">
						  <div class="input-group-prepend">
						    <span class="input-group-text" id="adminAccountPass">Contraseña</span>
						  </div>
						  <input form="formInstallWA" type="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="adminAccountPass" name="adminAccountPass" required>
						</div>

						<div class="input-group mb-3">
						  <div class="input-group-prepend">
						    <span class="input-group-text" id="adminAccountFirstName">Nombre</span>
						  </div>
						  <input form="formInstallWA" type="text" class="form-control" placeholder="Nombre" aria-label="Nombre" aria-describedby="adminAccountFirstName" name="adminAccountFirstName">
						</div>

						<div class="input-group mb-3">
						  <div class="input-group-prepend">
						    <span class="input-group-text" id="adminAccountLastName">Apellidos</span>
						  </div>
						  <input form="formInstallWA" type="text" class="form-control" placeholder="Apellidos" aria-label="Apellidos" aria-describedby="adminAccountLastName" name="adminAccountLastName">
						</div>

						<div class="input-group mb-3">
						  <div class="input-group-prepend">
						    <span class="input-group-text" id="adminAccountEmail">Correo electrónico</span>
						  </div>
						  <input form="formInstallWA" type="text" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="adminAccountEmail" name="adminAccountEmail">
						</div>

						<div class="input-group mb-3">
						  <div class="input-group-prepend">
						    <span class="input-group-text" id="adminAccountBirthdate">Cumpleaños</span>
						  </div>
						  <input form="formInstallWA" type="date" class="form-control" placeholder="Fecha" aria-label="Fecha" aria-describedby="adminAccountBirthdate" name="adminAccountBirthdate">
						</div>

						<div class="input-group mb-3">
						  <div class="input-group-prepend">
						    <span class="input-group-text" id="adminAccountAvatar">Avatar</span>
						  </div>
						  <input form="formInstallWA" type="file" class="form-control" placeholder="Avatar" aria-label="Avatar" aria-describedby="adminAccountAvatar" name="adminAccountAvatar">
						</div>
					</div>
				</div>
			</div>
		</div>

		<br>

		<div class="row">
			<div class="col-6">
				<div class="card">
					<div class="card-header text-white bg-dark">
						<strong>
							Datos de conexión a la base de datos
						</strong>
					</div>

					<div class="card-body form-group">
						<div class="input-group mb-3">
						  <div class="input-group-prepend">
						    <span class="input-group-text" id="creatorLogin">Usuario con permisos de creación</span>
						  </div>
						  <input form="formInstallWA" type="text" class="form-control" placeholder="Usuario" aria-label="Usuario" aria-describedby="creatorLogin" name="creatorLogin" required>
						</div>

						<div class="input-group mb-3">
						  <div class="input-group-prepend">
						    <span class="input-group-text" id="creatorPassword">Contraseña del usuario creador</span>
						  </div>
						  <input form="formInstallWA" type="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="creatorPassword" name="creatorPassword" required>
						</div>
					</div>
				</div>
			</div>
		</div>

		<br>

		<div class="row">
			<div class="col-12">
				<div class="text-right">
					<form method="POST" action="./create/step3.php" id="formInstallWA" enctype="multipart/form-data">
						<input type="submit" name="installSubmit" class="btn btn-secondary" value="Finalizar instalación">
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>