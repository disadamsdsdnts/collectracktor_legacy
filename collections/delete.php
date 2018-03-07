<?php
    include_once '../admin/functions.php';

    session_start();

	areULogin();

	$actualLogin = $_SESSION['login'];

	if(isset($_GET['default'])){
		$collectionToDelete = $_GET['default'];

		$query = "SELECT * FROM $tableCollections;"

		$infoDB = mysqli_query($databaseConnection, $query);

		$data = mysqli_fetch_assoc($infoDB);

		if(($actualLogin == $data['UsersLogin']) && (mysqli_num_rows($infoDB) == 1)){
			
		} else {
			?>
				<script type="text/javascript">
					alert("No tienes permiso para hacer esto. Volviendo a la administración de tu cuenta..");
					setTimeout(function(){<?php header('Location:./admin_collections.php'); ?>}, 500)
				</script>
			<?php
		}

	} else if(isset($_GET['predefined'])){
		$collectionToDelete = $_GET['predefined'];

		$query = "SELECT * FROM $userPreDefinedTable;"

		$infoDB = mysqli_query($databaseConnection, $query);

		$data = mysqli_fetch_assoc($infoDB);

		if(($actualLogin == $data['UsersLogin']) && (mysqli_num_rows($infoDB) == 1)){
			
		} else {
			?>
				<script type="text/javascript">
					alert("No tienes permiso para hacer esto. Volviendo a la administración de tu cuenta..");
					setTimeout(function(){<?php header('Location:./admin_collections.php'); ?>}, 500)
				</script>
			<?php
		}
	} else {
		echo '<script>
			alert("No sé cómo has llegado aquí, pero has llegado a un callejón sin información. Volviendo al inicio.");
			setTimeout(function(){ <?php header("Location: ../index.php"); ?> }, 500);
		</script>';
	}

	mysqli_close($databaseConnection);

	header('Location: ./admin_collections.php');
?>