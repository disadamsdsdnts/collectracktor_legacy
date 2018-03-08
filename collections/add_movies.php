<?php
    include_once '../admin/functions.php';

    session_start();

    areULogin();

    isActivated();

    $actualLogin = $_SESSION['login'];

    if(!isset($_GET['id'])){
        header('Location:./index.php');
    } 

    include '../config/config.php';

    $actualCollection = $_GET['id'];

    if (isset($_POST['addMovie'])){
        $itemName = $_POST['itemName'];
        $itemYear = $_POST['itemYear'];
        $itemCast = $_POST['itemCast'];
        $itemDirector = $_POST['itemDirector'];
        $itemFormat = $_POST['itemFormat'];

        $itemBarcode = '';
        if($_POST['itemBarcode'] == ''){
            $itemBarcode = NULL;
        } else {
            $itemBarcode = $_POST['itemBarcode'];
        }
        
        $itemImage = "img/item/0_movie.jpg";

        $query = "INSERT INTO $tableItem(ID, CollectionsID) VALUES (NULL, '$actualCollection')";

        $insert = mysqli_query($databaseConnection, $query);

        $ID = mysqli_insert_id($databaseConnection);

        $query = "INSERT INTO $tableMovies(Title, Year, Starring, Directed_by, Barcode, Format, Image, ItemID) VALUES('$itemName', '$itemYear', '$itemCast', '$itemDirector', '$itemBarcode', '$itemFormat', '$itemImage', '$ID')";

        $insert = mysqli_query($databaseConnection, $query);

        if(isset($_POST['itemImageFromWeb'])){
            $itemImage = $_POST['itemImageFromWeb'];
            $extension_pos = strrpos($itemImage, '.') + 1;
            $extension = substr($itemImage, $extension_pos);

            $rutaAGuardar = "img/item/$ID.$extension";

            download_image($itemImage, $rutaAGuardar);

            $query = "UPDATE $tableMovies SET Image='$rutaAGuardar' WHERE ItemID='$ID'";

            $data = mysqli_query($databaseConnection, $query);
        } else if(isset($_FILES['itemImage'])){
            $dir_subida = 'img/item/';
            $fichero_subido = $dir_subida . basename($_FILES['itemImage']['name']);
            $imageName = $ID . "." . pathinfo($_FILES['itemImage']['name'], PATHINFO_EXTENSION);
            $rutaFinal = $dir_subida . $imageName;
            move_uploaded_file($_FILES['itemImage']['tmp_name'], $rutaFinal);
            $query = "UPDATE $tableMovies SET Image='$rutaFinal' WHERE ItemID='$ID'";
            $data = mysqli_query($databaseConnection, $query);
        }

        header("Location:./view_movies.php?id_collection=$actualCollection");
    }


    $query = "SELECT * FROM $tableCollections WHERE ID='$actualCollection' AND UsersLogin='$actualLogin'";

    $collectionInfoQuery = mysqli_query($databaseConnection, $query);

    if (mysqli_num_rows($collectionInfoQuery) !== 1){
        echo '<script>
            alert("No sé cómo has llegado aquí, pero has llegado a un callejón sin información. Volviendo al inicio.");
            setTimeout(function(){ <?php header("Location: ./index.php"); ?> }, 500);
        </script>';
    }

    $collectionInfo = mysqli_fetch_assoc($collectionInfoQuery);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Añadir una nueva entrada a "<?php echo $collectionInfo['Name'] ?>"</title>
</head>

<body>
	<?php 
		include_once ('../navigator_inside.php');
	?>
    <link rel="stylesheet" type="text/css" href="../css/collections_create.css">
    <link rel="stylesheet" type="text/css" href="../css/add.css">

    <script type="text/javascript" src="../js/add_movies.js"></script>

    <br>

    <div class="row justify-content-center">
    	<h3>
    		🎬 Añadir una nueva entrada a "<?php echo $collectionInfo['Name'] ?>" 🎬
    	</h3>
    </div>

    <div class="row">
        <div class="col-8">
            <div class="card card-header">
                <h5>
                    Datos
                </h5>
            </div>

            <div class="card card-body">
                <label for="itemName">Nombre: </label>
                <input form="formAdding" type="text" name="itemName" id="itemName" placeholder=" Ej: Pocahontas" required>

                <hr>

                <label for="itemYear">Año:</label>
                <input form="formAdding" type="text" name="itemYear" id="itemYear" placeholder=" Ej: 1995">

                <hr>

                <label>Protagonizada por:</label>
                <input form="formAdding" type="text" name="itemCast" id="itemCast" placeholder=" Ej: Mel Gibson, Linda Hunt, Christian Bale">

                <hr>

                <label for="itemDirector">Dirigida por:</label>
                <input form="formAdding" type="text" name="itemDirector" id="itemDirector" placeholder=" Ej: Mike Gabriel, Eric Goldberg">

                <hr>

                <label for="itemFormat">Formato:</label>
                <select name="itemFormat" form="formAdding">
                    <option value="(sin indicar)">(sin indicar)</option>
                    <option value="DVD">DVD</option>
                    <option value="VHS">VHS</option>
                    <option value="Blu-Ray">Blu-Ray</option>
                    <option value="Digital">Digital</option>
                    <option value="Betamax">Betamax</option>
                </select>

                <hr>

                <label for="itemBarcode">Código de barras:</label>
                <input form="formAdding" type="text" name="itemBarcode" id="itemBarcode">

                <hr>

                <label for="itemImage">Imagen:</label>
                <input form="formAdding" type="file" name="itemImage" id="itemImage">
            </div>
        </div>

        <div class="col-4">
            <div class="card card-header">
                <h5>
                    Busca en la base de datos de FilmAffinity
                </h5>
            </div>

            <div class="card card-body" id="searcherBody">
                <form method="POST" if="formSearch">
                    <div id="fieldSearch">
                        <input type="text" name="nameQuery" id="nameSearch" placeholder=" Ej: El Rey León">
                    </div>
                    <input type="submit" name="submitQuery" id="buttonSearch" value="Buscar">
                </form>
            </div>
        </div>
    </div>

    <form method="POST" action="add_movies.php?id=<?php echo $actualCollection; ?>" id="formAdding" enctype="multipart/form-data">
        <div class="row float-right">
            <input type="submit" name="addMovie" value="Crear colección" id="addMovie" class="btn btn-secondary">
        </div>
    </form>
</body>
</html>