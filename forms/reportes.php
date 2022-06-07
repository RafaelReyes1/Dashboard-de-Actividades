<?php
    require_once("../template/head.php");
    require_once("../template/menu.php");
    require_once("../include/conexion.php");
?>
   <?php if(true){ ?>
bdanalitica2018
<!-- Contenido -->
                                <div class="card">
                                    <div class="card-header">
                                        <h4> <span class=""></span>Reportes</h4>
                                    </div>
                                    <div class="card-body">
                                      <div class="row">
                                        <div class="col-lg-3">
                                          <div class="">
                                          <!-- Cuadro de Seleccion tipo de reporte -->
                                          <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                            <a class="nav-link " id="v-pills-home-tab" data-toggle="pill" href="#reporte1" role="tab" aria-controls="v-pills-home" aria-selected="true">Reporte Actividades Vs Tecnicos</a>
                                            <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#reporte2" role="tab" aria-controls="v-pills-profile" aria-selected="false">Reporte Historial de Actividades por equipo</a>
                                            <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#reporte3" role="tab" aria-controls="v-pills-messages" aria-selected="false">Reporte Actividades Vs Clientes</a>
                                            <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#reporte4" role="tab" aria-controls="v-pills-settings" aria-selected="false">Reporte Estado de Actividades</a>
                                            <!--<a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#reporte5" role="tab" aria-controls="v-pills-settings" aria-selected="false">Reporte Actividades vs Tiempo listado de actividades ingresadas al sistema por mes</a>
                                            <strong><H1>VALIDACION DE FECHAS, QUE NO ESTEN VACIAS</H1></strong>-->
                                          </div>
                                          <!---->

                                          </div>
                                        </div>
                                        <div class="col-lg-9">
                                          <div class="row">
                                            <div class="tab-content" id="v-pills-tabContent">
                                              <div class="tab-pane fade show active" id="" role="tabpanel" aria-labelledby="v-pills--tab">
                                                <div class="container">
                                                  <div class="row">
                                                    <img  class="rounded mx-auto d-block" src="../assets/images/reporte.png">
                                                  </div>
                                                </div>
                                              </div>
                                              <!--Reporte 1 , Actividades vs Tecnicos -->
                                              <div class="tab-pane fade show " id="reporte1" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                                <div class="container">
                                                  <div class="card">
                                                    <div class="card-body">
                                                      <div class="container">
                                                        <div class="row">
                                                        <div class="col col-sm-4">
                                                          <div class="form-group">
                                                            
                                                            <label>Tecnico</label>
                                                            <select class="form form-control" id="usuario_tecnico_r1">
                                                              <?php 
                                                              require_once('../include/conexion.php');  
                                                              $consulta = "SELECT * FROM  users WHERE tipo_user='TECNICO' AND visibilidad='Y'";
                                                              $query = mysqli_query($conex, $consulta); 
                                                              while($rows = mysqli_fetch_array($query)){
                                                              echo "<option value=".$rows['user'].">".$rows['nombre']." ".$rows['apellido']."</option>";
                                                              } 
                                                               ?>
                                                            </select>
                                                          </div>
                                                        </div>
                                                        <div class="col col-sm-4">
                                                          <div class="row">

                                                            <div class="col-lg">
                                                              <label>Desde</label>
                                                              <input type="date" class="form-control" id="fecha_i">
                                                            </div>
                                                            <div class="col-lg">
                                                              <label>Hasta</label>
                                                              <input type="date" class="form-control" id="fecha_f">
                                                            </div>
                                                            <br>
                                                            <div class="form-group mb-2">
                                                              <input type="checkbox" value="afirmativo" name="v_fecha" id="v_fecha" > 
                                                              <label> El Origen de los tiempos</label>
                                                            </div>
                                                            
                                                            
                                                          </div>
                                                        </div>
                                                        <div class="col col-sm-2">
                                                          <center><a href="#" class="btn btn-success btn-block" onclick="reporte1();">Generar</a></center>
                                                        </div>
                                                      </div>
                                                      <hr>
                                                      <!--Tabla a generarse-->
                                                      <div id="contenido_r1"></div>
                                                    </div>
                                                  </div>
                                                  </div>
                                                </div>
                                              </div>
                                              <!--Reporte 1 , Actividades vs Tecnicos -->
                                              <!--Reporte 2 , Historial de equipo -->
                                              <div class="tab-pane fade" id="reporte2" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                                                <div class="container">
                                                  <div class="card">
                                                    <div class="card-body">
                                                      <div class="container">
                                                        <div class="row">
                                                        <div class="col col-sm-8">
                                                          <div class="form-group">
                                                            <label>Numero de Serie</label>
                                                            <select class="form form-control" id="serie_equipo_2">
                                                              <?php 
                                                              require_once('../include/conexion.php');  
                                                              $consulta = "select 
                                                              detalle_equipo.serie,
                                                              c_marcas.descripcion as marca,
                                                              c_modelos.descripcion as modelo,
                                                              c_empresas.nombre as empresa
                                                              from detalle_equipo
                                                              join c_marcas on c_marcas.id = detalle_equipo.cod_marca
                                                              join c_modelos on c_modelos.id = detalle_equipo.modelo
                                                              join c_empresas on c_empresas.id = detalle_equipo.cliente ";
                                                              $query = mysqli_query($conex, $consulta); 
                                                              while($rows = mysqli_fetch_array($query)){
                                                              echo "<option value=".$rows['serie'].">".$rows['serie']."  ".$rows['marca']." ".$rows['modelo']." ".$rows['empresa']."</option>";
                                                              } 
                                                               ?>
                                                            </select>
                                                          </div>
                                                       
                                                        </div>
                                                        

                                                        <div class="col col-sm-4">
                                                          <center><a href="#" class="btn btn-success btn-block" onclick="reporte2();">Generar</a></center>
                                                        </div>
                                                      </div>
                                                      <hr>
                                                      <!--Tabla a generarse-->
                                                      <div id="contenido_r2">
                                                        
                                                      </div>
                                                    </div>
                                                  </div>
                                                  </div>
                                                </div>
                                              </div>
                                              <!--Reporte 2 , Historial de equipos -->
                                              <!--Reporte 3 , Actividades vs clientes -->
                                              <div class="tab-pane fade" id="reporte3" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                                                <div class="container">
                                                  <div class="card">
                                                    <div class="card-body">
                                                      <div class="container">
                                                        <div class="row">
                                                        <div class="col col-sm-6">
                                                          <div class="form-group">
                                                            <label>Cliente</label>
                                                            <select class="form form-control" id="cliente_r3">
                                                              <?php 
                                                              require_once('../include/conexion.php');  
                                                              $consulta = "SELECT em.id,em.nombre,c_paises.descripcion as descripcion FROM c_empresas as em JOIN c_paises ON c_paises.id = em.pais";
                                                              $query = mysqli_query($conex, $consulta); 
                                                              while($rows = mysqli_fetch_array($query)){
                                                              echo "<option value='".$rows['id']."''>".$rows['nombre'].",  ".$rows['descripcion']." </option>";
                                                              } 
                                                               ?>
                                                            </select>
                                                          </div>
                                                        </div>
                                                        <div class="col col-sm-4">
                                                          <div class="row">

                                                            <div class="col-lg">
                                                              <label>Desde</label>
                                                              <input type="date" class="form-control" id="fecha_i_r3">
                                                            </div>
                                                            <div class="col-lg">
                                                              <label>Hasta</label>
                                                              <input type="date" class="form-control" id="fecha_f_r3">
                                                            </div>
                                                            <br>
                                                            <div class="form-group mb-2">
                                                              <input type="checkbox" value="afirmativo" name="v_fecha_r3" id="v_fecha_r3" > 
                                                              <label> El Origen de los tiempos</label>
                                                            </div>
                                                            
                                                            
                                                          </div>
                                                        </div>
                                                        <div class="col col-sm-2">
                                                          <center><a href="#" class="btn btn-success btn-block" onclick="reporte3();">Generar</a></center>
                                                        </div>
                                                      </div>
                                                      <hr>
                                                      <!--Tabla a generarse-->
                                                      <div id="contenido_r3"></div>
                                                    </div>
                                                  </div>
                                                  </div>
                                                </div>
                                              </div>
                                              <!--Reporte 4 , Estado proceso -->
                                              <div class="tab-pane fade" id="reporte4" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                                                <div class="container">
                                                  <div class="card">
                                                    <div class="card-body">
                                                      <div class="container">
                                                        <div class="row">
                                                        <div class="col col-sm-6">
                                                          <div class="form-group">
                                                            <label>Estado del Proceso</label>
                                                            <select class="form form-control" id="estado_r4">
                                                              <?php 
                                                              require_once('../include/conexion.php');  
                                                              $consulta = "SELECT * FROM estado_bien";
                                                              $query = mysqli_query($conex, $consulta); 
                                                              while($rows = mysqli_fetch_array($query)){
                                                              echo "<option value='".$rows['id']."''>".$rows['descripcion']."</option>";
                                                              } 
                                                               ?>
                                                            </select>
                                                          </div>
                                                        </div>
                                                        <div class="col col-sm-4">
                                                          <div class="row">

                                                            <div class="col-lg">
                                                              <label>Desde</label>
                                                              <input type="date" class="form-control" id="fecha_i_r4">
                                                            </div>
                                                            <div class="col-lg">
                                                              <label>Hasta</label>
                                                              <input type="date" class="form-control" id="fecha_f_r4">
                                                            </div>
                                                            <br>
                                                            <div class="form-group mb-2">
                                                              <input type="checkbox" value="afirmativo" name="v_fecha_r4" id="v_fecha_r4" > 
                                                              <label> Filtrar por Fecha</label>
                                                            </div>
                                                            
                                                            
                                                          </div>
                                                        </div>
                                                        <div class="col col-sm-2">
                                                          <center><a href="#" class="btn btn-success btn-block" onclick="reporte4();">Generar</a></center>
                                                        </div>
                                                      </div>
                                                      <hr>
                                                      <!--Tabla a generarse-->
                                                      <div id="contenido_r4"></div>
                                                    </div>
                                                  </div>
                                                  </div>
                                                </div>
                                              </div>
                                              <!--Reporte 4 , Estado proceso -->
                                            </div>

                                          </div>
                                          <div id="tabla_reportes">
                                            <!--Tabla de actividades--> 
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="card-footer">
                                        #Pie de pagina
                                    </div>
                                </div>
<!--Contenido-->
    <?php
    } ?>
