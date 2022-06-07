<?php
    require_once("template/head.php");
    require_once("template/menu.php");
    require_once("include/conexion.php");
    require_once("alumno_lista.php");

    if (@$_GET['codigo_alumno']!="") {
      //Funcion para llenar los datos
      llenarAlumno($_GET['codigo_alumno']); 

    }

    //se extraen los datos y se asignan al formul ario dependiendo de la busqueda
    @$GLOBALS['codigoalumno'] = @$_GET['codigo_alumno'] ;
?>  
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Inicio</h3>
        </div>
        <div class="panel">
        <br>
      <?php 
      header('location:aplicacion_sistema_insibo/login.php');
       ?>    
          <a href="alumno.php" class="btn btn-sm btn-warning">Regresar</a>
          <br><br>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                     <form name="form_alumno" class="form-horizontal" id="form_alumno" method="POST">
                         <fieldset>
                            <div id="legend">
                              <legend class="">REGISTRAR ALUMNO</legend>
                            </div>
                            <input type="hidden" id="codigo_alumno" value="<?= @$GLOBALS['codigoalumno'];?>" name="codigo_alumno">
                            <div class="control-group">
                              <!-- NIE -->
                              <label class="control-label"  for="NIE">NIE</label>
                              <div class="controls">
                                <input type="text" id="nie_alumno" value="<?= @$GLOBALS['nie'];?>" name="nie_alumno"  placeholder="8 digitos" class="form-control" maxlength="8" required minlength=8>
                                <!--<p class="help-block">Username can contain any letters or numbers, without spaces</p>-->
                              </div>
                            </div>

                            <div class="control-group">
                              <!-- Nombres -->
                              <label class="control-label"  for="nombres">PRIMEROS NOMBRES</label>
                              <div class="controls">
                                <input type="text" id="nombre_alumno" value="<?= @$GLOBALS['nombres'];?>" name="nombre_alumno" class="form-control" maxlength="30" required >
                                <!--<p class="help-block">Username can contain any letters or numbers, without spaces</p>-->
                              </div>
                            </div>
                            <div class="control-group">
                              <!-- Apellidos -->
                              <label class="control-label"  for="Apellidos">APELLIDOS</label>
                              <div class="controls">
                                <input type="text" id="apellidos_alumno" value="<?= @$GLOBALS['apellidos'];?>" name="apellidos_alumno"  class="form-control" maxlength="30" required >
                                <!--<p class="help-block">Username can contain any letters or numbers, without spaces</p>-->
                              </div>
                            </div>


                            <div class="control-group">
                              <!-- fecha_nacimiento -->
                              <label class="control-label"  for="fecha_nacimiento">FECHA DE NACIMIENTO</label>
                              <div class="controls">
                                <div class="container">
                                    <div class="row">
                                        <div class='col-sm-6'>
                                            <div class="form-group">
                                                <div class='input-group date'>
                                                    <input type='date' required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}"  name="dtpNacimiento" value="<?= @$GLOBALS['fecha_nacimiento'];?>" class="form-control" />
                                                    <span class="input-group-addon">
                                                        <span class="glyphicon glyphicon-calendar"></span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <script type="text/javascript">
                                            $(function () {
                                                $('#dtpNacimiento').datetimepicker();
                                            });
                                        </script>
                                    </div>
                                </div>
                                <!--<p class="help-block">Username can contain any letters or numbers, without spaces</p>-->
                              </div>
                            </div>
                            <div class="control-group">
                              <!-- Codigo estado Civil -->
                              <label class="control-label"  for="estadocivil">ESTADO CIVIL</label>
                              <div class="controls">
                                    <select class="form-control" name="estadocivil">
                                      <option value="<?= @$GLOBALS['codigo_estado_civil'];?>"><?= @$GLOBALS['estado_civil.nombre'];?></option>
                                      <!-- Aqui se incertaran las listas generadas-->

                                      <?php 
                                      echo listarEstadoCivil(); ?>
                                    </select>
                                  <!-- Espacio para insertar el combobox generado por la consulta a la bd -->
                              </div>
                            </div>

                            <div class="control-group">
                              <!-- DUI -->
                              <label class="control-label"  for="DUI">DUI</label>
                              <div class="controls">
                                <input type="text" id="dui_alumno" value="<?= @$GLOBALS['dui'];?>" name="dui_alumno"  class="form-control" maxlength="10" required >
                                <!--<p class="help-block">Username can contain any letters or numbers, without spaces</p>-->
                              </div>
                            </div>

                            <div class="control-group">
                              <!-- Carnet de minoridad -->
                              <label class="control-label"  for="carnet_minoridad">CARNET DE MINORIDAD</label>
                              <div class="controls">
                                <input type="text" id="minoridad_alumno" value="<?= @$GLOBALS['carnet_minoridad'];?>" name="minoridad_alumno"  class="form-control" maxlength="5" required >
                                <!--<p class="help-block">Username can contain any letters or numbers, without spaces</p>-->
                              </div>
                            </div>                        
                            <div class="control-group">
                              <!-- TELEFONO -->
                              <label class="control-label"  for="telefono">TELEFONO</label>
                              <div class="controls">
                                <input type="text" id="telefono_alumno" value="<?= @$GLOBALS['telefono'];?>" name="telefono_alumno"  class="form-control" maxlength="8" required >
                                <!--<p class="help-block">Username can contain any letters or numbers, without spaces</p>-->
                              </div>
                            </div>                        

                            <div class="control-group">
                              <!-- Email -->
                              <label class="control-label"  for="email">EMAIL</label>
                              <div class="controls">
                                <input type="email" id="email_alumno" value="<?= @$GLOBALS['correo'];?>" name="email_alumno"  class="form-control" maxlength="50" required >
                                <!--<p class="help-block">Username can contain any letters or numbers, without spaces</p>-->
                              </div>
                            </div>                        

                            <div class="control-group">
                              <!-- Codigo de departamento -->
                              <label class="control-label"  for="departamento">DEPARTAMENTO</label>
                              <div class="controls">
                                    <!-- Espacio para insertar el combobox generado por la consulta a la bd -->
                                    <select class="form-control" onchange='completarMunicipio();' id="departamento_alumno" name="departamento_alumno">
                                      <!-- Aqui se incertaran las listas generadas-->
                                      <option selected value="<?= @$GLOBALS['codigo_departamento'];?>"><?= @$GLOBALS['departamento.nombre'];?></option>
                                      <?php 
                                      echo listarDepartamentos();
                                       ?>
                                    </select>                                  
                                  <!-- Espacio para insertar el combobox generado por la consulta a la bd -->
                              </div>
                            </div>

