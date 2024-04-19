<?php 
//activamos almacenamiento en el buffer
ob_start();
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

require 'header.php';
 ?>
    <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="row">
        <div class="col-md-12">
      <div class="box">
<div class="box-header with-border">
  <h1 class="box-title">Asistencia del Personal</h1>
  <div class="box-tools pull-right">
    <button class="btn btn-primary" id="btnagregar" onclick="listar()"><i class="fa fa-list-ul"></i> Registros</button>
    <button class="btn btn-danger" id="btnagregar" onclick="listarhoy()"><i class="fa fa-clock-o"></i> Tardanzas</button>
  </div>
</div>
<!--box-header-->
<!--centro-->
<div class="panel-body table-responsive" id="listadoregistros">
  <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
    <thead>
      <th>Opciones</th>
      <th>DNI</th>
      <th>Nombres</th>
      <th>Cargo</th>
      <th>Fecha</th>
      <th>Entrada</th>
      <th>Salida</th>
    </thead>
    <tbody>
    </tbody>
    <tfoot>
      <th>Opciones</th>
      <th>DNI</th>
      <th>Nombres</th>
      <th>Cargo</th>
      <th>Fecha</th>
      <th>Entrada</th>
      <th>Salida</th>
    </tfoot>   
  </table>
</div>


  <div class="panel-body table-responsive" id="listadohoy">
    <table id="tbllistadohoy" class="table table-striped table-bordered table-condensed table-hover">
      <thead>
        <th>Opciones</th>
        <th>DNI</th>
        <th>Nombres</th>
        <th>Cargo</th>
        <th>Fecha</th>
        <th>Entrada</th>
        <th>Tolerancia</th>
        <th>Tardanza</th>
      </thead>
      <tbody>
      </tbody>
      <tfoot>
        <th>Opciones</th>
        <th>DNI</th>
        <th>Nombres</th>
        <th>Cargo</th>
        <th>Fecha</th>
        <th>Entrada</th>
        <th>Tolerancia</th>
        <th>Tardanza</th>
      </tfoot>   
    </table>
  </div>


      </div>
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
<?php 

require 'footer.php';
 ?>
 <script src="scripts/asistencia.js"></script>
 <?php 
}

ob_end_flush();
  ?>
