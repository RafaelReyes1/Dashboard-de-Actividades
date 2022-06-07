<?php
    require_once("../template/head.php");
    require_once("../template/menu.php");
    require_once("../include/conexion.php");
    //Preparacion de la consulta de visualizacion
    $id_mant=$_GET['id_mant'];
    $id_r=$_GET['id_r'];

   $consulta = "SELECT
    tl.id_mant,
    tl.id_r,
    tl.fecha as fecha_solicitud,
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
    tl.cod_estab
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
    JOIN c_modelos ON c_modelos.id = detalle_equipo.modelo
    WHERE tl.id_mant ='$id_mant' AND tl.id_r ='$id_r'";

    
    
    $query = mysqli_query($conex, $consulta); 
    if($rows = mysqli_fetch_array($query)){
      $id_mant = $rows['id_mant'];
      $id_r  = $rows['id_r'];
      $fecha_solicitud  = $rows['fecha_solicitud'];
      
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

/*
      $procedimiento_tecnico  = $rows['procedimiento_tecnico'];
      $horas_tecnico  = $rows['horas_tecnico'];
      $recomendaciones = $rows['recomendaciones'];
      $ref_administracion = $rows['ref_administracion'];
      $bandera_fin_tecnico  = $rows['bandera_fin'];
      $tecnico_asig  = $rows['tecnico_asig'];
      $fecha_asig_tecnico  = $rows['fecha_tecnico'];
      $fecha_acep_tecnico = $rows['fecha_aceptacion'];
      $fecha_fin_tecnico  = $rows['fecha_finalizacion'];
*/

      echo "<input type='hidden' id='id_mant_h' = value='".$id_mant."'>";
      echo "<input type='hidden' id='id_r_h' = value='".$id_r."'>";
    } 
