<?php

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

  require_once "../config/global.php";

  date_default_timezone_set('America/Lima');
  $fecha=date('Ymd-His');
 
  $salida_sql = DB_NAME.'_'.$fecha.'.sql'; 
  
  $dump = 'C:\xampp\mysql\bin\mysqldump --user='.DB_USERNAME." --password=".DB_PASSWORD." --host=".DB_HOST." ".DB_NAME." > $salida_sql";

  system($dump, $output); 

  $zip = new ZipArchive(); 
  
  $salida_zip = DB_NAME.'_'.$fecha.'.zip';
  
  if($zip->open($salida_zip,ZIPARCHIVE::CREATE)===true) { 
    $zip->addFile($salida_sql); 
    $zip->close(); 
    unlink($salida_sql); 
    
    header ("Location: $salida_zip"); 
    
    }else{
      echo 'Error';
    }

    //unlink($salida_zip);
}

?>

