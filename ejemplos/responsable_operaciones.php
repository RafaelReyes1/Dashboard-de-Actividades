<?php 
require_once("include/seguridad.php");

require_once("include/conexion.php");

//class listadoVarios{

//Se desea crear un nuevo alumno

if (@$_GET['acc']=="nuevo") {
	ingresarResponsable();
}elseif (@$_GET['acc']=="editar") {
	echo editar();
}elseif (@$_GET['acc']=="borrar") {
	
}elseif (@$_GET['acc']=="3") {
	
	echo listarMunicipios($_POST['departamento_alumno']);
}elseif (@$_GET['acc']=="4") {
	echo buscarAlumno($_POST['codigo_alumno']);
}

function ingresarResponsable(){
		@include("include/conexion.php");  		
		//Variables del formulario 
	 	
		$nombres = $_POST['nombre_alumno'];
		$apellidos = $_POST['apellidos_alumno'];
		$fecha_nacimiento = $_POST['dtpNacimiento'];
		$codigo_estado_civil = $_POST['estadocivil'];
		$dui = $_POST['dui_alumno'];
		$telefono = $_POST['telefono_alumno'];
		$codigo_departamento = $_POST['departamento_alumno'];
		$codigo_municipio = $_POST['municipio'];
		$direccion = $_POST['direccion_alumno'];
		$codigo_parentesco = $_POST['parentesco'];

		$insert = "INSERT INTO responsable
			(`nombres`, 
			`apellidos`, 
			`fecha_nacimiento`,
			 `codigo_estado_civil`, 
			 `dui`, 
			 `telefono`, 
			 `codigo_departamento`, 
			 `codigo_municipio`, 
			 `direccion`, 
			 `codigo_parentesco`) 
			 VALUES  
			  ('$nombres', 
			  '$apellidos', 
			  '$fecha_nacimiento', 
			  '$codigo_estado_civil', 
			  '$dui', 
			  '$telefono', 
			  '$codigo_departamento', 
			  '$codigo_municipio', 
			  '$direccion', 
			  '$codigo_parentesco')";
			  //echo $insert;
        $query = mysqli_query($conex, $insert);
        if($query){
            echo 1;
        }else{
        	echo 2;
        }
        mysqli_close($conex);
        exit();
        
}		

function editar(){

		@include("include/conexion.php");  		
		//Variables del formulario 
		$dui = $_POST['dui_g'];
		$nombres = $_POST['nombre_alumno'];
		$apellidos = $_POST['apellidos_alumno'];
		$fecha_nacimiento = $_POST['dtpNacimiento'];
		$codigo_estado_civil = $_POST['estadocivil'];
		$telefono = $_POST['telefono_alumno'];
		$codigo_departamento = $_POST['departamento_alumno'];
		$codigo_municipio = $_POST['municipio'];
		$direccion = $_POST['direccion_alumno'];
		$parentesco = $_POST['parentesco'];

		$insert ="UPDATE 
		responsable
		 SET
		 nombres='$nombres',
		 apellidos='$apellidos',
		 fecha_nacimiento='$fecha_nacimiento',
		 codigo_estado_civil='$codigo_estado_civil',
		 telefono='$telefono',
		 codigo_departamento='$codigo_departamento',
		 codigo_municipio='$codigo_municipio',
		 direccion='$direccion',
		 codigo_parentesco = '$parentesco'
		 WHERE 
		 codigo_responsable= '$dui'
		";
		//echo $insert;

		$query = mysqli_query($conex, $insert);
        if($query){
            echo 1;
        }else{
        	echo 2;
        }
        mysqli_close($conex);
        exit();
        
        
}		



