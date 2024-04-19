<?php 
//incluir la conexion de base de datos
require "../config/Conexion.php";
class Tipousuario{


	//implementamos nuestro constructor
public function __construct(){

}

//metodo insertar regiustro
public function insertar($nombre,$descripcion,$idusuario){
	//date_default_timezone_set('America/Lima');
	//$fechacreada=date('Y-m-d H:i:s');
	$sql="INSERT INTO tipousuario (nombre,descripcion,user_create) VALUES ('$nombre','$descripcion','$idusuario')";
	return ejecutarConsulta($sql);
}

public function editar($idtipousuario,$nombre,$descripcion,$idusuario){
	$sql="UPDATE tipousuario SET nombre='$nombre',descripcion='$descripcion',user_create='$idusuario' 
	WHERE idtipousuario='$idtipousuario'";
	return ejecutarConsulta($sql);
}

public function borrar($idtipousuario){
	$sql="DELETE FROM tipousuario WHERE idtipousuario='$idtipousuario'";
	return ejecutarConsulta($sql);
}

public function desactivar($idtipousuario){
	$sql="UPDATE tipousuario SET fecha_create='0' WHERE idtipousuario='$idtipousuario'";
	return ejecutarConsulta($sql);
}

public function activar($idtipousuario){
	$sql="UPDATE tipousuario SET fecha_create='1' WHERE idtipousuario='$idtipousuario'";
	return ejecutarConsulta($sql);
}

//metodo para mostrar registros
public function mostrar($idtipousuario){
	$sql="SELECT * FROM tipousuario WHERE idtipousuario='$idtipousuario'";
	return ejecutarConsultaSimpleFila($sql);
}

//listar registros
public function listar(){
	$sql="SELECT * FROM tipousuario";
	return ejecutarConsulta($sql);
}
//listar y mostrar en selct
public function select(){
	$sql="SELECT * FROM tipousuario";
	return ejecutarConsulta($sql);
}
}

 ?>
