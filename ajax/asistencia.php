<?php 
require_once "../modelos/Asistencia.php";

$asistencia=new Asistencia();

$codigo_persona=isset($_POST["codigo_persona"])? limpiarCadena($_POST["codigo_persona"]):"";


switch ($_GET["op"]) {
	case 'registrar_asistencia':
		$result=$asistencia->verificarcodigo_persona($codigo_persona);
    $dni = $result['idusuarios'];
    $tur = $result['idTurno'];
    $estate = $result['estado'];
    $avatar = $result['imagen'];

    if($result > 0) {
      if($estate == '1'){
        date_default_timezone_set('America/Lima');
        $fechaActual = date("Y-m-d");
        $hora = date("H:i:s");

        $result2=$asistencia->seleccionarcodigo_persona($codigo_persona);
        $id = $result2['idasistencia'];
        $fecha = $result2['fecha'];
        $contE = $result2['contEnt'];
        $contS = $result2['contSal'];
        $controlador = $result2['controlador'];

          //echo '<h3><strong>¡BIENVENIDO! </strong> '. $dni.' '.$controlador.'</h3><div class="alert alert-success"> Ingreso registrado '.$hora.'</div>';
          if ($controlador == 1){ 
            //Ya se registro la entrada, ahora se debe registrar la salida                  
            $controlador = 2;

            if($fecha==$fechaActual){
              $result3=$asistencia->seleccionar_registro_anterior($id, $dni);
              $idAnt = $result3['idasistencia'];

              $result4=$asistencia->registro_salida_anterior($idAnt);

              $contS = 1;
              $rspta=$asistencia->registrar_salida($id, $contS, $controlador);
              echo $rspta ? '<img src="../admin/files/usuarios/'.$avatar.'" height="50px" width="50px"><h3><strong>¡HASTA LUEGO! </strong> '. $result['nombre'].' '.$result['apellido'].'</h3><div class="alert alert-danger"> Salida registrada '.$hora.'</div>' : 'No se pudo registrar la salida';
            }else{
              $rspta=$asistencia->registrar_salida_controlador($id);

              $contE = 1;
              $controlador = 1;
              $rspta=$asistencia->registrar_entrada($dni, $codigo_persona, $contE, $controlador, $tur);
              echo $rspta ? '<img src="../admin/files/usuarios/'.$avatar.'" height="50px" width="50px"><h3><strong>¡BIENVENIDO! </strong> '. $result['nombre'].' '.$result['apellido'].'</h3><div class="alert alert-success"> Ingreso registrado '.$hora.'</div>' : 'No se pudo registrar el ingreso';  
            }
        		
     		  }else{ 
            //se debe registrar una nueva entrada
            if($fecha==$fechaActual){
              //$result3=$asistencia->seleccionar_registro_anterior($id, $dni);
              //$idAnt = $result3['idasistencia'];

              $result4=$asistencia->registro_salida_anterior($id);

              $contE = 0;
              $controlador = 1;
              $rspta=$asistencia->registrar_entrada($dni, $codigo_persona, $contE, $controlador, $tur);
              //$movimiento = 1;
              echo $rspta ? '<img src="../admin/files/usuarios/'.$avatar.'" height="50px" width="50px"><h3><strong>¡BIENVENIDO! </strong> '. $result['nombre'].' '.$result['apellido'].'</h3><div class="alert alert-success"> Ingreso registrado '.$hora.'</div>' : 'No se pudo registrar el ingreso'; 
            }else{
              $contE = 1;
              $controlador = 1;
              $rspta=$asistencia->registrar_entrada($dni, $codigo_persona, $contE, $controlador, $tur);
              //$movimiento = 1;
              echo $rspta ? '<img src="../admin/files/usuarios/'.$avatar.'" height="50px" width="50px"><h3><strong>¡BIENVENIDO! </strong> '. $result['nombre'].' '.$result['apellido'].'</h3><div class="alert alert-success"> Ingreso registrado '.$hora.'</div>' : 'No se pudo registrar el ingreso'; 
            }            
          }
        }else{
          echo '<div class="alert alert-warning">
              <img src="../admin/files/usuarios/'.$avatar.'" height="50px" width="50px" align="left">
              <h3> &nbsp;&nbsp;&nbsp; <i class="icon fa fa-warning"></i> Su Usuario ha sido <strong>¡DESHABILITADO! </strong></h3>
              </div>';
        } 
      }else {
		    echo '<div class="alert alert-danger">
              <h3><i class="icon fa fa-warning"></i> No existe trabajador registrado con ese DNI...!</h3>
              </div>';
      }

	break;

}
?>