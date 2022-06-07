<?php 
if ($_POST['acc']=="ingresar_actividad") {
	@include('../include/conexion.php');	
	$acc=$_POST['acc'];
    @$id_mant=$_POST['id_mant'];
    $serie_equipo=$_POST['serie_equipo'];
    $cod_falla=$_POST['cod_falla'];
    $p_entrega=$_POST['p_entrega'];
    $observacion=$_POST['observacion'];
    $act_preliminar=$_POST['act_preliminar'];
    $tipo_actividad=$_POST['tipo_actividad'];
    $tipo_trabajo=$_POST['tipo_trabajo'];
/*
    echo $acc."<br>";
    echo $id_mant."<br>";
    echo $serie_equipo."<br>";
    echo $cod_falla."<br>";
    echo $p_entrega."<br>";
    echo $observacion."<br>";
    echo $act_preliminar."<br>";
    echo $tipo_actividad."<br>";
    echo $tipo_trabajo."<br>";
*/
    if (!isset($id_mant)) {
    	//Si la Actividad es totalmente nueva
    	//obtener el maximo id en la tabla actividades, sumarle 1
    	//Ingresar Serie_equipo en tabla actividades , y asi obtener el primer paso
		$consulta = "SELECT id_mant FROM actividades";
		$query = mysqli_query($conex, $consulta); 
		
		$n_id = mysqli_num_rows($query);
		$n_id +=1;

		$estado = $conex->prepare("INSERT INTO actividades (id_mant,serie_equipo) values (?,?)");
		$estado->bind_param('is',$n_id,$serie_equipo);
		$estado->execute();
		$estado->close();
		//Finaliza proceso en tabla actividades
		//Inicia proceso en tabla seguimiento_actividades
		$estado = $conex->prepare("INSERT INTO seguimiento_actividades(id_mant,id_r,fecha,cod_falla,p_entrega,observacion,act_preliminar,cod_estab,tipo_actividad,tipo_trabajo) values (?, '1',CURRENT_TIMESTAMP,?,?,?,?,'1','".$tipo_actividad."',?)");
		$estado->bind_param('iissii',$n_id,$cod_falla,$p_entrega,$observacion,$act_preliminar,$tipo_trabajo);
		$estado->execute();
		$estado->close();

		echo 1;
		//Finaliza proceso en tabla seguimiento_actividades
    	//Posterior, ingresar en la tabla seguimiento actividades, sabiendo que es la primera vez, id_r =1

    }else{
    	//Si no esta vacia, tenemos el id_mant, y id_r no puede ser igual a 1, debemos calcularlo
    	$consulta = "SELECT id_mant FROM seguimiento_actividades WHERE id_mant = ".$id_mant;
		$query = mysqli_query($conex, $consulta); 
		
		$n_r = mysqli_num_rows($query);
		$n_r +=1;
		$estado = $conex->prepare("INSERT INTO actividades (id_mant,serie_equipo) values (?,?)");
		$estado->bind_param('is',$n_id,$serie_equipo);
		$estado->execute();
		$estado->close();
		//Finaliza proceso en tabla actividades
		//Inicia proceso en tabla seguimiento_actividades
		$estado = $conex->prepare("INSERT INTO seguimiento_actividades(id_mant,id_r,fecha,cod_falla,p_entrega,observacion,act_preliminar,cod_estab,tipo_actividad,tipo_trabajo) values (?, ?,CURRENT_TIMESTAMP,?,?,?,?,'1','".$tipo_actividad."',?)");
		$estado->bind_param('iiissii',$id_mant,$n_r,$cod_falla,$p_entrega,$observacion,$act_preliminar,$tipo_trabajo);
		$estado->execute();
		$estado->close();

		echo 1;

    }
}
 ?>

 <?php 
 if ($_POST['acc']=="pre_actividad") {
 	@include('../include/conexion.php');	
 	# proceso para iniciar actividad
 	# pasar de de espera a asignado
 	$id_mant = $_POST['id_mant'];
 	$id_r = $_POST['id_r'];
 	$tecnico = $_POST['tecnico'];
 	//Actualizando la actividad
	$estado = $conex->prepare("UPDATE seguimiento_actividades SET cod_estab = 3 WHERE id_mant = ? AND id_r =?");
	$estado->bind_param('ii',$id_mant,$id_r);

	$estado->execute();
	$estado->close();
	//Actualizando datos en asig_act_tecnicos
	$estado = $conex->prepare("UPDATE asig_act_tecnicos SET fec_a = CURRENT_TIMESTAMP WHERE id_mant = ? AND id_r =? AND id_usuario=?");
	$estado->bind_param('iis',$id_mant,$id_r,$tecnico);

	$estado->execute();
	$estado->close(); 
 }
  ?>



 <?php 
 if ($_POST['acc']=="iniciar_actividad") {
 	@include('../include/conexion.php');	
 	# proceso para iniciar actividad
 	# pasar de asignado a en proceso
 	$id_mant = $_POST['id_mant'];
 	$id_r = $_POST['id_r'];
 	$tecnico = $_POST['tecnico'];
 	//Actualizando la actividad
	$estado = $conex->prepare("UPDATE seguimiento_actividades SET cod_estab = 4 WHERE id_mant = ? AND id_r =?");
	$estado->bind_param('ii',$id_mant,$id_r);
	$estado->execute();
	$estado->close();
	//Actualizando datos en asig_act_tecnicos
	$estado = $conex->prepare("UPDATE asig_act_tecnicos SET fec_a = CURRENT_TIMESTAMP, cod_estab=4 WHERE id_mant = ? AND id_r =? AND id_usuario=?");
	$estado->bind_param('iis',$id_mant,$id_r,$tecnico);

	$estado->execute();
	$estado->close(); 
 }
  ?>

 <?php 
 if ($_POST['acc']=="guardar_actividad") {
 	//Guarda, pero no finaliza
 	@include('../include/conexion.php');	
 	# proceso para iniciar actividad
 	# pasar de asignado a en proceso
 	$id_mant = $_POST['id_mant'];
 	$id_r = $_POST['id_r'];
 	$tecnico = $_POST['tecnico'];
 	$procedimiento = $_POST['procedimiento'];
 	$recomendaciones = $_POST['recomendaciones'];
 	$horas_invertidas = $_POST['horas_invertidas'];
 	$ref_administracion = $_POST['ref_administracion'];
 	/*
 	//Actualizando la actividad
	$estado = $conex->prepare("UPDATE seguimiento_actividades SET cod_estab = 5 WHERE id_mant = ? AND id_r =?");
	$estado->bind_param('ii',$id_mant,$id_r);
	
	$estado->execute();
	$estado->close(); */
	//Actualizando datos en asig_act_tecnicos
	$estado = $conex->prepare("UPDATE asig_act_tecnicos SET procedimiento=?,recomendaciones=?,horas_tecnico=?,ref_administracion=? WHERE id_mant = ? AND id_r =? AND id_usuario=?");
	$estado->bind_param('ssisiis',$procedimiento,$recomendaciones,$horas_invertidas,$ref_administracion,$id_mant,$id_r,$tecnico);
	$estado->execute();
	$estado->close();
	echo 1;
 }
