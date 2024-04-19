<?php 
require_once "../modelos/Asistencia.php";
if (strlen(session_id())<1) 
	session_start();
$asistencia=new Asistencia();

$codigo_persona=isset($_POST["codigo_persona"])? limpiarCadena($_POST["codigo_persona"]):"";
$iddepartamento=isset($_POST["iddepartamento"])? limpiarCadena($_POST["iddepartamento"]):"";



switch ($_GET["op"]) {
	case 'guardaryeditar':
		$result=$asistencia->verificarcodigo_persona($codigo_persona);

      	if($result > 0) {
			date_default_timezone_set('America/Lima');
      		$fecha = date("Y-m-d");
			$hora = date("H:i:s");

			$result2=$asistencia->seleccionarcodigo_persona($codigo_persona);
			   
     		$par = abs($result2%2);

          if ($par == 0){ 
                              
                $tipo = "Entrada";
        		$rspta=$asistencia->registrar_entrada($codigo_persona,$tipo);
    			//$movimiento = 0;
    			echo $rspta ? '<h3><strong>Nombres: </strong> '. $result['nombre'].' '.$result['apellidos'].'</h3><div class="alert alert-success"> Ingreso registrado '.$hora.'</div>' : 'No se pudo registrar el ingreso';
   		  }else{ 
                $tipo = "Salida";
         		$rspta=$asistencia->registrar_salida($codigo_persona,$tipo);
     			//$movimiento = 1;
     			echo $rspta ? '<h3><strong>Nombres: </strong> '. $result['nombre'].' '.$result['apellidos'].'</h3><div class="alert alert-danger"> Salida registrada '.$hora.'</div>' : 'No se pudo registrar la salida';             
        } 
        } else {
		         echo '<div class="alert alert-danger">
                       <i class="icon fa fa-warning"></i> No hay empleado registrado con esa código...!
                         </div>';
        }

	break;

	
	case 'mostrar':
		$rspta=$asistencia->mostrar($idasistencia);
		echo json_encode($rspta);
	break;


	
	case 'listar':
		$rspta=$asistencia->listar();
		//declaramos un array
		$data=Array();

		$salida="No se marcó Salida";
		
		while ($reg=$rspta->fetch_object()) {

			$fechaFormat = date("d/m/Y", strtotime($reg->fecha));

			$data[]=array(
				"0"=>'<button class="btn btn-success btn-xs"><i class="fa fa-check"></i></button>',
				"1"=>$reg->dni,
				"2"=>$reg->nombre.' '.$reg->apellido,
				"3"=>$reg->cargo,
				"4"=>$fechaFormat,
				"5"=>$reg->hora_entrada,
				"6"=>$reg->hora_salida
				);
		}

		$results=array(
             "sEcho"=>1,//info para datatables
             "iTotalRecords"=>count($data),//enviamos el total de registros al datatable
             "iTotalDisplayRecords"=>count($data),//enviamos el total de registros a visualizar
             "aaData"=>$data); 
		echo json_encode($results);

	break;

	case 'listarhoy':
		$rspta=$asistencia->listarhoy();
		//declaramos un array
		$data=Array();

		$salida="No se marcó Salida";
		
		while ($reg=$rspta->fetch_object()) {

			$horaHoy=new DateTime($reg->hora_entrada);
			$horaHoyTolerancia=new DateTime($reg->tolerancia);
			if($horaHoyTolerancia >= $horaHoy){
				$tarde=1;
			    $dateInterval = $horaHoy->diff($horaHoyTolerancia);
				$tardanzaHoy = $dateInterval->format('Puntual: %Hh %im %ss').PHP_EOL;
			}

			if($horaHoy > $horaHoyTolerancia){
				$tarde=0;
			    $dateInterval = $horaHoy->diff($horaHoyTolerancia);
				$tardanzaHoy = $dateInterval->format('Tarde: %Hh %im %ss').PHP_EOL;
			}
			
			$fechaFormat = date("d/m/Y", strtotime($reg->fecha));

			$data[]=array(
				"0"=>'<button class="btn btn-success btn-xs"><i class="fa fa-check"></i></button>',
				"1"=>$reg->dni,
				"2"=>$reg->nombre.' '.$reg->apellido,
				"3"=>$reg->cargo,
				"4"=>$fechaFormat,
				"5"=>$reg->hora_entrada,
				"6"=>$reg->tolerancia,
				"7"=>($tarde)?'<span class="label bg-green">'.$tardanzaHoy.'</span>':'<span class="label bg-red">'.$tardanzaHoy.'</span>'
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
    	$idusuario=$_SESSION["login"];
		$rspta=$asistencia->listaru($idusuario);
		//declaramos un array
		$data=Array();

		while ($reg=$rspta->fetch_object()) {

			$fechaFormat = date("d/m/Y", strtotime($reg->fecha));

			$data[]=array(
				"0"=>'<button class="btn btn-success btn-xs"><i class="fa fa-check"></i></button>',
				"1"=>$reg->dni,
				"2"=>$reg->nombre.' '.$reg->apellido,
				"3"=>$reg->cargo,
				"4"=>$fechaFormat,
				"5"=>$reg->hora_entrada,
				"6"=>$reg->hora_salida
				);
		}

		$results=array(
             "sEcho"=>1,//info para datatables
             "iTotalRecords"=>count($data),//enviamos el total de registros al datatable
             "iTotalDisplayRecords"=>count($data),//enviamos el total de registros a visualizar
             "aaData"=>$data); 
		echo json_encode($results);

	break;

	case 'listar_asistencia':

	    $fecha_inicio=$_REQUEST["fecha_inicio"];
	    $fecha_fin=$_REQUEST["fecha_fin"];
	    $dni=$_REQUEST["idusuario"]; 
		$rspta=$asistencia->listar_asistencia($fecha_inicio,$fecha_fin,$dni);
		//declaramos un array
		$data=Array();
		$num = 0;
		while ($reg=$rspta->fetch_object()) {
			$num=$num+1;
			$fechaFormat = date("d/m/Y", strtotime($reg->fecha));

			$data[]=array(
				"0"=>$num,
				"1"=>$reg->dni,
				"2"=>$reg->nombre.' '.$reg->apellido,
				"3"=>$fechaFormat,
				"4"=>$reg->hora_entrada,
				"5"=>$reg->hora_salida
				);
		}

		$results=array(
             "sEcho"=>1,//info para datatables
             "iTotalRecords"=>count($data),//enviamos el total de registros al datatable
             "iTotalDisplayRecords"=>count($data),//enviamos el total de registros a visualizar
             "aaData"=>$data); 
		echo json_encode($results);

	break;

	case 'listar_asistencia_tardanza':

	    $fecha_inicio=$_REQUEST["fecha_inicio"];
	    $fecha_fin=$_REQUEST["fecha_fin"];
	    $dni=$_REQUEST["idusuario"]; 
		$rspta=$asistencia->listar_asistencia_tardanza($fecha_inicio,$fecha_fin,$dni);
		//declaramos un array
		$data=Array();
		$num = 0;

		while ($reg=$rspta->fetch_object()) {

			$horaUno=new DateTime($reg->hora_entrada);
			$horaDos=new DateTime($reg->tolerancia);
			if($horaDos >= $horaUno){
				$controlTarde=1;
			    $dateInterval = $horaUno->diff($horaDos);
				$tardanza = $dateInterval->format('Puntual: %Hh %im %ss').PHP_EOL;
			 }

			if($horaUno > $horaDos){
				$controlTarde=0;
			    $dateInterval = $horaUno->diff($horaDos);
				$tardanza = $dateInterval->format('Tarde: %Hh %im %ss').PHP_EOL;
			}

			$fechaFormat = date("d/m/Y", strtotime($reg->fecha));
			$num=$num+1;

			$data[]=array(
				"0"=>$num,
				"1"=>$reg->dni,
				"2"=>$reg->nombre.' '.$reg->apellido,
				"3"=>$fechaFormat,
				"4"=>$reg->hora_entrada,
				"5"=>$reg->tolerancia,
				"6"=>($controlTarde)?'<span class="label bg-green">'.$tardanza.'</span>':'<span class="label bg-red">'.$tardanza.'</span>'
				);
		}

		$results=array(
             "sEcho"=>1,//info para datatables
             "iTotalRecords"=>count($data),//enviamos el total de registros al datatable
             "iTotalDisplayRecords"=>count($data),//enviamos el total de registros a visualizar
             "aaData"=>$data); 
		echo json_encode($results);

	break;

	case 'listar_asistencia_salida':

	    $fecha_inicio=$_REQUEST["fecha_inicio"];
	    $fecha_fin=$_REQUEST["fecha_fin"];
	    $dni=$_REQUEST["idusuario"]; 
		$rspta=$asistencia->listar_asistencia_salida($fecha_inicio,$fecha_fin,$dni);
		//declaramos un array
		$data=Array();
		$num=0;
		
		while ($reg=$rspta->fetch_object()) {

			$hora1=new DateTime($reg->hora_salida);
			$hora2=new DateTime($reg->salida);
			
			if($hora2 > $hora1){
				$controlSalida=0;

				if(empty($reg->hora_salida)){
					$extra = 'Sin Salida';
				 }else{
				 	$dateInterval1 = $hora1->diff($hora2);
					$extra = $dateInterval1->format('Antes: %Hh %im %ss').PHP_EOL;
				 }
			 }

			if($hora1 >= $hora2){
				
				if(empty($reg->hora_salida)){
					$controlSalida=0;
					$extra = 'Sin Salida';
				 }else{
				 	$controlSalida=1;
				 	$dateInterval1 = $hora1->diff($hora2);
					$extra = $dateInterval1->format('Extra: %Hh %im %ss').PHP_EOL;
				 }
			}

			$fechaFormat = date("d/m/Y", strtotime($reg->fecha));
			$num=$num+1;

			$data[]=array(
				"0"=>$num,
				"1"=>$reg->dni,
				"2"=>$reg->nombre.' '.$reg->apellido,
				"3"=>$fechaFormat,
				"4"=>$reg->hora_salida,
				"5"=>$reg->salida,
				"6"=>($controlSalida)?'<span class="label bg-green">'.$extra.'</span>':'<span class="label bg-red">'.$extra.'</span>'
				);
		}

		$results=array(
             "sEcho"=>1,//info para datatables
             "iTotalRecords"=>count($data),//enviamos el total de registros al datatable
             "iTotalDisplayRecords"=>count($data),//enviamos el total de registros a visualizar
             "aaData"=>$data); 
		echo json_encode($results);

	break;

	case 'listar_asistencia_horas':

	    $fecha_inicio=$_REQUEST["fecha_inicio"];
	    $fecha_fin=$_REQUEST["fecha_fin"];
	    $dni=$_REQUEST["idusuario"]; 
		$tbEntrada=$asistencia->listar_entrada($fecha_inicio,$fecha_fin,$dni);
		$tbSalida=$asistencia->listar_salida($fecha_inicio,$fecha_fin,$dni);
		//declaramos un array
		$data=Array();
		$num=0;
		
		while ($ent=$tbEntrada->fetch_object()) {

			while ($sal=$tbSalida->fetch_object()){

				if($ent->dni == $sal->dni AND $ent->fecha == $sal->fecha){

					$horaUno=new DateTime($ent->hora_entrada);
					$horaDos=new DateTime($sal->hora_salida);

					if(empty($sal->hora_salida)){
						$contHora = 0;
						$horas = 'Sin Salida';
					}else{
						$contHora = 1;
						$dateIntervals = $horaUno->diff($horaDos);
						$horas = $dateIntervals->format('%Hh %im %ss').PHP_EOL;
					}

					$fechaFormat = date("d/m/Y", strtotime($ent->fecha));
					$num=$num+1;

					$data[]=array(
						"0"=>$num,
						"1"=>$ent->dni,
						"2"=>$ent->nombre.' '.$ent->apellido,
						"3"=>$fechaFormat,
						"4"=>$ent->hora_entrada,
						"5"=>$sal->hora_salida,
						"6"=>($contHora)?'<span class="label bg-blue">'.$horas.'</span>':'<span class="label bg-red">'.$horas.'</span>'
						);
				}
			}
			$tbSalida=$asistencia->listar_salida($fecha_inicio,$fecha_fin,$dni);
		}

		$results=array(
             "sEcho"=>1,//info para datatables
             "iTotalRecords"=>count($data),//enviamos el total de registros al datatable
             "iTotalDisplayRecords"=>count($data),//enviamos el total de registros a visualizar
             "aaData"=>$data); 
		echo json_encode($results);

	break;

	case 'listar_asistenciau':
    $fecha_inicio=$_REQUEST["fecha_inicio"];
    $fecha_fin=$_REQUEST["fecha_fin"];
    $dni=$_SESSION["login"]; 
		$rspta=$asistencia->listar_asistencia($fecha_inicio,$fecha_fin,$dni);
		//declaramos un array
		$data=Array();


		while ($reg=$rspta->fetch_object()) {
			$data[]=array(
				"0"=>$reg->dni,
				"1"=>$reg->nombre,
				"2"=>$reg->fecha,
				"3"=>$reg->hora_entrada,
				"4"=>$reg->hora_salida
				);
		}

		$results=array(
             "sEcho"=>1,//info para datatables
             "iTotalRecords"=>count($data),//enviamos el total de registros al datatable
             "iTotalDisplayRecords"=>count($data),//enviamos el total de registros a visualizar
             "aaData"=>$data); 
		echo json_encode($results);

	break;

		case 'selectPersona':
			require_once "../modelos/Usuario.php";
			$usuario=new Usuario();

			$rspta=$usuario->listar();
			$all="Todos";
			echo '<option value=' . $all.'>'.$all.'</option>';
			while ($reg=$rspta->fetch_object()) {
				echo '<option value=' . $reg->idusuarios.'>'.$reg->nombre.' '.$reg->apellido.'</option>';
			}
			break;

}
?>