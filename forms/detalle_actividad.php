<?php
    require_once("../template/head.php");
    require_once("../template/menu.php");
    require_once("../include/conexion.php");
    //Preparacion de la consulta de visualizacion
    $id_mant=$_GET['id_mant'];
    $id_r=$_GET['id_r'];
    $tecnico = $_GET['tecnico'];

   $consulta = "SELECT
    tl.id_mant,
    tl.id_r,
    tl.fecha as fecha_solicitud,
    asig_act_tecnicos.fec_t as fecha_tecnico,
    asig_act_tecnicos.fec_a as fecha_aceptacion,
    asig_act_tecnicos.fec_f as fecha_finalizacion,
    asig_act_tecnicos.procedimiento as procedimiento_tecnico,
    asig_act_tecnicos.horas_tecnico,
    asig_act_tecnicos.recomendaciones as recomendaciones,
    asig_act_tecnicos.ref_administracion,
    asig_act_tecnicos.fin_tec as bandera_fin,
    asig_act_tecnicos.id_usuario as tecnico_asig,
    f_equipo.descripcion as falla_presentada,
    c_eclientes.dui as dui_contacto,
    CONCAT(c_eclientes.nombre,' ',c_eclientes.apellido) as nombre_contacto,
    c_eclientes.numero_telefonico as numero_contacto,
    c_eclientes.email as email_contacto,
    c_empresas.nombre  as empresa_nombre,
    tl.observacion as obs_entrada,
    t_equipo.descripcion as t_equipo,
    c_marcas.descripcion as marca,
    estado_bien.descripcion as estado_bien,
    detalle_equipo.cod_marca,
    tl.tipo_actividad,
    c_ttrabajo.descripcion as t_trabajo,
    c_actividades.descripcion  as act_preliminar,
    actividades.serie_equipo as serie_equipo,
    c_modelos.descripcion  as modelo,
    asig_act_tecnicos.cod_estab

     FROM seguimiento_actividades as tl
    JOIN actividades ON actividades.id_mant = tl.id_mant
    JOIN asig_act_tecnicos  ON asig_act_tecnicos.id_mant = tl.id_mant AND asig_act_tecnicos.id_r = tl.id_r
    JOIN detalle_equipo ON detalle_equipo.serie = actividades.serie_equipo
    JOIN t_equipo ON t_equipo.id = detalle_equipo.cod_tequ
    JOIN c_marcas ON c_marcas.id = detalle_equipo.cod_marca
    JOIN c_eclientes ON c_eclientes.dui = tl.p_entrega
    JOIN c_empresas ON c_empresas.id = detalle_equipo.cliente
    JOIN estado_bien ON estado_bien.id = tl.cod_estab
    JOIN f_equipo ON f_equipo.id =tl.cod_falla 
    JOIN c_actividades  ON c_actividades.id = tl.act_preliminar
    JOIN c_ttrabajo ON c_ttrabajo.id = tl.tipo_trabajo
    JOIN c_modelos ON c_modelos.id = detalle_equipo.modelo
    WHERE asig_act_tecnicos.id_mant ='$id_mant' AND asig_act_tecnicos.id_r ='$id_r' 
    AND asig_act_tecnicos.id_usuario= '$tecnico'";

    
    
    $query = mysqli_query($conex, $consulta); 
    if($rows = mysqli_fetch_array($query)){
      $id_mant = $rows['id_mant'];
      $id_r  = $rows['id_r'];
      $fecha_solicitud  = $rows['fecha_solicitud'];
      $fecha_asig_tecnico  = $rows['fecha_tecnico'];
      $fecha_acep_tecnico = $rows['fecha_aceptacion'];
      $fecha_fin_tecnico  = $rows['fecha_finalizacion'];
      $procedimiento_tecnico  = $rows['procedimiento_tecnico'];
      $horas_tecnico  = $rows['horas_tecnico'];
      $recomendaciones = $rows['recomendaciones'];
      $ref_administracion = $rows['ref_administracion'];
      $bandera_fin_tecnico  = $rows['bandera_fin'];
      $tecnico_asig  = $rows['tecnico_asig'];
      $falla_presentada  = $rows['falla_presentada'];
      $serie_equipo = $rows['serie_equipo'];
      $dui_contacto = $rows['dui_contacto'];
      $nombre_contacto = $rows['nombre_contacto'];
      $numero_contacto = $rows['numero_contacto'];
      $email_contacto = $rows['email_contacto'];
      $empresa_nombre = $rows['empresa_nombre'];
      $obs_entrada = $rows['obs_entrada'];
      $t_equipo = $rows['t_equipo'];
      $marca = $rows['marca'];
      $modelo = $rows['modelo'];
      $estado_bien = $rows['estado_bien'];
      $tipo_actividad = $rows['tipo_actividad'];
      $t_trabajo = $rows['t_trabajo'];
      $act_preliminar = $rows['act_preliminar'];
      $cod_estab = $rows['cod_estab'];

      echo "<input type='hidden' id='id_mant_h' = value='".$id_mant."'>";
      echo "<input type='hidden' id='id_r_h' = value='".$id_r."'>";
      echo "<input type='hidden' id='tecnico_h' = value='".$tecnico_asig."'>";
    } 

    //Validacion de "en espera", a "Asignado"
    if ($cod_estab == 2 && $tecnico_asig==$_SESSION['email']) {
      $estado = $conex->prepare("UPDATE seguimiento_actividades SET cod_estab = 3 WHERE id_mant = ? AND id_r =?");
      $estado->bind_param('ii',$id_mant,$id_r);

      $estado->execute();
      $estado->close();
      //Actualizando datos en asig_act_tecnicos
      $estado = $conex->prepare("UPDATE asig_act_tecnicos SET fec_a = CURRENT_TIMESTAMP WHERE id_mant = ? AND id_r =? AND id_usuario=?");
      $estado->bind_param('iis',$id_mant,$id_r,$tecnico_asig);

      $estado->execute();
      $estado->close(); 
      $cod_estab = 3;
      $estado_bien ="Asignado";
    }
