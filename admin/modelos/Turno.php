<?php 
//incluir la conexion de base de datos
require "../config/Conexion.php";
class Turno{


	//implementamos nuestro constructor
public function __construct(){

}

//metodo insertar regiustro
public function insertar($nombre,$descripcion,$hora_entrada,$hora_salida,$tolerancia,$idusuario){
	$sql="INSERT INTO turnos (nombre,descripcion,hora_entrada,hora_salida,tolerancia,user_create) VALUES ('$nombre','$descripcion','$hora_entrada','$hora_salida','$tolerancia','$idusuario')";
	return ejecutarConsulta($sql);
}

public function editar($idturno,$nombre,$descripcion,$hora_entrada,$hora_salida,$tolerancia,$idusuario){
	$sql="UPDATE turnos SET nombre='$nombre',descripcion='$descripcion',hora_entrada='$hora_entrada',hora_salida='$hora_salida',tolerancia='$tolerancia',user_create='$idusuario' WHERE idturnos='$idturno'";
	return ejecutarConsulta($sql);
}

public function borrar($idturno){
	$sql="DELETE FROM turnos WHERE idturnos='$idturno'";
	return ejecutarConsulta($sql);
}

public function desactivar($idturno){
	$sql="UPDATE turnos SET fecha_create='0' WHERE idturnos='$idturno'";
	return ejecutarConsulta($sql);
}

public function activar($idturno){
	$sql="UPDATE turnos SET fecha_create='1' WHERE idturnos='$idturno'";
	return ejecutarConsulta($sql);
}

//metodo para mostrar registros
public function mostrar($idturno){
	$sql="SELECT * FROM turnos WHERE idturnos='$idturno'";
	return ejecutarConsultaSimpleFila($sql);
}

//listar registros
public function listar(){
	$sql="SELECT * FROM turnos";
	return ejecutarConsulta($sql);
}
//listar y mostrar en selct
public function select(){
	$sql="SELECT * FROM turnos";
	return ejecutarConsulta($sql);
}

public function regresaRolTurno($turno){
	$sql="SELECT nombre FROM turnos where idturnos='$idturno'";		
	return ejecutarConsulta($sql);
}



}

 ?>
