<?php 
//incluir la conexion de base de datos
require "../config/Conexion.php";
class Asistencia{


	//implementamos nuestro constructor
public function __construct(){

}


//listar registros
public function listar(){
	date_default_timezone_set('America/Lima');
	$fechaAtual=date('Y-m-d');
	$sql="SELECT a.idasistencia,a.dni,a.fecha,a.hora_entrada,a.hora_salida,u.nombre,u.apellido,c.nombre as cargo FROM asistencia a INNER JOIN usuarios u ON a.dni=u.idusuarios INNER JOIN cargos c ON u.idCargo=c.idcargos WHERE a.dni=u.idusuarios AND a.fecha='$fechaAtual' ORDER BY a.idasistencia DESC";
	return ejecutarConsulta($sql);
}

public function listarhoy(){
	date_default_timezone_set('America/Lima');
	$fechaAtual=date('Y-m-d');
	//$sql="SELECT a.idasistencia,a.dni,a.fecha,a.hora_entrada,a.hora_salida,u.nombre,u.apellido,c.nombre as cargo, t.hora_entrada AS entrada, t.hora_salida AS salida, t.tolerancia AS tolerancia FROM asistencia a INNER JOIN usuarios u ON a.dni=u.idusuarios INNER JOIN cargos c ON u.idCargo=c.idcargos INNER JOIN turnos t ON t.idturnos=u.idTurno WHERE a.dni=u.idusuarios AND a.fecha='$fechaAtual' GROUP BY a.dni ORDER BY a.idasistencia DESC";
	$sql="SELECT a.idasistencia,a.dni,a.fecha,a.hora_entrada,a.hora_salida,u.nombre,u.apellido,c.nombre as cargo, t.hora_entrada AS entrada, t.hora_salida AS salida, t.tolerancia AS tolerancia FROM asistencia a INNER JOIN usuarios u ON a.dni=u.idusuarios INNER JOIN cargos c ON u.idCargo=c.idcargos INNER JOIN turnos t ON t.idturnos=a.turno WHERE a.contEnt='1' AND a.fecha='$fechaAtual' ORDER BY a.idasistencia DESC";
	return ejecutarConsulta($sql);
}

public function listaru($idusuario){
	//$sql="SELECT a.idasistencia,a.codigo_persona,a.fecha_hora,a.tipo,a.fecha,u.nombre,u.apellidos,d.nombre as departamento FROM asistencia a INNER JOIN usuarios u INNER JOIN departamento d ON u.iddepartamento=d.iddepartamento WHERE a.codigo_persona=u.codigo_persona AND u.idusuario='$idusuario'";
	$sql="SELECT a.idasistencia,a.dni,a.fecha,a.hora_entrada,a.hora_salida,u.nombre,u.apellido,c.nombre as cargo FROM asistencia a INNER JOIN usuarios u INNER JOIN cargos c ON u.idCargo=c.idcargos WHERE a.dni=u.idusuarios AND u.idusuarios='$idusuario' ORDER BY a.idasistencia DESC";
	return ejecutarConsulta($sql);
}

public function listar_asistencia($fecha_inicio,$fecha_fin,$dni){
	if($dni=="Todos"){
		$sql="SELECT a.idasistencia,a.dni,a.fecha,a.hora_entrada,a.hora_salida,u.nombre,u.apellido, t.hora_entrada AS entrada, t.hora_salida AS salida, t.tolerancia AS tolerancia FROM asistencia a INNER JOIN usuarios u ON a.dni=u.idusuarios INNER JOIN turnos t ON t.idturnos=a.turno WHERE DATE(a.fecha)>='$fecha_inicio' AND DATE(a.fecha)<='$fecha_fin' ORDER BY a.idasistencia";
	}else{
		$sql="SELECT a.idasistencia,a.dni,a.fecha,a.hora_entrada,a.hora_salida,u.nombre,u.apellido, t.hora_entrada AS entrada, t.hora_salida AS salida, t.tolerancia AS tolerancia FROM asistencia a INNER JOIN usuarios u ON a.dni=u.idusuarios INNER JOIN turnos t ON t.idturnos=a.turno WHERE DATE(a.fecha)>='$fecha_inicio' AND DATE(a.fecha)<='$fecha_fin' AND a.dni='$dni'";
	}
	return ejecutarConsulta($sql);
}

public function listar_asistencia_tardanza($fecha_inicio,$fecha_fin,$dni){
	if($dni=="Todos"){
		$sql="SELECT a.idasistencia,a.dni,a.fecha,a.hora_entrada,u.nombre,u.apellido, t.hora_entrada AS entrada, t.tolerancia AS tolerancia FROM asistencia a INNER JOIN usuarios u ON a.dni=u.idusuarios INNER JOIN turnos t ON t.idturnos=a.turno WHERE DATE(a.fecha)>='$fecha_inicio' AND DATE(a.fecha)<='$fecha_fin' AND a.contEnt='1' ORDER BY a.idasistencia";
	}else{
		$sql="SELECT a.idasistencia,a.dni,a.fecha,a.hora_entrada,u.nombre,u.apellido, t.hora_entrada AS entrada, t.tolerancia AS tolerancia FROM asistencia a INNER JOIN usuarios u ON a.dni=u.idusuarios INNER JOIN turnos t ON t.idturnos=a.turno WHERE DATE(a.fecha)>='$fecha_inicio' AND DATE(a.fecha)<='$fecha_fin' AND a.contEnt='1' AND a.dni='$dni' ORDER BY a.idasistencia";
	}
	return ejecutarConsulta($sql);
}

public function listar_asistencia_salida($fecha_inicio,$fecha_fin,$dni){
	if($dni=="Todos"){
		$sql="SELECT a.idasistencia,a.dni,a.fecha,a.hora_salida,u.nombre,u.apellido, t.hora_salida AS salida FROM asistencia a INNER JOIN usuarios u ON a.dni=u.idusuarios INNER JOIN turnos t ON t.idturnos=a.turno WHERE DATE(a.fecha)>='$fecha_inicio' AND DATE(a.fecha)<='$fecha_fin' AND a.contSal='1' ORDER BY a.idasistencia";
	}else{
		$sql="SELECT a.idasistencia,a.dni,a.fecha,a.hora_salida,u.nombre,u.apellido, t.hora_salida AS salida FROM asistencia a INNER JOIN usuarios u ON a.dni=u.idusuarios INNER JOIN turnos t ON t.idturnos=a.turno WHERE DATE(a.fecha)>='$fecha_inicio' AND DATE(a.fecha)<='$fecha_fin' AND a.contSal='1' AND a.dni='$dni' ORDER BY a.idasistencia";
	}
	return ejecutarConsulta($sql);
}


public function listar_entrada($fecha_inicio,$fecha_fin,$dni){
	if($dni=="Todos"){
		$sql="SELECT a.idasistencia,a.dni,a.fecha,a.hora_entrada,u.nombre,u.apellido FROM asistencia a INNER JOIN usuarios u ON a.dni=u.idusuarios WHERE DATE(a.fecha)>='$fecha_inicio' AND DATE(a.fecha)<='$fecha_fin' AND a.contEnt='1' ORDER BY a.idasistencia";
	}else{
		$sql="SELECT a.idasistencia,a.dni,a.fecha,a.hora_entrada,u.nombre,u.apellido FROM asistencia a INNER JOIN usuarios u ON a.dni=u.idusuarios WHERE DATE(a.fecha)>='$fecha_inicio' AND DATE(a.fecha)<='$fecha_fin' AND a.contEnt='1' AND a.dni='$dni' ORDER BY a.idasistencia";
	}
	return ejecutarConsulta($sql);
}

public function listar_salida($fecha_inicio,$fecha_fin,$dni){
	if($dni=="Todos"){
		$sql="SELECT a.idasistencia,a.dni,a.fecha,a.hora_salida,u.nombre,u.apellido FROM asistencia a INNER JOIN usuarios u ON a.dni=u.idusuarios WHERE DATE(a.fecha)>='$fecha_inicio' AND DATE(a.fecha)<='$fecha_fin' AND a.contSal='1' ORDER BY a.idasistencia";
	}else{
		$sql="SELECT a.idasistencia,a.dni,a.fecha,a.hora_salida,u.nombre,u.apellido FROM asistencia a INNER JOIN usuarios u ON a.dni=u.idusuarios WHERE DATE(a.fecha)>='$fecha_inicio' AND DATE(a.fecha)<='$fecha_fin' AND a.contSal='1' AND a.dni='$dni' ORDER BY a.idasistencia";
	}
	return ejecutarConsulta($sql);
}


}

 ?>
