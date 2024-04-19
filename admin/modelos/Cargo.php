<?php 
//incluir la conexion de base de datos
require "../config/Conexion.php";
class Cargo{


	//implementamos nuestro constructor
public function __construct(){

}

//metodo insertar regiustro
public function insertar($nombre,$descripcion,$idusuario,$idDepartamento){
	//date_default_timezone_set('America/Lima');
	//$fechacreada=date('Y-m-d H:i:s');
	$sql="INSERT INTO cargos (nombre,descripcion,idDepartamento,user_create) VALUES ('$nombre','$descripcion','$idDepartamento','$idusuario')";
	return ejecutarConsulta($sql);
}

public function editar($idcargo,$nombre,$descripcion,$idusuario,$idDepartamento){
	$sql="UPDATE cargos SET nombre='$nombre',descripcion='$descripcion',idDepartamento='$idDepartamento' ,user_create='$idusuario' WHERE idcargos='$idcargo'";
	return ejecutarConsulta($sql);
}

public function borrar($idcargo){
	$sql="DELETE FROM cargos WHERE idcargos='$idcargo'";
	return ejecutarConsulta($sql);
}

public function desactivar($idcargo){
	$sql="UPDATE cargos SET fecha_create='0' WHERE idcargos='$idcargo'";
	return ejecutarConsulta($sql);
}
public function activar($idcargo){
	$sql="UPDATE cargos SET fecha_create='1' WHERE idcargos='$idcargo'";
	return ejecutarConsulta($sql);
}

//metodo para mostrar registros
public function mostrar($idcargo){
	$sql="SELECT * FROM cargos WHERE idcargos='$idcargo'";
	return ejecutarConsultaSimpleFila($sql);
}

//listar registros
public function listar(){
	$sql="SELECT c.*, d.nombre as departamento FROM cargos c INNER JOIN departamento d ON d.iddepartamento=c.idDepartamento";
	return ejecutarConsulta($sql);
}
//listar y mostrar en selct
public function select(){
	$sql="SELECT * FROM cargos";
	return ejecutarConsulta($sql);
}
}

 ?>
