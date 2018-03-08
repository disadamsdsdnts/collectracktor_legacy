<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<script type="text/javascript" src="../js/jquery-3.2.1.slim.min.js"></script>
	<script type="text/javascript" src="../js/popper.min.js"></script>
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../js/codigos.js"></script>
	<link rel="stylesheet" type="text/css" href="../css/admin.css">
	<link rel="stylesheet" type="text/css" href="../css/instalar.css">
	<script type="text/javascript" src="../js/instalar.js"></script>
	
	<title>Bienvenido a la instalación de "Adanuncios"</title>
	<meta charset="utf-8">
</head>

<body>
	<div class="container-fluid">
		<div class="row d-flex justify-content-center">
			<div class="col-4 logo-container d-flex justify-content-center">
				<img src="../media/img/logo.png" alt="Logo" id="logo">
			</div>

			<div class="col-1">
			</div>

			<!-- Inicio de bienvenida -->
			<div class="col-6 white-container" id="welcome">
				<h3>Bienvenido al asistente de instalación</h3>

				<p class="font-italic small">
					Escoja la opción que más se adecua a su sistema:
				</p>

				<hr><br>
				
				<button class="btn btn-primary welcome-btn" id="ihaveadb">Tengo una base de datos y deseo crear las tablas ahí.</button>
					<p class="font-italic small info">
						(Introducirá el nombre de la BD, la conexión y el usuario/password que administrará las tablas que, por seguridad, deberá solo tener permisos para los datos de esas tablas y no de otras.)
					</p>

				<br><br><br>

				<button class="btn btn-primary welcome-btn" id="idonthaveadb">No tengo una base de datos, pero tengo permiso para crearla.</button>
					<p class="font-italic small info">
						(Introducirá sus credenciales de administrador para crear la base de datos, las tablas y el usuario que manejará la información y conexión. Sus credenciales serán usadas y borradas una vez se haya completado el proceso. <span class="advertencia">Se borrarán todos los datos.</span>)
					</p>

				<br><br><br>
			</div>
			<!-- Final de bienvenida -->

			<!-- Opción 1: Hay base de datos existente UpdateInfoWA-->
			<div class="col-6 white-container" id="updateInfoWA">
				<h3 id="opcion1-title">Actualizando datos de instalación</h3>

				<p class="font-italic small" id="opcion1-title-info">
					Introduzca los datos que se solicitan a continuación para la creación de los archivos de configuración.
				</p>

				<hr/>

				<form method="POST" action="./update.php" id="formUpdateInfo">
					<label for="installConnection" class="labelInfoStep1"><strong>Conexión a la base de datos:</strong></label>
					<input type="text" name="installConnection" value="localhost" class="infoWAstep1" required/>

					<p class="labelInfoStep1"><br><br><br></p>

					<label for="installDatabase" class="labelInfoStep1"><strong>Nombre de la base de datos:</strong></label>
					<input type="text" name="installDatabase" class="infoWAstep1" required/>

					<p class="labelInfoStep1"><br><br><br></p>

					<label for="installNombre" class="labelInfoStep1"><strong>Usuario de la base de datos:</strong></label>
					<input type="text" name="installNombre" class="infoWAstep1" required/>

					<p class="labelInfoStep1"><br><br><br></p>

					<label for="installPassword" class="labelInfoStep1"><strong>Contraseña de la base de datos:</strong></label>
					<input type="password" name="installPassword" class="infoWAstep1" required/>

					<p class="labelInfoStep1"><br><br><br></p>

					<!-- Segunda pantalla -->

					<label for="installPrefix" class="infoWAstep2"><strong>Prefijo de tablas:</strong></label>
					<input type="text" name="installPrefix" value="ads_" class="infoWAstep2">
					<span class="font-italic small infoWAstep2">
						(si ha utilizado algún prefijo para la creación de las tablas 'usuarios' y 'anuncios', escriba aquí el prefijo. Si no tiene prefijo, deje este campo en blanco.)
					</span>

					<p id="infoWAstep2hr"></p>

					<label for="adminAccountLogin" class="infoWAstep2"><strong>Nombre del administrador: </strong></label>
					<input type="text" name="adminAccountLogin" class="infoWAstep2">

					<p class="infoWAstep2"><br><br><br></p>

					<label for="adminAccountPass" class="infoWAstep2"><strong>Contraseña del administrador: </strong></label>
					<input type="password" name="adminAccountPass" class="infoWAstep2">
					<span class="font-italic small infoWAstep2">
						(esta cuenta servirá para administrar todos los apartados desde la página web a través del panel de control disponible una vez iniciada la sesión con dicha cuenta. Si ya tiene una cuenta, por favor, deje en blanco estos dos campos.)
						
					</span>

					<p class="infoWAstep2"><br><br><br></p>
					<input type="submit" name="installSubmit" value="Instalar" class="btn btn-primary infoWAstep2" id="updateButton">	
				</form>
				 				
				<button id="nextButtonUpdateWAstep2" class="btn btn-primary">Siguiente ></button>
			</div>
			<!-- Final de la opción 1 -->

			<!-- Opción 2: No hay base de datos fullInstallWA-->
			<div class="col-6 white-container" id="fullInstallWA">
				<h3 id="opcion2-title">Bienvenido al segundo paso de instalación</h3>

				<p class="font-italic small" id="opcion2-title-info">
					Se creará la base de datos, las tablas con el prefijo elegido y se creará un usuario con privilegios sobre esa base de datos.
				</p>

				<hr/>

				<form method="POST" action="./creation.php" id="formInstallWA" onsubmit="return checkForm(this);">
					<!-- Paso 0: creedenciales para crear la infraestructura -->
					<label for="creatorUser" class="labelStep0"><strong>Usuario con privilegios:</strong></label>
					<input type="text" name="creatorUser" class="installWAstep0" required/>

					<p class="labelStep0"><br><br><br></p>

					<label for="creatorPassword" class="labelStep0"><strong>Contraseña del usuario privilegiado:</strong></label>
					<input type="password" name="creatorPassword" class="installWAstep0" required/>
					
					<p class="labelStep0"><br><br></p>

					<span class="font-italic small labelStep0">
							(Recuerde que estos datos no se almacenarán en ningún fichero, serán utilizados solo para crear la infraestructura de la base de datos.)
					</span>
					<!-- FIN Paso 0 -->

					<!-- Paso 1: datos de la base de datos -->
					<label for="installConnection" class="labelStep1"><strong>Conexión a la base de datos:</strong></label>
					<input type="text" name="installConnection" value="localhost" class="installWAstep1" required/>

					<p class="labelStep1"><br><br><br></p>

					<label for="installDatabase" class="labelStep1"><strong>Nombre de la base de datos:</strong></label>
					<input type="text" name="installDatabase" class="installWAstep1" required/>

					<p class="labelStep1"><br><br><br></p>

					<label for="installNombre" class="labelStep1"><strong>Usuario de la base de datos:</strong></label>
					<input type="text" name="installNombre" class="installWAstep1" required/>

					<p class="labelStep1"><br><br><br></p>

					<label for="installPassword" class="labelStep1"><strong>Contraseña de la base de datos:</strong></label>
					<input type="password" name="installPassword" class="installWAstep1" required/>

					<p class="labelStep1"><br><br><br></p>
					<!-- FIN Paso 1 -->

					<!-- Paso 2: prefijos y cuenta de admin -->
					<label for="installPrefix" class="installWAstep2"><strong>Prefijo de tablas:</strong></label>
					<input type="text" name="installPrefix" value="ads_" class="installWAstep2">
					<span class="font-italic small installWAstep2">
						(puede utilizar un prefijo para tener ordenada la base de datos si tiene varias aplicaciones instaladas en la misma base de datos. Deje en blanco si no desea tener prefijos.)
					</span>

					<p id="labelStep2hr"></p>

					<label for="adminAccountLogin" class="installWAstep2"><strong>Nombre del administrador: </strong></label>
					<input type="text" name="adminAccountLogin" class="installWAstep2">

					<p class="labelStep2"><br><br><br></p>

					<label for="adminAccountPass" class="installWAstep2"><strong>Contraseña del administrador: </strong></label>
					<input type="password" name="adminAccountPass" class="installWAstep2">
					<span class="font-italic small installWAstep2">
						(esta cuenta servirá para administrar todos los apartados desde la página web a través del panel de control disponible una vez iniciada la sesión con dicha cuenta.)
					</span>
					<!-- FIN Paso 2 -->

					<input type="submit" name="installSubmit" value="Instalar" class="btn btn-primary installWAstep2" id="installButton">	
				</form>
				<button id="nextButtonInstallWAstep1" class="btn btn-primary">Siguiente ></button>
				<button id="nextButtonInstallWAstep2" class="btn btn-primary">Siguiente ></button>
			</div>
			<!-- Final de la opción 2 -->
		</div>	
	</div>

	<script type="text/javascript" src="../js/instalar_jq.js"></script>
</body>
</html>