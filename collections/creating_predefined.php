<?php
    include_once($_SERVER['DOCUMENT_ROOT'] . '/' . 'config/functions.php');

	session_start();

	areULogin();

	if(isset($_POST)){
		/* Recolectando datos */
		$collectionName = $_POST['collectionName'];
		$collectionDesc = $_POST['collectionDesc'];
		$collectionImage = 'img/0_default.png';
		$login = $_SESSION['login'];

		/* Crear la entrada para colecciones predefinidas */
		$query = "INSERT INTO userdefinedcollections (ID, Name, Description, User_TableID, Image, UsersLogin) VALUES (NULL, '$collectionName', '$collectionDesc', NULL, '$collectionImage', '$login')";

		$data = mysqli_query($databaseConnection, $query);

		$ID = mysqli_insert_id($databaseConnection);

		/* Falta detectar si se ha subido una imagen */
		if(file_exists($_FILES['descriptiveImage']['tmp_name']) || is_uploaded_file($_FILES['descriptiveImage']['tmp_name'])){
			$dir_subida = 'img/';
			$fichero_subido = $dir_subida . basename($_FILES['descriptiveImage']['name']);

			$imageName = $tableName . "." . pathinfo($_FILES['descriptiveImage']['name'], PATHINFO_EXTENSION);

			$rutaFinal = $dir_subida . $imageName;

			move_uploaded_file($_FILES['descriptiveImage']['tmp_name'], $rutaFinal);

			$query = "UPDATE userdefinedcollections SET Image='$rutaFinal', User_TableID='$tableName' WHERE ID='$ID'";
			
			$data = mysqli_query($databaseConnection, $query);
		}
		
		$tableName = 'zz_' . $login . '_' . $ID;

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

		mysqli_close($databaseConnection);

		if($result){
			header('Location: ./index.php?result=ok');
		} else{
			header('Location: ./index.php?result=error');
                }
        
            } else {
		header('Location: ./create_predefined.php');
	}
	
?>