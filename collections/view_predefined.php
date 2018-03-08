<?php
	include '../config/config.php';
	include_once('../admin/functions.php');

	session_start();

	areULogin();

	isActivated();

	$actualLoginUser = $_SESSION['login'];

	if(isset($_GET['id_collection'])){
		$collectionToShow = mysqli_real_escape_string($databaseConnection, $_GET['id_collection']);

		$query = "SELECT * FROM $userPreDefinedTable WHERE ID='$collectionToShow'";

		$data = mysqli_query($databaseConnection, $query);

		$info = mysqli_fetch_assoc($data);

		$infoTableName = $info['User_TableID'];
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
	$allColumns = array();

	$query = "DESC $infoTableName";

	$columnsQuery = mysqli_query($databaseConnection, $query);

	while ($actualColumn = mysqli_fetch_assoc($columnsQuery)){
		if($actualColumn['Field'] != 'ItemID'){
			$allColumns[] = $actualColumn['Field'];
		}
	}

	$totalColSpan = sizeof($allColumns);

	if (mysqli_num_rows($data) == 1){
		$infoID = $info['ID'];
		?>
			<div class="row d-flex justify-content-between">
				<div class="col-12">
					<table class="table table-bordered table-hover">
						<thead class="thead-dark">
							<tr>
								<th colspan="<?php echo $totalColSpan; ?>">
									<h5>
										📋 <?php echo $info['Name']; ?> ✏️
									</h5>
								</th>
							</tr>

							<tr>
								<th colspan="<?php echo $totalColSpan; ?>" class="font-italic">
									<?php echo $info['Description']; ?>
								</th>
							</tr>

							<tr>
							<tr>
								<?php
									foreach ($allColumns as $actualColumn) {
										echo '<th>' . $actualColumn . '</th>';
									}
								?>
							</tr>
						</thead>
						<tbody>
							<?php
								$query = "SELECT * FROM $infoTableName";

								$allItems = mysqli_query($databaseConnection, $query);

								if (mysqli_num_rows($allItems) == 0){
									?>
										<tr>
											<td colspan="<?php echo $totalColSpan; ?>" class="font-italic text-center">
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
													<img src="<?php echo './' . $image; ?>" height="100px">
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
</html>