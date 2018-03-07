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

	if (mysqli_num_rows($data) == 1){
		$infoID = $info['ID'];
		?>
			<div class="row d-flex justify-content-between">
				<div class="col-12">
					<table class="table table-bordered table-hover">
						<thead class="thead-dark">
							<tr>
								<th colspan="6">
									<h5>
										📋 <?php echo $info['Name']; ?> 🎬
									</h5>
								</th>
								<th>
									<a href="./add_movies.php?id=<?php echo $info['ID']; ?>">
										<button>Añadir nueva película</button>
									</a>
								</th>
							</tr>

							<tr>
								<th colspan="7" class="font-italic">
									<?php echo $info['Description']; ?>
								</th>

							</tr>

							<tr>
								<th>
									
								</th>
								<th>
									Título
								</th>
								<th>
									Año
								</th>
								<th>
									Protagonizada por
								</th>
								<th>
									Dirigida por
								</th>
								<th>
									Formato
								</th>
								<th>
									Código de barras
								</th>
						</thead>
						<tbody>
							<?php
								$query = "SELECT * FROM item, movies WHERE (item.ID = movies.ItemID) AND collectionsID='$infoID'";

								$allItems = mysqli_query($databaseConnection, $query);

								if (mysqli_num_rows($allItems) == 0){
									?>
										<tr>
											<td colspan="7" class="font-italic text-center">
												(no se ha encontrado ningún item en esta colección)
											</td>
										</tr>
									<?php
								} else {
									while($actualRow = mysqli_fetch_assoc($allItems)){
										?>
											<tr>
												<td class="align-middle">
													<?php 
														if(strpos($actualRow['Image'], 'http') !== FALSE){
															?>
															<img src="<?php echo $actualRow['Image']; ?>" height="100px">
															<?php
														} else {
															?>
															<img src="<?php echo './' . $actualRow['Image']; ?>" height="100px">
															<?php
														}
													?>
												</td>
												<td class="align-middle">
													<?php echo '<strong>' . $actualRow['Title'] . '</strong>'; ?>
												</td>
												<td class="align-middle">
													<?php echo $actualRow['Year']; ?>
												</td>
												<td class="align-middle">
													<?php echo $actualRow['Starring']; ?>
												</td>
												<td class="align-middle">
													<?php echo $actualRow['Directed_By']; ?>
												</td>
												<td class="align-middle">
													<?php echo $actualRow['Format']; ?>
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
<script type="text/javascript">
	$(document).ready(function() {
		$("img, input[type=image]").each(function() {
    	this.src = cacheBuster(this.src);
		});
	});
</script>
</html>