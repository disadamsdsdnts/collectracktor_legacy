<?php
    include_once '../admin/functions.php';

    session_start();

    areULogin();

    if(isset($_POST['submitButton'])){
        include '../config/config.php';

        $collectionName = $_POST['collectionName'];
        $collectionDesc = $_POST['collectionDesc'];
        $collectionImage = 'img/0_cans.jpg';
        $login = $_SESSION['login'];

        $query = "INSERT INTO $tableCollections (ID, Name, Description, Image, Category, UsersLogin) VALUES (NULL, '$collectionName', '$collectionDesc', '$collectionImage', 'cans', '$login')";

        $result = mysqli_query($databaseConnection, $query);

        $ID = mysqli_insert_id($databaseConnection);

        if(isset($_FILES['descriptiveImage'])){
            $dir_subida = 'img/';
            $fichero_subido = $dir_subida . basename($_FILES['descriptiveImage']['name']);
            $imageName = $ID . "." . pathinfo($_FILES['descriptiveImage']['name'], PATHINFO_EXTENSION);
            $rutaFinal = $dir_subida . $imageName;
            move_uploaded_file($_FILES['descriptiveImage']['tmp_name'], $rutaFinal);
            $query = "UPDATE $tableCollections SET Image='$rutaFinal' WHERE ID='$ID'";
            $data = mysqli_query($databaseConnection, $query);
        } 

        mysqli_close($databaseConnection);

        if($result){
            header('Location: ./index.php?result=ok');
        } else{
            header('Location: ./index.php?result=error');
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Crear una colección de latas de refresco</title>
</head>

<body>
	<?php 
		include_once ('../navigator_inside.php');
	?>
    <link rel="stylesheet" type="text/css" href="../css/collections_create.css">

    <br>

    <div class="row justify-content-center">
    	<h1>
    		🥫 Crea una colección de latas 🥫
    	</h1>
    </div>

    <div class="row card justify-content-center">
        <div class="card-header">
            <h5>
                Nombre de la colección
            </h5>
        </div>

        <div class="card-body">
            <input form="formCreator" type="text" name="collectionName" id="collectionName" placeholder=" Mi colección" required>
        </div>
    </div>

    <div class="row card justify-content-center">
        <div class="card-header">
            <h5>
                Descripción de la colección
            </h5>
        </div>

        <div class="card-body">
            <input form="formCreator" type="text" name="collectionDesc" id="collectionDesc" placeholder=" Esta colección colecciona colecciones." required>
        </div>
    </div>
       
    <hr>

    <form method="POST" action="create_cans.php" id="formCreator" enctype="multipart/form-data">
        <div class="row card justify-content-center">
            <div class="card-header">
                <h3>Sube una imagen descriptiva</h3>
            </div>
            <div class="card-body">
                <div class="col-6">
                    <input type="file" name="descriptiveImage">
                </div>
                <div class="col-6">
                    Límite: 1 MB
                </div>
            </div>
        </div>
        <br>
        <div class="row float-right">
            <input type="submit" name="submitButton" value="Crear colección" id="submitButton">
        </div>
    </form>
</body>
</html>