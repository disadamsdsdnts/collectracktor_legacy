<?php
    include_once '../admin/functions.php';

    session_start();



    include_once '../config/config.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>Colec-track-tor</title>
</head>
<body>
	<?php 
        include_once '../navigator_inside.php';
	?>

	<link rel="stylesheet" type="text/css" href="../css/global.css">
	<script type="text/javascript" src="../js/updateAccount.js"></script>
	<link rel="stylesheet" type="text/css" href="../css/account.css">

	<br>

	<div class="container">
		<div class="row d-flex justify-content-between">
			<div class="col-12">
				<table class="table table-bordered table-hover">
					<thead class="thead-dark">
						<tr>
							<th colspan="4">
								<h3 class="text-center">
									Perfil del usuario
								</h3>
							</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>

	<div class="container text-center">
		<div class="card-body">
			<p class="card-text text-center">
				<?php
					if(isset($_SESSION['login'])){
						echo "<img class='img-circle sombreado' src='../" . $_SESSION['avatar'] . "' class='img-circle'>";
						echo "<h5 id='cambiarAvatar'>Cambiar avatar</h5>";
						echo "<div id='formCambiarAvatar' class='form-hidden'>";
							echo "<form method='POST' action='./updating.php' enctype='multipart/form-data'>";
								echo "<input type='file' name='updatingAvatar-img'>";
								echo "<br/><br/>";
								echo "<input type='submit' name='updatingAvatar-submit' value='Actualizar avatar'>";
							echo "</form>";
						echo "</div>";
						echo "<hr/>";
						echo "<h5>Nombre a mostrar:</h5>";
						echo "<h1>" . $_SESSION['showName'] . "</h1>";
						echo "<div id='formCambiarNombreMostrar' class='form-hidden'>";
							echo "<form method='POST' action='./updating.php'>";
								echo "<input type='text' name='updatingNombre-nombre'>";
								echo "<input type='submit' name='updatingNombre-submit' value='Actualizar nombre a mostrar'>";
							echo "</form>";
						echo "</div>";
						echo "<hr/>";
						echo "<h5 id='cambiarNombreMostrar'>Cambiar nombre a mostrar</h5>";
						echo "<hr/>";
						echo "<h5 id='cambiarPassword'>Cambiar contraseña</h5>";
						echo "<div id='formCambiarPassword' class='form-hidden'>";
							echo "<form method='POST' action='./updating.php'>";
								echo "<input type='password' name='updatingPassword-oldPassword' placeholder='Antigua contraseña' required/>";
								echo "<input type='password' name='updatingPassword-newPassword' placeholder='Nueva contraseña' required/>";
								echo "<input type='password' name='updatingPassword-retypePassword' placeholder='Repite nueva contraseña' requiered/>";
								echo "<input type='submit' name='updatingPassword-submit' value='Actualizar contraseña'>";
							echo "</form>";
						echo "</div>";
					}
				?>
			</p>
		</div>
	</div>


</body>
</html>