?>
   <?php if(true){ ?>

<!-- Contenido -->
                                <div class="card">
                                    <div class="card-header">
                                        <h4> <span class=""></span> Detalles </h4>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title"></h5>
                                        <p class="card-text">
                                          <div class="row">
                                            <div class="col-lg-10">

                                            </div>
                                            <div class="col-lg-2">
                                              
                                            </div>
                                          </div>
                                        </p>
<!---->
<form>
  <!--Antes de empezar-->
<div class="row">
  <div class="col-lg-3">
    <h4><h1> Actividad 1-1</h1></h4>  <br>
  </div>
  <div class="col-lg-9">
    <div class="row">
      <div class="col">
        <div class="alert alert-info block" ><center> <h2>ESTADO : <?= $estado_bien; ?></h2></center></div>  
      </div>
      
    </div>
    <div class="row">
      <div class="col">Fecha de Solicitud : </div>
      <div class="col"><?= $fecha_solicitud; ?></div>
    </div>
    <div class="row">
      <div class="col">Fecha Asignacion : </div>
      <div class="col"><?= $fecha_asig_tecnico; ?></div>
    </div>
    <div class="row">
      <div class="col">Fecha de Aceptacion : </div>
      <div class="col"><?= $fecha_acep_tecnico; ?></div>
    </div>
    <div class="row">
      <div class="col">Tecnico Asignado : </div>
      <div class="col"><?= $tecnico; ?></div>
    </div>
  </div>
</div>
<br><br><br>

<div class="row">

  <div class="col-lg-6">
    <div id="formequipo" class="alert alert-info">
      <input type="hidden" name="numero_serie" id="numero_serie" value="<?= $rows['serie']; ?>">
      <div class="row">
        <div class="col"><label>Numero de Serie</label></div>
        <div class="col"><label><?= $serie_equipo; ?></label></div>
      </div>
      <br>
      <div class="row">
        <div class="col"><label>Marca</label></div>
        <div class="col">
          <label><?= $marca;  ?></label>
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col"><label>Modelo</label></div>
        <div class="col">
          <label><?= $modelo;  ?></label>
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col"><label>Tipo de Equipo</label></div>
        <div class="col" >
          <label><?= $t_equipo;  ?></label>
        </div>
      </div>
      <br>
    </div>  
  </div>
  <div class="col-lg-6">
    <div id="formcliente" class="alert alert-info">
                  <div class="row">
                    <div class="col"><label>DUI</label></div>
                    <div class="col"><label><?= $dui_contacto; ?></label></div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col"><label>Nombre</label></div>
                    <div class="col">
                      <label><?= $nombre_contacto; ?></label>
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col"><label>Telefono</label></div>
                    <div class="col" >
                      <label><?= $numero_contacto; ?></label>
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col"><label>Correo Electronico</label></div>
                    <div class="col" >
                      <label><?= $email_contacto;?></label>
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col"><label>Empresa</label></div>
                    <div class="col">
                      <div class="row">
                        <div class="col">
                          <label><?= $empresa_nombre;?></label>
                        </div>
                      </div>
                    </div>
                  </div>
                      <br>
    </div>
  </div>
</div>
<hr>
<div class="row">
  <div class="col">
   <!--Observacion-->
  <div class="row">
    <div class="col">
      <div class="row">
        <div class="col-lg-3">
          <h5>Observacion</h5>
        </div>
        <div class="col-lg-9">
          <div class="jumbotron">
            <p><?= $obs_entrada; ?></p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <br>
  <div class="row">
    <div class="col-lg">
      <label><strong>Falla Presentada : </strong> <?= $falla_presentada; ?> </label>
    </div>
    <div class="col-lg">
      <label><strong>Actividad Preliminar : </strong> <?= $act_preliminar; ?> </label>
    </div>
    <div class="col-lg">
      <label><strong>Tipo de Trabajo : </strong><?= $t_trabajo; ?></label>
    </div>
  </div>

  </div>
</div>
</form>
<!---->

<?php if ($cod_estab=='3' && $_SESSION['email']==$tecnico_asig ){
  //boton para proceder de asignado > En proceso,
?>
    <div class="card-footer">
        <a href="#" class="btn btn-block btn-danger" onclick="iniciar_actividad();" >Iniciar Actividad</a>
    </div>
<?php  //Se cambia el estado, se actualizan las fechas correspondientes, y se muestra el formulario correspondiente a los atributos de la actividad  
}else{  ?>
  <hr>
  <h3>Formulario:</h3>
  <hr>
  <div class="row">
    <div class="col-lg-9">
       <div class="row">
        <div class="col">
          <div class="col"><label for="">Procedimiento Realizado:</label><textarea class="form form-control" id="procedimiento" rows="5"><?= $procedimiento_tecnico; ?></textarea></div>
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col">
          <div class="col"><label for="">Recomendaciones: </label><textarea class="form form-control" id="recomendaciones" rows="5"><?= @$recomendaciones; ?></textarea></div>
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col">
          <div class="col"><label for="">Horas Invertidas </label><input type="number" id="horas_invertidas" class="form form-control" min ="1"value="<?= @$horas_tecnico; ?>"></div>
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col">
          <div class="col"><label for="">Numero de Factura o Documento </label><input type="text" id="ref_administracion" class="form form-control"  value="<?= $ref_administracion; ?>" name=""></div>
        </div>
      </div>
    </div>


    <div class="col-lg-3">
      <br>
      <?php if ($_SESSION['email']==$tecnico_asig): ?>
       
        
        <?php if ($cod_estab==4): ?>
          
       <div class="jumbotron">
      <center><div id="respuesta"></div></center>
        <div class="row">
          <div class="col">
            <a  onclick="guardar_cambios();" class="btn btn-block btn-info">Guardar Cambios</a>
          </div>
        </div>
        <br><hr><br>  
          <div class="row">
          <div class="col">
            <a  class="btn btn-block btn-warning" onclick="finalizar_actividad_tecnico();">Finalizar Actividad</a>
          </div>
        </div> 
       </div>
        <?php endif ?>
        
     
      <?php endif ?>
    </div>
  </div>
  
 

  <?php } ?>



                                    </div>
                                </div>

<div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="modalconfirmacion" id='modalconfirmacion' aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="alert alert-success" >
       <center>¡Actividad Ingresada con Exito!</center> 
       <br>
       <a href="../forms/dashboard.php" class="btn btn-primary btn-block">>></a>
      </div>
    </div>
  </div>
</div>


<!--Contenido-->
    <?php
    } ?>
