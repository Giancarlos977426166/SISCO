<?php 
require_once "../modelos/Cargo.php";
if (strlen(session_id())<1) 
	session_start();

$cargo=new Cargo();

$idcargo=isset($_POST["idcargo"])? limpiarCadena($_POST["idcargo"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$descripcion=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";
$iddepartamento=isset($_POST["iddepartamento"])? limpiarCadena($_POST["iddepartamento"]):"";
$idusuario=$_SESSION["login"];

switch ($_GET["op"]) {
	case 'guardaryeditar':
	if (empty($idcargo)) {
		$rspta=$cargo->insertar($nombre,$descripcion,$idusuario,$iddepartamento);
		echo $rspta ? "Datos registrados correctamente" : "No se pudo registrar los datos";
	}else{
         $rspta=$cargo->editar($idcargo,$nombre,$descripcion,$idusuario,$iddepartamento);
		echo $rspta ? "Datos actualizados correctamente" : "No se pudo actualizar los datos";
	}
		break;
	
	case 'borrar':
		$rspta=$cargo->borrar($idcargo);
		echo $rspta ? "Datos ELIMINADOS correctamente" : "No se pudo ELIMINAR los datos";
	break;

	case 'desactivar':
		$rspta=$cargo->borrar($idcargo);
		echo $rspta ? "Datos desactivados correctamente".$idusuario : "No se pudo desactivar los datos";
		break;
	case 'activar':
		$rspta=$cargo->activar($idcargo);
		echo $rspta ? "Datos activados correctamente" : "No se pudo activar los datos";
		break;
	
	case 'mostrar':
		$rspta=$cargo->mostrar($idcargo);
		echo json_encode($rspta);
		break;

    case 'listar':
		$rspta=$cargo->listar();
		$data=Array();

		while ($reg=$rspta->fetch_object()) {
			$data[]=array(
            "0"=>'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idcargos.')"><i class="fa fa-pencil"></i></button>'.' '.'<button class="btn btn-danger btn-xs" onclick="borrar('.$reg->idcargos.')"><i class="fa fa-minus-circle"></i></button>',
            "1"=>$reg->departamento,
            "2"=>$reg->nombre,
            "3"=>$reg->descripcion,
            "4"=>$reg->fecha_create
              );
		}
		$results=array(
             "sEcho"=>1,//info para datatables
             "iTotalRecords"=>count($data),//enviamos el total de registros al datatable
             "iTotalDisplayRecords"=>count($data),//enviamos el total de registros a visualizar
             "aaData"=>$data); 
		echo json_encode($results);   
		break;

		case 'selectCargo':
			$rspta=$cargo->select();
			echo '<option value="0">seleccione...</option>';
			while ($reg=$rspta->fetch_object()) {
				echo '<option value=' . $reg->idcargos.'>'.$reg->nombre.'</option>';
			}
			break;
}
 ?>