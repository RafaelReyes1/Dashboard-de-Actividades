<?php
	if(true){
?>
 		
	 <!-- Comienza el Nav -->	
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		
	  <a class="navbar-brand" href="<?php echo base_url_;?>index.php"><img src="">Dashboard</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>

	  <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
	    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
			<li class="nav-item active">
				</li>
				<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"  aria-expanded="false">
			  		Reportes
					</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
				  <a class="dropdown-item" href="reportes.php" >Generacion de Reportes</a>
				</div>
			</li>

			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			  Administracion 
			</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
				  <a class="dropdown-item" href="#">Catalogo de Tipos de equipo</a>
				  <a class="dropdown-item" href="#">Catalogo de Fallas</a>
				  <a class="dropdown-item" href="#">Catalogo de Marcas</a>
				  <a class="dropdown-item" href="#">Catalogo de Actividades</a>
				  <a class="dropdown-item" href="#">Catalogo de Empresas</a>
				  <div class="dropdown-divider"></div>
				  
				</div>
			</li>

			
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			  Control de Accesos
			</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
				  <a class="dropdown-item" href="#">Control de Cuentas de Usuario</a>
				  <div class="dropdown-divider"></div>
				 
				</div>
			</li>

			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			  <?= $_SESSION['email']; ?>
			</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
				  <a class="dropdown-item" href="#">Mi cuenta</a>
				  <div class="dropdown-divider"></div>
				  <a class="dropdown-item" href="<?php echo base_url_;?>operaciones/cerrar_sesion.php">Cerrar Sesion</a>
				</div>
			</li>

	    </ul>
	    
	   <!-- <form class="form-inline my-2 my-lg-0">
	      
	    </form>-->
	  </div>

	</nav>
	<!-- Termina el Nav -->	

    	<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">		
					<br>
					<!--<div class="jumbotron col-md-12" style="padding:15px;">-->
					    <div class="row">
	        				<div class="col-1"></div>
	        				<div class="col-lg-10">
<?php } ?>