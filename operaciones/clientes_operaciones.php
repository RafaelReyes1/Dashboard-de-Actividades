<?php 
if ($_POST['acc']=='listar_cliente') {
	
@include("../include/conexion.php");
		$consulta = "
		SELECT
		c_eclientes.dui as dui,
		c_eclientes.nombre as nombre,
		c_eclientes.apellido as apellido,
		c_eclientes.numero_telefonico as numero_telefonico,
		c_eclientes.email as email,
		c_empresas.nombre as empresa
		FROM c_eclientes JOIN c_empresas ON c_empresas.id = c_eclientes.empresa WHERE c_eclientes.dui='".$_POST['dui']."'";
		$query = mysqli_query($conex, $consulta); 
		if (mysqli_num_rows($query)==1) {
			if($rows = mysqli_fetch_array($query))
			{
				//Se contruye el formulario con los datos obtenidos de la consulta ?>
				<input type="hidden" name="dui_cliente" id="dui_cliente" value="<?= $rows['dui']; ?>">
                <div class="row">
                    <div class="col"><label>DUI</label></div>
                    <div class="col"><label><?= $rows['dui']; ?></label></div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col"><label>Nombre</label></div>
                    <div class="col">
                      <label><?= $rows['nombre']; ?></label>
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col"><label>Apellidos</label></div>
                    <div class="col">
                      <label><?= $rows['apellido']; ?></label>
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col"><label>Telefono</label></div>
                    <div class="col" >
                      <label><?= $rows['numero_telefonico']; ?></label>
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col"><label>Correo Electronico</label></div>
                    <div class="col" >
                      <label><?= $rows['email']; ?></label>
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col"><label>Empresa</label></div>
                    <div class="col">
                      <div class="row">
                        <div class="col">
                          <label><?= $rows['empresa']; ?></label>

                        </div>
                        
                      </div>
                      <br>
                      <!--Formulario de detalles de Empresa--
                      <div class="row">
                        <div class="col">
                          <div class="row">
                            <div class="formulario_empresa_visualizacion">
                              <div class="row">
                                <div class="col"><label><strong>Nombre</strong></label></div>
                                <div class="col"><label for="">Nombre de la Empresa</label></div>
                              </div>
                              <br>
                              <div class="row">
                                <div class="col"><label><strong>Direccion</strong></label></div>
                                <div class="col"><label>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Suscipit natus quaerat in esse inventore tempore pariatur fugit vero labore voluptatum quis dolor id eligendi aspernatur, architecto voluptates illo ducimus impedit.</label></div>
                              </div>
                              <br>
                              <div class="row">
                                <div class="col"><label><strong>Pais</strong></label></div>
                                <div class="col">
                                  <label>Pais de la Empresa</label>
                                </div>
                              </div>
                              <br>
                              <div class="row">
                                <div class="col"><label><strong>Numero Telefonico</strong></label></div>
                                <div class="col"><label>503 22331122</label></div>
                              </div> 
                            </div>
                          </div>
                        </div>
                      </div>
                      <!---->
                      
                      <!--Formulario de Ingreso de Empresa--
                      <div class="row">
                        <div class="col">
                          <div class="row">
                            <div class="formulario_empresa_visualizacion">
                              <div class="row">
                                <div class="col"><label>Nombre</label></div>
                                <div class="col"><input type="text" class="form-control" name=""></div>
                              </div>
                              <br>
                              <div class="row">
                                <div class="col"><label>Direccion</label></div>
                                <div class="col"><textarea class="form-control" rows="5"></textarea></div>
                              </div>
                              <br>
                              <div class="row">
                                <div class="col"><label>Pais</label></div>
                                <div class="col">
                                  <select class="form-control">
                                    <option>Pais A</option>
                                    <option>Pais B</option>
                                  </select>
                                </div>
                              </div>
                              <br>
                              <div class="row">
                                <div class="col"><label>Numero Telefonico</label></div>
                                <div class="col"><TEXTAREA class="form-control"></TEXTAREA></div>
                              </div> 
                            </div>
                          </div>
                        </div>
                      </div>
                      <!---->

                    </div>
                    <br>
                  </div>
<?php
	        }
	        }else{ ?>
				<div class="alert alert-danger">
				<center><h3>Persona no registrada<br>
					<h5>Completa el formulario siguiente para completar el registro:</h5>
				</div>
				 <label><strong>Registrar Persona</strong></label>
              <br>
				<div class="row">
                    <div class="col"><label>DUI</label></div>
                    <div class="col"><input type="text" class="form-control" maxlength="10" name="dui_n" id="dui_n"></div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col"><label>Nombre</label></div>
                    <div class="col">
                      <input type="text" class="form-control" name="nombre_cliente_n" id="nombre_cliente_n">
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col"><label>Apellidos</label></div>
                    <div class="col">
                      <input type="text"  class="form-control" name="apellido_cliente_n" id="apellido_cliente_n">
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col"><label>Telefono</label></div>
                    <div class="col" >
                      <input type="text" class="form-control" name="telefono_cliente_n" id="telefono_cliente_n">
                    </div>
                  </div>
                  <br>
                  <br>
                  <div class="row">
                    <div class="col"><label>Correo Electronico</label></div>
                    <div class="col" >
                      <input type="text" class="form-control" name="email_n" id="email_n">
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col"><label>Empresa</label></div>
                    <div class="col">
                      <div class="row">
                        <div class="col">
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
                      
                      <!--Formulario de Ingreso de Empresa--
                      <div class="row">
                        <div class="col">
                          <div class="row">
                            <div class="formulario_empresa_visualizacion">
                              <div class="row">
                                <div class="col"><label>Nombre</label></div>
                                <div class="col"><input type="text" class="form-control" name=""></div>
                              </div>
                              <br>
                              <div class="row">
                                <div class="col"><label>Direccion</label></div>
                                <div class="col"><textarea class="form-control" rows="5"></textarea></div>
                              </div>
                              <br>
                              <div class="row">
                                <div class="col"><label>Pais</label></div>
                                <div class="col">
                                  <select class="form-control">
                                    <option>Pais A</option>
                                    <option>Pais B</option>
                                  </select>
                                </div>
                              </div>
                              <br>
                              <div class="row">
                                <div class="col"><label>Numero Telefonico</label></div>
                                <div class="col"><TEXTAREA class="form-control"></TEXTAREA></div>
                              </div> 
                            </div>
                          </div>
                        </div>
                      </div>
                      <!---->

                    </div>
                    <br>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col">
                      <center><a class="btn btn-success" onclick="ingresar_cliente();">Registrar</a></center>
                    </div>
                  </div>
<?php
	}
	                
 } 
 ?>







<?php if ($_POST['acc']=="ingresar_cliente") {
	@include("../include/conexion.php");
	$consulta = "
	SELECT
	*
	FROM c_eclientes 
	WHERE dui = '".$_POST['dui']."'";
	$query = mysqli_query($conex, $consulta); 
	if (mysqli_num_rows($query)==0) {
		//Al no encontrarse el equipo, lo ingreso:
		$dui = $_REQUEST['dui'];
		$nombre = $_REQUEST['nombre'];
		$apellido = $_REQUEST['apellido'];
		$numero_telefonico = $_REQUEST['numero_telefonico'];
		$email = $_REQUEST['email'];
		$empresa = $_REQUEST['empresa'];
		

		$estado = $conex->prepare("INSERT INTO c_eclientes (dui,nombre,apellido,numero_telefonico,email,empresa) VALUES (?,?,?,?,?,?)");
		$estado->bind_param('sssssi',$dui,$nombre,$apellido,$numero_telefonico,$email,$empresa);

		$estado->execute();
		$estado->close();
		if ($estado) {
		echo $dui;
		}else{
		}

	}else{
		//El equipo si se encontro, notificar que ya esta registrado
		
	}
} ?>