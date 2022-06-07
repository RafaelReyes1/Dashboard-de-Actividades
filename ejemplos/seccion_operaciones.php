<?php
    
    require_once("include/seguridad.php");

    require_once("include/conexion.php");

    //$id_usuario = $_SESSION['id_usuario'];
    $fecha_hora = date("Y-m-d H:i:s");

    if(isset($_POST['crear'])){
        
        if(isset($_POST['nombre'])){
        
            $nombre = strtoupper($_POST['nombre']);

            $insert = "INSERT INTO secciones (nombre) values('$nombre')";
            $query = $conex->query($insert);


            //$id_nivel = $conex->insert_id;

            if($query){
                //$insert = "INSERT INTO ufg_registro_operaciones (id_usuario,id_operacion,fecha_hora,descripcion) values($id_usuario,6,'$fecha_hora','ID: $id_tipo_usuario')";
                //$query = $conex->query($insert);
            }

            $conex->close();
            
        }
        
    }elseif(isset($_POST['editar'])){
        
        if(isset($_POST['codigo_seccion']) && isset($_POST['nombre'])){
        
            $codigo_seccion = $_POST['codigo_seccion'];
            $nombre = strtoupper($_POST['nombre']);

            $update = "UPDATE secciones SET nombre='$nombre' WHERE codigo_seccion=$codigo_seccion";
            $query = $conex->query($update);

            if($query){
                //$insert = "INSERT INTO ufg_registro_operaciones (id_usuario,id_operacion,fecha_hora,descripcion) values($id_usuario,7,'$fecha_hora','ID: $id_tipo_usuario')";
                //$query = mysqli_query($conex, $insert);
            }

            $conex->close();
            
        }
        
    }elseif(isset($_GET['eliminar'])){
        
        if(isset($_GET['codigo_seccion'])){
        
            $codigo_seccion = $_GET['codigo_seccion'];

            $delete = "DELETE FROM secciones WHERE codigo_seccion=$codigo_seccion";
            $query = $conex->query($delete);

            if($query){
                //$insert = "INSERT INTO ufg_registro_operaciones (id_usuario,id_operacion,fecha_hora,descripcion) values($id_usuario,8,'$fecha_hora','ID: $id_tipo_usuario')";
                //$query = mysqli_query($conex, $insert);
            }

            $conex->close();
            
        }
        
    }

    header('Location: seccion_gestion.php');
    exit();

?>