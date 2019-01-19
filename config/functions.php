<?php 
    /* CONFIGURACIÓN BÁSICA SOBRE EL DOMINIO EL DOCUMENTROOT */
    define('DOMAIN_PATH', ('//' . $_SERVER['HTTP_HOST'] . '/'));
    define('DOCUMENT_ROOT', ($_SERVER['DOCUMENT_ROOT'] . '/'));

    /* Funciones para el manejo de conexiones */
    include_once('functions/connections.php');

    /* Funciones para la creación de colecciones de música por defecto */
    include_once('functions/collection_music.php');

    /* Funciones para la creación de custom collections */
    include_once('functions/collection_custom.php');

    /* Funciones realizadas durante la creación de la cuenta de usuario */
    include_once('functions/creating_user.php');

    /* Funciones sobre las sesiones de los usuarios */
    include_once('functions/users.php');

    /* Funciones generales para realizar funciones triviales */
    include_once('functions/utils.php');
	
