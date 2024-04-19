<?php 
//incluir la conexion de base de datos
require "../config/Conexion.php";
class Motivo_papeleta{


	//implementamos nuestro constructor
public function __construct(){

}

//metodo insertar regiustro
public function insertar($nombre,$descripcion,$idusuario){
	$sql="INSERT INTO motivos_papeleta (nombre,descripcion,user_create) VALUES ('$nombre','$descripcion','$idusuario')";
	return ejecutarConsulta($sql);
}

public function editar($idmotivo,$nombre,$descripcion,$idusuario){
	$sql="UPDATE motivos_papeleta SET nombre='$nombre',descripcion='$descripcion',user_create='$idusuario' 
	WHERE idmotivos='$idmotivo'";
	return ejecutarConsulta($sql);
}

public function borrar($idmotivo){
	$sql="DELETE FROM motivos_papeleta WHERE idmotivos='$idmotivo'";
	return ejecutarConsulta($sql);
}

public function desactivar($idmotivo){
	$sql="UPDATE motivos_papeleta SET fecha_create='0' WHERE idmotivos='$idmotivo'";
	return ejecutarConsulta($sql);
}

public function activar($idmotivo){
	$sql="UPDATE motivos_papeleta SET fecha_create='1' WHERE idmotivos='$idmotivo'";
	return ejecutarConsulta($sql);
}

//metodo para mostrar registros
public function mostrar($idmotivo){
	$sql="SELECT * FROM motivos_papeleta WHERE idmotivos='$idmotivo'";
	return ejecutarConsultaSimpleFila($sql);
}

//listar registros
public function listar(){
	$sql="SELECT * FROM motivos_papeleta";
	return ejecutarConsulta($sql);
}
//listar y mostrar en selct
public function select(){
	$sql="SELECT * FROM motivos_papeleta";
	return ejecutarConsulta($sql);
}

/*public function regresaRolMotivo($motivo){
	$sql="SELECT nombre FROM motivos where idmotivos='$motivo'";		
	return ejecutarConsulta($sql);
}*/



}

 ?>
