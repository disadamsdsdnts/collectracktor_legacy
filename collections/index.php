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
		if(isset($_GET['result'])){
			if ($_GET['result'] == 'ok'){
				?>
					<div class="alert alert-success">
						Su nueva colección ha sido creada.
					</div>
				<?php
			} else {
				?>
					<div class="alert alert-success">
						Ha ocurrido un error al crear su colección.
					</div>
				<?php
			}
		}
	?>

	<div class="row">
		<div class="col-12">
			<table class="table table-bordered table-hover">
				<thead class="thead-dark">
					<tr class="text-center">
						<th>
							➕ Crear una nueva colección ➕
						</th>
						<th>
							<a href="./admin_collections.php">
								👩‍💻 Administrar colecciones 👨‍💻
							</a>
						</th>
					</tr>
				</thead>
			</table>
		</div>
	</div>

	<div class="row d-flex justify-content-around">
		<a href="./create_music.php">
			<button type="button" class="btn btn-secondary">
				<span>➕ 🎵</span> Añadir una lista de música
			</button>
		</a>

		<a href="./create_movies.php">
			<button type="button" class="btn btn-secondary">
				<span>➕ 🎬</span> Añadir una lista de películas
			</button>
		</a>
	</div>
	
	<div class="row d-flex justify-content-around">
		<a href="./create_books.php">
			<button type="button" class="btn btn-secondary">
				<span>➕ 📚</span> Añadir una coleccion de libros
			</button>
		</a>
	</div>

	<div class="row d-flex justify-content-around">
		<a href="./create_cans.php">
			<button type="button" class="btn btn-secondary">
				<span>➕ 🥫</span> Añadir una coleccion de latas
			</button>
		</a>

		<a href="./create_predefined.php">
			<button type="button" class="btn btn-secondary">
				<span>➕ 📝</span> Añadir una nueva colección personalizada
			</button>
		</a>
	</div>

	<br>

	<?php
		/* Listas de música */
		openConnection();

		$query = "SELECT * FROM `collections` WHERE UsersLogin='$actualLoginUser' AND Category='music'";

		$data = mysqli_query($databaseConnection, $query);

		if (mysqli_num_rows($data) > 0){
		?>
			<div class="row d-flex justify-content-between">
				<div class="col-12">
					<table class="table table-bordered table-hover">
						<thead class="thead-dark">
							<tr>
								<th colspan="3">
									<h5>
										📋 Listas de música 🎼
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
							</tr>
						</thead>
						<tbody>
							<?php
								while($actualRow = mysqli_fetch_assoc($data)){
									$actualID = $actualRow['ID'];
									?>
										<tr onclick="window.location='./view_music.php?id_collection=<?php echo $actualID; ?>'">
											<td class="align-middle text-center">
												<img class="rounded" src="<?php echo $actualRow['Image']; ?>" width="150px">
											</td>
											<td class="align-middle">
												<?php echo '<strong>' . $actualRow['Name'] . '</strong>'; ?>
											</td>
											<td class="align-middle">
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
					<table class="table table-bordered table-hover">
						<thead class="thead-dark">
							<tr>
								<th colspan="3">
									<h5>
										📋 Listas de latas 🥫
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
							</tr>
						</thead>
						<tbody>
							<?php
								while($actualRow = mysqli_fetch_assoc($data)){
									$actualID = $actualRow['ID'];
									?>
										<tr onclick="window.location='./view_cans.php?id_collection=<?php echo $actualID; ?>'">
											<td class="align-middle text-center">
												<img class="rounded" src="<?php echo $actualRow['Image']; ?>" width="150px">
											</td>
											<td class="align-middle">
												<?php echo '<strong>' . $actualRow['Name'] . '</strong>'; ?>
											</td>
											<td class="align-middle">
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
					<table class="table table-bordered table-hover">
						<thead class="thead-dark">
							<tr>
								<th colspan="3">
									<h5>
										📋 Listas de libros 📚
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
							</tr>
						</thead>
						<tbody>
							<?php
								while($actualRow = mysqli_fetch_assoc($data)){
									$actualID = $actualRow['ID'];
									?>
										<tr onclick="window.location='./view_books.php?id_collection=<?php echo $actualID; ?>'">
											<td class="align-middle text-center">
												<img class="rounded" src="<?php echo $actualRow['Image']; ?>" width="150px">
											</td>
											<td class="align-middle">
												<?php echo '<strong>' . $actualRow['Name'] . '</strong>'; ?>
											</td>
											<td class="align-middle">
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
					<table class="table table-bordered table-hover">
						<thead class="thead-dark">
							<tr>
								<th colspan="3">
									<h5>
										📋 Listas de películas 🎬
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
							</tr>
						</thead>
						<tbody>
							<?php
								while($actualRow = mysqli_fetch_assoc($data)){
									$actualID = $actualRow['ID'];
									?>
										<tr onclick="window.location='./view_movies.php?id_collection=<?php echo $actualID; ?>'">
											<td class="align-middle text-center">
												<img class="rounded" src="<?php echo $actualRow['Image']; ?>" width="150px">
											</td>
											<td class="align-middle">
												<?php echo '<strong>' . $actualRow['Name'] . '</strong>'; ?>
											</td>
											<td class="align-middle">
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
					<table class="table table-bordered table-hover">
						<thead class="thead-dark">
							<tr>
								<th colspan="3">
									<h5>
										📋 Listas personalizadas ✏️
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
							</tr>
						</thead>
						<tbody>
							<?php
								while($actualRow = mysqli_fetch_assoc($data)){
									$actualID = $actualRow['ID'];
									?>
										<tr onclick="window.location='./view_predefined.php?id_collection=<?php echo $actualID; ?>'">
											<td class="align-middle text-center">
												<img class="rounded" src="<?php echo $actualRow['Image']; ?>" width="150px">
											</td>
											<td class="align-middle">
												<?php echo '<strong>' . $actualRow['Name'] . '</strong>'; ?>
											</td>
											<td class="align-middle">
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