<?php  require_once("../template/footer.php"); ?>


<script type="text/javascript">
  $(document).ready(function(){
      $("#minicio").addClass("active");
  });

  //Llena el formulario de datos del equipo
  function iniciar_actividad(){
    var id_mant = $('#id_mant_h').val();
    var id_r =  $('#id_r_h').val();
    var tecnico = $('#tecnico_h').val();
    $.ajax({    
    url : '../operaciones/actividades_operaciones.php', 
    data : {'acc':'iniciar_actividad','id_mant':id_mant,'id_r':id_r,'tecnico':tecnico},   
    type : 'POST',
    success : function(data) 
    {
      location.reload();
    }
    });
  }

function guardar_cambios(){

  var id_mant = $('#id_mant_h').val();
  var id_r =  $('#id_r_h').val();
  var tecnico = $('#tecnico_h').val();
  var procedimiento = $('#procedimiento').val();
  var recomendaciones= $('#recomendaciones').val();
  var horas_invertidas =$('#horas_invertidas').val();
  var ref_administracion = $('#ref_administracion').val();

  $.ajax({    
    url : '../operaciones/actividades_operaciones.php', 
    data : {'acc':'guardar_actividad','id_mant':id_mant,'id_r':id_r,'tecnico':tecnico,'procedimiento':procedimiento,'recomendaciones':recomendaciones,'horas_invertidas':horas_invertidas,'ref_administracion':ref_administracion},   
    type : 'POST',
    success : function(data) 
    {
      if (data==1) {
        document.getElementById('respuesta').innerHTML = "<strong><h3>¡Cambios Guardados!</h3></strong>";
      }
    }

});
}


function finalizar_actividad_tecnico(){
 var id_mant = $('#id_mant_h').val();
  var id_r =  $('#id_r_h').val();
  var tecnico = $('#tecnico_h').val();
  var procedimiento = $('#procedimiento').val();
  var recomendaciones= $('#recomendaciones').val();
  var horas_invertidas =$('#horas_invertidas').val();
  var ref_administracion = $('#ref_administracion').val();

  if (id_mant!="" && id_r!="" && tecnico!="" &&procedimiento!=""&&recomendaciones!=""&&horas_invertidas>0 &&ref_administracion!="") {
  $.ajax({    
    url : '../operaciones/actividades_operaciones.php', 
    data : {'acc':'finalizar_actividad_tecnico','id_mant':id_mant,'id_r':id_r,'tecnico':tecnico,'procedimiento':procedimiento,'recomendaciones':recomendaciones,'horas_invertidas':horas_invertidas,'ref_administracion':ref_administracion},   
    type : 'POST',
    success : function(data) 
    {
      if (data==1) {
        document.getElementById('respuesta').innerHTML = "<strong><h3>¡Cambios Guardados!</h3></strong>";
      }
    }
  }); 
  }else{
    alert("Debes completar todos los campos");
  }

  

}

</script>