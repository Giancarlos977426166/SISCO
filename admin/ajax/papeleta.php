<?php 
require_once "../modelos/Papeleta.php";
if (strlen(session_id())<1) 
	session_start();

$papeleta=new Papeleta();

$idpapeleta=isset($_POST["idpapeleta"])? limpiarCadena($_POST["idpapeleta"]):"";
$fecha_salida=isset($_POST["fecha_salida"])? limpiarCadena($_POST["fecha_salida"]):"";
$hora_salida=isset($_POST["hora_salida"])? limpiarCadena($_POST["hora_salida"]):"";
$fundamento=isset($_POST["fundamento"])? limpiarCadena($_POST["fundamento"]):"";
$retorno=isset($_POST["retorno"])? limpiarCadena($_POST["retorno"]):"";
$fecha_retorno=isset($_POST["fecha_retorno"])? limpiarCadena($_POST["fecha_retorno"]):"";
$hora_retorno=isset($_POST["hora_retorno"])? limpiarCadena($_POST["hora_retorno"]):"";
$idmotivo=isset($_POST["idmotivo"])? limpiarCadena($_POST["idmotivo"]):"";
$idusuario=isset($_POST["idusuario"])? limpiarCadena($_POST["idusuario"]):"";
$idlugar=isset($_POST["idlugar"])? limpiarCadena($_POST["idlugar"]):"";
$idusuarioLogin=$_SESSION["login"];