?>

   <?php 
 if ($_POST['acc']=="finalizar_actividad_tecnico") {
 	//Guarda, pero no finaliza
 	@include('../include/conexion.php');	
 	# proceso para iniciar actividad
 	# pasar de asignado a en proceso
 	$id_mant = $_POST['id_mant'];
 	$id_r = $_POST['id_r'];
 	$tecnico = $_POST['tecnico'];
 	$procedimiento = $_POST['procedimiento'];
 	$recomendaciones = $_POST['recomendaciones'];
 	$horas_invertidas = $_POST['horas_invertidas'];
 	$ref_administracion = $_POST['ref_administracion'];
 	
 	//Actualizando la actividad, pasa a "listo"
	//$estado = $conex->prepare("UPDATE seguimiento_actividades SET cod_estab = 5 WHERE id_mant = ? AND id_r =?");
	//$estado->bind_param('ii',$id_mant,$id_r);
	//$estado->execute();
	//$estado->close(); 

	//Actualizando datos en asig_act_tecnicos
	$estado = $conex->prepare("UPDATE asig_act_tecnicos SET procedimiento=?,recomendaciones=?,horas_tecnico=?,ref_administracion=?,fec_f=CURRENT_TIMESTAMP , fin_tec='Y',cod_estab=5 WHERE id_mant = ? AND id_r =? AND id_usuario=?");
	$estado->bind_param('ssisiis',$procedimiento,$recomendaciones,$horas_invertidas,$ref_administracion,$id_mant,$id_r,$tecnico);
	$estado->execute();
	$estado->close();
	echo 1;
 }
  ?>
<?php 
 if ($_POST['acc']=="remover_actividad") {
 	//Guarda, pero no finaliza
 	@include('../include/conexion.php');	
 	# proceso para iniciar actividad
 	# pasar de asignado a en proceso
 	$id_mant = $_POST['id_mant'];
 	$id_r = $_POST['id_r'];
 	$tecnico = $_POST['tecnico'];
 	
	//Actualizando datos en asig_act_tecnicos
	$estado = $conex->prepare("DELETE FROM asig_act_tecnicos WHERE id_mant = ? AND id_r =? AND id_usuario=?");
	$estado->bind_param('iis',$id_mant,$id_r,$tecnico);
	$estado->execute();
	$estado->close();
	echo 1;
 }
?>

<?php 
 if ($_POST['acc']=="asignar_actividad") {
 	//Guarda, pero no finaliza
 	@include('../include/conexion.php');	
 	# proceso para iniciar actividad
 	# pasar de asignado a en proceso
 	$id_mant = $_POST['id_mant'];
 	$id_r = $_POST['id_r'];
 	$tecnico = $_POST['tecnico'];
 	
	//Actualizando datos en Seguimiento actividades
	$estado = $conex->prepare("UPDATE seguimiento_actividades SET cod_estab = 4 WHERE id_mant=? AND id_r=?");
	$estado->bind_param('ii',$id_mant,$id_r);
	$estado->execute();
	$estado->close();

	//Creando registro en asignacines act asig_act_tecnicos
	//Actualizando datos en asig_act_tecnicos, para que el tecnico tenga su registro
	$estado = $conex->prepare("INSERT INTO asig_act_tecnicos (id_mant,id_r,id_usuario,fec_t,cod_estab) VALUES (?,?,?,CURRENT_TIMESTAMP,'3')");
	$estado->bind_param('iis',$id_mant,$id_r,$tecnico);
	$estado->execute();
	$estado->close();

	echo 1;
 }
?>