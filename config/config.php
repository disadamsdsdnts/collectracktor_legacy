<?php

	$databaseHostConnection = 'localhost';
	$databaseUserConnection = 'proyectoFinal';
	$databasePasswordConnection = 'unacoleccionparadominarlosatodos';
	$databaseNameConnection = 'proyectofinal';

	$databaseConnection = mysqli_connect($databaseHostConnection, $databaseUserConnection, $databasePasswordConnection, $databaseNameConnection);

	mysqli_set_charset($databaseConnection, 'utf8');

	/* Table users */
	$tableNameUsers = 'users';

	$usersColumnLogin = 'Login';
	$usersColumnPassword = 'Password';
	$usersColumnFirstName = '`First Name`';
	$usersColumnLastName = '`Last Name`';
	$usersColumnEmail = 'Email';
	$usersColumnBirthDate = '`Birth Date`';
	$usersColumnRol = 'Rol';

	$userPreDefinedTable = '`userdefinedcollections`';
?>