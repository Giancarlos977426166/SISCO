<?php 
//incluir la conexion de base de datos
require "../config/Conexion.php";
class Lugar_papeleta{


	//implementamos nuestro constructor
public function __construct(){

}

//metodo insertar regiustro
public function insertar($nombre,$descripcion,$idusuario){
	$sql="INSERT INTO lugar_papeleta (nombre,descripcion,user_create) VALUES ('$nombre','$descripcion','$idusuario')";
	return ejecutarConsulta($sql);
}

public function editar($idlugar,$nombre,$descripcion,$idusuario){
	$sql="UPDATE lugar_papeleta SET nombre='$nombre',descripcion='$descripcion',user_create='$idusuario' 
	WHERE idlugares='$idlugar'";
	return ejecutarConsulta($sql);
}

public function borrar($idlugar){
	$sql="DELETE FROM lugar_papeleta WHERE idlugares='$idlugar'";
	return ejecutarConsulta($sql);
}

public function desactivar($idlugar){
	$sql="UPDATE lugar_papeleta SET fecha_create='0' WHERE idlugares='$idlugar'";
	return ejecutarConsulta($sql);
}

public function activar($idlugar){
	$sql="UPDATE lugar_papeleta SET fecha_create='1' WHERE idlugares='$idlugar'";
	return ejecutarConsulta($sql);
}

//metodo para mostrar registros
public function mostrar($idlugar){
	$sql="SELECT * FROM lugar_papeleta WHERE idlugares='$idlugar'";
	return ejecutarConsultaSimpleFila($sql);
}

//listar registros
public function listar(){
	$sql="SELECT * FROM lugar_papeleta";
	return ejecutarConsulta($sql);
}
//listar y mostrar en selct
public function select(){
	$sql="SELECT * FROM lugar_papeleta";
	return ejecutarConsulta($sql);
}

/*public function regresaRolMotivo($motivo){
	$sql="SELECT nombre FROM motivos where idmotivos='$motivo'";		
	return ejecutarConsulta($sql);
}*/



}

 ?>
