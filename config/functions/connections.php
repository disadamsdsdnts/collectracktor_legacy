<?php
	function openConnection(){
		global $databaseHostConnection, $databaseUserConnection, $databasePasswordConnection, $databaseNameConnection;

		return mysqli_connect($databaseHostConnection, $databaseUserConnection, $databasePasswordConnection, $databaseNameConnection);
	}

	function closeConnection(){
		global $databaseConnection;

		mysqli_close($databaseConnection);
	}