<?php
	include_once($_SERVER['DOCUMENT_ROOT'] . '/' . 'config/functions.php');

	session_start();

	areULogin();

	isActivated();

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

	if ($data != false && mysqli_num_rows($data) == 1){
		$infoID = $info['ID'];

		$query = "SELECT * FROM $tableItem, $tableCex WHERE ($tableItem.ID = $tableCex.ItemID) AND collectionsID='$infoID'";

		$allItems = mysqli_query($databaseConnection, $query);

		$numItems = mysqli_num_rows($allItems);

		?>
			<div class="row d-flex justify-content-between">
				<div class="col-12">
					<table class="table table-bordered table-hover">
						<thead class="thead-dark">
							<tr>
								<th colspan="4">
									<h5>
										📋 <?php echo $info['Name']; ?> <img src="https://s3-eu-west-1.amazonaws.com/tpd/logos/57ac42dd0000ff0005935ac1/0x0.png" style="width: 25px">
									</h5>
								</th>
								<th>
									<?php if($numItems > 0){?>
									<a href="./checkall_cex.php?id=<?php echo $info['ID']; ?>">
										<button>Comprobar todos</button>
									</a>
									<?php } ?>
								</th>

								<th>
									<a href="./add_cex.php?id=<?php echo $info['ID']; ?>">
										<button>Añadir</button>
									</a>
								</th>
							</tr>

							<tr>
								<th colspan="6" class="font-italic">
									<?php echo $info['Description']; ?>
								</th>
							</tr>

							<tr>
								<th>
									
								</th>
								<th>
									Nombre
								</th>
								<th>
									Enlace
								</th>
								<th>
									Precio
								</th>
								<th>
									Disponible
								</th>
								<th>
									Última comprobación
								</th>
							</tr>
						</thead>
						<tbody>
							<?php
								

								if ($allItems != false && $numItems == 0){
									?>
										<tr>
											<td colspan="6" class="font-italic text-center">
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
													<?php echo '<strong>' . $actualRow['Name'] . '</strong>'; ?>
												</td>
												<td class="align-middle">
													<?php echo '<a href="' . $actualRow['URL'] . '"><img src="https://s3-eu-west-1.amazonaws.com/tpd/logos/57ac42dd0000ff0005935ac1/0x0.png" style="width: 25px"></a>'; ?>
												</td>
												<td class="align-middle">
													<?php echo number_format($actualRow['Price'], 2) . ' €'; ?>
												</td>
												<td class="align-middle">
													<?php if($actualRow['Available'] == 1){
														echo '✅';
													}else{
														echo '❌';
													}; ?>
												</td>
												<td class="align-middle">
													<?php echo $actualRow['LastCheck']; ?>
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