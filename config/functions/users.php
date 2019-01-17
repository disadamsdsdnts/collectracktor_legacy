<?php

    /* APARTADO INICIO DE SESIÓN */
    /* COMPROBAR QUE SE HA INICIADO SESIÓN */
	function areULogin(){
		include_once(DOCUMENT_ROOT . 'config/config.php');

		if(!isset($_SESSION['login'])){
			header('Location:' . DOCUMENT_ROOT . '/login.php');
		}
    }
    
    /* COMPROBAR DE QUE SI NO ES ADMIN, LARGO DE AQUÍ */
    function youDontBelongHere(){
		if (!(isset($_SESSION['login'])) || ($_SESSION['rol'] != 'administrator')){
			header('Location:' . DOCUMENT_ROOT . 'index.php');
		}
	}

    /* SI LA CUENTA NO ESTÁ ACTIVADA, VOLVER AL INICIO, DONDE SE MOSTRARÁ UN MENSAJE */
	function isActivated(){
		if ($_SESSION['activated'] == '1'){
			header('Location:' . DOCUMENT_ROOT . 'index.php');
		}
	}