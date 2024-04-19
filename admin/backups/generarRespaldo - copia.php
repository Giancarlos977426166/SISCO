<?php
//activamos almacenamiento en el buffer
//ob_start();
session_start();
if (!isset($_SESSION['nombre'])) {
  header("Location: login.html");
}else{
  if ($_SESSION['tipousuario']!='Administrador'){
      //Limpiamos las variables de sesión   
      session_unset();
      //Destruìmos la sesión
      session_destroy();
      //Redireccionamos al login
      header("Location: ../index.php");
    }

  require_once "global.php";

  $db_host = 'localhost'; //Host del Servidor MySQL
  $db_name = 'control_asistencia_bd'; //Nombre de la Base de datos
  $db_user = 'root'; //Usuario de MySQL
  $db_pass = ''; //Password de Usuario MySQL
  
  //$fecha = date("Ymd-His"); //Obtenemos la fecha y hora para identificar el respaldo
  date_default_timezone_set('America/Lima');
  $fecha=date('Ymd-His');
 
  // Construimos el nombre de archivo SQL Ejemplo: mibase_20170101-081120.sql
  $salida_sql = $db_name.'_'.$fecha.'.sql'; 
  
  //Comando para genera respaldo de MySQL, enviamos las variales de conexion y el destino
  //$dump = "mysqldump -h$db_host -u$db_user -p$db_pass --opt $db_name > $salida_sql";
  $dump = 'C:\xampp_v7\mysql\bin\mysqldump --user='.$db_user." --password=".$db_pass." --host=".$db_host." ".$db_name." > $salida_sql";

  system($dump, $output); //Ejecutamos el comando para respaldo
  //echo $dump;

  $zip = new ZipArchive(); //Objeto de Libreria ZipArchive
  
  //Construimos el nombre del archivo ZIP Ejemplo: mibase_20160101-081120.zip
  $salida_zip = $db_name.'_'.$fecha.'.zip';
  
  if($zip->open($salida_zip,ZIPARCHIVE::CREATE)===true) { //Creamos y abrimos el archivo ZIP
    $zip->addFile($salida_sql); //Agregamos el archivo SQL a ZIP
    $zip->close(); //Cerramos el ZIP
    unlink($salida_sql); //Eliminamos el archivo temporal SQL
    
    header ("Location: $salida_zip"); // Redireccionamos para descargar el Arcivo ZIP
    
    //unlink($salida_zip);
    }else{
      echo 'Error'; //Enviamos el mensaje de error
    }

    //unlink($salida_zip);
}

//ob_end_flush();
?>

