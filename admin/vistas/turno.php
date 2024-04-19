<?php
//activamos almacenamiento en el buffer
ob_start();
session_start();
if (!isset($_SESSION['nombre'])) {
  header("Location: login.php");
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
  <h1 class="box-title">Turnos de trabajo <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-square"></i>  Agregar</button></h1>
  <div class="box-tools pull-right">
    
  </div>
</div>
<!--box-header-->
<!--centro-->
<div class="panel-body table-responsive" id="listadoregistros">
  <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
    <thead>
      <th>Opciones</th>
      <th>Nombre</th>
      <th>Descripcion</th>
      <th>Hora/Entrada</th>
      <th>Hora/Salida</th>
      <th>Tolerancia</th>
      <th>Fecha/Registro</th>
    </thead>
    <tbody> 
    </tbody>
    <tfoot>
      <th>Opciones</th>
      <th>Nombre</th>
      <th>Descripcion</th>
      <th>Hora/Entrada</th>
      <th>Hora/Salida</th>
      <th>Tolerancia</th>
      <th>Fecha/Registro</th>
    </tfoot>   
  </table>
</div>


<div class="panel-body" style="height: 400px;" id="formularioregistros">
  <form action="" name="formulario" id="formulario" method="POST">
    <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">Nombre</label>
      <input class="form-control" type="hidden" name="idturno" id="idturno">
      <input class="form-control" type="text" name="nombre" id="nombre" maxlength="80" placeholder="Nombre" required>
    </div>
        <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">Descripcion</label>
      <input class="form-control" type="text" name="descripcion" id="descripcion" maxlength="256" placeholder="Descripcion">
    </div>
    <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label>Hora de Entrada (Use Formato de 24 horas)</label>
      <input type="time" class="form-control" name="hora_entrada" id="hora_entrada" value="<?php echo date("H:i"); ?>">
    </div>
    <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label>Hora de Salida (Use Formato de 24 horas)</label>
      <input type="time" class="form-control" name="hora_salida" id="hora_salida" value="<?php echo date("H:i"); ?>">
    </div>
    <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label>Minutos de Tolerancia</label>
      <input type="time" class="form-control" name="tolerancia" id="tolerancia" value="<?php echo date("H:i"); ?>">
    </div>
    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i>  Guardar</button>

      <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
    </div>
  </form>
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
 <script src="scripts/turno.js"></script>
 <?php 
}

ob_end_flush();
  ?>

