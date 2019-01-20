<?php
	session_start();

	include_once($_SERVER['DOCUMENT_ROOT'] . '/' . 'config/functions.php');

	youDontBelongHere();

	$query = "SELECT * FROM $tableNameUsers";

	$consultaLista = mysqli_query($databaseConnection, $query);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Panel de control - Listas de usuarios</title>
	<meta charset="utf-8">
	<script type="text/javascript" src="../js/jquery-3.2.1.slim.min.js"></script>
	<script type="text/javascript" src="../js/popper.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../css/global.css">
	<link rel="stylesheet" type="text/css" href="../css/index.css">
	<script type="text/javascript" src="../js/list.js"></script>
	<link rel="stylesheet" type="text/css" href="../css/admin.css">
	<script type="text/javascript" src="../js/list.js"></script>
</head>

<body>
	<?php include_once '../navigator_inside.php'; ?>

	<br>

	<div class="card card-body" id="caridad">
		<div class="container">
			<div class="row">
				<h1>Lista de usuarios</h1>
				<span class="font-italic text-secondary">(nota: recuerde que los códigos están ocultos por seguridad. Puede seleccionarlos con el ratón o darle al botón de editar para verlos. No ocurre nada si no se modifica el código.)</span>
			</div>

			<div class="card-body">
				<table class="table">
					<tr>
						<th>Avatar</th>
						<th>Nombre a mostrar</th>
						<th>Login</th>
						<th>Cuenta activada</th>
						<th>Código activación</th>
						<th>Editar código activación</th>
						<th>Borrar cuenta</th>
					</tr>
					<?php
						while($actualUser = mysqli_fetch_assoc($consultaLista)){?>
							<tr class="align-middle">
								<td class="align-middle">
									<?php
									if ($actualUser['Avatar'] != ""){?>
										<img class='mini-avatar img-circle sombreado' src='../<?php echo $actualUser['Avatar']; ?>'>
										<?php
									}
								?>
								</td>

								<td class="align-middle"><?php echo $actualUser['First Name']; ?></td>

								<td class='containsInfo align-middle'><?php echo $actualUser['Login']; ?></td>

								<td class='containsInfo align-middle'>
								<?php
									if ($actualUser['Activated Account'] == '1'){
										echo "Si";
									} else if ($actualUser['Activated Account'] == '0'){
										echo "No";
									}
								?>
								</td>

								<td class='containsInfo align-middle' style='color: white;'><?php echo $actualUser['Activation Code']; ?></td>

								<td class='containsButtom align-middle'>
									<button class='btn btn-info' onclick='editar(this.parentNode.parentNode);'>Editar</button>
								</td>

								<td class='containsButtom align-middle'><?php
									if ($actualUser['Rol'] != 'administrator'){?>
										<a href='./delete_user.php?login=<?php echo $actualUser['Login']; ?>'><button class='btn btn-info'>Borrar</button></a>
									<?php
									}
									?>
								</td>
							</tr><?php
						}
					?>
				</table>
			</div>
		</div>

		<div class="container">

		</div>
	</div>
</body>
</html>