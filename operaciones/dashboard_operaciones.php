<?php 
//
session_name('ANS');
session_start();
/*
Ambos pueden ver los datlles
si es tecnico vera solo las activiodades que el tenga asignadas

Si es adm, vera todas las actividades
*/
if ($_POST['acc']=='tabla_dash') {
	//Contruimos las condiciones
	//incluye estado. y fechas
	$valfecha = "";
	$valestado ="";
	$condicion ="";
	
	
	//incluye no estado (cuando se pone en general)



	if ($_SESSION['acceso']=="TECNICO") {
		//CONTRUIMOS CONSULTA
		if ($_POST['v_fecha']=='Y')  {
			$valfecha = " AND (tl.fecha BETWEEN '".$_POST['fecha_i']."' AND '".$_POST['fecha_f']."' ) AND ";
		}else{$valfecha = " AND"; }
		if ($_POST['estado']==100) {
			$valestado =" 1=1  ";
		}else{
			$valestado = " tl.cod_estab = ".$_POST['estado'];
		}
		$condicion = $valfecha.$valestado." ORDER BY tl.fecha ";
		$consulta ="SELECT
			tl.id_mant,
			tl.id_r,
			tl.fecha,
			tl.cod_estab,
			t_equipo.descripcion as t_equipo,
			c_marcas.descripcion as marca,
			estado_bien.descripcion as estado,
			c_empresas.nombre as cliente,
			asig_act_tecnicos.id_usuario as tecnico
			FROM seguimiento_actividades as tl
			JOIN actividades ON actividades.id_mant = tl.id_mant
			JOIN detalle_equipo ON detalle_equipo.serie = actividades.serie_equipo
			JOIN t_equipo ON t_equipo.id = detalle_equipo.cod_tequ
			JOIN c_marcas ON c_marcas.id = detalle_equipo.cod_marca
			JOIN c_empresas ON c_empresas.id = detalle_equipo.cliente
			JOIN estado_bien ON estado_bien.id = tl.cod_estab 
			JOIN 	asig_act_tecnicos ON asig_act_tecnicos.id_mant = tl.id_mant AND asig_act_tecnicos.id_r = tl.id_r 
			WHERE asig_act_tecnicos.id_usuario = '".$_SESSION['email']."'  ".$condicion;
	}

	if ($_SESSION['acceso']=="ADMINISTRADOR") {	
		//CONTRUIMOS CONSULTA
		if ($_POST['v_fecha']=='Y')  {
			$valfecha = " WHERE (tl.fecha BETWEEN '".$_POST['fecha_i']."' AND '".$_POST['fecha_f']."' ) AND ";
		}else{$valfecha = " WHERE"; }
		if ($_POST['estado']==100) {
			$valestado =" 1=1  ";
		}else{
			$valestado = " tl.cod_estab = ".$_POST['estado'];
		}
		$condicion = $valfecha.$valestado." ORDER BY tl.fecha ";
		$consulta ="SELECT
			tl.id_mant,
			tl.id_r,
			tl.fecha,
			tl.cod_estab,
			t_equipo.descripcion as t_equipo,
			c_marcas.descripcion as marca,
			estado_bien.descripcion as estado,
			c_empresas.nombre as cliente
			FROM seguimiento_actividades as tl
			JOIN actividades ON actividades.id_mant = tl.id_mant
			JOIN detalle_equipo ON detalle_equipo.serie = actividades.serie_equipo
			JOIN t_equipo ON t_equipo.id = detalle_equipo.cod_tequ
			JOIN c_marcas ON c_marcas.id = detalle_equipo.cod_marca
			JOIN c_empresas ON c_empresas.id = detalle_equipo.cliente
			JOIN estado_bien ON estado_bien.id = tl.cod_estab ".$condicion;
	}
	

	?>
											<table class="table">	
                                              <thead>
                                                <tr>
                                                  <th scope="col"><center>ID</center></th>
                                                  <th scope="col"><center>Equipo</center></th>
                                                  <th scope="col"><center>F Solicitud</center></th>
                                                  <th scope="col"><center>Cliente</center></th>
                                                  <th scope="col"><center>Estado</center></th>
                                                  <th scope="col"></th>
                                                </tr>
                                              </thead>
                                              <tbody>
<?php 
require_once("../include/conexion.php");
$query = mysqli_query($conex, $consulta); 
while($rows = mysqli_fetch_array($query)){ 	
	//Definiendo colores
	switch ($rows['cod_estab']) {
		case '1': 	//Pendiente
			$gravedad = "danger";
			break;
		case '2': 	//Asignado
			$gravedad = "info";
			break;
		case '3': 	//reprogramar
			$gravedad = "default";
			break;
		case '4': 	//En espera
			$gravedad = "warning";
			break;
		case '5': 	//En Proceso
			$gravedad = "info";
			break;
		case '6': 	//finalizado
			$gravedad = "primary";
			break;
		case '7': 	//emsamblaje
			$gravedad = "default";
			break;
		case '8': 	//listo
			$gravedad = "success";
			break;
		default:
		$gravedad="";
		break;
	}
?>
                                                <tr class="table-<?= $gravedad;  ?>">
                                                  <th scope="row"><center>
                                                  	<?= $rows['id_mant']."-".$rows['id_r'] ?>
                                                  	</center></th>
                                                  <td><center><?= $rows['t_equipo']." ".$rows['marca']; ?></center></td>
                                                  <td><center><?= $rows['fecha']; ?></center></td>
                                                  <td><center><?= $rows['cliente']; ?></center></td>
                                                  <td><center><?= $rows['estado']; ?></center></td>
                                                  <td>
                                                  	<?php if ($_SESSION['acceso']=="ADMINISTRADOR"){ ?>
                                                  		<a class="btn btn-success btn-block" href="../forms/adm_actividades.php?id_mant=<?= $rows['id_mant']."&id_r=".$rows['id_r']; ?>"><span class="fa fa-search">Administrar</span>
                                                  	<?php } ?>
                                                  	<?php if ($_SESSION['acceso']=="TECNICO"){ ?>
														<a class="btn btn-success btn-block" href="../forms/detalle_actividad.php?id_mant=<?= $rows['id_mant']."&id_r=".$rows['id_r']."&tecnico=".$rows['tecnico']; ?>"><span class="fa fa-search">Detalles</span>                                                  		
                                                  	<?php } ?>
                                                      
                                                  </td>
                                                </tr>
	<?php } ?>
                                              </tbody>
                                            </table>
<?php } ?>


