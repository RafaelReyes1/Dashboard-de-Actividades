<?php
    require_once("template/head.php");
    require_once("template/menu.php");
    require_once("include/conexion.php");
    require_once("responsable_operaciones.php");

    if (@$_GET['codigo_a']!="") {
      //Funcion para llenar los datos
      llenar($_GET['codigo_a']);
    }
    //se extraen los datos y se asignan al formul ario dependiendo de la busqueda
    
?>  
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Inicio</h3>
        </div>
        <div class="panel">
        <br>
          <a href="responsable.php" class="btn btn-sm btn-warning">Regresar</a>
          <br><br>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                     <form name="form_alumno" class="form-horizontal" id="form_alumno" method="POST">
                         <fieldset>
                            <div id="legend">
                            <?php  $saludo = "INGRESAR "; ?>
                            <?php if (@$_GET['codigo_a']!=""): $saludo = "EDITAR "?>
                                
                            <?php endif ?>
                              <legend class=""><?php echo @$saludo; ?> RESPONSABLE</legend>
                            </div>                      
                           <div class="control-group">

                              <!-- DUI -->
                              <label><h3>Codigo : <?php echo $_GET['codigo_a']; ?></h3></label>
                              <br>
                              <label class="control-label"  for="DUI">DUI</label>
                              <div class="controls">
                                <?php if (@$_GET['codigo_a']!=""){ ?>
                                <br>
                                <input type="hidden" name="dui_g" id="dui_g" value="<?= $_GET['codigo_a']; ?>">  
                                <h3><label><?= $GLOBALS['dui']; ?></label></h3>
                              <?php }else{  ?>
                                <input type="text" id="dui_alumno" value="<?= @$GLOBALS['dui'];?>" name="dui_alumno"  class="form-control" maxlength="10" required >
                            <?php } ?>

                                <!--<p class="help-block">Username can contain any letters or numbers, without spaces</p>-->
                              </div>
                            </div>
                            <br><hr><br>

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
                              <!-- TELEFONO -->
                              <label class="control-label"  for="telefono">TELEFONO</label>
                              <div class="controls">
                                <input type="text" id="telefono_alumno" value="<?= @$GLOBALS['telefono'];?>" name="telefono_alumno"  class="form-control" maxlength="8" required >
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
                              <!-- Codigo estado Civil -->
                              <label class="control-label"  for="parentesco">PARENTESCO</label>
                              <div class="controls">
                                    
                                  <select class="form-control"  name="parentesco" id="parentesco" >
                                  
                                    <option value="<?= @$GLOBALS['codigo_parentesco'];?>"><?= @$GLOBALS['parentesco.nombre'];?></option>
                                    <?php  echo listarParentesco(); ?>
                                  </select>



                              </div>
                            </div>


                            <div class="control-group">
                              <!-- Direccion -->
                              <label class="control-label"  for="direccion">DIRECCION</label>
                              <div class="controls">
                                
                                <textarea class="form-control" rows="8" id="direccion_alumno" name="direccion_alumno" required><?= @$GLOBALS['direccion'];?></textarea>
                                <!--<p class="help-block">Username can contain any letters or numbers, without spaces</p>-->
                                
                              </div>
                            </div>   

                        </fieldset>
                        <br><br>
                        <HR></HR>
                        <center>

                        
                            <center><h3><div id="respuesta"></div></h3></center> 

                        
                        <?php if (@$_GET['codigo_a'] == "" || @$_GET['codigo_a'] == NULL){ ?>
                            <button type="button" class="btn btn-lg btn-primary" onClick="ingresarResponsable();">INGRESAR RESPONSABLE</button>
                          <?php }else{ ?> 
                            <button type="button" class="btn btn-lg btn-primary" onClick="editar();">EDITAR RESPONSABLE</button>
                          <?php } ?>
                        <a href="responsable.php" class="btn  btn-lg btn-danger">CANCELAR</a></center>
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
    }

function ingresarResponsable()
{
    //Validacion de campos vacios
    if ($('#nombre_alumno').val() != ""  && $('#apellidos_alumno').val() != ""   && $('#dtpNacimiento').val() != "" && $('#').val() != "") {
    

    $.ajax({    
    url : 'responsable_operaciones.php?acc=nuevo', 
    data : $('#form_alumno').serialize(),   
    type : 'POST',
    success : function(data) 
      {
        if(data==1)
        {
          $('#respuesta').html('¡Responsable registrado con exito!');
          setTimeout(function(){location.href='responsable.php';},1500);
        }                
        else
        {
          $('#respuesta').html('Responsable no ingresado '+data); 
        }
      }
    });


    }else{
      alert("DEBES DE COMPLETAR LOS CAMPOS");
    }
}


function editar()
{
    
    //Validacion de campos vacios
    if ($('#nombre_alumno').val() != ""  && $('#apellidos_alumno').val() != ""   && $('#dtpNacimiento').val() != "" ) {
        $.ajax({    

          url : 'responsable_operaciones.php?acc=editar', 
          data : $('#form_alumno').serialize(),   
          type : 'POST',
          success : function(data) 
            {
              if(data==1)
              {
                $('#respuesta').html('¡Responsable editado con exito!');
                setTimeout(function(){location.href='responsable.php';},1500);
              }                
              else
              {
                $('#respuesta').html('¡Responsable no editado! algo fallo... ' + data); 
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



function buscarAlumno()
{

var parametro = {
    codigo_alumno: document.getElementById("codigo_alumno").value
  };

  $.ajax({    
        url : 'responsable_operaciones.php?acc=4', 
        data : parametro,   
        type : 'POST',
        success : function(data) 
          {
            $('#nombrealumo').html(data); 
          }
  }); 
}   











</script>
<option selected value=""></option>      
<?php 
    require_once("template/footer.php");
?>