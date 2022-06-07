<?php 
	
	session_name("ANS");
	//inicio la sesion
	session_start();
	//comprueba que el usuario esta autenticado
	if(!$_SESSION["autenticado"]=="AN_SA"){
		//si no existe, va a la pagina de autenticacion
		header("location:../login.php");
		//salimos de este script
		exit();
	}
	require_once("base_url.php"); 
?>
<!DOCTYPE html> 
<html lang="es">
 	<head>
	    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">

	    <title>Analitica Salvadoreña</title>
	    <link href="<?php echo base_url_;?>assets/css/jquery-ui.css" rel="stylesheet">
	    <link href="<?php echo base_url_;?>assets/css/bootstrap.min.css" rel="stylesheet">
	    <link href="<?php echo base_url_;?>assets/css/jquery.dataTables.min.css" rel="stylesheet">
	    <link href="<?php echo base_url_;?>assets/css/line-icon.css" rel="stylesheet">
	    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
	    <link rel="shortcut icon" href="<?php echo base_url_;?>assets/images/analitica.png" />
	</head>
  	<body>
