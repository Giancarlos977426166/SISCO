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
  date_default_timezone_set('America/Lima');
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
    <h1 class="box-title">Consulta de Asistencias por Fecha</h1>
    <div class="box-tools pull-right">
      
    </div>
  </div>

  <!--box-header-->
  <!--centro-->
  <div class="panel-body table-responsive" id="listadoregistros">
    <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
      <label>Fecha Inicio</label>
      <input type="date" class="form-control" name="fecha_inicio" id="fecha_inicio" value="<?php echo date("Y-m-d"); ?>">
    </div>
    <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
      <label>Fecha Fin</label>
      <input type="date" class="form-control" name="fecha_fin" id="fecha_fin" value="<?php echo date("Y-m-d"); ?>">
    </div>
    <div class="form-inline col-lg-6 col-md-6 col-sm-6 col-xs-12">
      <label>Seleccione al Trabajador</label>
      <select name="idusuario" id="idusuario" class="form-control selectpicker" data-live-search="true" required>
      </select>
      <br>
      <button class="btn btn-success" onclick="listar_asistencia();"><i class="fa fa-list-ul"></i> Registros</button>
      <button class="btn btn-danger" onclick="listar_asistencia_tardanza();"><i class="fa fa-clock-o"></i> Tardanza</button>
      <button class="btn btn-primary" onclick="listar_asistencia_salida();"><i class="fa fa-list-ul"></i> Salida</button>
      <button class="btn btn-warning" onclick="listar_asistencia_horas();"><i class="fa fa-list-ul"></i> Trabajo</button>
    </div>

  <div class="panel-body table-responsive" id="listadoasistencia">
    <table id="tbllistado_asistencia" class="table table-striped table-bordered table-condensed table-hover">
      <thead>
        <th>N°</th>
        <th>DNI</th>
        <th>Nombres</th>
        <th>Fecha</th>
        <th>Entrada</th>
        <th>Salida</th>
      </thead>
      <tbody>
      </tbody>
      <tfoot>
        <th>N°</th>
        <th>DNI</th>
        <th>Nombres</th>
        <th>Fecha</th>
        <th>Entrada</th>
        <th>Salida</th>
      </tfoot>   
    </table>
  </div>

  <div class="panel-body table-responsive" id="listadotardanzas">
    <table id="tbllistado_asistencia_tardanza" class="table table-striped table-bordered table-condensed table-hover">
      <thead>
        <th>N°</th>
        <th>DNI</th>
        <th>Nombres</th>
        <th>Fecha</th>
        <th>Entrada</th>
        <th>Tolerancia</th>
        <th>Tardanza</th>
      </thead>
      <tbody>
      </tbody>
      <tfoot>
        <th>N°</th>
        <th>DNI</th>
        <th>Nombres</th>
        <th>Fecha</th>
        <th>Entrada</th>
        <th>Tolerancia</th>
        <th>Tardanza</th>
      </tfoot>   
    </table>
  </div>

  <div class="panel-body table-responsive" id="listadosalida">
    <table id="tbllistado_asistencia_salida" class="table table-striped table-bordered table-condensed table-hover">
      <thead>
        <th>N°</th>
        <th>DNI</th>
        <th>Nombres</th>
        <th>Fecha</th>
        <th>Salida</th>
        <th>Hora/Salida</th>
        <th>Extras</th>
      </thead>
      <tbody>
      </tbody>
      <tfoot>
        <th>N°</th>
        <th>DNI</th>
        <th>Nombres</th>
        <th>Fecha</th>
        <th>Salida</th>
        <th>Hora/Salida</th>
        <th>Extras</th>
      </tfoot>   
    </table>
  </div>

  <div class="panel-body table-responsive" id="listadohoras">
    <table id="tbllistado_asistencia_horas" class="table table-striped table-bordered table-condensed table-hover">
      <thead>
        <th>N°</th>
        <th>DNI</th>
        <th>Nombres</th>
        <th>Fecha</th>
        <th>Entrada</th>
        <th>Salida</th>
        <th>Trabajo/Horas</th>
      </thead>
      <tbody>
      </tbody>
      <tfoot>
        <th>N°</th>
        <th>DNI</th>
        <th>Nombres</th>
        <th>Fecha</th>
        <th>Entrada</th>
        <th>Salida</th>
        <th>Trabajo/Horas</th>
      </tfoot>   
    </table>
  </div>

      <!--fin centro-->
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