<!--  -->
<input type="hidden" id="departamentoguardado" value="<?= @$GLOBALS['codigo_departamento'];?>"> 
<input type="hidden" id="idmunicpioguardado" value="<?= @$GLOBALS['codigo_municipio'];?>"> 
<input type="hidden" id="nmunicpioguardado" name="nombremunicio"  value="<?= @$GLOBALS['municipios.nombre'];?>"> 

                            <div class="control-group">
                              <!-- Codigo estado Civil -->
                              <label class="control-label"  for="Municipio">MUNICIPIO</label>
                              <div class="controls">
                                    <!-- Espacio para insertar el combobox generado por la consulta a la bd -->
                                      <select class="form-control" name="municipio" id="municipio">
                                      <!-- Aqui se incertaran las listas generadas-->
                                    

                                  <option selected value="<?= $GLOBALS['codigo_municipio'];?>"><?= $GLOBALS['municipios.nombre'];?></option>      
                                            
                                            
                                        
                                        
                                    </select>
                              </div>
                            </div>
<!--  -->






                            <div class="control-group">
                              <!-- Direccion -->
                              <label class="control-label"  for="direccion">DIRECCION</label>
                              <div class="controls">
                                
                                <textarea class="form-control" rows="8" id="direccion_alumno" name="direccion_alumno" required><?= @$GLOBALS['direccion'];?></textarea>
                                <!--<p class="help-block">Username can contain any letters or numbers, without spaces</p>-->
                                
                              </div>
                            </div>   

                            <div class="control-group">
                              <!-- Observaciones -->
                              <label class="control-label"  for="direccion">OBSERVACIONES</label>
                              <div class="controls">
                                <textarea class="form-control"  rows="5" id="observaciones_alumno" name="observaciones_alumno" required><?= @$GLOBALS['observaciones'];?></textarea>
                                <!--<p class="help-block">Username can contain any letters or numbers, without spaces</p>-->
                              </div>
                            </div>   


                            <hr>

                            <div class="control-group">
                              <!-- Observaciones -->
                              <label class="control-label"  for="direccion">Responsable</label>
                              <div class="controls">
                                

                                
                                <div class="row">
                                  <div class="col-lg-6">
                                    <input type="text" name="responsable" placeholder="Codigo de identificador del responsable" value="<?= @$GLOBALS['dui_responsable'];?>" id="responsable" class="form-control">    
                                    <br>
                                    <input type="button" class="btn btn-default btn-sm" value="Buscar" onclick="buscarRes();">    
                                  </div>
                                  <div class="col-lg-6">
                                      <div id="detalleres"></div>
                                  </div>
                                </div>
                              </div>
                            </div>  
                        </fieldset>
                        <br><br>
                        <HR></HR>
                           <center><h3><div id="respuesta"></div></h3></center> 
                        <center>
                        <?php if (@$_GET['codigo_alumno'] == "" || @$_GET['codigo_alumno'] == NULL){ ?>
                            <button type="button" class="btn btn-lg btn-primary" onClick="ingresarAlumno();">INGRESAR ALUMNO</button>
                          <?php }else{ ?> 
                            <button type="button" class="btn btn-lg btn-primary" onClick="editarAlumno();">EDITAR ALUMNO</button>
                          <?php } ?>
                        <a href="alumno_detalle.php" class="btn  btn-lg btn-danger">CANCELAR</a></center>
                        <hr>                       
                </form>              
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
    </div>
 
