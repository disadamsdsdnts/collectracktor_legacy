<?php
	include_once($_SERVER['DOCUMENT_ROOT'] . '/' . 'config/functions.php');

	if (isset($_GET['login'])){
		$login = $_GET['login'];

		$query = "DELETE FROM $tableNameUsers WHERE Login='$login'";

		$borrado = mysqli_query($databaseConnection, $query);
	}

	header('Location: ./users_list.php');
?>