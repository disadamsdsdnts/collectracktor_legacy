<?php
    include_once('../admin/functions.php');

    session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Colección personalizada</title>
</head>

<body>
	<?php 
		include_once ('../navigator_inside.php');
	?>
    <link rel="stylesheet" type="text/css" href="../css/collections_createPredefined.css">
    <!--Development-->
    <script>
        document.write('<script src="../js/create_predefined.js?dev=' + Math.floor(Math.random() * 100) + '"\><\/script>');
    </script>
    <!--<script type="text/javascript" src="../js/create_predefined.js"></script>-->

    <div class="row">
    	<h1>
    		Crea tu propia colección personalizada
    	</h1>
    </div>

    <div class="row card">
        <div class="card-header">
            <h5>
                Nombre de la colección
            </h5>
        </div>

        <div class="card-body">
            <input form="formCreator" type="text" name="collectionName" id="collectionName" placeholder="Mi colección" required>
        </div>
    </div>

    <div class="row card">
        <div class="card-header">
            <h5>
                Descripción de la colección
            </h5>
        </div>

        <div class="card-body">
            <input form="formCreator" type="text" name="collectionDesc" id="collectionDesc" placeholder="Esta colección colecciona colecciones." required>
        </div>
    </div>
   
    <div class="row card">
        <div class="card-header">
            <h5>
                Añadir un campo
            </h5>
        </div>
        <div class="d-flex justify-content-center card-body">
            <button id="addAnID">➕ 🆔 Identificador Único</button>
        </div>

        <div class="d-flex justify-content-between card-body">
            <button id="addText">➕ 📝 Campo 'texto'</button><br>
            <button id="addDate">➕ 📅 Campo 'fecha'</button><br>
            <button id="addInt">➕ 🔢 Campo 'números enteros' </button><br>
            <button id="addImage">➕ 📷 Campo 'imágenes'</button><br>
        </div>
    </div>

    <div class="row card">
        <div class="card-header">
            <h5>Tabla de campos</h5>
        </div>
        <div class="col-12 card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">
                            Nombre
                        </th>

                        <th scope="col">
                            Tipo
                        </th>

                        <th scope="col">
                             
                        </th>

                        <th scope="col">
                             
                        </th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                </tbody>
            </table>
        </div>
    </div>
    
    <hr>

    <form method="POST" action="creating_predefined.php" id="formCreator" enctype="multipart/form-data">
        <div class="row card">
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