<?php if ($_POST['acc']=="detalles_dash"){ 

@require_once("../include/conexion.php");

if ($_SESSION['acceso']=="ADMINISTRADOR") {
	
}

$consulta =" SELECT
tl.id_mant,
tl.id_r,
tl.fecha,
actividades.serie_equipo,
f_equipo.descripcion as falla_presentada,
c_eclientes.dui as dui_contacto,
CONCAT(c_eclientes.nombre,' ',c_eclientes.apellido) as nombre_contacto,
c_eclientes.numero_telefonico as numero_contacto,
c_eclientes.email as email_contacto,
tl.observacion as obs_entrada,
t_equipo.descripcion as t_equipo,
c_marcas.descripcion as marca,
tl.cod_estab as estado_c,
estado_bien.descripcion as estado,
c_empresas.nombre as cliente,
detalle_equipo.cod_marca,
DATEDIFF(CURRENT_TIMESTAMP, tl.fecha ) as dias_di
 FROM seguimiento_actividades as tl
JOIN actividades ON actividades.id_mant = tl.id_mant
JOIN detalle_equipo ON detalle_equipo.serie = actividades.serie_equipo
JOIN t_equipo ON t_equipo.id = detalle_equipo.cod_tequ
JOIN c_marcas ON c_marcas.id = detalle_equipo.cod_marca
JOIN c_eclientes ON c_eclientes.dui = tl.p_entrega
JOIN c_empresas ON c_empresas.id = detalle_equipo.cliente
JOIN estado_bien ON estado_bien.id = tl.cod_estab
JOIN f_equipo ON f_equipo.id =tl.cod_falla 
JOIN c_actividades  ON c_actividades.id = tl.act_preliminar
JOIN c_ttrabajo ON c_ttrabajo.id = tl.tipo_trabajo 
WHERE tl.id_mant = '".$_POST['id_mant']."' AND tl.id_r = '".$_POST['id_r']."'";


	        $query = mysqli_query($conex, $consulta); 
	        while($rows = mysqli_fetch_array($query)){ 	
?>
<div class="container">
	<h4>Identificador de Actividad : <strong> <?= $rows['id_mant']."-".$rows['id_r']; ?></strong></h4><br>
	<div class="row">
		<div class="col-sm-4"><label><h5>Detalles del equipo</h5></label><hr></div>
		<div class="col-sm-8">
			<div class="row">
				<div class="col"><strong>Numero de Serie</strong></div>
				<div class="col"><?= $rows['serie_equipo']; ?></div>
			</div>	
			<div class="row">
				<div class="col"><strong>Marca</strong></div>
				<div class="col"><?= $rows['marca'] ?></div>
			</div>	
		</div>
	</div>
	<div class="row">
		<div class="col-sm-4"><label><h5>Detalles del Cliente</h5></label></div>
		<div class="col-sm-8">
			<div class="row">
				<div class="col"><strong>Empresa </strong></div>
				<div class="col"><?= $rows['cliente']; ?></div>
			</div>	
			<div class="row">
				<div class="col"><strong>Entrego  </strong></div>
				<div class="col"><?= $rows['nombre_contacto'] ?></div>
			</div>	
			<div class="row">
				<div class="col"><strong>Numero de Contacto </strong></div>
				<div class="col"><?= $rows['numero_contacto'] ?></div>
			</div>	
			<div class="row">
				<div class="col"><strong>Correo Electronico </strong></div>
				<div class="col"><?= $rows['email_contacto'] ?></div>
			</div>	
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-sm-4"><label><h5></h5></label></div>
		<div class="col-sm-8">
			<div class="row">
				<div class="col"><strong>Observacion inicial</strong></div>
				<div class="col"><?= $rows['obs_entrada']; ?></div>
			</div>	
			<div class="row">
				<div class="col"><strong>Falla presentada</strong></div>
				<div class="col"><?= $rows['falla_presentada'] ?></div>
			</div>	
		</div>
	</div>
	<br>
	<div class="alert alert-info">
		<center><h3>Dias desde el inicio del proceso : <?= $rows['dias_di']; ?> </h3></center><br>
		<center><h3>Estado : <?= $rows['estado']; ?></h3></center>
	</div>
	<!---->
	<div class="row">
		<?php if ($_SESSION['acceso']=="ADMINISTRADOR"): ?>
			<!--<div class="col"><a href="detalle_actividad.php" class="btn btn-block btn-success" >Asignar a Tecnico</a></div>-->
		<?php endif ?>
		<?php if ($_SESSION['acceso']=="TECNICO"){
			if ($rows['estado_c']==2) {
				//En espera, al entrar a los detalles inicia el proceso, pasa a asignado
				//Si esta en 2, se que tiene un tecnico asignado, hago consulta para sacar el valor
				?> 
				

				<div class="col"><a onclick="aceptar_actividad(<?= $rows['id_mant'].",".$rows['id_r'].",".@$rows['']; ?>);" class="btn btn-block btn-success" >Aceptar Actividad AUN NO SIRVE</a></div>
				<?php
			}
			if ($rows['estado_c']==3) {
				//Asignado, Al entrar sigue en asignado
				?> 
				<div class="col">
					
					<a href="detalle_actividad();" class="btn btn-block btn-success" >Detalles Actividad</a>
				</div>
				<?php
			}
		 ?>
		<?php } ?>		

	</div>
</div>
	
<?php }
} ?>




