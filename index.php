<?php 
  session_name("ANS");
  //inicio la sesion
  session_start();
  //comprueba que el usuario esta autenticado
  if(@$_SESSION["autenticado"]=="AN_SA"){
    //si no existe, va a la pagina de autenticacion
    header("location:forms/dashboard.php");
    //salimos de este script
    exit();
  }else{
   header('location: login.php');
    exit();
  }