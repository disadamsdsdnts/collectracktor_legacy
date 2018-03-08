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
	$userColumnAvatar = 'Avatar';
	$userColumnActivationCode = '`Activation Code`';
	$userColumnActivatedAccount = '`Activated Account`';

	$userPreDefinedTable = '`userdefinedcollections`';
	$userPreDefinedItemsTable = '`userfeineditem`';

	/* Table collections */
	$tableCollections = '`collections`';

	/* Table item */
	$tableItem = '`item`';

	/* Table cans */
	$tableNameCans = '`cans`';

	$canBrand = 'Brand';
	$canFlavor = 'Flavor';
	$canQuantity = 'Quantity';
	$canYear = 'Year';
	$canBarcode = 'Barcode';
	$canCountry = 'Country';
	$canImage = 'Image';

	/* Table movies */
	$tableMovies = '`movies`';

	/* Table music */
	$tableMusic = '`music`';

	$musicArtist ='Artist';
	$musicTitle = 'Title';
	$musicPublishDate = '`Publish Date`';
	$musicRecordCompany = '`Record Company`';
	$musicType = 'Type';
	$musicBarcode = 'Barcode';
	$musicImage = 'Image';

	/* Table books */
	$tableNameBooks = '`books`';

	$bookTitle = 'Title';
	$bookAuthor = 'Author';
	$bookPublisher = 'Publisher';
	$bookPublishDate = '`Publish date`';
	$bookISBN = 'ISBN';
	$bookImage = 'Image';
?>