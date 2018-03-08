<?php
    include_once '../admin/functions.php';

    session_start();

    areULogin();

    $actualLogin = $_SESSION['login'];

    if(!isset($_GET['id'])){
        header('Location:./index.php');
    } 

    include '../config/config.php';

    $actualCollection = $_GET['id'];

    if (isset($_POST['addMusic'])){
		$itemArtist = $_POST['itemArtist'];
		$itemTitle = $_POST['itemTitle'];
		$itemPublishDate = $_POST['itemPublishDate'];
		$itemRecordCompany = $_POST['itemRecordCompany'];
		$itemType = $_POST['itemType'];
		$itemBarcode = $_POST['itemBarcode'];

        $itemBarcode = '';
        if($_POST['itemBarcode'] == ''){
            $itemBarcode = NULL;
        } else {
            $itemBarcode = $_POST['itemBarcode'];
        }
        
        $itemImage = "img/item/0_music.png";

        $query = "INSERT INTO $tableItem(ID, CollectionsID) VALUES (NULL, '$actualCollection')";

        $insert = mysqli_query($databaseConnection, $query);

        $ID = mysqli_insert_id($databaseConnection);
        
        $query = "INSERT INTO $tableMusic($musicArtist, $musicTitle, $musicPublishDate, $musicRecordCompany, $musicType, $musicBarcode, $musicImage, ItemID) VALUES('$itemArtist', '$itemTitle', '$itemPublishDate', '$itemRecordCompany', '$itemType', '$itemBarcode', '$itemImage', '$ID')";

        $insert = mysqli_query($databaseConnection, $query) or die(mysqli_error($databaseConnection));

        if(isset($_POST['itemImageFromWeb'])){
            $itemImage = $_POST['itemImageFromWeb'];
            var_dump($itemImage);
            $extension_pos = strrpos($itemImage, '.') + 1;
            $extension = substr($itemImage, $extension_pos);

            $rutaAGuardar = "img/item/$ID.$extension";

            download_image($itemImage, $rutaAGuardar);

            $query = "UPDATE $tableMusic SET Image='$rutaAGuardar' WHERE ItemID='$ID'";

            $data = mysqli_query($databaseConnection, $query);
        } else if(!empty($_FILES['itemImage'])){
            $dir_subida = 'img/item/';
            $fichero_subido = $dir_subida . basename($_FILES['itemImage']['name']);
            $imageName = $ID . "." . pathinfo($_FILES['itemImage']['name'], PATHINFO_EXTENSION);
            $rutaFinal = $dir_subida . $imageName;
            move_uploaded_file($_FILES['itemImage']['tmp_name'], $rutaFinal);
            $query = "UPDATE $tableMusic SET Image='$rutaFinal' WHERE ItemID='$ID'";
            $data = mysqli_query($databaseConnection, $query);
        }

        //header("Location:./view_music.php?id_collection=$actualCollection");
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

    <script type="text/javascript" src="../js/add_music.js?dev=1"></script>

    <link rel="stylesheet" type="text/css" href="../css/collections_create.css">
    <link rel="stylesheet" type="text/css" href="../css/add.css">

    <br>

    <div class="row justify-content-center">
    	<h3>
    		🎶 Añadir una nueva entrada a "<?php echo $collectionInfo['Name'] ?>" 🎶
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
                <label for="itemArtist">Artista: </label>
                <input form="formAdding" type="text" name="itemArtist" id="itemArtist" placeholder=" Ej: Metallica" required>

                <hr>

                <label for="itemTitle">Título: </label>
                <input form="formAdding" type="text" name="itemTitle" id="itemTitle" placeholder=" Ej: Hardwired... to Self-Destruct!">

                <hr>

                <label form="itemPublishDate">Fecha de publicación:</label>
                <input form="formAdding" type="text" name="itemPublishDate" id="itemPublishDate" placeholder=" Ej: 2016-11-11">

                <hr>

                <label for="itemRecordCompany">Compañía discográfica:</label>
                <input form="formAdding" type="text" name="itemRecordCompany" id="itemRecordCompany" placeholder=" Ej: Blackened Recordings">

                <hr>

                <label for="itemType">Formato:</label>
                <input form="formAdding" type="text" name="itemType" id="itemType" placeholder=" Ej: Físico">

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
                    Busca en la base de datos de MusicBrainz
                </h5>
            </div>

            <div class="card card-body" id="searcherBody">
                <form method="POST" if="formSearch">
                    <div id="fieldSearch">
                        <input type="text" name="nameQuery" id="nameSearch" placeholder=" Ej: Mi gran noche Raphael">
                    </div>
                    <input type="submit" name="submitQuery" id="buttonSearch" value="Buscar">
                </form>
            </div>
        </div>
    </div>

    <form method="POST" action="add_music.php?id=<?php echo $actualCollection; ?>" id="formAdding" enctype="multipart/form-data">
        <div class="row float-right">
            <input type="submit" name="addMusic" value="Crear colección" id="addMusic" class="btn btn-secondary">
        </div>
    </form>
</body>
</html>