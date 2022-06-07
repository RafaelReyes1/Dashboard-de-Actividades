<?php
	session_name("ANS");
	session_start();

	//comprueba que el usuario esta autenticado
	if($_SESSION["autenticado"]=="AN_SA"){
		require_once("../include/conexion.php");
		$mail = $_SESSION['email'];

		//$insert = "INSERT INTO movimientos(email,id_actividad) VALUES ('$mail',6) ";
        //$query = mysqli_query($conex, $insert);
        //mysqli_close($conex);
        
		session_destroy();
		header("location:../login.php");
	}else{

		//si no existe, va a la pagina de autenticacion
		header("location:../login.php");
			
	}

		
?>