<?php  require_once("../template/footer.php"); ?>
<script type="text/javascript">


function genpdf(nombreDiv, preporte) {
  var titulo="";
if (preporte==1) {titulo = "FORMULARIO DE REPORTES ACTIVIDADES VS TECNICOS";}
if (preporte==2) {titulo = "FORMULARIO DE REPORTES HISTORIAL DE EQUIPOS";}
if (preporte==3) {titulo = "FORMULARIO DE REPORTES ACTIVIDADES VS CLIENTES";}
if (preporte==4) {titulo = "FORMULARIO DE REPORTES ESTADO DE ACTIVIDADES";}

var contenido= document.getElementById(nombreDiv).innerHTML;
contenido = "<br><center><h1>ANALITICA SALVADOREÑA</h1><br>"+titulo+"</center>"+contenido;
var contenidoOriginal= document.body.innerHTML;
document.body.innerHTML = contenido;
window.print();
document.body.innerHTML = contenidoOriginal;
}



function reporte1(){
  var fecha_i = $('#fecha_i').val();
  var fecha_f = $('#fecha_f').val();
  var usuario = $('#usuario_tecnico_r1').val();
  var v_fecha = "";
  var checkBox = document.getElementById("v_fecha");
  if (checkBox.checked == true){
     v_fecha= "Y";
  } else {
    v_fecha = "N";
  }

    $.ajax({    
    url : '../operaciones/reportes_operaciones.php', 
    data : {'acc':'actvtec','fecha_i':fecha_i,'fecha_f':fecha_f,'usuario':usuario,'v_fecha':v_fecha},   
    type : 'POST',
    success : function(data) 
      {
        document.getElementById('contenido_r1').innerHTML = data; 
      }
    });
}