function eliminarAlumno(){}		
function listarDepartamentos(){
		@include("include/conexion.php");   
		$consulta = "SELECT * FROM departamentos";
		$query = mysqli_query($conex, $consulta); 
		$retorno = "";
		while($rows = mysqli_fetch_array($query))
		{
			$id_depar = $rows['codigo_departamento'];
			$nombre = $rows['nombre']; 
			$retorno = $retorno.' <option value="'.$id_depar.'">'.$nombre.'</option>';
        }
    mysqli_close($conex);	
    return  $retorno;		
}
function llenar($codigo){

	//Consulta para el llenado del responsable
		//$GLOBALS['codigoalumno'] = $id_alumno;
		@include("include/conexion.php");
		$consulta = "
					SELECT 
					rp.dui,
					rp.nombres,
					rp.apellidos,
					rp.fecha_nacimiento,
					rp.codigo_estado_civil,
					estado_civil.nombre AS  nestado_civil,
					rp.telefono,
					rp.codigo_departamento,
					departamentos.nombre AS ndepartamentos,
					rp.codigo_municipio,
					municipios.nombre AS nmunicipios,
					rp.direccion,
					rp.codigo_parentesco,
					parentesco.nombre AS nparentesco
					FROM 
					responsable AS rp
					JOIN estado_civil ON estado_civil.codigo_estado_civil = rp.codigo_estado_civil
					JOIN departamentos ON departamentos.codigo_departamento= rp.codigo_departamento
					JOIN municipios ON municipios.codigo_municipio = rp.codigo_municipio
					JOIN parentesco ON parentesco.codigo_parentesco = rp.codigo_parentesco
					WHERE
					rp.codigo_responsable= '$codigo'
					";
		$query = mysqli_query($conex, $consulta); 
		
		while($rows = mysqli_fetch_array($query))
		{
			$GLOBALS['dui'] = $rows['dui'];

			$GLOBALS['nombres'] = $rows['nombres'];
			$GLOBALS['apellidos'] = $rows['apellidos'];
			$GLOBALS['fecha_nacimiento'] = $rows['fecha_nacimiento'];
			$GLOBALS['codigo_estado_civil'] = $rows['codigo_estado_civil'];
			$GLOBALS['estado_civil.nombre'] = $rows['nestado_civil'];
			$GLOBALS['telefono'] = $rows['telefono'];
			$GLOBALS['codigo_departamento'] = $rows['codigo_departamento'];
			$GLOBALS['departamento.nombre'] = $rows['ndepartamentos'];
			$GLOBALS['codigo_municipio'] = $rows['codigo_municipio'];
			$GLOBALS['municipios.nombre']= $rows['nmunicipios'];
			$GLOBALS['direccion'] = $rows['direccion'];
			$GLOBALS['codigo_parentesco'] = $rows['codigo_parentesco'];
			$GLOBALS['parentesco.nombre']= $rows['nparentesco'];
        }
    mysqli_close($conex);  
}

function listarMunicipios($coddepar){
		@include("include/conexion.php");		

		$consulta = "SELECT * FROM municipios WHERE codigo_departamento = '$coddepar'";

		$query = mysqli_query($conex, $consulta); 
		$retorno = "";
		while($rows = mysqli_fetch_array($query))
		{
			$id = $rows['codigo_municipio'];
			$nombre = $rows['nombre']; 
			$retorno = $retorno.' <option value="'.$id.'">'.$nombre.'</option>';
        }
    mysqli_close($conex);	
    echo  $retorno;		
}
 function listarEstadoCivil()
{
		@include("include/conexion.php");
		$consulta = "SELECT * FROM estado_civil";
		$query = mysqli_query($conex, $consulta); 
		$retorno = "";
		while($rows = mysqli_fetch_array($query))
		{
			$id = $rows['codigo_estado_civil'];
			$nombre = $rows['nombre']; 
			$retorno = $retorno.' <option value="'.$id.'">'.$nombre.'</option>';
        }
    mysqli_close($conex);	
    return  $retorno;	
}

function listarParentesco()
{
		@include("include/conexion.php");
		$consulta = "SELECT * FROM parentesco";
		$query = mysqli_query($conex, $consulta); 
		$retorno = "";
		while($rows = mysqli_fetch_array($query))
		{
			$id = $rows['codigo_parentesco'];
			$nombre = $rows['nombre']; 
			$retorno = $retorno.' <option value="'.$id.'">'.$nombre.'</option>';
        }
    mysqli_close($conex);	
    return  $retorno;	
}

function buscarAlumno($cod)
{
	@include("include/conexion.php");
	$consulta = "SELECT COUNT(codigo_alumno) as busqueda,nombres,apellidos FROM alumno WHERE codigo_alumno='$cod'";
	$query = mysqli_query($conex, $consulta); 

	while($rows = mysqli_fetch_array($query))
	{
		$contador = $rows['busqueda'];
		$nombre = $rows['nombres'] ."  ". $rows['apellidos']; 
		
    }
    mysqli_close($conex);	
    if ($contador==1) {
    	return $nombre;
    }else{
    	return "Alumno no encontrado";
    }
}

//}
 ?>
