<?php 
require_once("include/seguridad.php");

require_once("include/conexion.php");

//class listadoVarios{

//Se desea crear un nuevo alumno

if (@$_GET['acc']=="nuevo") {
	ingresarAlumno();
}elseif (@$_GET['acc']=="editar") {
	echo editarAlumno();
}elseif (@$_GET['acc']=="borrar") {
	eliminarAlumno();
}elseif (@$_GET['acc']=="3") {
	echo listarMunicipios($_POST['departamento_alumno']);
}elseif (@$_GET['acc']=="4") {
	echo detalleres($_POST['responsable']);

}

function ingresarAlumno(){
		@include("include/conexion.php");  		
		//Variables del formulario 
	 	//$codigoalumno = $_POST['codigo_alumno'];
		$nie = $_POST['nie_alumno'];
		$nombres = $_POST['nombre_alumno'];
		$apellidos = $_POST['apellidos_alumno'];
		$fecha_nacimiento = $_POST['dtpNacimiento'];
		$codigo_estado_civil = $_POST['estadocivil'];
		$dui = $_POST['dui_alumno'];
		$carnet_minoridad = $_POST['minoridad_alumno'];
		$telefono = $_POST['telefono_alumno'];
		$correo = $_POST['email_alumno'];
		$codigo_departamento = $_POST['departamento_alumno'];
		$codigo_municipio = $_POST['municipio'];
		$direccion = $_POST['direccion_alumno'];
		$observaciones = $_POST['observaciones_alumno'];

		if ($_POST['responsable']=="") {
			$responsable = "NULL";
		}else{
			$var = $_POST['responsable'];
			$responsable= "'$var'";
		}

		$insert = "INSERT INTO `registro_academico`.`alumno` 
			(`nie`, 
			`nombres`, 
			`apellidos`, 
			`fecha_nacimiento`,
			 `codigo_estado_civil`, 
			 `dui`, 
			 `carnet_minoridad`, 
			 `telefono`, 
			 `correo`, 
			 `codigo_departamento`, 
			 `codigo_municipio`, 
			 `direccion`, 
			 `observaciones`,
			 `codigo_responsable`,codigo_estado) 
			 VALUES  
			 ('$nie', 
			  '$nombres', 
			  '$apellidos', 
			  '$fecha_nacimiento', 
			  '$codigo_estado_civil', 
			  '$dui', 
			  '$carnet_minoridad', 
			  '$telefono', 
			  '$correo', 
			  '$codigo_departamento', 
			  '$codigo_municipio', 
			  '$direccion', 
			  '$observaciones',
			  $responsable,
			  '1')";
        $query = mysqli_query($conex, $insert);
        if($query){
            echo 1;
        }else{
        	echo 2;
        }
        mysqli_close($conex);
        exit();
}

