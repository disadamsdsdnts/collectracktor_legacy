<?php
    /* INCLUIR EL CONFIG SI SE HA CREADO */
    if(file_exists(DOCUMENT_ROOT . 'config/config.php')){
        include_once (DOCUMENT_ROOT . 'config/config.php');
    } else {
        header('Location: ' . DOMAIN_PATH . 'install/index.php');
    }

    /* FUNCIONES GENERALES DE CONEXIÓN */
    /* Abrir conexión a la base de datos */
	function openConnection(){
		include_once(DOCUMENT_ROOT . 'config/config.php');
	}

    /* Cerrar la conexión a la base de datos */
	function closeConnection(){
        include_once(DOCUMENT_ROOT . 'config/config.php');
		mysqli_close($databaseConnection);
		unset($databaseConnection);
	}