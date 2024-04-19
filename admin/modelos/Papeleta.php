<?php 
//incluir la conexion de base de datos
require "../config/Conexion.php";
class Papeleta{


	//implementamos nuestro constructor
public function __construct(){

}

//metodo insertar regiustro
public function insertar($idusuario,$idmotivo,$lugar,$fecha_salida,$hora_salida,$fecha_retorno,$hora_retorno,$retorno,$fundamento){
	$sql="INSERT INTO papeletas (idUsuario,idMotivo,idLugar,fecha_salida,hora_salida,fecha_retorno,hora_retorno,retorno,fundamento,aprobado) VALUES ('$idusuario','$idmotivo','$lugar','$fecha_salida','$hora_salida','$fecha_retorno','$hora_retorno','$retorno','$fundamento','0')";
	return ejecutarConsulta($sql);
}

public function editar($idpapeleta,$idusuario,$idmotivo,$lugar,$fecha_salida,$hora_salida,$fecha_retorno,$hora_retorno,$retorno,$fundamento){
	$sql="UPDATE papeletas SET idUsuario='$idusuario',idMotivo='$idmotivo',idLugar='$lugar',fecha_salida='$fecha_salida',hora_salida='$hora_salida',fecha_retorno='$fecha_retorno',hora_retorno='$hora_retorno',retorno='$retorno',fundamento='$fundamento' WHERE idpapeletas='$idpapeleta'";
	return ejecutarConsulta($sql);
}

public function desactivar($idpapeleta){
	$sql="UPDATE papeletas SET aprobado='0' WHERE idpapeletas='$idpapeleta'";
	return ejecutarConsulta($sql);
}

public function activar($idpapeleta){
	$sql="UPDATE papeletas SET aprobado='1' WHERE idpapeletas='$idpapeleta'";
	return ejecutarConsulta($sql);
}

//metodo para mostrar registros
public function mostrar($idpapeleta){
	$sql="SELECT * FROM papeletas WHERE idpapeletas='$idpapeleta'";
	return ejecutarConsultaSimpleFila($sql);
}

public function mostrarPapeleta($idpapeleta){
	$sql="SELECT P.*, L.nombre AS lugar, U.apellido AS apellido, U.nombre AS nombre, C.nombre AS cargo, M.nombre AS motivo FROM papeletas P INNER JOIN motivos_papeleta M ON M.idmotivos=P.idMotivo INNER JOIN lugar_papeleta L ON L.idlugares=P.idLugar INNER JOIN usuarios U ON U.idusuarios=P.idUsuario INNER JOIN cargos C ON C.idcargos=U.idCargo WHERE P.idpapeletas='$idpapeleta'";
	return ejecutarConsultaSimpleFila($sql);
}

//listar registros
public function listar(){
	$sql="SELECT p.*, m.nombre as motivo FROM papeletas p INNER JOIN motivos_papeleta m ON m.idmotivos=p.idMotivo ORDER BY p.idpapeletas DESC";
	return ejecutarConsulta($sql);
}

public function listaru($idusuario){
	$sql="SELECT p.*, m.nombre as motivo FROM papeletas p INNER JOIN motivos_papeleta m ON m.idmotivos=p.idMotivo WHERE p.idUsuario='$idusuario'";
	return ejecutarConsulta($sql);
}

//listar y mostrar en selct
public function select(){
	$sql="SELECT * FROM cargos";
	return ejecutarConsulta($sql);
}
}

 ?>