function reporte2(){
    var equipo = $('#serie_equipo_2').val();
    var v_fecha = "";
    $.ajax({    
    url : '../operaciones/reportes_operaciones.php', 
    data : {'acc':'histeq','serie_equipo':equipo},   
    type : 'POST',
    success : function(data) 
      {
        document.getElementById('contenido_r2').innerHTML = data; 
      }
    });
}


function reporte3(){
  var fecha_i = $('#fecha_i_r3').val();
  var fecha_f = $('#fecha_f_r3').val();
  var cliente = $('#cliente_r3').val();
  var v_fecha = "";
  var checkBox = document.getElementById("v_fecha_r3");
  if (checkBox.checked == true){
     v_fecha= "Y";
  } else {
    v_fecha = "N";
  }

    $.ajax({    
    url : '../operaciones/reportes_operaciones.php', 
    data : {'acc':'actvcli','fecha_i':fecha_i,'fecha_f':fecha_f,'cliente':cliente,'v_fecha':v_fecha},   
    type : 'POST',
    success : function(data) 
      {
        document.getElementById('contenido_r3').innerHTML = data; 
      }
    });
}

function reporte4(){
  var fecha_i = $('#fecha_i_r4').val();
  var fecha_f = $('#fecha_f_r4').val();
  var estado = $('#estado_r4').val();
  var v_fecha = "";
  var checkBox = document.getElementById("v_fecha_r4");
  if (checkBox.checked == true){
     v_fecha= "Y";
  } else {
    v_fecha = "N";
  }

    $.ajax({    
    url : '../operaciones/reportes_operaciones.php', 
    data : {'acc':'reesbi','fecha_i':fecha_i,'fecha_f':fecha_f,'estado':estado,'v_fecha':v_fecha},   
    type : 'POST',
    success : function(data) 
      {
        document.getElementById('contenido_r4').innerHTML = data; 
      }
    });




}
</script>