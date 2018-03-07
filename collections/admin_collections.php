<?php
	include '../config/config.php';
	include_once('../admin/functions.php');

	session_start();

	areULogin();

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
	<!--Development: begin-->
	<script>
		document.write('<link rel="stylesheet" type="text/css" href="../css/collections_index.css?dev=' + Math.floor(Math.random() * 100) + '">');
		document.write('<link rel="stylesheet" type="text/css" href="../css/collections_create.css?dev=' + Math.floor(Math.random() * 100) + '">');
	</script>
	<!--<link rel="stylesheet" type="text/css" href="../css/collections_index.css">-->
	<!--<link rel="stylesheet" type="text/css" href="../css/collections_create.css">-->
	<!--Development: end-->

	<br>

	<?php
	openConnection();

	$query = "SELECT * FROM `collections` WHERE UsersLogin='$actualLoginUser'";

	$data = mysqli_query($databaseConnection, $query);

	if (mysqli_num_rows($data) > 0){
	?>
		<div class="row d-flex justify-content-between">
			<div class="col-12">
				<table class="table table-bordered table-hover">
					<thead class="thead-dark">
						<tr>
							<th colspan="4">
								<h5>
									📋 Administración de colecciones
								</h5>
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
											<button onclick="window.location='./delete.php?default=<?php echo $actualID;?>'">❌ Borrar</button>
										</td>
									</tr>
								<?php
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
												<button onclick="window.location='./delete.php?predefined=<?php echo $actualID;?>'">❌ Borrar</button>
											</td>
										</tr>
									<?php
								}
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
	<?php
	}