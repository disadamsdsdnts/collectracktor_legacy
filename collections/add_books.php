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

    if (isset($_POST['addBook'])){
		$itemTitle = $_POST['itemTitle'];
		$itemAuthor = $_POST['itemAuthor'];
		$itemPublisher = $_POST['itemPublisher'];
		$itemPublishDate = $_POST['itemPublishDate'];

        $itemISBN = '';
        if($_POST['itemISBN'] == ''){
            $itemISBN = NULL;
        } else {
            $itemISBN = $_POST['itemISBN'];
        }
        
        $itemImage = "img/item/0_books.jpg";

        $query = "INSERT INTO $tableItem(ID, CollectionsID) VALUES (NULL, '$actualCollection')";

        $insert = mysqli_query($databaseConnection, $query);

        $ID = mysqli_insert_id($databaseConnection);

        $query = "INSERT INTO $tableBooks($bookTitle, $bookAuthor, $bookPublisher, $bookPublishDate, $bookISBN, $bookImage, ItemID) VALUES('$itemTitle', '$itemAuthor', '$itemPublisher', '$itemPublishDate', '$itemISBN', '$itemImage', '$ID')";

        $insert = mysqli_query($databaseConnection, $query);

        if(isset($_POST['itemImageFromWeb'])){
            $itemImage = $_POST['itemImageFromWeb'];
            $extension_pos = strrpos($itemImage, '.') + 1;
            $extension = substr($itemImage, $extension_pos);

            $rutaAGuardar = "img/item/$ID.$extension";

            download_image($itemImage, $rutaAGuardar);

            $query = "UPDATE $tableBooks SET Image='$rutaAGuardar' WHERE ItemID='$ID'";

            $data = mysqli_query($databaseConnection, $query);
        } else if(isset($_FILES['itemImage'])){
            $dir_subida = 'img/item/';
            $fichero_subido = $dir_subida . basename($_FILES['itemImage']['name']);
            $imageName = $ID . "." . pathinfo($_FILES['itemImage']['name'], PATHINFO_EXTENSION);
            $rutaFinal = $dir_subida . $imageName;
            move_uploaded_file($_FILES['itemImage']['tmp_name'], $rutaFinal);
            $query = "UPDATE $tableBooks SET Image='$rutaFinal' WHERE ItemID='$ID'";
            $data = mysqli_query($databaseConnection, $query);
        }

        header("Location:./view_books.php?id_collection=$actualCollection");
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
    		📚 Añadir una nueva entrada a "<?php echo $collectionInfo['Name'] ?>" 📚
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
                <label for="itemTitle">Título: </label>
                <input form="formAdding" type="text" name="itemTitle" id="itemTitle" placeholder=" Ej: 1986" required>

                <hr>

                <label for="itemAuthor">Autor:</label>
                <input form="formAdding" type="text" name="itemAuthor" id="itemAuthor" placeholder=" Ej: George Orwell">

                <hr>

                <label for="itemPublisher">Editorial:</label>
                <input form="formAdding" type="text" name="itemPublisher" id="itemPublisher" placeholder=" Ej: DEBOLSILLO">

                <hr>

                <label for="itemPublishDate">Fecha de publicación:</label>
                <input form="formAdding" type="text" name="itemPublishDate" id="itemPublishDate" placeholder=" Ej: 2010-04-07">

                <hr>

                <label for="itemISBN">ISBN:</label>
                <input form="formAdding" type="text" name="itemISBN" id="itemISBN">

                <hr>

                <label for="itemImage">Imagen:</label>
                <input form="formAdding" type="file" name="itemImage" id="itemImage">
            </div>
        </div>
    </div>

    <form method="POST" action="add_books.php?id=<?php echo $actualCollection; ?>" id="formAdding" enctype="multipart/form-data">
        <div class="row float-right">
            <input type="submit" name="addBook" value="Crear colección" id="addBook" class="btn btn-secondary">
        </div>
    </form>
</body>
</html>