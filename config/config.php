<?php 
/* Datos de conexion */ 
$databaseHostConnection='localhost'; 
$databaseUserConnection='caracola'; 
$databasePasswordConnection='caracola'; 
$databaseNameConnection='caracola'; 

$databaseConnection = mysqli_connect($databaseHostConnection, $databaseUserConnection, $databasePasswordConnection, $databaseNameConnection);

mysqli_set_charset($databaseConnection, 'utf8'); 

/* Table users */
$tableNameUsers ='`cal_users`';

$usersColumnLogin ='Login';
$usersColumnPassword ='Password';
$usersColumnFirstName ='`First Name`';
$usersColumnLastName ='`Last Name`';
$usersColumnEmail ='Email';
$usersColumnBirthDate ='`Birth Date`';
$usersColumnRol ='Rol';
$userColumnAvatar ='Avatar';
$userColumnActivationCode ='`Activation Code`';
$userColumnActivatedAccount ='`Activated Account`';

$userPreDefinedTable ='`cal_userdefinedcollections`';
/* Table collections */
$tableCollections ='`cal_collections`';

/* Table item */
$tableItem ='`cal_item`';

/* Table cans */
$tableNameCans ='`cal_cans`';

$canBrand ='Brand';
$canFlavor ='Flavor';
$canQuantity ='Quantity';
$canYear ='Year';
$canBarcode ='Barcode';
$canCountry ='Country';
$canImage ='Image';

/* Table movies */
$tableMovies ='`cal_movies`';

/* Table music */
$tableMusic ='`cal_music`';
$musicArtist ='Artist';
$musicTitle ='Title';
$musicPublishDate ='`Publish Date`';
$musicRecordCompany ='`Record Company`';
$musicType ='Type';
$musicBarcode ='Barcode';
$musicImage ='Image';

/* Table books */
$tableNameBooks ='`cal_books`';

$bookTitle ='Title';
$bookAuthor ='Author';
$bookPublisher ='Publisher';
$bookPublishDate ='`Publish date`';
$bookISBN ='ISBN';
$bookImage ='Image'; 

?>