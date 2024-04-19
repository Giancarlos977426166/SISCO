<?php 
//incluir la conexion de base de datos
require "../admin/config/Conexion.php";
class Asistencia{


	//implementamos nuestro constructor
	public function __construct(){

	}


	public function verificarcodigo_persona($codigo_asistencia){
	 	$sql = "SELECT idusuarios, idTurno, nombre, apellido, estado, imagen FROM usuarios WHERE codigo_asistencia='$codigo_asistencia'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//En caso de Cambio de Código actualizar la ultima entrada de la asistencia con el codigo nuevo
	public function seleccionarcodigo_persona($codigo_asistencia){
	    $sql = "SELECT idasistencia, fecha, contEnt, contSal, controlador FROM asistencia WHERE codigo_asistencia = '$codigo_asistencia' order by idasistencia desc limit 1";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function seleccionar_registro_anterior($id, $dni){
	    $sql = "SELECT idasistencia, fecha, contEnt, contSal, controlador FROM asistencia WHERE idasistencia < '$id' AND dni = '$dni' order by idasistencia desc limit 1";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function registrar_entrada($dni, $codigo_asistencia, $contE, $controlador, $tur){
		date_default_timezone_set('America/Lima');
		$fecha = date("Y-m-d");
		$hora = date("H:i:s");//INSERT INTO `asistencia` (`idasistencia`, `dni`, `codigo_asistencia`, `fecha`, `hora_entrada`, `hora_salida`, `controlador`) VALUES (NULL, '88888888', '99999999', '2020-05-12', '08:00:00', NULL, '1')
	    $sql = "INSERT INTO asistencia (dni, codigo_asistencia, fecha, hora_entrada, contEnt, contSal, controlador, turno) VALUES ('$dni', '$codigo_asistencia', '$fecha', '$hora', '$contE','1' , '$controlador', '$tur')";
		return ejecutarConsulta($sql);
	}

	public function registrar_entrada_controlador($id){
	 	$sql = "UPDATE asistencia SET contSal = '1', controlador = '2' WHERE idasistencia = '$id'";
	    return ejecutarConsulta($sql);
	}

	public function registrar_salida($id, $contS, $controlador){
		date_default_timezone_set('America/Lima');
		$fecha = date("Y-m-d");
		$hora = date("H:i:s");
	 	$sql = "UPDATE asistencia SET hora_salida = '$hora', contSal = '$contS', controlador = '$controlador' WHERE idasistencia = '$id'";
	    return ejecutarConsulta($sql);
	}

	public function registro_salida_anterior($id){
	    $sql = "UPDATE asistencia SET contSal = '0' WHERE idasistencia = '$id'";
	    return ejecutarConsulta($sql);
	}

	public function registrar_salida_controlador($id){
	 	$sql = "UPDATE asistencia SET contSal = '1', controlador = '2' WHERE idasistencia = '$id'";
	    return ejecutarConsulta($sql);
	}
}

?>