switch ($_GET["op"]) {
	case 'guardaryeditar':
	if (empty($idpapeleta)) {
		$rspta=$papeleta->insertar($idusuario,$idmotivo,$idlugar,$fecha_salida,$hora_salida,$fecha_retorno,$hora_retorno,$retorno,$fundamento);
		echo $rspta ? "Datos INSERT registrados correctamente".$idpapeleta : "No se pudo registrar los datos";
	}else{
         $rspta=$papeleta->editar($idpapeleta,$idusuario,$idmotivo,$idlugar,$fecha_salida,$hora_salida,$fecha_retorno,$hora_retorno,$retorno,$fundamento);
		echo $rspta ? "Datos EDIT actualizados correctamente" : "No se pudo actualizar los datos";
	}
		break;

	case 'guardaryeditaru':
	if (empty($idpapeleta)) {
		$rspta=$papeleta->insertar($idusuarioLogin,$idmotivo,$idlugar,$fecha_salida,$hora_salida,$fecha_retorno,$hora_retorno,$retorno,$fundamento);
		echo $rspta ? "Datos registrados correctamente" : "No se pudo registrar los datos";
	}else{
         $rspta=$papeleta->editar($idpapeleta,$idusuarioLogin,$idmotivo,$idlugar,$fecha_salida,$hora_salida,$fecha_retorno,$hora_retorno,$retorno,$fundamento);
		echo $rspta ? "Datos actualizados correctamente" : "No se pudo actualizar los datos";
	}
		break;
	

	case 'desactivar':
		$rspta=$papeleta->desactivar($idpapeleta);
		echo $rspta ? "Papeleta DESAPROBADA correctamente" : "No se pudo DESAPROBAR la Papeleta";
		break;

	case 'activar':
		$rspta=$papeleta->activar($idpapeleta);
		echo $rspta ? "Papeleta APROBADA correctamente" : "No se pudo APROBAR la Papeleta";
		break;
	
	case 'mostrar':
		$rspta=$papeleta->mostrar($idpapeleta);
		echo json_encode($rspta);
		break;

	case 'mostrarPapeleta':
		$rspta=$papeleta->mostrarPapeleta($idpapeleta);
		echo json_encode($rspta);
		break;

    case 'listar':
		$rspta=$papeleta->listar();
		$data=Array();

		while ($reg=$rspta->fetch_object()) {
			
			$numeroPapeleta = str_pad($reg->idpapeletas, 7, "0", STR_PAD_LEFT);

			$fechaSal = date("d/m/Y", strtotime($reg->fecha_salida));

			$data[]=array(
            "0"=>($reg->aprobado)?'<button class="btn btn-info btn-xs" onclick="mostrarPapeleta('.$reg->idpapeletas.')"><i class="fa fa-print"></i></button>'.' '.'<button class="btn btn-danger btn-xs" onclick="desactivar('.$reg->idpapeletas.')"><i class="fa fa-close"></i></button>':'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idpapeletas.')"><i class="fa fa-pencil"></i></button>'.' '.'<button class="btn btn-info btn-xs" onclick="mostrarPapeleta('.$reg->idpapeletas.')"><i class="fa fa-print"></i></button>'.' '.'<button class="btn btn-success btn-xs" onclick="activar('.$reg->idpapeletas.')"><i class="fa fa-check"></i></button>',
            "1"=>$reg->idUsuario,
            "2"=>$numeroPapeleta,
            "3"=>$fechaSal,
            "4"=>$reg->hora_salida,
            "5"=>$reg->hora_retorno,
            "6"=>($reg->retorno)?'<span class="label bg-green">SÍ</span>':'<span class="label bg-red">NO</span>',
            "7"=>$reg->motivo,
            "8"=>($reg->aprobado)?'<span class="label bg-green">Aprobado</span>':'<span class="label bg-red">Pendiente</span>',
            "9"=>$reg->fecha_create
              );
		}
		$results=array(
             "sEcho"=>1,//info para datatables
             "iTotalRecords"=>count($data),//enviamos el total de registros al datatable
             "iTotalDisplayRecords"=>count($data),//enviamos el total de registros a visualizar
             "aaData"=>$data); 
		echo json_encode($results);   
		break;

		case 'listaru':
		$rspta=$papeleta->listaru($idusuarioLogin);
		$data=Array();

		while ($reg=$rspta->fetch_object()) {
			
			$numeroPapeleta = str_pad($reg->idpapeletas, 7, "0", STR_PAD_LEFT);
			$fechaSalU = date("d/m/Y", strtotime($reg->fecha_salida));
			$fechaRetU = date("d/m/Y", strtotime($reg->fecha_retorno));

			$data[]=array(
            "0"=>($reg->aprobado)?'<button class="btn btn-info btn-xs" onclick="mostrarPapeleta('.$reg->idpapeletas.')"><i class="fa fa-print"></i></button>':'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idpapeletas.')"><i class="fa fa-pencil"></i></button>'.' '.'<button class="btn btn-info btn-xs" onclick="mostrarPapeleta('.$reg->idpapeletas.')"><i class="fa fa-print"></i></button>',
            "1"=>$idusuarioLogin,
            "2"=>$numeroPapeleta,
            "3"=>$fechaSalU,
            "4"=>$reg->hora_salida,
            "5"=>$fechaRetU,
            "6"=>$reg->hora_retorno,
            "7"=>$reg->motivo,
            "8"=>$reg->fundamento,
            "9"=>($reg->aprobado)?'<span class="label bg-green">Aprobado</span>':'<span class="label bg-red">Pendiente</span>'
              );
		}
		$results=array(
             "sEcho"=>1,//info para datatables
             "iTotalRecords"=>count($data),//enviamos el total de registros al datatable
             "iTotalDisplayRecords"=>count($data),//enviamos el total de registros a visualizar
             "aaData"=>$data); 
		echo json_encode($results);   
		break;

		case 'selectPapeleta':
			$rspta=$papeleta->select();
			echo '<option value="0">seleccione...</option>';
			while ($reg=$rspta->fetch_object()) {
				echo '<option value=' . $reg->idpapeletas.'>'.$reg->idLugar.'</option>';
			}
			break;

		case 'selectPersona':
			require_once "../modelos/Usuario.php";
			$usuario=new Usuario();

			$rspta=$usuario->listarPersonal($_SESSION["login"]);
			
			echo '<option value='.$_SESSION["login"].'>'.$_SESSION["nombre"].' '.$_SESSION["apellido"].'</option>';
			while ($reg=$rspta->fetch_object()) {
				echo '<option value=' . $reg->idusuarios.'>'.$reg->nombre.' '.$reg->apellido.'</option>';
			}
			break;
}
 ?>