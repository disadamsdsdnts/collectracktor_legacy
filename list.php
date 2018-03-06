<?php

	include_once './config/config.php';

	$queryDataForList = getAllInfo('usuarios');

?>

<!DOCTYPE html>
<html>
<head>
	<title>Hola</title>
</head>
<body>
	<table>
		<tr>
			<th>
				ID
			</th>

			<th>
				Dirección
			</th>

			<th>
				Fecha
			</th>
		</tr>
		<?php
			while($actualDataFromQuery = mysqli_fetch_assoc($queryDataForList)){
				echo "<tr> <td>" . $actualDataFromQuery['id'] . "</td> <td>" . $actualDataFromQuery['direccion'] . "</td> <td>" . $actualDataFromQuery['fecha']. "</td> </tr>";
			}
		?>
	</table>
</body>
</html>