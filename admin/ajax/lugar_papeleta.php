<?php 
require_once "../modelos/Lugar_papeleta.php";
if (strlen(session_id())<1) 
	session_start();

$lugar=new Lugar_papeleta();

$idlugar=isset($_POST["idlugar"])? limpiarCadena($_POST["idlugar"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$descripcion=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";
$idusuario=$_SESSION["login"];

switch ($_GET["op"]) {
	case 'guardaryeditar':
	if (empty($idlugar)) {
		$rspta=$lugar->insertar($nombre,$descripcion,$idusuario);
		echo $rspta ? "Datos registrados correctamente" : "No se pudo registrar los datos";
	}else{
         $rspta=$lugar->editar($idlugar,$nombre,$descripcion,$idusuario);
		echo $rspta ? "Datos actualizados correctamente" : "No se pudo actualizar los datos";
	}
		break;
	
	case 'borrar':
		$rspta=$lugar->borrar($idlugar);
		echo $rspta ? "Datos ELIMINADOS correctamente" : "No se pudo ELIMINAR los datos";
		break;

	case 'desactivar':
		$rspta=$lugar->desactivar($idlugar);
		echo $rspta ? "Datos desactivados correctamente" : "No se pudo desactivar los datos";
		break;

	case 'activar':
		$rspta=$lugar->activar($idlugar);
		echo $rspta ? "Datos activados correctamente" : "No se pudo activar los datos";
		break;
	
	case 'mostrar':
		$rspta=$lugar->mostrar($idlugar);
		echo json_encode($rspta);
		break;

    case 'listar':
		$rspta=$lugar->listar();
		$data=Array();

		while ($reg=$rspta->fetch_object()) {
			$data[]=array(
            "0"=>'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idlugares.')"><i class="fa fa-pencil"></i></button>'.' '.'<button class="btn btn-danger btn-xs" onclick="borrar('.$reg->idlugares.')"><i class="fa fa-minus-circle"></i></button>',
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

		case 'selectLugar':
			$rspta=$lugar->select();
			echo '<option value="0">seleccione...</option>';
			while ($reg=$rspta->fetch_object()) {
				echo '<option value=' . $reg->idlugares.'>'.$reg->nombre.'</option>';
			}
			break;
}
 ?>