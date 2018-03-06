<?php
	include_once '../admin/functions.php';
?>

<script type="text/javascript" src="../js/jquery-3.2.1.slim.min.js"></script>
<script type="text/javascript" src="../js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="../js/popper.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../css/general.css">
<script type="text/javascript" src="../js/login.js"></script>

	<nav id="navigation-bar" class="navbar navbar-dark bg-dark">
	  <a class="navbar-brand" href="../index.php">Colec-track-tor</a>
	  <ul class="nav nav-pills">
	    <?php
			/* Si ha iniciado sesión */
	    	if (isset($_SESSION['login'])){
	    		if($_SESSION['rol'] == 'administrator'){ /* Si es administrador, muestra el panel de control */
	    			echo "<li class='nav-item'>";
				      echo "<a class='nav-link' href='../admin/control_panel.php'>Panel de Control</a>";
				    echo "</li>";
	    		}
				/* Si está registrado e iniciado sesión, muestra los apartados básicos. El admin cuenta como registrado */
	    		echo "<li class='nav-item'>";
			      echo "<a class='nav-link' href=''>Nuevo anuncio</a>";
			    echo "</li>";

	    		echo "<li class='nav-item'>";
			      echo "<a class='nav-link' href='../collections/index.php'>Mis colecciones</a>";
			    echo "</li>";

			    echo "<li class='nav-item'>";
			      echo "<a class='nav-link' href='../registrados/perfilUsuario.php'>Mi cuenta</a>";
			   	echo "</li>";

	    		echo "<li class='nav-item'>";
	    			echo "<a class='nav-link' href='../logout.php'>Cerrar sesión (" . $_SESSION['login'] . ")</a>";
	    		echo "</li>";
	    	} else { /* Si no ha iniciado sesión, se muestra el registrarse y el iniciar sesión */
	    		echo "<li class='nav-item'>";
			    	echo "<a class='nav-link' href='../register.php'>Registrarse</a>";
			    echo "</li>";

	    		echo "<li class='nav-item dropdown'>";
			      echo "<a class='nav-link' id='iniciarSessionButton' href='#'>Iniciar sesión</a>";
			    echo "</li>";
	    	}
	    ?>
	  </ul>
	</nav>

	<?php 
		if(!isset($_SESSION['login'])){
	?>
			<div>
				<div class="card">
					<div class="card-header">
						Inicio de sesión
					</div>

					<div class="card-body">
						<form id='formLogin' method='POST' action='../login.php' onsubmit='return validarLogin(this);'>
							<input class='login' type='text' name='login' placeholder='Login'>
							<input class='login' type='password' name='password' placeholder='Password'>
							<input class='login' type='submit' name='loginsubmit' value='Logueate'></input>
						</form>
					</div>
				</div>
			</div>
	<?php
		}
	?>
