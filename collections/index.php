<?php
	include($_SERVER['DOCUMENT_ROOT'] . '/' . 'config/functions.php');

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
		echo insertStyles(__FILE__);
	?>

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

			<hr>

			<a href="./create_cex.php">
				<button type="button" class="btn btn-secondary">
					<span>➕ <img src="https://s3-eu-west-1.amazonaws.com/tpd/logos/57ac42dd0000ff0005935ac1/0x0.png" style="width: 25px"></span> Añadir un rastreador para WeBuy
				</button>
			</a>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
	      </div>
	    </div>
	  </div>
	</div>

	<?php
		$contentExists = 0;

		$styles = array(
			[
				'name' =>  	'📋 Listas de música 🎼', 
				'style' => 	'music'
			],
			[
				'name' => 	'📋 Listas de latas 🥫',
				'style' => 	'cans'
			],
			[
				'name' => 	'📋 Listas de libros 📚',
				'style' => 	'books'
			],
			[
				'name' => 	'📋 Listas de películas 🎬',
				'style' => 	'movies'
			]
		);

		foreach($styles as $actualStyle){
			openConnection();

			$category = $actualStyle['style'];

			$query = "SELECT * FROM $tableCollections WHERE UsersLogin='$actualLoginUser' AND Category='$category'";

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
											<?= $actualStyle['name'] ?>
										</h5>
									</th>
								</tr>
								<tr>
									<th max-width="150px">
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
											<tr onclick="window.location='./view_<?= $actualStyle['style'] ?>.php?id_collection=<?php echo $actualID; ?>'">
												<td class="align-middle text-center" style="width:33%">
													<img class="rounded" src="<?php echo $actualRow['Image']; ?>" width="150px">
												</td>
												<td class="align-middle" style="width:33%">
													<?php echo '<strong>' . $actualRow['Name'] . '</strong>'; ?>
												</td>
												<td class="align-middle" style="width:33%">
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
											<td class="align-middle text-center" style="width:33%">
												<img class="rounded" src="<?php echo $actualRow['Image']; ?>" width="150px">
											</td>
											<td class="align-middle" style="width:33%">
												<?php echo '<strong>' . $actualRow['Name'] . '</strong>'; ?>
											</td>
											<td class="align-middle" style="width:33%">
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