<?php if ($_POST['acc']=='encontrarequipo'){ 
@include("../include/conexion.php");
		$consulta = "
		SELECT
		detalle_equipo.serie,
		c_marcas.descripcion as marca,
		c_modelos.descripcion as modelo,
		t_equipo.descripcion as tequ
		FROM detalle_equipo 
		JOIN c_marcas ON c_marcas.id = detalle_equipo.cod_marca
		JOIN c_modelos ON c_modelos.id = detalle_equipo.modelo
		JOIN t_equipo ON t_equipo.id = detalle_equipo.cod_tequ
		WHERE serie = '".$_POST['nserie']."'";
		$query = mysqli_query($conex, $consulta); 
		$retorno = "";
		if (mysqli_num_rows($query)==1) {
			if($rows = mysqli_fetch_array($query))
			{
				//Se contruye el formulario con los datos obtenidos de la consulta ?>
				<input type="hidden" name="numero_serie" id="numero_serie" value="<?= $rows['serie']; ?>">
				<div class="row">
                    <div class="col"><label>Numero de Serie</label></div>
                    <div class="col"><label><?= $rows['serie']; ?></label></div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col"><label>Marca</label></div>
                    <div class="col">
                    	<label><?= $rows['marca']; ?></label>
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col"><label>Modelo</label></div>
                    <div class="col">
                      <label><?= $rows['modelo']; ?></label>
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col"><label>Tipo de Equipo</label></div>
                    <div class="col" >
                      <label><?= $rows['tequ']; ?></label>
                    </div>
                  </div>
                  <br>
<?php
	        }
	        }else{ ?>
				<div class="alert alert-danger">
				<center><h3>Equipo no encontrado<br>
					<h5>Si no lo has registrado, completa el formulario siguiente para registrarlo:</h5>
				</div>
				 <label><strong>Ingresar Equipo</strong></label>
              <br>
                  <div class="row">
                    <div class="col"><label>Numero de Serie</label></div>
                    <div class="col"><input type="text" class="form-control" id="nserie_n"></div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col"><label>Marca</label></div>
                    <div class="col">
                    	<select class="form-control" id="marca_n">
						<?php 
							@include("include/conexion.php");
							$consulta = "SELECT * FROM c_marcas";
							$query = mysqli_query($conex, $consulta); 
							$retorno = "";
							while($rows = mysqli_fetch_array($query))
							{
							echo "<option value=".$rows['id'].">".$rows['descripcion']."</option>";
							}
						 ?>
                      </select>

                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col"><label>Modelo</label></div>
                    <div class="col">
                      <select class="form-control" id="modelo_n">
						<?php 
							@include("include/conexion.php");
							$consulta = "SELECT * FROM c_modelos";
							$query = mysqli_query($conex, $consulta); 
							$retorno = "";
							while($rows = mysqli_fetch_array($query))
							{
							echo "<option value=".$rows['id'].">".$rows['descripcion']."</option>";
							}
						 ?>
                      </select>
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col"><label>Tipo de Equipo</label></div>
                    <div class="col" >
                      <select class="form-control" id="t_equipo_n">
						<?php 
							@include("include/conexion.php");
							$consulta = "SELECT * FROM t_equipo";
							$query = mysqli_query($conex, $consulta); 
							$retorno = "";
							while($rows = mysqli_fetch_array($query))
							{
							echo "<option value=".$rows['id'].">".$rows['descripcion']."</option>";
							}
						 ?>
                      </select>
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col"><label>Empresa</label></div>
                    <div class="col" >
                      <select class="form-control" id="empresa_n">
						<?php 
							@include("include/conexion.php");
							$consulta = "SELECT * FROM c_empresas";
							$query = mysqli_query($conex, $consulta); 
							$retorno = "";
							while($rows = mysqli_fetch_array($query))
							{
							echo "<option value=".$rows['id'].">".$rows['nombre']."</option>";
							}
						 ?>
                      </select>
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col">
                      <center><a onclick="ingresar_equipo();" class="btn btn-success">Registrar</a></center>
                    </div>
                  </div>  
<?php
	}
		
    mysqli_close($conex);	
?>
	                
<?php } ?>









