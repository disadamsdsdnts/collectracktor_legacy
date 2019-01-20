<?php
	include_once($_SERVER['DOCUMENT_ROOT'] . '/' . 'config/functions.php');

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
							<a href="#" data-toggle="modal" data-target="#createCollectionModal">➕ Crear una nueva colección ➕</a>
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

	<!-- Modal -->
	<div class="modal fade" id="createCollectionModal" tabindex="-1" role="dialog" aria-labelledby="createCollection" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLongTitle">Crear una colección</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body align-content-center">
			<a href="./create_music.php">
				<button type="button" class="btn btn-secondary">
					<span>➕ 🎵</span> Añadir una lista de música
				</button>
			</a>

			<hr>

			<a href="./create_movies.php">
				<button type="button" class="btn btn-secondary">
					<span>➕ 🎬</span> Añadir una lista de películas
				</button>
			</a>
			
			<hr>

			<a href="./create_books.php">
				<button type="button" class="btn btn-secondary">
					<span>➕ 📚</span> Añadir una coleccion de libros
				</button>
			</a>
			
			<hr>

			<a href="./create_cans.php">
				<button type="button" class="btn btn-secondary">
					<span>➕ 🥫</span> Añadir una coleccion de latas
				</button>
			</a>
			
			<hr>

			<a href="./create_predefined.php">
				<button type="button" class="btn btn-secondary">
					<span>➕ 📝</span> Añadir una nueva colección personalizada
				</button>
			</a>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
	      </div>
	    </div>
	  </div>
	</div>

	<br>

	<?php
		$contentExists = 0;

		/* Listas de música */
		openConnection();

		$query = "SELECT * FROM `collections` WHERE UsersLogin='$actualLoginUser' AND Category='music'";

		$data = mysqli_query($databaseConnection, $query);

		if ($data != false && mysqli_num_rows($data) > 0){
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
		} else {
			$contentExists = $contentExists + 1;
		}

		/* Listas de latas */
		openConnection();

		$query = "SELECT * FROM `collections` WHERE UsersLogin='$actualLoginUser' AND Category='cans'";

		$data = mysqli_query($databaseConnection, $query);

		if ($data != false && mysqli_num_rows($data) > 0){
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
		} else {
			$contentExists = $contentExists + 1;
		}


		/* Listas de libros */
				openConnection();

		$query = "SELECT * FROM `collections` WHERE UsersLogin='$actualLoginUser' AND Category='books'";

		$data = mysqli_query($databaseConnection, $query);

		if ($data != false && mysqli_num_rows($data) > 0){
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
		} else {
			$contentExists = $contentExists + 1;
		}


		/* Listas de películas */
				openConnection();

		$query = "SELECT * FROM `collections` WHERE UsersLogin='$actualLoginUser' AND Category='movies'";

		$data = mysqli_query($databaseConnection, $query);

		if ($data != false && mysqli_num_rows($data) > 0){
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
		} else {
			$contentExists = $contentExists + 1;
		}


		/* Listas personalizadas */
		openConnection();

		$query = "SELECT * FROM $userPreDefinedTable WHERE UsersLogin='$actualLoginUser'";

		$data = mysqli_query($databaseConnection, $query);

		if ($data != false && mysqli_num_rows($data) > 0){
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
		} else {
			$contentExists = $contentExists + 1;
		}

		if($contentExists == 5){
			?>
				<div class="row d-flex justify-content-between">
					<div class="col-12 font-italic text-center">
						(no hay colecciones disponibles para mostrar. Añada alguna para visualizarla aquí.)
					</div>
				</div>
			<?php
		}
	?>
</body>
</html>