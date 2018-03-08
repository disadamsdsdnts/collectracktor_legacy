<?php
	include '../config/config.php';
	include_once('../admin/functions.php');

	session_start();

	areULogin();

	$actualLoginUser = $_SESSION['login'];

	if(isset($_GET['id_collection'])){
		$collectionToShow = mysqli_real_escape_string($databaseConnection, $_GET['id_collection']);

		$query = "SELECT * FROM $tableCollections WHERE ID='$collectionToShow'";

		$data = mysqli_query($databaseConnection, $query);

		$info = mysqli_fetch_assoc($data);
	} else {
		echo '<script>
			alert("No sé cómo has llegado aquí, pero has llegado a un callejón sin información. Volviendo al inicio.");
			setTimeout(function(){ <?php header("Location: ../index.php"); ?> }, 500);
		</script>';
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $info['Name']; ?></title>
</head>

<body>
	<?php 
		include_once ('../navigator_inside.php');
	?>

	<link rel="stylesheet" type="text/css" href="../css/collections_index.css">
	<link rel="stylesheet" type="text/css" href="../css/collections_create.css">

	<br>

	<?php

	if (mysqli_num_rows($data) == 1){
		$infoID = $info['ID'];
		?>
			<div class="row d-flex justify-content-between">
				<div class="col-12">
					<table class="table table-bordered table-hover">
						<thead class="thead-dark">
							<tr>
								<th colspan="7">
									<h5>
										📋 <?php echo $info['Name']; ?> 🎵
									</h5>
								</th>
							</tr>

							<tr>
								<th colspan="6" class="font-italic">
									<?php echo $info['Description']; ?>
								</th>

								<th>
									<a href="./add_music.php?id=<?php echo $info['ID']; ?>">
										<button>Añadir nuevo disco</button>
									</a>
								</th>
							</tr>

							<tr>
								<th>
									
								</th>
								<th>
									Artista
								</th>
								<th>
									Título
								</th>
								<th>
									Fecha de Publicación
								</th>
								<th>
									Discográfica
								</th>
								<th>
									Formato
								</th>
								<th>
									Código de barras
								</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$query = "SELECT * FROM item, music WHERE (item.ID = music.ItemID) AND collectionsID='$infoID'";

								$allItems = mysqli_query($databaseConnection, $query);

								if (mysqli_num_rows($allItems) == 0){
									?>
										<tr>
											<td colspan="8" class="font-italic text-center">
												(no se ha encontrado ningún item en esta colección)
											</td>
										</tr>
									<?php
								} else {
									while($actualRow = mysqli_fetch_assoc($allItems)){
										$image = $actualRow['Image'];
										?>
											<tr>
												<td class="align-middle">
													<img src="<?php echo './' . $image; ?>" style="max-height: 100px; max-width: 100px;"">
												</td>
												<td class="align-middle">
													<?php echo '<strong>' . $actualRow['Artist'] . '</strong>'; ?>
												</td>
												<td class="align-middle">
													<?php echo $actualRow['Title']; ?>
												</td>
												<td class="align-middle">
													<?php echo $actualRow['Publish Date']; ?>
												</td>
												<td class="align-middle">
													<?php echo $actualRow['Record Company']; ?>
												</td>
												<td class="align-middle">
													<?php echo $actualRow['Type']; ?>
												</td>
												<td class="align-middle">
													<?php echo $actualRow['Barcode']; ?>
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
		?>
</body>
</html>