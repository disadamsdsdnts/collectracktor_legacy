<?php
	include_once($_SERVER['DOCUMENT_ROOT'] . '/' . 'config/functions.php');
?>
<meta charset="utf-8">
<script type="text/javascript" src="./js/jquery-3.2.1.slim.min.js"></script>
<script type="text/javascript" src="./js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="./js/popper.min.js"></script>
<script type="text/javascript" src="./js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="./css/general.css">
<script type="text/javascript" src="./js/login.js"></script>

	<nav id="navigation-bar" class="navbar navbar-dark bg-dark">
	  <a class="navbar-brand" href="./index.php">Colec-track-tor</a>
	  <ul class="nav nav-pills">
	    <?php
			/* Si ha iniciado sesión */
	    	if (isset($_SESSION['login'])){
	    		if($_SESSION['rol'] == 'administrator'){ /* Si es administrador, muestra el panel de control */
	    			echo "<li class='nav-item'>";
				      echo "<a class='nav-link' href='./admin/index.php'>Panel de Control</a>";
				    echo "</li>";
	    		}
				/* Si está registrado e iniciado sesión, muestra los apartados básicos. El admin cuenta como registrado */

	    		echo "<li class='nav-item'>";
			      echo "<a class='nav-link' href='./collections/index.php'>Mis colecciones</a>";
			    echo "</li>";

			    echo "<li class='nav-item'>";
			      echo "<a class='nav-link' href='./users/index.php'>Mi cuenta</a>";
			   	echo "</li>";

	    		echo "<li class='nav-item'>";
	    			echo "<a class='nav-link' href='./logout.php'>Cerrar sesión (" . $_SESSION['login'] . ")</a>";
	    		echo "</li>";
	    	} else { /* Si no ha iniciado sesión, se muestra el registrarse y el iniciar sesión */
	    		echo "<li class='nav-item'>";
			    	echo "<a class='nav-link' href='./register.php'>Registrarse</a>";
			    echo "</li>";

	    		echo "<li class='nav-item dropdown'>";
			      echo "<a class='nav-link' id='iniciarSessionButton' href='#' data-toggle=\"modal\" data-target=\"#inicioSesionModal\">Iniciar sesión</a>";
			    echo "</li>";
	    	}
	    ?>
	  </ul>
	</nav>

	<?php 
		if(!isset($_SESSION['login'])){
	?>
		<div class="modal fade" id="inicioSesionModal" tabindex="-1" role="dialog" aria-labelledby="IniciodeSesion" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-centered" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLongTitle">Inicio de sesión</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		        	<form id='formLogin' method='POST' action='./login.php' onsubmit='return validarLogin(this);'>
						<div class="row justify-content-center">
							<input form="formLogin" class='login' type='text' name='login' placeholder='Login'>
						</div>
						<br>
						<div class="row justify-content-center">
							<input form="formLogin" class='login' type='password' name='password' placeholder='Password'>
						</div>
					</form>
		      </div>
		      <div class="modal-footer">
		        <input form="formLogin" type="submit" class="btn btn-primary" name="loginsubmit" value="Iniciar sesión">
		      </div>
		    </div>
		  </div>
		</div>
	<?php
		}
	?>
