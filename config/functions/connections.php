<?php
	function openConnection(){
		include($_SERVER['DOCUMENT_ROOT'] . '/' . 'config/config.php');

		return mysqli_connect($databaseHostConnection, $databaseUserConnection, $databasePasswordConnection, $databaseNameConnection);
	}

	function closeConnection(){
		include($_SERVER['DOCUMENT_ROOT'] . '/' . 'config/config.php');

		return mysqli_close($databaseConnection);
	}