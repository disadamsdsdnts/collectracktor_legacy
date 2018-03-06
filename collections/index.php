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
        document.write('<link rel="stylesheet" type="text/css" href="../css/collections_createPredefined.css?dev=' + Math.floor(Math.random() * 100) + '">');
    </script>
    <!--<link rel="stylesheet" type="text/css" href="../css/collections_index.css">-->
    <!--<link rel="stylesheet" type="text/css" href="../css/collections_createPredefined.css">-->
    <!--Development: end-->
	

	
		<div class="row card">
			<div class="col-6 card-header">
				<h5>
					<span>➕ 🎵 </span>Añadir una lista de música
				</h5>
			</div>
			<a href="./create_predefined.php">
				<div class="col-6 card-header">
					<font class="titles">
						<span>➕ 📚 </span>Añadir una nueva colección personalizada
					</font>
				</div>
			</a>
		</div>
	

	<?php
		/* Listas de música */
		openConnection();

		$query = "SELECT * FROM `collections` WHERE UsersLogin='$actualLoginUser' AND Category='music'";

		$data = mysqli_query($databaseConnection, $query);

		if (mysqli_num_rows($data) > 0){
		?>
			<div class="row d-flex justify-content-between">
				<div class="col-12">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th colspan="3">
									<h5>
										📋 Listas de música 🎼
									</h5>
								</th>
							</tr>
							<tr>
								<th>
									Imagen descriptiva
								</th>
								<th>
									Nombre
								</th>
								<th>
									Descripción
								</th>
							</tr>
						</thead>
						<tbody>
							<?php
								while($actualRow = mysqli_fetch_assoc($data)){
									?>
										<tr>
											<td>
												<img src="<?php echo $actualRow['Image']; ?>" width="150px">
											</td>
											<td>
												<?php echo $actualRow['Name']; ?>
											</td>
											<td>
												<?php echo $actualRow['Description']; ?>
											</td>
										</tr>
									<?php
								}
							?>
						</tbody>
					</table>
				</div>
			</div>
		<?php
		}

		/* Listas de latas */
				openConnection();

		$query = "SELECT * FROM `collections` WHERE UsersLogin='$actualLoginUser' AND Category='cans'";

		$data = mysqli_query($databaseConnection, $query);

		if (mysqli_num_rows($data) > 0){
		?>
			<div class="row d-flex justify-content-between">
				<div class="col-12">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th colspan="3">
									<h5>
										📋 Listas de música 🎼
									</h5>
								</th>
							</tr>
							<tr>
								<th>
									Imagen descriptiva
								</th>
								<th>
									Nombre
								</th>
								<th>
									Descripción
								</th>
							</tr>
						</thead>
						<tbody>
							<?php
								while($actualRow = mysqli_fetch_assoc($data)){
									?>
										<tr>
											<td>
												<img src="<?php echo $actualRow['Image']; ?>" width="150px">
											</td>
											<td>
												<?php echo $actualRow['Name']; ?>
											</td>
											<td>
												<?php echo $actualRow['Description']; ?>
											</td>
										</tr>
									<?php
								}
							?>
						</tbody>
					</table>
				</div>
			</div>
		<?php
		}

		/* Listas de libros */
				openConnection();

		$query = "SELECT * FROM `collections` WHERE UsersLogin='$actualLoginUser' AND Category='books'";

		$data = mysqli_query($databaseConnection, $query);

		if (mysqli_num_rows($data) > 0){
		?>
			<div class="row d-flex justify-content-between">
				<div class="col-12">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th colspan="3">
									<h5>
										📋 Listas de libros 📚
									</h5>
								</th>
							</tr>
							<tr>
								<th>
									Imagen descriptiva
								</th>
								<th>
									Nombre
								</th>
								<th>
									Descripción
								</th>
							</tr>
						</thead>
						<tbody>
							<?php
								while($actualRow = mysqli_fetch_assoc($data)){
									?>
										<tr>
											<td>
												<img src="<?php echo $actualRow['Image']; ?>" width="150px">
											</td>
											<td>
												<?php echo $actualRow['Name']; ?>
											</td>
											<td>
												<?php echo $actualRow['Description']; ?>
											</td>
										</tr>
									<?php
								}
							?>
						</tbody>
					</table>
				</div>
			</div>
		<?php
		}

		/* Listas de películas */
				openConnection();

		$query = "SELECT * FROM `collections` WHERE UsersLogin='$actualLoginUser' AND Category='movies'";

		$data = mysqli_query($databaseConnection, $query);

		if (mysqli_num_rows($data) > 0){
		?>
			<div class="row d-flex justify-content-between">
				<div class="col-12">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th colspan="3">
									<h5>
										📋 Listas de películas 🎬
									</h5>
								</th>
							</tr>
							<tr>
								<th>
									Imagen descriptiva
								</th>
								<th>
									Nombre
								</th>
								<th>
									Descripción
								</th>
							</tr>
						</thead>
						<tbody>
							<?php
								while($actualRow = mysqli_fetch_assoc($data)){
									?>
										<tr>
											<td>
												<img src="<?php echo $actualRow['Image']; ?>" width="150px">
											</td>
											<td>
												<?php echo $actualRow['Name']; ?>
											</td>
											<td>
												<?php echo $actualRow['Description']; ?>
											</td>
										</tr>
									<?php
								}
							?>
						</tbody>
					</table>
				</div>
			</div>
		<?php
		}

		/* Listas personalizadas */
		openConnection();

		$query = "SELECT * FROM $userPreDefinedTable WHERE UsersLogin='$actualLoginUser'";

		$data = mysqli_query($databaseConnection, $query);

		if (mysqli_num_rows($data) > 0){
		?>
			<div class="row d-flex justify-content-between">
				<div class="col-12">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th colspan="3">
									<h5>
										📋 Listas personalizadas ✏️
									</h5>
								</th>
							</tr>
							<tr>
								<th>
									Imagen descriptiva
								</th>
								<th>
									Nombre
								</th>
								<th>
									Descripción
								</th>
							</tr>
						</thead>
						<tbody>
							<?php
								while($actualRow = mysqli_fetch_assoc($data)){
									?>
										<tr>
											<td>
												<img src="<?php echo $actualRow['Image']; ?>" width="150px">
											</td>
											<td>
												<?php echo $actualRow['Name']; ?>
											</td>
											<td>
												<?php echo $actualRow['Description']; ?>
											</td>
										</tr>
									<?php
								}
							?>
						</tbody>
					</table>
				</div>
			</div>
		<?php
		}
	?>
</body>
</html>