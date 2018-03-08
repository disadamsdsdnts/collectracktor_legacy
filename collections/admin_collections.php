<?php
	include '../config/config.php';
	include_once('../admin/functions.php');

	session_start();

	areULogin();

	isActivated();

	$actualLoginUser = $_SESSION['login'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>Mis colecciones</title>
</head>

<body>
	<?php 
		include_once ('../navigator_inside.php');
	?>

	<link rel="stylesheet" type="text/css" href="../css/collections_index.css">
	<link rel="stylesheet" type="text/css" href="../css/collections_create.css">

	<br>

	<div class="row d-flex justify-content-between">
		<div class="col-12">
			<table class="table table-bordered table-hover">
				<thead class="thead-dark">
					<tr>
						<th colspan="4">
							<h3 class="text-center">
								📋 Administración de colecciones
							</h3>
						</th>
					</tr>
					<tr>
						<th max-width="200px">
							Imagen descriptiva
						</th>
						<th>
							Nombre
						</th>
						<th>
							Descripción
						</th>
						<th>
							
						</th>
					</tr>
				</thead>
				<tbody>

	<?php
	openConnection();

	$query = "SELECT * FROM `collections` WHERE UsersLogin='$actualLoginUser'";

	$data = mysqli_query($databaseConnection, $query);

	$contentExists = 0;

	if (mysqli_num_rows($data) > 0){
	?>
						<?php
							while($actualRow = mysqli_fetch_assoc($data)){
								$actualID = $actualRow['ID'];
								?>
									<tr>
										<td class="align-middle text-center">
											<img src="<?php echo $actualRow['Image']; ?>" width="100px">
										</td>
										<td class="align-middle">
											<?php echo '<strong>' . $actualRow['Name'] . '</strong>'; ?>
										</td>
										<td class="align-middle">
											<?php echo $actualRow['Description']; ?>
										</td>
										<td class="align-middle text-center">
											<a href="./delete.php?default=<?php echo $actualID;?>">
												<button>❌ Borrar</button>
											</a>
										</td>
									</tr>
								<?php
							}
						} else {
									$contentExists = $contentExists + 1;
						}

						$query = "SELECT * FROM $userPreDefinedTable WHERE UsersLogin='$actualLoginUser'";

						$userCollections = mysqli_query($databaseConnection, $query);

						if (mysqli_num_rows($data) > 0){
							while($actualRow = mysqli_fetch_assoc($userCollections)){
								$actualID = $actualRow['ID'];
								?>
									<tr>
										<td class="align-middle text-center">
											<img src="<?php echo $actualRow['Image']; ?>" width="100px">
										</td>
										<td class="align-middle">
											<?php echo '<strong>' . $actualRow['Name'] . '</strong>'; ?>
										</td>
										<td class="align-middle">
											<?php echo $actualRow['Description']; ?>
										</td>
										<td class="align-middle text-center">
										<a href="./delete.php?predefined=<?php echo $actualID;?>">
											<button>❌ Borrar</button>
										</a>
										</td>
									</tr>
								<?php
								}
							} else {
									$contentExists = $contentExists + 1;
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
	<?php

		if($contentExists == 2){
		?>
			<div class="row d-flex justify-content-between">
				<div class="col-12 font-italic text-center">
					(no hay colecciones disponibles para mostrar. Añada alguna para visualizarla aquí.)
				</div>
			</div>
		<?php
	}