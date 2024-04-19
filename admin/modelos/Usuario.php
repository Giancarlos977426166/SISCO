<?php 
//incluir la conexion de base de datos
require "../config/Conexion.php";
class Usuario{


	//implementamos nuestro constructor
public function __construct(){

}

//metodo insertar regiustro
public function insertar($login,$codigo_asistencia,$nombre,$apellido,$email,$clavehash,$imagen,$user_create,$idtipousuario,$idcargo,$idturno){
	//date_default_timezone_set('America/Lima');
	//$fechacreado=date('Y-m-d H:i:s');
	$sql="INSERT INTO usuarios (idusuarios,codigo_asistencia,nombre,apellido,email,password,imagen,estado,user_create,idTipousuario,idCargo,idTurno) VALUES ('$login','$codigo_asistencia','$nombre','$apellido','$email','$clavehash','$imagen','1','$user_create','$idtipousuario','$idcargo','$idturno')";
	//echo "<script>alert('$sql')</script>";
	return ejecutarConsulta($sql);
}

public function editar($login,$codigo_asistencia,$nombre,$apellido,$email,$clavehash,$imagen,$user_create,$idtipousuario,$idcargo,$idturno){
	$sql="UPDATE usuarios SET idusuarios='$login',codigo_asistencia='$codigo_asistencia',nombre='$nombre',apellido='$apellido',email='$email',password='$clavehash',imagen='$imagen',user_create='$user_create' ,idTipousuario='$idtipousuario',idCargo='$idcargo',idTurno='$idturno' WHERE idusuarios='$login'";
	return ejecutarConsulta($sql);
}

public function editar_clave($idusuario,$clavehash){
	$sql="UPDATE usuarios SET password='$clavehash' WHERE idusuarios='$idusuario'";
	return ejecutarConsulta($sql);
}

public function mostrar_clave($idusuario){
	$sql="SELECT idusuarios, password FROM usuarios WHERE idusuarios='$idusuario'";
	return ejecutarConsultaSimpleFila($sql);
}

public function desactivar($idusuario){
	$sql="UPDATE usuarios SET estado='0' WHERE idusuarios='$idusuario'";
	return ejecutarConsulta($sql);
}

public function activar($idusuario){
	$sql="UPDATE usuarios SET estado='1' WHERE idusuarios='$idusuario'";
	return ejecutarConsulta($sql);
}

//metodo para mostrar registros
public function mostrar($idusuario){
	$sql="SELECT * FROM usuarios WHERE idusuarios='$idusuario'";
	return ejecutarConsultaSimpleFila($sql);
}

//listar registros
public function listarPersonal($idusuario){//SELECT u.*, c.nombre FROM usuarios u inner join cargos c on c.idcargos=u.idCargo
	$sql="SELECT idusuarios, nombre, apellido FROM usuarios WHERE idusuarios!='$idusuario'";
	return ejecutarConsulta($sql);
}

//listar registros
public function listar(){//SELECT u.*, c.nombre FROM usuarios u inner join cargos c on c.idcargos=u.idCargo
	$sql="SELECT u.*, c.nombre as cargo FROM usuarios u INNER JOIN cargos c ON c.idcargos=u.idCargo";
	return ejecutarConsulta($sql);
}

public function cantidad_usuario(){
	$sql="SELECT count(*) nombre FROM usuarios";
	return ejecutarConsulta($sql);
}

//Función para verificar el acceso al sistema
	public function verificar($login,$clave)
    {
    	$sql="SELECT u.idusuarios,u.nombre,u.apellido,u.email,u.imagen,ca.nombre as cargo,tu.nombre as tipousuario FROM usuarios u INNER JOIN tipousuario tu ON u.idTipousuario=tu.idtipousuario INNER JOIN cargos ca ON u.idCargo=ca.idcargos WHERE idusuarios='$login' AND password='$clave' AND estado='1'"; 
    	return ejecutarConsulta($sql);  
    }
}

 ?>
