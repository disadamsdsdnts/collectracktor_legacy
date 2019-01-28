<?php
    include_once($_SERVER['DOCUMENT_ROOT'] . '/' . 'config/functions.php');

    session_start();

    areULogin();

    isActivated();

    $actualLogin = $_SESSION['login'];

    if(!isset($_GET['id'])){
        header('Location:./index.php');
    } 

    $actualCollection = $_GET['id'];

    if (isset($_POST['addCan'])){
		$itemBrand = $_POST['itemBrand'];
		$itemFlavor = $_POST['itemFlavor'];
		$itemQuantity = $_POST['itemQuantity'];
		$itemYear = date('Y', strtotime($_POST['itemYear']));;
        $itemCountry = $_POST['itemCountry'];

        $itemBarcode = '';
        if($_POST['itemBarcode'] == ''){
            $itemBarcode = NULL;
        } else {
            $itemBarcode = $_POST['itemBarcode'];
        }
        
        $itemImage = "img/item/0_cans.jpg";

        $query = "INSERT INTO $tableItem(ID, CollectionsID) VALUES (NULL, '$actualCollection')";

        $insert = mysqli_query($databaseConnection, $query);

        $ID = mysqli_insert_id($databaseConnection);

        $query = "INSERT INTO $tableCans($canBrand, $canFlavor, $canQuantity, $canYear, $canBarcode, $canCountry, $canImage, ItemID) VALUES('$itemBrand', '$itemFlavor', '$itemQuantity', '$itemYear', '$itemBarcode', '$itemCountry', '$itemImage', '$ID')";

        $insert = mysqli_query($databaseConnection, $query);

        if(isset($_POST['itemImageFromWeb'])){
            $itemImage = $_POST['itemImageFromWeb'];
            $extension_pos = strrpos($itemImage, '.') + 1;
            $extension = substr($itemImage, $extension_pos);

            $rutaAGuardar = "img/item/$ID.$extension";

            download_image($itemImage, $rutaAGuardar);

            $query = "UPDATE $tableCans SET Image='$rutaAGuardar' WHERE ItemID='$ID'";

            $data = mysqli_query($databaseConnection, $query);
        } else if(isset($_FILES['itemImage'])){
            $dir_subida = 'img/item/';
            $fichero_subido = $dir_subida . basename($_FILES['itemImage']['name']);
            $imageName = $ID . "." . pathinfo($_FILES['itemImage']['name'], PATHINFO_EXTENSION);
            $rutaFinal = $dir_subida . $imageName;
            move_uploaded_file($_FILES['itemImage']['tmp_name'], $rutaFinal);
            $query = "UPDATE $tableCans SET Image='$rutaFinal' WHERE ItemID='$ID'";
            $data = mysqli_query($databaseConnection, $query);
        }

        header("Location:./view_cans.php?id_collection=$actualCollection");
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
    		🥫 Añadir una nueva entrada a "<?php echo $collectionInfo['Name'] ?>" 🥫
    	</h3>
    </div>

    <div class="row">
        <div class="col-10">
            <div class="card card-header">
                <h5>
                    Datos
                </h5>
            </div>

            <div class="card card-body">
                <label for="itemBrand">Marca: </label>
                <input form="formAdding" type="text" name="itemBrand" id="itemBrand" placeholder=" Ej: Coca-Cola" required>

                <hr>

                <label for="itemFlavor">Sabor:</label>
                <input form="formAdding" type="text" name="itemFlavor" id="itemFlavor" placeholder=" Ej: Cola (light)">

                <hr>

                <label for="itemQuantity">Cantidad (cl):</label>
                <input form="formAdding" type="text" name="itemQuantity" id="itemQuantity" placeholder=" Ej: 33">

                <hr>

                <label for="itemYear">Año:</label>
                <input form="formAdding" type="text" name="itemYear" id="itemYear" placeholder=" Ej: 2014">

                <hr>

                <label for="itemCountry">Pais de procedencia:</label>
                <input form="formAdding" type="text" name="itemCountry" id="itemCountry" placeholder=" Ej: Alemania">

                <hr>

                <label for="itemBarcode">Código de barras:</label>
                <input form="formAdding" type="text" name="itemBarcode" id="itemBarcode" placeholder=" Ej: 5449000131805">

                <hr>

                <label for="itemImage">Imagen:</label>
                <input form="formAdding" type="file" name="itemImage" id="itemImage">
            </div>
        </div>
    </div>

    <form method="POST" action="add_cans.php?id=<?php echo $actualCollection; ?>" id="formAdding" enctype="multipart/form-data">
        <div class="row float-right">
            <input type="submit" name="addCan" value="Crear colección" id="addCan" class="btn btn-secondary">
        </div>
    </form>
</body>
</html>