function editarAlumno(){

		@include("include/conexion.php");  		
		//Variables del formulario 
	 	$codigoalumno = $_POST['codigo_alumno'];
		$nie = $_POST['nie_alumno'];
		$nombres = $_POST['nombre_alumno'];
		$apellidos = $_POST['apellidos_alumno'];
		$fecha_nacimiento = $_POST['dtpNacimiento'];
		$codigo_estado_civil = $_POST['estadocivil'];
		$dui = $_POST['dui_alumno'];
		$carnet_minoridad = $_POST['minoridad_alumno'];
		$telefono = $_POST['telefono_alumno'];
		$correo = $_POST['email_alumno'];
		$codigo_departamento = $_POST['departamento_alumno'];
		$codigo_municipio = $_POST['municipio'];
		$direccion = $_POST['direccion_alumno'];
		$observaciones = $_POST['observaciones_alumno'];

		if ($_POST['responsable']=="") {
			$responsable = "NULL";
		}else{
			$var = $_POST['responsable'];
			$responsable= "'$var'";
		}
		$insert ="UPDATE 
		alumno
		 SET
		 nie='$nie',
		 nombres='$nombres',
		 apellidos='$apellidos',
		 fecha_nacimiento='$fecha_nacimiento',
		 codigo_estado_civil='$codigo_estado_civil',
		 dui='$dui',
		 carnet_minoridad='$carnet_minoridad',
		 telefono='$telefono',
		 correo='$correo',
		 codigo_departamento='$codigo_departamento',
		 codigo_municipio='$codigo_municipio',
		 direccion='$direccion',
		 observaciones='$observaciones',
		 codigo_responsable= $responsable
		 WHERE 
		 codigo_alumno= '$codigoalumno'";
//		echo $insert;

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
function llenarAlumno($id_alumno){
	//Aqui se hace el llenado de las cosas, y posteriormente se sacan laos datos con las variables
//		$GLOBALS['codigoalumno'] = $id_alumno;
		
		@include("include/conexion.php");

		$consulta = "
				SELECT 
				al.codigo_alumno,
				al.nie,
				al.nombres,
				al.apellidos,
				al.fecha_nacimiento,
				al.codigo_estado_civil,
				estado_civil.nombre as nestado_civil,
				al.dui,
				al.carnet_minoridad,
				al.telefono,
				al.correo,
				al.codigo_departamento,
				departamentos.nombre as ndepartamentos,
				al.codigo_municipio,
				municipios.nombre as nmunicipios,
				al.direccion,
				al.observaciones,
				al.codigo_responsable
				FROM 
				alumno as al  
				JOIN departamentos ON departamentos.codigo_departamento = al.codigo_departamento 
				JOIN municipios ON municipios.codigo_municipio= al.codigo_municipio
				JOIN estado_civil ON estado_civil.codigo_estado_civil = al.codigo_estado_civil
		WHERE codigo_alumno = '$id_alumno'";
		
		$query = mysqli_query($conex, $consulta); 
		
		while($rows = mysqli_fetch_array($query))
		{
			$GLOBALS['codigo_alumno'] = $rows['codigo_alumno'];
			$GLOBALS['nie'] = $rows['nie'];
			$GLOBALS['nombres'] = $rows['nombres'];
			$GLOBALS['apellidos'] = $rows['apellidos'];
			$GLOBALS['fecha_nacimiento'] = $rows['fecha_nacimiento'];
			$GLOBALS['codigo_estado_civil'] = $rows['codigo_estado_civil'];
			$GLOBALS['estado_civil.nombre'] = $rows['nestado_civil'];
			$GLOBALS['dui'] = $rows['dui'];
			$GLOBALS['carnet_minoridad'] = $rows['carnet_minoridad'];
			$GLOBALS['telefono'] = $rows['telefono'];
			$GLOBALS['correo'] = $rows['correo'];
			$GLOBALS['codigo_departamento'] = $rows['codigo_departamento'];
			$GLOBALS['departamento.nombre'] = $rows['ndepartamentos'];
			$GLOBALS['codigo_municipio'] = $rows['codigo_municipio'];
			$GLOBALS['municipios.nombre']= $rows['nmunicipios'];
			$GLOBALS['direccion'] = $rows['direccion'];
			$GLOBALS['observaciones'] = $rows['observaciones'];
			$GLOBALS['dui_responsable']= $rows['codigo_responsable'];
			
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

function detalleres($res)
{
		@include("include/conexion.php");
		$consulta = "SELECT * FROM responsable WHERE codigo_responsable = '$res'";
		$query = mysqli_query($conex, $consulta); 
		$retorno = "";
		while($rows = mysqli_fetch_array($query))
		{
			$retorno = $rows['nombres']."  ".$rows['apellidos']."  TEL: ".$rows['telefono']." <br> <a href='responsable_form.php?codigo_a=$res'>Editar</a> ";

        }
    mysqli_close($conex);	
    return  $retorno;	
}
//}
 ?>