<?php if ($_POST['acc']=="ingresar_equipo") {
	@include("../include/conexion.php");
	$consulta = "
	SELECT
	*
	FROM detalle_equipo 
	WHERE serie = '".$_POST['nserie']."'";
	$query = mysqli_query($conex, $consulta); 
	$retorno = "";
	if (mysqli_num_rows($query)==0) {
		//Al no encontrarse el equipo, lo ingreso:
		$nserie = $_REQUEST['nserie'];
		$cod_marca = $_REQUEST['marca'];
		$modelo = $_REQUEST['modelo'];
		$cliente = $_REQUEST['cliente'];
		$cod_tequ = $_REQUEST['t_equipo'];

		$estado = $conex->prepare("INSERT INTO detalle_equipo (serie,cod_marca,modelo,cliente,cod_tequ) VALUES (?,?,?,?,?)");
		$estado->bind_param('siiii',$nserie,$cod_marca,$modelo,$cliente,$cod_tequ);

		$estado->execute();
		$estado->close();
		if ($estado) {
		echo $nserie;
		}else{
		}

	}else{
		//El equipo si se encontro, notificar que ya esta registrado
		
		
	}
} ?>

<?php 
if ($_POST['acc']=="val_actividad"){
@include("../include/conexion.php");
$consulta = "
SELECT
*
FROM actividades 
WHERE id_mant = '".$_POST['id']."' AND serie_equipo = '".$_POST['serie']."'";
$query = mysqli_query($conex, $consulta); 
$retorno = "";
if (mysqli_num_rows($query)==1) {
	//Si encuentra, la solicitud procede
	echo "1";
 }else{
 	echo "0";
 }
}
  ?>