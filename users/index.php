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
					if(isset($_SESSION['login'])){?>
						<img class='img-circle sombreado' src='../<?php echo $_SESSION['avatar']; ?>' class='img-circle'>
						<h5 id='cambiarAvatar'>Cambiar avatar</h5>
						<div id='formCambiarAvatar' class='form-hidden'>
							<form method='POST' action='./updating.php' enctype='multipart/form-data'>
								<input type='file' name='updatingAvatar-img'>
								<br/><br/>
								<input type='submit' name='updatingAvatar-submit' value='Actualizar avatar'>
							</form>
						</div>
						<hr/>
						<h5>Nombre a mostrar:</h5>
						<h1><?php echo $_SESSION['showName']; ?></h1>
						<div id='formCambiarNombreMostrar' class='form-hidden'>
							<form method='POST' action='./updating.php'>
								<input type='text' name='updatingNombre-nombre'>
								<input type='submit' name='updatingNombre-submit' value='Actualizar nombre a mostrar'>
							</form>
						</div>
						<hr/>
						<h5 id='cambiarNombreMostrar'>Cambiar nombre a mostrar</h5>
						<hr/>
						<h5 id='cambiarPassword'>Cambiar contraseña</h5>
						<div id='formCambiarPassword' class='form-hidden'>
							<form method='POST' action='./updating.php'>
								<input type='password' name='updatingPassword-oldPassword' placeholder='Antigua contraseña' requiered/>
								<input type='password' name='updatingPassword-newPassword' placeholder='Nueva contraseña' requiered/>
								<input type='password' name='updatingPassword-retypePassword' placeholder='Repite nueva seña' requiered/>
								<input type='submit' name='updatingPassword-submit' value='Actualizar contraseña'>
							</form>
						</div>
					<?php
					}
				?>
			</p>
		</div>
	</div>


</body>
</html>
