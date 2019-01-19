<?php
	include_once($_SERVER['DOCUMENT_ROOT'] . '/' . 'config/functions.php');

	if (isset($_GET['login'])){
		$codigo = $_GET['code'];
		$login = $_GET['login'];

		$query = "UPDATE $tableNameUsers SET $userColumnActivationCode='$codigo' WHERE Login='$login'";

		$consultaLista = mysqli_query($databaseConnection, $query);

		header('Location: ./users_list.php');
	}

?>