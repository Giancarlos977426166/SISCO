<?php 
session_start();
require_once "../modelos/Usuario.php";

$usuario=new Usuario();

$idusuarioc=isset($_POST["idusuarioc"])? limpiarCadena($_POST["idusuarioc"]):"";
$clavec=isset($_POST["clavec"])? limpiarCadena($_POST["clavec"]):"";
$idusuario=isset($_POST["idusuario"])? limpiarCadena($_POST["idusuario"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$apellidos=isset($_POST["apellidos"])? limpiarCadena($_POST["apellidos"]):"";
$login=isset($_POST["login"])? limpiarCadena($_POST["login"]):"";
$iddepartamento=isset($_POST["iddepartamento"])? limpiarCadena($_POST["iddepartamento"]):"";
$idtipousuario=isset($_POST["idtipousuario"])? limpiarCadena($_POST["idtipousuario"]):"";
$idcargo=isset($_POST["idcargo"])? limpiarCadena($_POST["idcargo"]):"";
$idturno=isset($_POST["idturno"])? limpiarCadena($_POST["idturno"]):"";
$email=isset($_POST["email"])? limpiarCadena($_POST["email"]):"";
$codigo_asistencia=isset($_POST["codigo_asistencia"])? limpiarCadena($_POST["codigo_asistencia"]):"";
$password=isset($_POST["clave"])? limpiarCadena($_POST["clave"]):"";
$imagen=isset($_POST["imagen"])? limpiarCadena($_POST["imagen"]):"";
//$usuariocreado=isset($_POST["login"])? limpiarCadena($_POST["login"]):"";
$user_create=$_SESSION["login"];
//$idmensaje=isset($_POST["idmensaje"])? limpiarCadena($_POST["idmensaje"]):"";


switch ($_GET["op"]) {
	case 'guardaryeditar':

		if (!file_exists($_FILES['imagen']['tmp_name'])|| !is_uploaded_file($_FILES['imagen']['tmp_name']))  
		{
			$imagen=$_POST["imagenactual"];
		}else
		{

			$ext=explode(".", $_FILES["imagen"]["name"]);
			if ($_FILES['imagen']['type'] == "image/jpg" || $_FILES['imagen']['type'] == "image/jpeg" || $_FILES['imagen']['type'] == "image/png")
			 {

			   $imagen = round(microtime(true)).'.'. end($ext);
				move_uploaded_file($_FILES["imagen"]["tmp_name"], "../files/usuarios/" . $imagen);
		 	}
		}

		//Hash SHA256 para la contraseña
		$clavehash=hash("SHA256", $password);

		if (empty($idusuario)) {
			//$idusuario=$_SESSION["login"];
			$rspta=$usuario->insertar($login,$codigo_asistencia,$nombre,$apellidos,$email,$clavehash,$imagen,$user_create,$idtipousuario,$idcargo,$idturno);
			echo $rspta ? "Datos registrados correctamente" : "No se pudo registrar todos los datos del usuario";
		}
		else {
			$rspta=$usuario->editar($login,$codigo_asistencia,$nombre,$apellidos,$email,$clavehash,$imagen,$user_create,$idtipousuario,$idcargo,$idturno);
			echo $rspta ? "Datos actualizados correctamente" : "No se pudo actualizar los datos";
		}
	break;
	

	case 'desactivar':
		$rspta=$usuario->desactivar($idusuario);
		echo $rspta ? "Datos desactivados correctamente" : "No se pudo desactivar los datos";
	break;

	case 'activar':
		$rspta=$usuario->activar($idusuario);
		echo $rspta ? "Datos activados correctamente" : "No se pudo activar los datos";
	break;
	
	case 'mostrar':
		$rspta=$usuario->mostrar($idusuario);
		echo json_encode($rspta);
	break;

	case 'editar_clave':
		$clavehash=hash("SHA256", $clavec);

		$rspta=$usuario->editar_clave($idusuarioc,$clavehash);
		//echo $rspta ? "Password actualizado correctamente".$idusuarioc.'-'.$clavehash : "No se pudo actualizar el password";
		echo $rspta ? "Password actualizado correctamente" : "No se pudo actualizar el password";
	break;

	case 'mostrar_clave':
		//echo "<script>alert('Mostrar clave')</script>";
		$rspta=$usuario->mostrar_clave($idusuario);
		//echo $rspta ? "Mostrar clave:".$idusuario : "No se pudo actualizar";
		echo json_encode($rspta);
	break;
	
	case 'listar':
		$rspta=$usuario->listar();
		//declaramos un array
		$data=Array();


		while ($reg=$rspta->fetch_object()) {
			$data[]=array(
				"0"=>($reg->estado)?'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idusuarios.')"><i class="fa fa-pencil"></i></button>'.' '.'<button class="btn btn-info btn-xs" onclick="mostrar_clave('.$reg->idusuarios.')"><i class="fa fa-key"></i></button>'.' '.'<button class="btn btn-danger btn-xs" onclick="desactivar('.$reg->idusuarios.')"><i class="fa fa-close"></i></button>':'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idusuarios.')"><i class="fa fa-pencil"></i></button>'.' '.'<button class="btn btn-info btn-xs" onclick="mostrar_clave('.$reg->idusuarios.')"><i class="fa fa-key"></i></button>'.' '.'<button class="btn btn-primary btn-xs" onclick="activar('.$reg->idusuarios.')"><i class="fa fa-check"></i></button>',
				"1"=>$reg->idusuarios,
				"2"=>$reg->nombre,
				"3"=>$reg->apellido,
				"4"=>$reg->email,
				"5"=>"<img src='../files/usuarios/".$reg->imagen."' height='50px' width='50px'>",
				"6"=>$reg->fecha_create,
				"7"=>$reg->cargo,
				"8"=>($reg->estado)?'<span class="label bg-green">Activado</span>':'<span class="label bg-red">Desactivado</span>'
				);
		}

		$results=array(
             "sEcho"=>1,//info para datatables
             "iTotalRecords"=>count($data),//enviamos el total de registros al datatable
             "iTotalDisplayRecords"=>count($data),//enviamos el total de registros a visualizar
             "aaData"=>$data); 
		echo json_encode($results);

	break;


	case 'verificar':
		//validar si el usuario tiene acceso al sistema
		$logina=$_POST['logina'];
		$clavea=$_POST['clavea'];

		//Hash SHA256 en la contraseña
		$clavehash=hash("SHA256", $clavea);
		
		$rspta=$usuario->verificar($logina, $clavehash);

		$fetch=$rspta->fetch_object();

		if (isset($fetch)) 
		{
			# Declaramos la variables de sesion
			$_SESSION['login']=$fetch->idusuarios;
			$id=$fetch->idusuarios;
			$_SESSION['nombre']=$fetch->nombre;
			$_SESSION['apellido']=$fetch->apellido;
			$_SESSION['imagen']=$fetch->imagen;
			if($fetch->imagen==''){
				$avatar='user.png';
				$_SESSION['imagen']=$avatar;
			}
			$_SESSION['tipousuario']=$fetch->tipousuario;
			$_SESSION['cargo']=$fetch->cargo;

			/*require "../config/Conexion.php";

			$sql="UPDATE usuarios SET iteracion='1' WHERE idusuarios='$id'";
			echo $sql; 
	 		ejecutarConsulta($sql);	*/ 		

		}

		echo json_encode($fetch);

	break;

	case 'salir':
			
			/*$id=$_SESSION['login'];
			$sql="UPDATE usuarios SET iteracion='0' WHERE idusuarios='$id'";
			echo $sql; 
	 		ejecutarConsulta($sql);	*/ 		


		//Limpiamos las variables de sesión   
        session_unset();
        //Destruìmos la sesión
        session_destroy();
        //Redireccionamos al login
        header("Location: ../index.php");

	break;

}
?>