<?php
    require_once("../template/head.php");
    require_once("../template/menu.php");
    require_once("../include/conexion.php");
?>
   <?php if(true){ ?>

<!-- Contenido -->
                                <div class="card">
                                    <div class="card-header">
                                        <h4> <span class=""></span> Nueva Actividad  </h4>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title"></h5>
                                        <p class="card-text">
                                          <div class="row">
                                            <div class="col-lg-10">
<div id="prueba"></div>
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
    <h4>Datos Iniciales</h4>  
  </div>
  <div class="col-lg-9">
    <div class="row">
      <select class="form form-control" id="opc_inicial" onchange="valinicio();">
        <option></option>
        <option value="1">Cuento con un ID de Actividad asociado</option>
        <option value="2">No, La actividad no tiene antecedentes</option>
      </select>
    </div>
    <br>
    <div class="row">
      <div class="col">
       <div id="val_inicio_proceso">
         

       </div>
      </div>
    </div>
  </div>
</div>
<hr>

<!--Datos de Equipo-->
<div class="row">
  <div class="col-lg-3">
    <h4>Datos del Equipo</h4>  
  </div>
  <div class="col-lg-9">
    <div class="row">
      <div class="col"><label>Numero de serie</label></div>
      <div class="col"><input type="text" class="form-control" name="nserie" id="nserie"></div>
      <div class="col"><a  class="btn btn-success btn-block" onclick="accion_equipo();">Buscar</a></div>
      
    </div>
    <br>
    <div class="row">
      <div class="col">
        <div class="jumbotron">
            <!--Formulario de visualizacion si encuentra-->
              <div id="formulario_equipo_visualizacion">
                
              </div>
            <!---->
            <br>
        </div>
      </div>
    </div>
  </div>
</div>
<hr>

<!--Persona que entrega-->
<div class="row">
  <div class="col-lg-3">
    <h4>Responsable</h4>  
  </div>
  <div class="col-lg-9">
   <div class="row">
      <div class="col"><label>DUI</label></div>
      <div class="col">
        <input type="text" class="form-control" maxlength="10" name="dui_responsable_t" id="dui_responsable_t">
      </div>
      <div class="col"><a  class="btn btn-success btn-block" onclick="accion_cliente();">Buscar</a></div>
      
    </div>
    <br>
    <div class="row">
      <div class="col">
        <div class="jumbotron">
          <div id="formulario_responsable">
                  
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
<hr>
<!--Observacion-->
<div class="row">
  <div class="col">
    <div class="row">
      <div class="col-lg-3">
        <h5>Observacion</h5>
      </div>
      <div class="col-lg-9">
        <textarea rows="5" id = "observacion-actividad" class="form-control" name=""></textarea>
      </div>
    </div>
  </div>
</div>
<br>

<!--Falla presentada-->
<div class="row">
  <div class="col">
    <div class="row">
      <div class="col-lg-3">
        <h5>Falla Presentada</h5>
      </div>
      <div class="col-lg-9">
        <select class="form-control" id="falla_presentada">
            <?php 
              @include("../include/conexion.php");
              $consulta = "SELECT * FROM f_equipo";
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
  </div>
</div>
<br>
<!--Actividad preliminar-->
<div class="row">
  <div class="col">
    <div class="row">
      <div class="col-lg-3">
        <h5>Actividad preliminar</h5>
      </div>
      <div class="col-lg-9">
        <div class="row">
          <?php 
            @include("include/conexion.php");
            $consulta = "SELECT * FROM c_actividades";
            $query = mysqli_query($conex, $consulta); 
            $retorno = "";
            while($rows = mysqli_fetch_array($query))
            { ?>
              <div class="col">
                <input type="radio"  name="act_preliminar"  id="act_preliminar" value="<?= $rows['id']; ?>"> <?= $rows['descripcion']; ?><br>
              </div>
            <?php
            }
           ?>
          

        </div>
      </div>
    </div>
  </div>
</div>
<br>
<!--Tipo de actividad-->
<div class="row">
  <div class="col">
    <div class="row">
      <div class="col-3">
        <h5>Tipo de Actividad</h5>
      </div>
      <div class="col-9 ">
        <select class="form-control" id="tipo_actividad">
          <option val="INTERNO">Interno</option>
          <option val="EXTERNO">Externo</option>
        </select>
      </div>
    </div>
  </div>
</div>
<br>
<!--Tipo de trabajo-->
<div class="row">
  <div class="col">
    <div class="row">
      <div class="col-3">
        <h5>Tipo de Trabajo</h5>
      </div>
      <div class="col-9">
        <select class="form-control" id="tipo_trabajo">
            <?php 
              @include("../include/conexion.php");
              $consulta = "SELECT * FROM c_ttrabajo";
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
  </div>
</div>
</form>
<!---->

                                    </div>
                                    <div class="card-footer">
                                        <a href="#" class="btn btn-block btn-success" onclick="agregar_actividad();" >Agregar Actividad</a>
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
  function accion_equipo(){
    var serie = $('#nserie').val();
    if (serie!="") {
    $.ajax({    
    url : '../operaciones/dashboard_operaciones.php', 
    data : {'acc':'encontrarequipo','nserie':serie},   
    type : 'POST',
    success : function(data) 
    {
    document.getElementById('formulario_equipo_visualizacion').innerHTML = data; 

    }
    });  
  }else{
    alert('¡Debes ingresar el numero de serie!');
  }
    
  }


  //ingresa los datos del equipo 
  function ingresar_equipo(){

    var serie = $('#nserie_n').val();
    var marca = $('#marca_n').val();
    var modelo = $('#modelo_n').val();
    var cliente = $('#empresa_n').val();
    var t_equipo = $('#t_equipo_n').val();

    if (serie!="" && marca!="" && modelo!=""&&cliente!=""&&t_equipo!="") {
    $.ajax({
    url : '../operaciones/dashboard_operaciones.php', 
    data : {'acc':'ingresar_equipo','nserie':serie,'marca':marca,'modelo':modelo,'cliente':cliente,'t_equipo':t_equipo},   
    type : 'POST',
    success : function(data) 
    {
      $('#nserie').val(data);
      accion_equipo();
    }
    });
    }else{
      alert('Debes completar los campos del formulario de ingreso de equipo (Numero de serie, Marca, Modelo, Tipo de Equipo, Empresa)');
    }
    

  }

  //Llena el formulario de datos del cliente (responsable)
  function accion_cliente(){
      var dui = $('#dui_responsable_t').val();
      if (dui !="") {
      $.ajax({    
      url : '../operaciones/clientes_operaciones.php', 
      data : {'acc':'listar_cliente','dui':dui},   
      type : 'POST',
      success : function(data) 
        {
          document.getElementById('formulario_responsable').innerHTML = data; 
        }
      });  
    }else{
      alert('Debes ingresar un numero de DUI');
    }
      
  }
  //ingresa los datos del equipo 
  function ingresar_cliente(){

    var dui = $('#dui_n').val();
    var nombre = $('#nombre_cliente_n').val();
    var apellido = $('#apellido_cliente_n').val();
    var telefono = $('#telefono_cliente_n').val();
    var email = $('#email_n').val();
    var empresa = $('#empresa_n').val();

    if (dui!="" && nombre!="" && apellido !="" && telefono !="" && email !="" && empresa !="") {
      $.ajax({
    url : '../operaciones/clientes_operaciones.php', 
    data : {'acc':'ingresar_cliente','dui':dui,'nombre':nombre,'apellido':apellido,'numero_telefonico':telefono,'email':email,'empresa':empresa},
    type : 'POST',
    success : function(data) 
    {
      $('#dui_responsable_t').val(data);
      accion_cliente();
     $('#dui_responsable_t').attr('disabled', 'disabled');
    }
    });

    }else{
      alert('¡Para completar el registro de Cliente, debes completar el formulario de registro!');
    }

    

  }

  function valinicio(){
    var valor = $('#opc_inicial').val();
    if (valor==1) {
      //Existen antecedentes
      document.getElementById('val_inicio_proceso').innerHTML = " "
      +"<div class='jumbotron'> "
      +"       <div class='row'>"
      +"         <div class='col'>"
      +"          <label>ID Actividad</label>"
      +"           <input type='text' class='form form-control' id='id_mant_n'>"
      +"         </div>"
      +"         <div class='col'>"
      +"           <label>Numero de Serie</label>"
      +"           <input type='text' class='form form-control' id='nserie_nn'>"
      +"         </div>"
      +"       </div>"
      +"       <div class='row'>"
      +"         <div class='col'><br><center><a class='btn btn-success' onclick='valactividad();'> Verificar   </a></center></div>"
      +"       </div>"
      +"     </div>";
    }else{
      document.getElementById('val_inicio_proceso').innerHTML = "<div class='alert alert-warning' ><h4>¡Excelente! Sigue completando el formulario</h4></div> ";
    }
  }
            
  function valactividad(){
    var id = $('#id_mant_n').val();
    var serie = $('#nserie_nn').val();
    if (id!="" && serie!="") {
      $.ajax({
      url:'../operaciones/dashboard_operaciones.php',
      data:{'acc':'val_actividad','id':id,'serie':serie},
      type:'POST',
      success:function(data)
      {
        if (data==1) {
          //Si se encontro
          $('#nserie').val(serie);
          var id = $('#id_mant_n').val();
          accion_equipo();

          document.getElementById('nserie').disabled = true;
          $('#opc_inicial').attr('disabled', 'disabled');
          document.getElementById('val_inicio_proceso').innerHTML = "<div class='alert alert-success' ><center><h4>¡Excelente! Actividad Encontrada</h4></center></div> "
          +"<input type='hidden' id='id_mant' value='"+id+"'>";
        }else{
          alert('¡Actividad no encontrada!');
        }
      }
    });
    }else{
      alert('¡Debes Ingresar un ID asociado y un numero de serie para verificar!');
    }
    
  }

  //Agregar la actividad
  function agregar_actividad(){
    //Validacion de campos vacios
    //Extraccion de variables
    var id_mant = $('#id_mant').val(); //campo de busqueda
    var serie_equipo = $('#nserie').val();
    //var id_r
    //var fecha
    var cod_falla  = $('#falla_presentada').val();
    var p_entrega   = $('#dui_cliente').val();  //campo validado con la busqueda
    var observacion   = $('#observacion-actividad').val();
    var act_preliminar = $('input:radio[name=act_preliminar]:checked').val();
    //var cod_estab
    var tipo_actividad =  $('#tipo_actividad').val();
    var tipo_trabajo = $('#tipo_trabajo').val();

  if (serie_equipo!="" && p_entrega!="" && observacion!="" && act_preliminar!="" && tipo_actividad!="" && tipo_trabajo!="") {

  $.ajax({
    url:'../operaciones/actividades_operaciones.php',
    data:{
      'acc':'ingresar_actividad',
      'serie_equipo':serie_equipo,
      'id_mant':id_mant,
      'cod_falla':cod_falla,
      'p_entrega':p_entrega,
      'observacion':observacion,
      'act_preliminar':act_preliminar,
      'tipo_actividad':tipo_actividad,
      'tipo_trabajo':tipo_trabajo
    },
    type:'POST',
    success : function(data)
    {
     if (data==1) {
      $('#modalconfirmacion').modal('show');
    }
    }
  });



  }else{
    alert('¡Existen parametros obligatorios en el fomulario! <br> No puedes dejar campos vacios.');
  }

  }
  //Agregar Actividad
</script>