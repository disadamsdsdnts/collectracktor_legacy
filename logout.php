<?php
	/* Iniciar sesión */
	session_start();

	/* Destruir sesión */
	session_destroy();

	/* Dirigir al index */
	header('Location: ./index.php');
?>