<?php
	include($_SERVER['DOCUMENT_ROOT'] . '/' . 'config/functions.php');
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
	<link rel="stylesheet" type="text/css" href="<?= DOMAIN_PATH; ?>css/installer/installer.css">


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

		<h1>Paso 3. </h1><h3>Instalando...</h3>

		<br>

		<div class="row" id="mensajeria">


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
		$adminFirstName = $_POST['adminAccountFirstName'];
		$adminLastName = $_POST['adminAccountLastName'];
		$adminEmail = $_POST['adminAccountEmail'];
		$adminBirthday = $_POST['adminAccountBirthdate'];

		/* Archivo donde estará las conexiones y variables de tablas */
		$configFilePath = DOCUMENT_ROOT . "config/config.php";

		/* Inicializando las variables de tablas */
		$tablaBooks = 'books';
		$tablaCans = 'cans';
		$tablaCollections = 'collections';
		$tablaItem = 'item';
		$tablaMovies = 'movies';
		$tablaMusic = 'music';
		$tablaCex = 'cex';
		$tablaUserDefinedCollections = 'userdefinedcollections';
		$tablaUsers = 'users';

		/* Si el usuario ha decidido poner prefijos, se añadirán aquí */
		if($prefix != ""){
			$tablaBooks = $prefix . $tablaBooks;
			$tablaCans = $prefix . $tablaCans;
			$tablaCollections = $prefix . $tablaCollections;
			$tablaItem = $prefix . $tablaItem;
			$tablaMovies = $prefix . $tablaMovies;
			$tablaMusic = $prefix . $tablaMusic;
			$tablaCex = $prefix . $tablaCex;
			$tablaUserDefinedCollections = $prefix . $tablaUserDefinedCollections;
			$tablaUsers = $prefix . $tablaUsers;
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
			'$databaseHostConnection=' . "'$conexion'; \n" . 
			'$databaseUserConnection=' . "'$login'; \n" . 
			'$databasePasswordConnection=' . "'$password'; \n" . 
			'$databaseNameConnection=' . "'$database'; \n\n" . 
			'$databaseConnection = mysqli_connect($databaseHostConnection, $databaseUserConnection, $databasePasswordConnection, $databaseNameConnection);' . "\n\n" . 
			'mysqli_set_charset($databaseConnection, ' . "'utf8'); \n\n" .
			"/* Table users */\n" .
			'$tableNameUsers =' . "'$tablaUsers';\n\n" .
			'$usersColumnLogin =' . "'Login';\n" .
			'$usersColumnPassword =' . "'Password';\n" .
			'$usersColumnFirstName =' . "'`First Name`';\n" .
			'$usersColumnLastName =' . "'`Last Name`';\n" .
			'$usersColumnEmail =' . "'Email';\n" .
			'$usersColumnBirthDate =' . "'`Birth Date`';\n" .
			'$usersColumnRol =' . "'Rol';\n" .
			'$userColumnAvatar =' . "'Avatar';\n" .
			'$userColumnActivationCode =' . "'`Activation Code`';\n" .
			'$userColumnActivatedAccount =' . "'`Activated Account`';\n\n" .
			'$userPreDefinedTable =' . "'`$tablaUserDefinedCollections`';\n" .
			"/* Table collections */\n" . 
			'$tableCollections =' . "'$tablaCollections';\n\n" . 
			"/* Table item */\n" . 
			'$tableItem =' . "'$tablaItem';\n\n" .
			"/* Table cans */\n" . 
			'$tableCans =' . "'$tablaCans';\n\n" . 
			'$canBrand =' . "'Brand';\n" . 
			'$canFlavor =' . "'Flavor';\n" . 
			'$canQuantity =' . "'Quantity';\n" . 
			'$canYear =' . "'Year';\n" . 
			'$canBarcode =' . "'Barcode';\n" . 
			'$canCountry =' . "'Country';\n" . 
			'$canImage =' . "'Image';\n\n" . 
			"/* Table movies */\n" . 
			'$tableMovies =' . "'$tablaMovies';\n\n" . 
			"/* Table music */\n" . 
			'$tableMusic =' . "'$tablaMusic';\n" . 
			'$musicArtist =' . "'Artist';\n" . 
			'$musicTitle =' . "'Title';\n" . 
			'$musicPublishDate =' . "'`Publish Date`';\n" . 
			'$musicRecordCompany =' . "'`Record Company`';\n" . 
			'$musicType =' . "'Type';\n" . 
			'$musicBarcode =' . "'Barcode';\n" . 
			'$musicImage =' . "'Image';\n\n" . 
			"/* Table books */\n" . 
			'$tableBooks =' . "'$tablaBooks';\n\n" . 
			'$bookTitle =' . "'Title';\n" . 
			'$bookAuthor =' . "'Author';\n" . 
			'$bookPublisher =' . "'Publisher';\n" . 
			'$bookPublishDate =' . "'`Publish date`';\n" . 
			'$bookISBN =' . "'ISBN';\n" . 
			'$bookImage =' . "'Image'; \n\n" . 
			"/* Table Cex */\n" . 
			'$tableCex =' . "'`$tablaBooks`';\n\n" . 
			'$cexName =' . "'Name';\n" . 
			'$cexURL =' . "'URL';\n" . 
			'$cexPrice =' . "'Price';\n" . 
			'$cexLastCheck =' . "'`LastCheck`';\n" . 
			'$cexAvailable =' . "'Available';\n" . 
			'$cexImage =' . "'Image'; \n\n" . 
			"?>";

			$writingConfigFile = fwrite($configFile, $configText);

			$cerrar = fclose($configFile);
		
			/* Mostramos al usuario de que se ha creado la configuración */
			?>
				<p class='alert alert-success'>[ Archivo de configuración creado. ]</p>
			<?php

			$continue = true;

		} else {
			$error = true;
			
			?>
				<p class='alert alert-danger'><strong>Instalación abortada: </strong>No se ha podido escribir el archivo config.php. Deberá de comprobar los permisos de los archivos.</p>
			<?php
		}

		/* *-*-*-*-*-* Crear las tablas *-*-*-*-*-* */
		if(!$error && $continue){
			$cleaner = array(
				"$tablaBooks", "$tablaCans", "$tablaMovies", "$tablaMusic", "$tablaCex", "$tablaUserDefinedCollections", "$tablaItem", "$tablaCollections", "$tablaUsers"
			);

			$sql = "SET FOREIGN_KEY_CHECKS = 0";
				
			$consulta = mysqli_query($databaseConnection, $sql) or die(mysqli_error($databaseConnection));

			foreach($cleaner as $actual){
				include (DOCUMENT_ROOT . 'config/config.php');

				$sql = "SELECT concat('ALTER TABLE ', TABLE_NAME, ' DROP FOREIGN KEY ', CONSTRAINT_NAME, ';') FROM information_schema.key_column_usage WHERE CONSTRAINT_SCHEMA = '$database' AND TABLE_NAME='$actual' AND REFERENCED_TABLE_NAME IS NOT NULL;";
					
				$consulta = mysqli_query($databaseConnection, $sql) or die(mysqli_error($databaseConnection));

				include (DOCUMENT_ROOT . 'config/config.php');

				$sql = "DROP TABLE IF EXISTS `$actual`";
				
				$consulta = mysqli_query($databaseConnection, $sql) or die(mysqli_error($databaseConnection));

				if($consulta){
					?>
					<p class='alert alert-warning'>
						Se ha comprobado y eliminado la tabla '<?= $actual ?>' para evitar errores.
					</p>
					<?php
				}
			}

			/* Volver a comprobar la integridad con las claves foráneas */
			include (DOCUMENT_ROOT . 'config/config.php');

			$sql = "SET FOREIGN_KEY_CHECKS = 1";
				
			$consulta = mysqli_query($databaseConnection, $sql) or die(mysqli_error($databaseConnection));


			$createTable = array(
				[$tablaBooks, "CREATE TABLE $tablaBooks (`Title` varchar(255) DEFAULT NULL, `Author` varchar(255) DEFAULT NULL, `Publisher` varchar(255) DEFAULT NULL, `Publish date` date DEFAULT NULL, `ISBN` varchar(255) DEFAULT NULL, `Image` varchar(255) DEFAULT 'img/0_books.jpg', `ItemID` int(20) NOT NULL ) ENGINE=InnoDB DEFAULT CHARSET=utf8;"],
				[$tablaCans, "CREATE TABLE $tablaCans (`Brand` varchar(255) DEFAULT NULL, `Flavor` varchar(255) DEFAULT NULL, `Quantity` int(5) DEFAULT NULL, `Year` year(4) DEFAULT NULL, `Barcode` varchar(255) DEFAULT NULL, `Country` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL DEFAULT '(sin añadir)', `Image` varchar(255) NOT NULL DEFAULT 'img/0_cans.jpg', `ItemID` int(20) NOT NULL ) ENGINE=InnoDB DEFAULT CHARSET=utf8;"],
				[$tablaCollections, "CREATE TABLE $tablaCollections (`ID` int(11) NOT NULL, `Name` varchar(255) NOT NULL DEFAULT 'Mi colección', `Description` varchar(255) DEFAULT NULL, `Image` varchar(255) DEFAULT NULL, `Category` enum('cans','movies','books','music') NOT NULL, `UsersLogin` varchar(16) NOT NULL ) ENGINE=InnoDB DEFAULT CHARSET=utf8;"],
				[$tablaItem, "CREATE TABLE $tablaItem (`ID` int(20) NOT NULL, `CollectionsID` int(11) NOT NULL ) ENGINE=InnoDB DEFAULT CHARSET=utf8;"],
				[$tablaMovies, "CREATE TABLE $tablaMovies (`Title` varchar(255) COLLATE utf8_spanish_ci NOT NULL, `Year` varchar(255) COLLATE utf8_spanish_ci NOT NULL, `Starring` varchar(255) COLLATE utf8_spanish_ci NOT NULL, `Directed_By` varchar(255) COLLATE utf8_spanish_ci NOT NULL, `Format` enum('DVD','VHS','Blu-Ray','Digital','Betamax','(sin indicar)') COLLATE utf8_spanish_ci NOT NULL DEFAULT '(sin indicar)', `Barcode` varchar(255) COLLATE utf8_spanish_ci NOT NULL DEFAULT '(sin datos)', `Image` varchar(255) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'img/0_movies.jpg', `ItemID` int(20) NOT NULL ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;"],
				[$tablaMusic, "CREATE TABLE $tablaMusic (`Artist` varchar(255) DEFAULT NULL, `Title` varchar(255) DEFAULT NULL, `Publish Date` date DEFAULT NULL, `Total discs` int(3) DEFAULT NULL, `Record Company` varchar(255) DEFAULT NULL, `Type` varchar(255) DEFAULT NULL, `Barcode` varchar(255) DEFAULT NULL, `Image` varchar(255) NOT NULL DEFAULT 'img/item/0_music.jpg', `ItemID` int(20) NOT NULL ) ENGINE=InnoDB DEFAULT CHARSET=utf8;"],
				[$tablaCex, "CREATE TABLE $tablaCex ( `Name` varchar(100) NOT NULL DEFAULT '', `URL` varchar(250) NOT NULL DEFAULT '', `Price` float NOT NULL, `LastCheck` datetime NOT NULL, `Available` tinyint(1) NOT NULL, `Image` varchar(255) NOT NULL DEFAULT 'img/item/0_cex2.jpg', `ItemID` int(11) NOT NULL ) ENGINE=InnoDB DEFAULT CHARSET=utf8;"],
				[$tablaUserDefinedCollections, "CREATE TABLE $tablaUserDefinedCollections (`ID` int(11) NOT NULL, `Name` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL, `Description` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL, `User_TableID` text COLLATE utf8_spanish_ci, `Image` varchar(255) CHARACTER SET utf8 DEFAULT NULL, `Vista` enum('cuadricula','listado') COLLATE utf8_spanish_ci NOT NULL DEFAULT 'listado', `UsersLogin` varchar(16) CHARACTER SET utf8 NOT NULL ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;"],
				[$tablaUsers, "CREATE TABLE $tablaUsers (`Login` varchar(16) CHARACTER SET utf8 NOT NULL, `Password` varchar(255) CHARACTER SET utf8 DEFAULT NULL, `First Name` varchar(255) CHARACTER SET utf8 DEFAULT NULL, `Last Name` varchar(255) CHARACTER SET utf8 DEFAULT NULL, `Email` varchar(255) CHARACTER SET utf8 DEFAULT NULL, `Birth Date` date DEFAULT NULL, `Rol` enum('administrator','registered') COLLATE utf8_spanish_ci NOT NULL DEFAULT 'registered', `Avatar` varchar(255) COLLATE utf8_spanish_ci NULL DEFAULT 'img/avatars/bear2.png', `Activated Account` tinyint(1) NOT NULL DEFAULT '0', `Activation Code` int(4) NOT NULL DEFAULT '9517') ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;"]
			);

			foreach ($createTable as $peticion){
				include (DOCUMENT_ROOT . 'config/config.php');

				$actualTableName = $peticion[0];

				$queryCreateTable = mysqli_query($databaseConnection, $peticion[1]);
			
				if(!$queryCreateTable){
					$continue = false;

					?>
						<p class='alert alert-danger'><strong>Instalación abortada: </strong>No se ha podido crear la tabla '<?= $actualTableName ?>'. Asegurese de que la cuenta que nos ha proporcionado tiene permisos para crearla.</p>
					<?php
				} else {
					$continue = true;
					?>
						<p class='alert alert-success'>[ Tabla '<?= $actualTableName ?>' creada. ]</p>
					<?php
				}
			}

			/* Configuración adicional */
			$alterTable = array(
				"ALTER TABLE `$tablaBooks` ADD KEY `FKBooks135814` (`ItemID`), ADD KEY `ItemID` (`ItemID`);",
				"ALTER TABLE `$tablaCans` ADD KEY `FKCans412427` (`ItemID`);",
				"ALTER TABLE `$tablaCollections` ADD PRIMARY KEY (`ID`), ADD KEY `poseen` (`UsersLogin`);",
				"ALTER TABLE `$tablaItem` ADD PRIMARY KEY (`ID`), ADD KEY `Contienen` (`CollectionsID`); ",
				"ALTER TABLE `$tablaMovies` ADD KEY `ItemID` (`ItemID`); ",
				"ALTER TABLE `$tablaMusic` ADD KEY `ItemID` (`ItemID`); ",
				"ALTER TABLE `$tablaUserDefinedCollections` ADD PRIMARY KEY (`ID`), ADD KEY `Tienen` (`UsersLogin`); ",
				"ALTER TABLE `$tablaUsers` ADD PRIMARY KEY (`Login`);",
				"ALTER TABLE `$tablaCollections` MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;",
				"ALTER TABLE `$tablaItem` MODIFY `ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;",
				"ALTER TABLE `$tablaUserDefinedCollections` MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;",
				"ALTER TABLE `$tablaBooks` ADD CONSTRAINT `FKBooks135814` FOREIGN KEY (`ItemID`) REFERENCES `$tablaItem` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;",
				"ALTER TABLE `$tablaCans` ADD CONSTRAINT `FKCans412427` FOREIGN KEY (`ItemID`) REFERENCES `$tablaItem` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;",
				"ALTER TABLE `$tablaCollections` ADD CONSTRAINT `poseen` FOREIGN KEY (`UsersLogin`) REFERENCES `$tablaUsers` (`Login`) ON DELETE CASCADE ON UPDATE CASCADE;",
				"ALTER TABLE `$tablaItem` ADD CONSTRAINT `Contienen` FOREIGN KEY (`CollectionsID`) REFERENCES `$tablaCollections` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;",
				"ALTER TABLE `$tablaMovies` ADD CONSTRAINT `IfItemIsDeleted` FOREIGN KEY (`ItemID`) REFERENCES `$tablaItem` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE; ",
				"ALTER TABLE `$tablaCex` ADD CONSTRAINT `PerteneceA` FOREIGN KEY (`ItemID`) REFERENCES `$tablaItem` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE; ",
				"ALTER TABLE `$tablaMusic` ADD CONSTRAINT `DeleteIfItemIsDeleted` FOREIGN KEY (`ItemID`) REFERENCES `$tablaItem` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE; ",
				"ALTER TABLE `$tablaUserDefinedCollections` ADD CONSTRAINT `Tienen` FOREIGN KEY (`UsersLogin`) REFERENCES `$tablaUsers` (`Login`) ON DELETE CASCADE ON UPDATE CASCADE;"
			);

			foreach ($alterTable as $peticion) {
				include (DOCUMENT_ROOT . 'config/config.php');

				$consulta = mysqli_query($databaseConnection, $peticion) or die(mysqli_error($databaseConnection));

				if(!$consulta){

					$continue = false;
					?>
						<p class='alert alert-danger'><b>Instalación abortada: </b>No se ha podido modificar las tablas ya creadas. Asegurese de que la cuenta que nos ha proporcionado tiene permisos para modificarla.</p>
					<?php
				}

				closeConnection();
			}

			if($continue){
				?>
					<p class='alert alert-success'>[ Tablas creadas. ]</p>
				<?php
			}
		}

		/* *-*-*-*-*-*-* Insertar la cuenta del admnistrador *-*-*-*-*-*-*-* */
		if(!$error && $continue && ($adminLogin != "" && $adminPass != "")){
			include (DOCUMENT_ROOT . 'config/config.php');

			$adminAvatar = '';

			if(is_uploaded_file($_FILES['adminAccountAvatar']['name'])){
				/* Declaración de variables del directorio de subida y de la ruta inicial donde se va a subir */
				$dir_subida = 'img/avatars/';
				$fichero_subido = $dir_subida . basename($_FILES['adminAccountAvatar']['name']);

				/* Le pone el nombre nuevo que será: id.extensión */
				$imageName = $login . "." . pathinfo($_FILES['adminAccountAvatar']['name'], PATHINFO_EXTENSION);
				
				/* Composición de la ruta final */
				$adminAvatar = $dir_subida . $imageName;

				/* Sube el fichero con su nombre temporal y luego lo mueve con el nuevo nombre de arriba */
				move_uploaded_file($_FILES['adminAccountAvatar']['tmp_name'], $adminAvatar);
			} else {
				$random = rand(1,5);
				$adminAvatar = "img/avatars/bear" . $random . ".png";
			}

			$sql = "INSERT INTO $tableNameUsers ($usersColumnLogin, $usersColumnPassword, $usersColumnFirstName, $usersColumnLastName, $usersColumnEmail, $usersColumnBirthDate, $usersColumnRol, $userColumnAvatar, $userColumnActivatedAccount) VALUES ('$adminLogin', PASSWORD('$adminPass'), '$adminFirstName', '$adminLastName', '$adminEmail', '$adminBirthday', 'administrator', '$adminAvatar', '1')";

			$consulta = mysqli_query($databaseConnection, $sql) or die(mysqli_error($databaseConnection));

			closeConnection();

			if(!$consulta){
				$continue = false;
				?>
					<p class='alert alert-danger'><strong>Instalación interrumpida: </strong>No se ha podido crear el usuario administrador. Asegurese de que los credenciales de la base de datos tiene permiso para añadir filas a las tablas.</p>
				<?php
			} else {
				$continue = true;
				?>
					<p class='alert alert-success'>[ Usuario <?= $adminLogin ?> creado. ]</p>
				<?php
			}
		}

		/* Avisamos al usuario que está todo listo y lo mandamos al limpiador de archivos. */
		if(!$error && $continue){?>
			<p class='alert alert-success'>[ <strong>Instalación finalizada.</strong> ]</p>

			<p><a href="../cleaner.php"><button type="button" class="btn btn-dark float-right">Continuar</button></a></p>
		<?php
		}
	}
?>

		</div>
	</div>
</body>
</html>