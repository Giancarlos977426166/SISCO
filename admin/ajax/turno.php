<?php 
require_once "../modelos/Turno.php";
if (strlen(session_id())<1) 
	session_start();

$turno=new Turno();

$idturno=isset($_POST["idturno"])? limpiarCadena($_POST["idturno"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$descripcion=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";
$hora_entrada=isset($_POST["hora_entrada"])? limpiarCadena($_POST["hora_entrada"]):"";
$hora_salida=isset($_POST["hora_salida"])? limpiarCadena($_POST["hora_salida"]):"";
$tolerancia=isset($_POST["tolerancia"])? limpiarCadena($_POST["tolerancia"]):"";
$idusuario=$_SESSION["login"];

switch ($_GET["op"]) {
	case 'guardaryeditar':
	if (empty($idturno)) {
		$rspta=$turno->insertar($nombre,$descripcion,$hora_entrada,$hora_salida,$tolerancia,$idusuario);
		echo $rspta ? "Datos registrados correctamente" : "No se pudo registrar los datos";
	}else{
        $rspta=$turno->editar($idturno,$nombre,$descripcion,$hora_entrada,$hora_salida,$tolerancia,$idusuario);
		echo $rspta ? "Datos actualizados correctamente" : "No se pudo actualizar los datos";
	}
		break;
	

	case 'borrar':
		$rspta=$turno->borrar($idturno);
		echo $rspta ? "Datos ELIMINADOS correctamente" : "No se pudo ELIMINAR los datos";
		break;

	case 'desactivar':
		$rspta=$turno->desactivar($idturno);
		echo $rspta ? "Datos desactivados correctamente" : "No se pudo desactivar los datos";
		break;

	case 'activar':
		$rspta=$turno->activar($idturno);
		echo $rspta ? "Datos activados correctamente" : "No se pudo activar los datos";
		break;
	
	case 'mostrar':
		$rspta=$turno->mostrar($idturno);
		echo json_encode($rspta);
		break;

    case 'listar':
		$rspta=$turno->listar();
		$data=Array();

		while ($reg=$rspta->fetch_object()) {
			$data[]=array(
            "0"=>'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idturnos.')"><i class="fa fa-pencil"></i></button>'.' '.'<button class="btn btn-danger btn-xs" onclick="borrar('.$reg->idturnos.')"><i class="fa fa-minus-circle"></i></button>',
            "1"=>$reg->nombre,
            "2"=>$reg->descripcion,
            "3"=>$reg->hora_entrada,
            "4"=>$reg->hora_salida,
            "5"=>$reg->tolerancia,
            "6"=>$reg->fecha_create
              );
		}
		$results=array(
             "sEcho"=>1,//info para datatables
             "iTotalRecords"=>count($data),//enviamos el total de registros al datatable
             "iTotalDisplayRecords"=>count($data),//enviamos el total de registros a visualizar
             "aaData"=>$data); 
		echo json_encode($results);   
		break;

		case 'selectTurno':
			$rspta=$turno->select();
			echo '<option value="0">seleccione...</option>';
			while ($reg=$rspta->fetch_object()) {
				echo '<option value=' . $reg->idturnos.'>'.$reg->nombre.'</option>';
			}
			break;
}
 ?>