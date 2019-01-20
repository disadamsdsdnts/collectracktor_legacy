<?php
	function openConnection(){
		global $databaseHostConnection, $databaseUserConnection, $databasePasswordConnection, $databaseNameConnection;

		return mysqli_connect($databaseHostConnection, $databaseUserConnection, $databasePasswordConnection, $databaseNameConnection);
	}