<script type="text/javascript">
    
    window.onload= function(){
      completarMunicipio();
      buscarRes();
    }

function buscarRes()
{
var parametro = {
    responsable: document.getElementById("responsable").value
  };

$.ajax({    
url : 'alumno_lista.php?acc=4', 
data : parametro,   
type : 'POST',
success : function(data) 
{
$('#detalleres').html(data); 
}
  }); 
}   
 



function ingresarAlumno()
{
    //Validacion de campos vacios
    if ($('#nombre_alumno').val() != ""  && $('#apellidos_alumno').val() != ""   && $('#dtpNacimiento').val() != "" && $('#').val() != "") {
    $.ajax({    
    url : 'alumno_lista.php?acc=nuevo', 
    data : $('#form_alumno').serialize(),   
    type : 'POST',
    success : function(data) 
      {
        if(data==1)
        {
          $('#respuesta').html('¡Alumno registrado con exito!');
          setTimeout(function(){location.href='alumno_detalle.php';},1500);
        }                
        else
        {
          $('#respuesta').html('Alumno no registrado '); 
        }
      }
    });


    }else{
      alert("DEBES DE COMPLETAR LOS CAMPOS");
    }
}


function editarAlumno()
{
    
    //Validacion de campos vacios
    if ($('#nombre_alumno').val() != ""  && $('#apellidos_alumno').val() != ""   && $('#dtpNacimiento').val() != "" ) {
        $.ajax({    

          url : 'alumno_lista.php?acc=editar', 
          data : $('#form_alumno').serialize(),   
          type : 'POST',
          success : function(data) 
            {
              if(data==1)
              {
                $('#respuesta').html('¡Alumno editado con exito!');
                setTimeout(function(){location.href='alumno.php';},1500);
              }                
              else
              {
                $('#respuesta').html('¡Alumno no editado! algo fallo... ' + data); 
              }
            }
    });


    }else{
      alert("¡CUIDADO! Existen campos obligatorios");
    }
}

function completarMunicipio()
{
var idmuni = document.getElementById("idmunicpioguardado").value;
var nmuni = document.getElementById("nmunicpioguardado").value;
var seleccionado = "";

var parametro = {
    departamento_alumno: document.getElementById("departamento_alumno").value
  };

  $.ajax({    
        url : 'alumno_lista.php?acc=3', 
        data : parametro,   
        type : 'POST',
        success : function(data) 
          {
            if (document.getElementById("departamentoguardado").value ==document.getElementById("departamento_alumno").value) {
              seleccionado = "<option selected value='"+idmuni+"'>"+nmuni+"</option>";  
            }
            $('#municipio').html(seleccionado+data); 
          }
  }); 
}   















</script>
<option selected value=""></option>      
<?php 
    require_once("template/footer.php");
?>