?>
   <?php if($_SESSION['acceso']=="ADMINISTRADOR"){ ?>

<!-- Contenido -->
                                <div class="card">
                                    <div class="card-header">
                                        <h4> <span class=""></span> Detalles </h4>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title"></h5>
                                        <p class="card-text">
                                        </p>
                                        <!---->
                                        <form>
                                          <!--Antes de empezar-->
                                        <div class="row">
                                          <div class="col-lg-12">
                                            <div class="row">
                                              <div class="col">
                                                <div class="alert alert-info block" >
                                                  <div class="row">
                                                    <div class="col"><h1> Actividad 1-1</h1></div>
                                                    <div class="col">
                                                      <h2>ESTADO : <?= $estado_bien; ?></h2>
                                                      <div class="row">
                                                        <div class="col">Fecha de Solicitud : </div>
                                                        <div class="col"><?= $fecha_solicitud; ?></div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>  
                                              </div>
                                              
                                            </div>
                                          </div>
                                        </div>
                                        <br>

                                        <div class="row">
                                          <div class="col-lg-6">
                                            <div id="formequipo" class="alert alert-default">
                                                <h5>Datos del Equipo</h5>
                                              <hr>
                                              <input type="hidden" name="numero_serie" id="numero_serie" value="<?= $rows['serie']; ?>">
                                              <div class="row">
                                                <div class="col"><label>Numero de Serie</label></div>
                                                <div class="col"><label><?= $serie_equipo; ?></label></div>
                                              </div>
                                              
                                              <div class="row">
                                                <div class="col"><label>Marca</label></div>
                                                <div class="col">
                                                  <label><?= $marca;  ?></label>
                                                </div>
                                              </div>
                                              
                                              <div class="row">
                                                <div class="col"><label>Modelo</label></div>
                                                <div class="col">
                                                  <label><?= $modelo;  ?></label>
                                                </div>
                                              </div>
                                              
                                              <div class="row">
                                                <div class="col"><label>Tipo de Equipo</label></div>
                                                <div class="col" >
                                                  <label><?= $t_equipo;  ?></label>
                                                </div>
                                              </div>
                                              <br>
                                                <h5>Datos del Cliente</h5>
                                                <hr><br>
                                               <div class="row">
                                                
                                                  <div class="col"><label>DUI</label></div>
                                                  <div class="col"><label><?= $dui_contacto; ?></label></div>
                                                </div>
                                                
                                                <div class="row">
                                                  <div class="col"><label>Nombre</label></div>
                                                  <div class="col">
                                                    <label><?= $nombre_contacto; ?></label>
                                                  </div>
                                                </div>
                                                
                                                <div class="row">
                                                  <div class="col"><label>Telefono</label></div>
                                                  <div class="col" >
                                                    <label><?= $numero_contacto; ?></label>
                                                  </div>
                                                </div>
                                                
                                                <div class="row">
                                                  <div class="col"><label>Correo Electronico</label></div>
                                                  <div class="col" >
                                                    <label><?= $email_contacto;?></label>
                                                  </div>
                                                </div>
                                                
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
                                            </div>
                                            <hr>
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
                                            <hr>
                                            <div class="row">
                                              <div class="col-sm">
                                                <label><strong>Falla Presentada : </strong> <?= $falla_presentada; ?> </label>
                                              </div>
                                              <div class="col-sm">
                                                <label><strong>Actividad Preliminar : </strong> <?= $act_preliminar; ?> </label>
                                              </div>
                                              <div class="col-sm">
                                                <label><strong>Tipo de Trabajo : </strong><?= $t_trabajo; ?></label>
                                              </div>
                                            </div>

                                          </div>
                                          <div class="col-lg-6">
                                            <div id="formasignaciones" class="alert alert-danger">
                                              <h2>Tecnicos Asignados:</h2>
                                                <table class="table">
                                                  <tr>
                                                    <th>Tecnico</th>
                                                    <th>Fecha de Asignacion</th>
                                                    <th>Estado</th>
                                                    <th></th>
                                                  </tr>
                                                  <?php 
                                                  @require_once("../include/conexion.php");
                                                  //Actividades asignadas
                                                  $asignados=0;
                                                  //Actividades en proceso
                                                  $en_proceso=0;
                                                  //Actividades finalizadas por el tecnico, Listo
                                                  $listos=0;
                                                  $consulta = "SELECT * FROM asig_act_tecnicos JOIN estado_bien ON estado_bien.id = asig_act_tecnicos.cod_estab WHERE id_mant =".$id_mant."  AND id_r=".$id_r."";
                                                  $query = mysqli_query($conex, $consulta); 
                                                  while($rows = mysqli_fetch_array($query)){  ?>
                                                  <tr>
                                                    <td><?= $rows['id_usuario']; ?></td>
                                                    <td><?= $rows['fec_t']; ?></td>
                                                    <td><?= $rows['descripcion']; ?></td>
                                                    <td><a class="btn btn-danger" onclick="remover_actividad(<?= $rows['id_mant'].",".$rows['id_r'].",'".$rows['id_usuario']."'"; ?>);" >Remover Actividad</a></td>
                                                  </tr>
                                                <?php } ?>
                                                </table>
                                                <br><br>
                                                <div class="col">
                                                  <a class="btn btn-block btn-success"  data-toggle="modal" data-target="#modal_adm">Añadir Asignacion</a>
                                                </div>
                                            </div>
                                          </div>
                                        </div>
                                          
                                        </form>
                                        <!---->
                                        <?php if ($cod_estab==3 && $_SESSION['email']==$tecnico_asig ){
                                          //boton para proceder de asignado > En proceso,
                                        ?>
                                            <div class="card-footer">
                                                <a  class="btn btn-block btn-danger" onclick="iniciar_actividad();" >Iniciar Actividad</a>
                                            </div>
                                        <?php  //Se cambia el estado, se actualizan las fechas correspondientes, y se muestra el formulario correspondiente a los atributos de la actividad  
                                        }else{  ?>
                                          <br>
                                          <hr>
                                          <center><h1>DETALLE ACTIVIDADES</h1></center>
                                          <hr>
                                          <br>

                                        <div id="tabla_detalles">
                                          <table class="table">
                                            <tr>
                                              <th>Tecnico</th>
                                              <th>Fecha Asignacion</th>
                                              <th>Fecha Aceptacion</th>
                                              <th>Estado</th>
                                              <th></th>

                                            </tr>
                                        <?php 
                                        @require_once("../include/conexion.php");
                                        $consulta = "SELECT ".
                                        " asig.id_mant,".
                                        "asig.id_r,".
                                        "asig.id_usuario,".
                                        "asig.fec_t,".
                                        "asig.fec_a,".
                                        " estado_bien.descripcion as desc_".
                                        " FROM asig_act_tecnicos as asig JOIN estado_bien ON estado_bien.id = asig.cod_estab WHERE id_mant =".$id_mant."  AND id_r=".$id_r." ";
                                        $query = mysqli_query($conex, $consulta); 
                                        while($rows = mysqli_fetch_array($query)){  ?>
                                            <tr>
                                              <td><?= $rows['id_usuario']; ?></td>
                                              <td><?= $rows['fec_t']; ?></td>
                                              <td><?= $rows['fec_a']; ?></td>
                                              <td><?= $rows['desc_'];?></td>
                                              <td><a href="detalle_actividad.php?<?= "id_mant=".$rows['id_mant']."&id_r=".$rows['id_r']."&tecnico=".$rows['id_usuario']; ?>" class="btn btn-info">Detalles</a></td>
                                            </tr>
                                        <?php } ?>
                                          </table>
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
<!-- Ventana Modal -->
<div class="modal fade bs-example-modal-lg" id="modal_adm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detalles</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="cont_modal">

          <select class='form form-control' id="tecnico_nuevo">
            <?php 
          @require_once("../include/conexion.php");
          $consulta = "SELECT * FROM users WHERE tipo_user='TECNICO'";
          $query = mysqli_query($conex, $consulta); 
          while($rows = mysqli_fetch_array($query)){  
            echo "<option  value='".$rows['user']."'>".$rows['user']."</option>";
           } ?>
        </select>
        <br>
        <a  class="btn btn-block btn-warning" onclick="asignar_actividad();" >Asignar</a>

        </div>
      </div>
    </div>
  </div>
</div>

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
}

function remover_actividad(id,id_r,tecnico){
  console.log('se pudo');
    $.ajax({    
    url : '../operaciones/actividades_operaciones.php', 
    data : {'acc':'remover_actividad','id_mant':id,'id_r':id_r,'tecnico':tecnico },   
    type : 'POST',
    success : function(data) 
      {
        alert("Asignacion removida con exito!");
        location.reload();
      }
    });
}


function asignar_actividad(){
 var id_mant = $('#id_mant_h').val();
  var id_r =  $('#id_r_h').val();
  var tecnico = $('#tecnico_nuevo').val();
    $.ajax({    
    url : '../operaciones/actividades_operaciones.php', 
    data : {'acc':'asignar_actividad','id_mant':id_mant,'id_r':id_r,'tecnico':tecnico },   
    type : 'POST',
    success : function(data) 
      {
        //alert(data);
       alert("Proceso realizado con exito!");
       location.reload();
      }
    });
}
</script>
