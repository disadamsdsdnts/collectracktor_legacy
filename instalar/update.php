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
				<h3>Instalando</h3>

				<p class="font-italic small">
					Aquí se mostrará el proceso de instalación: 
				</p>

				<hr/>

				<p id="mensajeria"></p>
			</div>
			<!-- Final de bienvenida -->
		</div>	
	</div>

	<script type="text/javascript" src="../js/instalar_jq.js"></script>
</body>
</html>

<?php
	$error = false;
	$continue = false;

	if (isset($_POST['installSubmit'])){
		/* Asignamos las variables que llegan a nombres más ordenados */
		$conexion = $_POST['installConnection'];
		$database = $_POST['installDatabase'];
		$login = $_POST['installNombre'];
		$password = $_POST['installPassword'];
		$prefix = $_POST['installPrefix'];
		
		$adminLogin = $_POST['adminAccountLogin'];
		$adminPass = $_POST['adminAccountPass'];

		/* Archivo donde estará las conexiones y variables de tablas */
		$configFilePath = "../config/config.php";

		/* Inicializando las variables de tablas */
		$tablaAnuncios = 'anuncios';
		$tablaUsuarios = 'usuarios';

		/* Si el usuario ha decidido poner prefijos, se añadirán aquí */
		if($prefix != ""){
			$tablaAnuncios = $prefix . $tablaAnuncios;
			$tablaUsuarios = $prefix . $tablaUsuarios;
		}


		/* *-*-*-*-*-* Archivo configuración *-*-*-*-*-* */
		/* Comprobamos si existe un config anterior y, si existe, lo borramos para crear uno nuevo */
		if(file_exists($configFilePath)){
			unlink($configFilePath);
		}

		$configFile = fopen($configFilePath, 'w');

		if(is_writable($configFilePath)){
			$configText = 
			"<?php \n" . 
			"/* Datos de conexion */ \n" . 
			'$dbHost=' . "'$conexion'; \n" . 
			'$dbName=' . "'$database'; \n" . 
			'$dbUser=' . "'$login'; \n" . 
			'$dbPass=' . "'$password'; \n\n" . 
			"/* Nombre de las tablas */ \n" . 
			'$tablaAnuncios=' . "'$tablaAnuncios'; \n" . 
			'$tablaUsuarios=' . "'$tablaUsuarios'; \n\n" . 
			'$conexion = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);' . "\n\n" . 
			'mysqli_set_charset($conexion, ' . "'utf8'); \n" . 
			"?>";

			$writingConfigFile = fwrite($configFile, $configText);

			$cerrar = fclose($configFile);
		
			/* Mostramos al usuario de que se ha creado la configuración */
			echo '<script type="text/javascript">';
				echo "document.getElementById('mensajeria').innerHTML += \"<p class='alert alert-success'>[ Archivo de configuración creado. ]</p>\";";
			echo '</script>';

			$continue = true;

		} else {
			$error = true;
			
			echo '<script type="text/javascript">';
				echo "document.getElementById('mensajeria').innerHTML += \"<p class='alert alert-danger'><strong>Instalación abortada: </strong>No se ha podido escribir el archivo config.php. Deberá de comprobar los permisos de los archivos.</p>\";";
			echo '</script>';
		}

		/* *-*-*-*-*-* Crear las tablas *-*-*-*-*-* */
		if(!$error && $continue){
			/* Tabla usuarios */
			/* Si existe, la borra */
			include '../config/config.php';

			$sql = "DROP TABLE IF EXISTS `$database`.`$tablaUsuarios`";

			$consulta = mysqli_query($conexion, $sql);

			include '../config/close_connection.php';

			/* Crea la tabla */
			include '../config/config.php';

			$sql = "CREATE TABLE `$database`.`$tablaUsuarios` (
					    `login` varchar(25) COLLATE utf8_spanish_ci NOT NULL PRIMARY KEY,
						`password` varchar(256) COLLATE utf8_spanish_ci NOT NULL,
						`nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
						`apellidos` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
						`dni` varchar(12) COLLATE utf8_spanish_ci NOT NULL,
						`email` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
						`activado` ENUM('activado','desactivado') COLLATE utf8_spanish_ci NOT NULL DEFAULT 'desactivado',
						`rol` ENUM('administrador','registrado') COLLATE utf8_spanish_ci NOT NULL DEFAULT 'registrado'	
					) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;";

			$consulta = mysqli_query($conexion, $sql);

			include '../config/close_connection.php';

			if(!$consulta){
				$continue = false;

				echo '<script type="text/javascript">';
					echo "document.getElementById('mensajeria').innerHTML += \"<p class='alert alert-danger'><strong>Instalación abortada: </strong>No se ha podido crear la tabla 'usuarios'. Asegurese de que la cuenta que nos ha proporcionado tiene permisos para crearla.</p>\";";
				echo '</script>';
			} else {
				$continue = true;
				echo '<script type="text/javascript">';
					echo "document.getElementById('mensajeria').innerHTML += \"<p class='alert alert-success'>[ Tabla 'usuarios' creada. ]</p>\";";
				echo '</script>';
			}

			/* Tabla anuncios */
			include '../config/config.php';

			$sql = "DROP TABLE IF EXISTS `$database`.`$tablaAnuncios`";
			
			$consulta = mysqli_query($conexion, $sql);

			include '../config/close_connection.php';

			include '../config/config.php';

			$sql = "CREATE TABLE `$database`.`$tablaAnuncios` (
					  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
					  `titulo` varchar(35) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
					  `mensaje` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
					  `fechaPublicacion` datetime NOT NULL,
					  `revisado` ENUM('si', 'no') CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL DEFAULT 'no',
					  `fechaValidez` datetime NOT NULL DEFAULT '2099-12-31 23:59:00',
					  `login` varchar(25) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
					) ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE = utf8_spanish_ci;";

			$consulta = mysqli_query($conexion, $sql);

			include '../config/close_connection.php';

			if(!$consulta){
				$continue = false;

				echo '<script type="text/javascript">';
					echo "document.getElementById('mensajeria').innerHTML += \"<p class='alert alert-danger'><strong>Instalación abortada: </strong>No se ha podido crear la tabla 'anuncios'. Asegurese de que la cuenta que nos ha proporcionado tiene permisos para crearla.</p>\";";
				echo '</script>';
			} else {
				$continue = true;

				echo '<script type="text/javascript">';
					echo "document.getElementById('mensajeria').innerHTML += \"<p class='alert alert-success'>[ Tabla 'anuncios' creada. ]</p>\";";
				echo '</script>';
			}

			/* Configuración adicional */
			$alterTable = array(
				"ALTER TABLE `$database`.`$tablaAnuncios` ADD CONSTRAINT `anuncios_ibfk_1` FOREIGN KEY (`login`) REFERENCES `$tablaUsuarios` (`login`) ON DELETE CASCADE"
			);

			foreach ($alterTable as $peticion) {
				include '../config/config.php';

				$consulta = mysqli_query($conexion, $peticion);

				if(!$consulta){
					$continue = false;
					echo '<script type="text/javascript">';
						echo "document.getElementById('mensajeria').innerHTML += \"<p class='alert alert-danger'><strong>Instalación abortada: </strong>No se ha podido modificar las tablas ya creadas. Asegurese de que la cuenta que nos ha proporcionado tiene permisos para modificarla.$peticion</p>\";";
					echo '</script>';
				}

				include '../config/close_connection.php';
			}

			if($continue){
				echo '<script type="text/javascript">';
					echo "document.getElementById('mensajeria').innerHTML += \"<p class='alert alert-success'>[ Tablas creadas. ]</p>\";";
				echo '</script>';
			}
		}

		/* *-*-*-*-*-*-* Insertar la cuenta del admnistrador *-*-*-*-*-*-*-* */
		if(!$error && $continue && ($adminLogin != "" && $adminPass != "")){
			include '../config/config.php';
			$sql = "INSERT INTO `$database`.`$tablaUsuarios`(login, password, rol, activado, nombre, apellidos, email, dni) VALUES ('$adminLogin', PASSWORD('$adminPass'), 'administrador', 'activado', '$adminLogin', '$adminLogin', ' ', ' ')";

			$consulta = mysqli_query($conexion, $sql);

			include '../config/close_connection.php';

			if(!$consulta){
				$continue = false;
				echo '<script type="text/javascript">';
					echo "document.getElementById('mensajeria').innerHTML += \"<p class='alert alert-danger'><strong>Instalación interrumpida: </strong>No se ha podido crear el usuario administrador. Asegurese de que los credenciales de la base de datos tiene permiso para añadir filas a las tablas.</p>\";";
				echo '</script>';
			} else {
				$continue = true;
				echo '<script type="text/javascript">';
					echo "document.getElementById('mensajeria').innerHTML += \"<p class='alert alert-success'>[ Usuario $adminLogin creado. ]</p>\";";
				echo '</script>';
			}
		}

		/* Avisamos al usuario que está todo listo y lo mandamos al limpiador de archivos. */
		if(!$error && $continue){
			echo '<script type="text/javascript">';
				echo "document.getElementById('mensajeria').innerHTML += \"<p class='alert alert-success'>[ <strong>Instalación finalizada.</strong> Le redirigimos a la web en 5 segundos... ]</p>\";";

				echo "$(document).ready(function() {";
					echo "setTimeout(function(){";
					echo "window.location.replace('./cleaner.php');";
					echo "}, 5000)";
				echo "});";
			echo "</script>";
		}
	}
?>