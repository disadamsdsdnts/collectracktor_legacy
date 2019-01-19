<?php
    include_once($_SERVER['DOCUMENT_ROOT'] . '/' . 'config/functions.php');

    session_start();

	areULogin();

	isActivated();

	$actualLogin = $_SESSION['login'];

	if(isset($_GET['default'])){
		$collectionToDelete = $_GET['default'];

		$query = "SELECT * FROM $tableCollections WHERE ID='$collectionToDelete'";

		$infoDB = mysqli_query($databaseConnection, $query);

		$data = mysqli_fetch_assoc($infoDB);

		if(($actualLogin == $data['UsersLogin']) && (mysqli_num_rows($infoDB) == 1)){
			$query = "DELETE FROM `collections` WHERE ID='$collectionToDelete'";

			$deleting = mysqli_query($databaseConnection, $query);

			if($deleting){
				header('Location: ./admin_collections.php?delete=ok');
			} else {
				header('Location: ./admin_collections.php?delete=fail');
			}
		} else {
			?>
				<script type="text/javascript">
					alert("No tienes permiso para hacer esto. Volviendo a la administración de tu cuenta...");
					setTimeout(function(){<?php header('Location:./admin_collections.php?var=arriba'); ?>}, 500)
				</script>
			<?php
		}

	} else if(isset($_GET['predefined'])){
		$collectionToDelete = $_GET['predefined'];

		$query = "SELECT * FROM $userPreDefinedTable WHERE ID='$collectionToDelete'";

		$infoDB = mysqli_query($databaseConnection, $query);

		$data = mysqli_fetch_assoc($infoDB);

		if(($actualLogin == $data['UsersLogin']) && (mysqli_num_rows($infoDB) == 1)){
			$query = "SELECT User_TableID FROM $userPreDefinedTable WHERE ID='$collectionToDelete'";

			$tableRealName = mysqli_query($databaseConnection, $query);

			$deleting = '';

			if($tableRealName){
				$query = "DELETE FROM $userPreDefinedTable WHERE ID='$collectionToDelete'";

				$deleting = mysqli_query($databaseConnection, $query);
			}

			if($tableRealName && $deleting){
				header('Location: ./admin_collections.php?delete=ok');
			} else {
				header('Location: ./admin_collections.php?delete=fail');
			}
		} else {
			?>
				<script type="text/javascript">
					alert("No tienes permiso para hacer esto. Volviendo a la administración de tu cuenta...");
					/*setTimeout(function(){}, 500)*/
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

	//header('Location: ./admin_collections.php');
?>