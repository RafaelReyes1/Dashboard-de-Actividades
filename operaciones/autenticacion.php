<?php
    require_once("../template/base_url.php"); 
    require_once("../include/conexion.php");
    if(isset($_POST['login'])){
        if(isset($_POST['usuario']) && isset($_POST['password'])){
            $usuario = trim($_POST['usuario']);
            $contrasena = trim($_POST['password']);
            $contrasena_ = password_hash($contrasena, PASSWORD_DEFAULT);
            $consulta = "SELECT user as email,nombre,apellido,pwd as pwd ,tipo_user FROM users WHERE user='$usuario' AND visibilidad='Y'";
            $query = $conex->query($consulta);
            if($query->num_rows > 0){
                $row = $query->fetch_assoc();
                $contrasena_bd = $row['pwd'];
                if(password_verify($contrasena, $contrasena_bd)){
                    session_name("ANS");
                    session_start();
                    $_SESSION["autenticado"] = "AN_SA";
                    $_SESSION["nombres"] = $row['nombre'];
                    $_SESSION["apellidos"] = $row['apellido'];
                    $_SESSION["email"] = $row['email'];
                    
                    $_SESSION['acceso'] = $row['tipo_user'];
                    $_SESSION['pwd'] = $row['pwd'];
                    //Consulta para el ingreso al sistema
                    //$insert = "INSERT INTO movimientos (email,id_actividad) VALUES ('$mail',3) ";
                    //$query = mysqli_query($conex, $insert);
                    //$conex->close();
                    header('Location: '.base_url_.'forms/dashboard.php');
                    exit();
                }else{
                    header('Location: '.base_url_.'login.php?msj=2');
                }
            }else{

                header('Location: '.base_url_.'login.php?msj=2');
            }
        }else{
            header('Location: '.base_url_.'login.php?msj=1');
        }
    }
    $conex->close();
?>