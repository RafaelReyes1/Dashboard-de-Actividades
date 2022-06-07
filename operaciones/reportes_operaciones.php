<?php 
if ($_POST['acc']=="actvtec") {
	require_once('../include/conexion.php');	
	$usuario=$_POST['usuario'];

	

	if ($_POST['v_fecha']=='N') {


		if ($_POST['fecha_i'] == NULL OR $_POST['fecha_f'] == NULL ) {
		echo "<center><h1>¡Debes completar los parametros de fecha!</h1></center>";
	}

		$condicion = " AND (seguimiento_actividades.fecha BETWEEN '".$_POST['fecha_i']."'  AND '".$_POST['fecha_f']."') ";
	}else{



		$condicion="";
	}
	$consulta = "SELECT 
				asig.id_mant as actividad_mant,
				asig.id_r as actividad_r,
				c_empresas.nombre as cliente,
				seguimiento_actividades.fecha as fecha_requerimiento,
				asig.fec_t as fecha_asignacion,
				asig.fec_a as fecha_inicio_tecnico,
				asig.ref_administracion as numero_documento,
				estado_bien.descripcion as estado_actividad
				FROM
				asig_act_tecnicos as asig
				JOIN seguimiento_actividades ON seguimiento_actividades.id_mant = asig.id_mant AND seguimiento_actividades.id_r = asig.id_r
				JOIN actividades ON actividades.id_mant = asig.id_mant
				JOIN detalle_equipo ON detalle_equipo.serie = actividades.serie_equipo
				JOIN c_empresas ON c_empresas.id = detalle_equipo.cliente
				JOIN estado_bien ON estado_bien.id = asig.cod_estab
				WHERE asig.id_usuario='".$usuario."' ".$condicion;
	$query = mysqli_query($conex, $consulta); 
	$cuerpo_tabla="";
	//echo $consulta;
	while($rows = mysqli_fetch_array($query)){
		//Generar tabla
		$cuerpo_tabla .= "
		<tr>
			<td>".$rows['actividad_mant']."-".$rows['actividad_r']."</td>
			<td>".$rows['cliente']."</td>
			<td>".$rows['fecha_requerimiento']."</td>
			<td>".$rows['fecha_asignacion']."</td>
			<td>".$rows['fecha_inicio_tecnico']."</td>
			<td>".$rows['numero_documento']."</td>
			<td>".$rows['estado_actividad']."</td>
			<td><a class='btn btn-info' href='detalle_actividad.php?id_mant=".$rows['actividad_mant']."&id_r=".$rows['actividad_r']."&tecnico=".$usuario."' target='_Blank'>Detalles</a></td>
		</tr>";
	}
	?> 
	
	<div id="treporte1">
		<table class="table" >
			<thead>
				<tr>
					<th>Actividad</th>
					<th>Fecha</th>
					<th>Observacion</th>
					<th>Entrego</th>
					<th>Estado</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?=  $cuerpo_tabla; ?>
			</tbody>
		</table>
	</div>	
	<a href="#" onclick="genpdf('treporte1',1);" class="btn btn-block btn-info">Generar PDF</a>
	<?php  
}
 ?>

 <?php 
if ($_POST['acc']=="histeq") {
	require_once('../include/conexion.php');	
	$consulta = "SELECT 
				seguimiento_actividades.id_mant,
				seguimiento_actividades.id_r,
				seguimiento_actividades.fecha,
				seguimiento_actividades.observacion,
				seguimiento_actividades.p_entrega,
				estado_bien.descripcion as estado_bien
				FROM actividades
				JOIN detalle_equipo ON detalle_equipo.serie = actividades.serie_equipo 
				JOIN seguimiento_actividades ON seguimiento_actividades.id_mant = actividades.id_mant
				JOIN c_ttrabajo ON c_ttrabajo.id = seguimiento_actividades.tipo_trabajo
				JOIN estado_bien ON estado_bien.id = seguimiento_actividades.cod_estab
				where actividades.serie_equipo='".$_POST['serie_equipo']."'";
	$query = mysqli_query($conex, $consulta); 
	$cuerpo_tabla="";
	//echo $consulta;
	while($rows = mysqli_fetch_array($query)){
		//Generar tabla
		$cuerpo_tabla .= "
		<tr>
			<td>".$rows['id_mant']."-".$rows['id_r']."</td>
			<td>".$rows['fecha']."</td>
			<td>".$rows['observacion']."</td>
			<td>".$rows['p_entrega']."</td>
			<td>".$rows['estado_bien']."</td>
			<td></td>
			
		</tr>";
	}
	?> 
	<div id="treporte2">
	<table class="table">
			<thead>
				<tr>
					<th>Actividad</th>
					<th>Fecha</th>
					<th>Observacion</th>
					<th>Entrego</th>
					<th>Estado</th>
					<th></th>
					
				</tr>
			</thead>
			<tbody>
				<?=  $cuerpo_tabla; ?>
			</tbody>
		</table>
	</div>
	<a href="#" onclick="genpdf('treporte2',2);" class="btn btn-block btn-info">Generar PDF</a>
	
	<?php  
}
 ?>

 <?php 
 //Reporte actividades vs cliente
