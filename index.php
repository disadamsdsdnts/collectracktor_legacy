<?php
    include_once './admin/functions.php';

    session_start();

    include_once './config/config.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php 
        include_once './navigator.php';
	?>

</body>
</html>

<?php
	mysqli_close($databaseConnection);
?>