<?php
	include_once './config/config.php';

	if (isset($_POST['direccion'])){
		$direccion = mysqli_real_escape_string($conexionBaseDatos, $_POST['direccion']);
		$fecha = date('Y-m-d H:i:s');

		$sql = "INSERT INTO reportes (id, direccion, fecha) VALUES (NULL, '$direccion', '$fecha')";

		$consulta = mysqli_query($conexionBaseDatos, $sql);

		if ($consulta){
			echo 'allGood';
		} else {
			echo 'allWrong';
		}
	}

	mysqli_close($conexionBaseDatos);
?>