if ($_POST['acc']=="actvcli") {
	require_once('../include/conexion.php');	

	if ($_POST['v_fecha']=='N') {

		if ($_POST['fecha_i'] == NULL OR $_POST['fecha_f'] == NULL ) {
		echo "<center><h1>¡Debes completar los parametros de fecha!</h1></center>";
	}
		$condicion = " AND (seguimiento_actividades.fecha BETWEEN '".$_POST['fecha_i']."'  AND '".$_POST['fecha_f']."') ";
	}else{
		$condicion="";
	}


	$consulta = "SELECT 
				seguimiento_actividades.id_mant,
				seguimiento_actividades.id_r,
				seguimiento_actividades.fecha,
				seguimiento_actividades.observacion,
				seguimiento_actividades.p_entrega,
				estado_bien.descripcion as estado_bien
				FROM actividades
				JOIN detalle_equipo ON detalle_equipo.serie = actividades.serie_equipo 
				JOIN seguimiento_actividades ON seguimiento_actividades.id_mant = actividades.id_mant
				JOIN c_ttrabajo ON c_ttrabajo.id = seguimiento_actividades.tipo_trabajo
				JOIN estado_bien ON estado_bien.id = seguimiento_actividades.cod_estab
				WHERE detalle_equipo.cliente = '".$_POST['cliente']."' ".$condicion;
	$query = mysqli_query($conex, $consulta); 
	$cuerpo_tabla="";
	//echo $consulta;
	while($rows = mysqli_fetch_array($query)){
		//Generar tabla
		$cuerpo_tabla .= "
		<tr>
			<td>".$rows['id_mant']."-".$rows['id_r']."</td>
			<td>".$rows['fecha']."</td>
			<td>".$rows['observacion']."</td>
			<td>".$rows['p_entrega']."</td>
			<td>".$rows['estado_bien']."</td>
			<td><a href='adm_actividades.php?id_mant=".$rows['id_mant']."&id_r=".$rows['id_r']."' class='form form-control btn btn-block btn-info' target='_Blank'>Detalles</a></td>	
		</tr>";
	}
	?> 
	<div id="treporte3">
	<table class="table">
			<thead>
				<tr>
					<th>Actividad</th>
					<th>Fecha</th>
					<th>Observacion</th>
					<th>Entrego</th>
					<th>Estado</th>
					<th></th>
					
				</tr>
			</thead>
			<tbody>
				<?=  $cuerpo_tabla; ?>
			</tbody>
		</table> 
	</div>
	<a href="#" onclick="genpdf('treporte3',3);" class="btn btn-block btn-info">Generar PDF</a>
	<?php  
}
 ?>




 <?php 
 //reporte estado actividades
if ($_POST['acc']=="reesbi") {
	require_once('../include/conexion.php');	

	if ($_POST['v_fecha']=='Y') {
		if ($_POST['fecha_i'] == NULL OR $_POST['fecha_f'] == NULL ) {
		echo "<center><h1>¡Debes completar los parametros de fecha!</h1></center>";
	}
		
		$condicion = " AND (seg.fecha BETWEEN '".$_POST['fecha_i']."'  AND '".$_POST['fecha_f']."') ";

	}else{
		$condicion="";
	}
	$consulta = "
				SELECT
				seg.id_mant,
				seg.id_r,
				seg.fecha,
				f_equipo.descripcion as falla,
				c_ttrabajo.descripcion as t_trabajo,
				seg.observacion
				FROM seguimiento_actividades as seg
				JOIN f_equipo ON f_equipo.id = seg.cod_falla
				JOIN c_ttrabajo ON c_ttrabajo.id = seg.tipo_trabajo
				 WHERE seg.cod_estab = '".$_POST['estado']."' ".$condicion;
	$query = mysqli_query($conex, $consulta); 
	$cuerpo_tabla="";
	//	echo $consulta;
	while($rows = mysqli_fetch_array($query)){
		//Generar tabla
		$cuerpo_tabla .= "
		<tr>
			<td>".$rows['id_mant']."-".$rows['id_r']."</td>
			<td>".$rows['fecha']."</td>
			<td>".$rows['falla']."</td>
			<td>".$rows['t_trabajo']."</td>
			<td>".$rows['observacion']."</td>
			<td><a href='adm_actividades.php?id_mant=".$rows['id_mant']."&id_r=".$rows['id_r']."' class='form form-control btn btn-block btn-info' target='_Blank'>Detalles</a></td>	
		</tr>";
		
		
	}
	?> 
	<div id="treporte4">
	<table class="table">
			<thead>
				<tr>
					<th>Actividad</th>
					<th>Fecha</th>
					<th>Falla</th>
					<th>Tipo de Trabajo</th>	
					<th>Observacion</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?=  $cuerpo_tabla; ?>
			</tbody>
		</table> 
	</div>
	<a href="#" onclick="genpdf('treporte4',4);" class="btn btn-block btn-info">Generar PDF</a>
	<?php  
}
 ?>

