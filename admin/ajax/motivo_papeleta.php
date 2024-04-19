<?php 
require_once "../modelos/Motivo_papeleta.php";
if (strlen(session_id())<1) 
	session_start();

$motivo=new Motivo_papeleta();

$idmotivo=isset($_POST["idmotivo"])? limpiarCadena($_POST["idmotivo"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$descripcion=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";
$idusuario=$_SESSION["login"];

switch ($_GET["op"]) {
	case 'guardaryeditar':
	if (empty($idmotivo)) {
		$rspta=$motivo->insertar($nombre,$descripcion,$idusuario);
		echo $rspta ? "Datos registrados correctamente" : "No se pudo registrar los datos";
	}else{
         $rspta=$motivo->editar($idmotivo,$nombre,$descripcion,$idusuario);
		echo $rspta ? "Datos actualizados correctamente" : "No se pudo actualizar los datos";
	}
		break;
	
	case 'borrar':
		$rspta=$motivo->borrar($idmotivo);
		echo $rspta ? "Datos ELIMINADOS correctamente" : "No se pudo ELIMINAR los datos";
		break;

	case 'desactivar':
		$rspta=$motivo->desactivar($idmotivo);
		echo $rspta ? "Datos desactivados correctamente" : "No se pudo desactivar los datos";
		break;

	case 'activar':
		$rspta=$motivo->activar($idmotivo);
		echo $rspta ? "Datos activados correctamente" : "No se pudo activar los datos";
		break;
	
	case 'mostrar':
		$rspta=$motivo->mostrar($idmotivo);
		echo json_encode($rspta);
		break;

    case 'listar':
		$rspta=$motivo->listar();
		$data=Array();

		while ($reg=$rspta->fetch_object()) {
			$data[]=array(
            "0"=>'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idmotivos.')"><i class="fa fa-pencil"></i></button>'.' '.'<button class="btn btn-danger btn-xs" onclick="borrar('.$reg->idmotivos.')"><i class="fa fa-minus-circle"></i></button>',
            "1"=>$reg->nombre,
            "2"=>$reg->descripcion,
            "3"=>$reg->fecha_create
              );
		}
		$results=array(
             "sEcho"=>1,//info para datatables
             "iTotalRecords"=>count($data),//enviamos el total de registros al datatable
             "iTotalDisplayRecords"=>count($data),//enviamos el total de registros a visualizar
             "aaData"=>$data); 
		echo json_encode($results);   
		break;

		case 'selectMotivo':
			$rspta=$motivo->select();
			echo '<option value="0">seleccione...</option>';
			while ($reg=$rspta->fetch_object()) {
				echo '<option value=' . $reg->idmotivos.'>'.$reg->nombre.'</option>';
			}
			break;
}
 ?>