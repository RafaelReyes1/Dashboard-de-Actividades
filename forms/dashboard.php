<?php
    require_once("../template/head.php");
    require_once("../template/menu.php");
    require_once("../include/conexion.php");
?>
   <?php if(true){ ?>

<!-- Contenido -->
                                <div class="card">
                                    <div class="card-header">
                                        <h4> <span class=""></span> Dashboard de Actividades  </h4>
                                    </div>
                                    <div class="card-body">
                                      <div class="row">
                                        <div class="col-lg-3">
                                          <div class="jumbotron">
                                           <!-- Cuadro de Busqueda -->
                                              <h4>Busqueda</h4>
                                              <hr>
                                              <div class="row">
                                                <div class="col-lg">
                                                  Estado:
                                                </div>
                                                <div class="col-lg">
                                                  <select class="form-control" name = "estado_actividades" id ="estado_actividades">
                                                    <option value="100">General</option>
                                                    <?php 

                                                      $consulta = "select * from estado_bien";
                                                      $query = mysqli_query($conex, $consulta); 
                                                      while($rows = mysqli_fetch_array($query)){
                                                      echo "<option value=".$rows['id'].">".$rows['descripcion']."</option>";
                                                      } 
                                                     ?>

                                                  </select>
                                                </div>
                                              </div>
                                              <hr>
                                              <h5><input type="checkbox" value="afirmativo" name="v_fecha" id="v_fecha" > <label>Filtrado por Fecha</label></h5>
                                              <br>
                                              <div class="row">
                                                
                                                <br>
                                                <div class="col-lg">
                                                  <label>Desde</label>
                                                  <input type="date" class="form-control" id="fecha_i">
                                                </div>
                                                <div class="col-lg">
                                                  <label>Hasta</label>
                                                  <input type="date" class="form-control" id="fecha_f">
                                                </div>
                                              </div>
                                              <br>
                                              <div class="row">
                                                <div class="col">
                                                  <a href="#" class="btn btn-info btn-block" onclick="tabla_dashboard();">Filtrar</a>
                                                </div>
                                              </div>
                                           <!---->

                                          </div>
                                        </div>
                                        <div class="col-lg-9">
                                          <div class="row">
                                            <div class="col"><a href="agregar_actividad.php" class="btn btn-success">Ingresar Actividad</a></div>

                                          </div>
                                          <div id="tabla_actividades">
                                            <!--Tabla de actividades-->
                                                
                                          </div>
                                        </div>
                                      </div>
                                        <!--Tabla de actividades-->
                                    </div>
                                    <div class="card-footer">
                                        #Pie de pagina
                                    </div>
                                </div>


<!-- Ventana Modal -->
<div class="modal fade bs-example-modal-lg" id="modaldetallesoperaciones" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
        </div>
      </div>
    </div>
  </div>
</div>
<!--Contenido-->
    <?php
    } ?>
<?php  require_once("../template/footer.php"); ?>
<script type="text/javascript">

function tabla_dashboard(){
  var fecha_i =  $('#fecha_i').val();
  var fecha_f = $('#fecha_f').val();
  var estado = $('#estado_actividades').val();
  var v_fecha = "";
  var checkBox = document.getElementById("v_fecha");
  if (checkBox.checked == true){
     v_fecha= "Y";
  } else {
    v_fecha = "N";
  }

    $.ajax({    
    url : '../operaciones/dashboard_operaciones.php', 
    data : {'acc':'tabla_dash','fecha_i':fecha_i,'fecha_f':fecha_f,'estado':estado,'v_fecha':v_fecha},   
    type : 'POST',
    success : function(data) 
      {
        document.getElementById('tabla_actividades').innerHTML = data; 
      }
    });
}

function aceptar_actividad(){
  alert('la actividad se aceptara');
}

function detalles_actividad(id,id_r){
    $.ajax({    
    url : '../operaciones/dashboard_operaciones.php', 
    data : {'acc':'detalles_dash','id_mant':id,'id_r':id_r <?php if ($_SESSION['acceso']=='TECNICO') {echo ",'tecnico':'".$_SESSION['email']."'";} ?> },   
    type : 'POST',
    success : function(data) 
      {
        document.getElementById('cont_modal').innerHTML = data; 
        $('#modaldetallesoperaciones').modal('show');
      }
    });
}
</script>