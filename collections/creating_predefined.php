<?php
	echo "Ho-la";

    include_once ('../admin/functions.php');

    include '../config/config.php';

	session_start();

	/* DESARROLLO: inicio */
	highlight_string("<?php\n\$_POST =\n" . var_export($_POST, true) . ";\n?>");

	highlight_string("<?php\n\$_FILES =\n" . var_export($_FILES, true) . ";\n?>");
	/* DESARROLLO: final */

	if(isset($_POST)){
		$collectionName = $_POST['collectionName'];
		$collectionDesc = $_POST['collectionDesc'];
		$collectionImage = 'img/0_default.png';
		$login = $_SESSION['login'];

		$dir_subida = 'img/';
		$fichero_subido = $dir_subida . basename($_FILES['descriptiveImage']['name']);

		$query = "INSERT INTO userdefinedcollections (ID, Name, Description, User_TableID, Image, UsersLogin) VALUES (NULL, '$collectionName', '$collectionDesc', NULL, '$collectionImage', '$login')";

		$data = mysqli_query($databaseConnection, $query);

		$ID = mysqli_insert_id($databaseConnection);

		$tableName = 'zz_' . $login . '_' . $ID;

		$imageName = $tableName . "." . pathinfo($_FILES['descriptiveImage']['name'], PATHINFO_EXTENSION);

		$rutaFinal = $dir_subida . $imageName;

		move_uploaded_file($_FILES['descriptiveImage']['tmp_name'], $rutaFinal);

		$query = "UPDATE userdefinedcollections SET Image='$rutaFinal', User_TableID='$tableName' WHERE ID='$ID'";
		
		$data = mysqli_query($databaseConnection, $query);

		/* Sección de crear la tabla */
		$finalQuery = "CREATE TABLE `$tableName` (";

		foreach ($_POST['field'] as $actualField) {
			$finalQuery = $finalQuery . '`' . $actualField['name'] . '`' . whatItIs($actualField['type']);
		}

		$finalQuery = trim($finalQuery);

		if (substr($finalQuery, -1) == ','){
			$finalQuery = substr($finalQuery, 0, -1);
		}

		$finalQuery = $finalQuery . ');';

		var_dump($finalQuery);

		$result = mysqli_query($databaseConnection, $finalQuery);

		/*
		if($result){
			header('Location: ./create_predefined.php?result=ok');
		} else{
			header('Location: ./create_predefined.php?result=error');
		}*/

		mysqli_close($databaseConnection);
	} else {
		header('Location: ./create_predefined.php');
	}
	
?>