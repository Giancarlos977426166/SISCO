<?php
//activamos almacenamiento en el buffer
ob_start();
session_start();
if (!isset($_SESSION['login'])) {
  header("Location: login.php");
}else{

 
require 'header.php';
require_once('../modelos/Usuario.php');
  $usuario = new Usuario();
  $rsptan = $usuario->cantidad_usuario();
  $reg=$rsptan->fetch_object();
  $reg->nombre;
?>
<div class="content-wrapper">
    <!-- Main content -->
  <section class="content">

      <!-- Default box -->
    <div class="row">
      <div class="col-md-12">
    <div class="box">
<div class="panel-body">

<?php if ($_SESSION['tipousuario']=='Administrador') {
?>
<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
  <div class="small-box bg-aqua">
    
    <a href="asistencia.php" class="small-box-footer">
    <div class="inner">
      <h5 style="font-size: 20px;">
        <strong>Lista asistencias </strong>
      </h5>
      <p>Módulo</p>
    </div>
    <div class="icon">
      <i class="fa fa-list" aria-hidden="true"></i>
    </div>&nbsp;
     <div class="small-box-footer">
           <i class="fa"></i>
     </div>

    </a>
  </div>
</div>
<?php } ?>

<?php if ($_SESSION['tipousuario']=='Administrador') {
?>
<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
  <div class="small-box bg-red">
    
    <a href="papeleta.php" class="small-box-footer">
    <div class="inner">
      <h5 style="font-size: 20px;">
        <strong>Papeletas de Salida </strong>
      </h5>
      <p>Módulo</p>
    </div>
    <div class="icon">
      <i class="fa fa-edit" aria-hidden="true"></i>
    </div>&nbsp;
     <div class="small-box-footer">
           <i class="fa"></i>
     </div>

    </a>
  </div>
</div>
<?php } ?>

<?php if ($_SESSION['tipousuario']!='Administrador') {
?>
<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
  <div class="small-box bg-green">
    
    <a href="asistenciau.php" class="small-box-footer">
    <div class="inner">
      <h5 style="font-size: 20px;">
        <strong>Mi lista de asistencias </strong>
      </h5>
      <p>Módulo</p>
    </div>
    <div class="icon">
      <i class="fa fa-list" aria-hidden="true"></i>
    </div>&nbsp;
     <div class="small-box-footer">
           <i class="fa"></i>
     </div>

    </a>
  </div>
</div>
<?php } ?>



<?php if ($_SESSION['tipousuario']=='Administrador') {
?>
<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
  <div class="small-box bg-green">
    <a href="usuario.php" class="small-box-footer">
      <div class="inner">
        <h4 style="font-size: 20px;">
          <strong>Personal:   </strong>
        </h4>
        <p>Total <?php echo $reg->nombre; ?></p>
      </div>
      <div class="icon">
         <i class="fa fa-users" aria-hidden="true"></i>
      </div>&nbsp;
       <div class="small-box-footer">
             <i class="fa"></i>
       </div>
    </a>
  </div>
</div>
<?php } ?>


<?php if ($_SESSION['tipousuario']=='Administrador') {
?>
<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
  <div class="small-box bg-purple">
    
    <a href="rptasistencia.php" class="small-box-footer">
    <div class="inner">
      <h5 style="font-size: 20px;">
        <strong>Reporte de asistencias </strong>
      </h5>
      <p>Módulo</p>
    </div>
    <div class="icon">
      <i class="fa fa-area-chart" aria-hidden="true"></i>
    </div>&nbsp;
     <div class="small-box-footer">
           <i class="fa"></i>
     </div>

    </a>
  </div>
</div>
<?php } ?>

<?php if ($_SESSION['tipousuario']=='Administrador') {
?>
<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
  <div class="small-box bg-orange">
    
    <a href="departamento.php" class="small-box-footer">
    <div class="inner">
      <h5 style="font-size: 20px;">
        <strong>Gestión de Áreas </strong>
      </h5>
      <p>Módulo</p>
    </div>
    <div class="icon">
      <i class="fa fa-institution" aria-hidden="true"></i>
    </div>&nbsp;
     <div class="small-box-footer">
           <i class="fa"></i>
     </div>

    </a>
  </div>
</div>
<?php } ?>

<?php if ($_SESSION['tipousuario']=='Administrador') {
?>
<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
  <div class="small-box bg-blue">
    
    <a href="turno.php" class="small-box-footer">
    <div class="inner">
      <h5 style="font-size: 20px;">
        <strong>Gestión de Turnos </strong>
      </h5>
      <p>Módulo</p>
    </div>
    <div class="icon">
      <i class="fa fa-hourglass" aria-hidden="true"></i>
    </div>&nbsp;
     <div class="small-box-footer">
           <i class="fa"></i>
     </div>

    </a>
  </div>
</div>
<?php } ?>

<?php if ($_SESSION['tipousuario']!='Administrador') {
?>
<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
  <div class="small-box bg-aqua">
    
    <a href="rptasistenciau.php" class="small-box-footer">
    <div class="inner">
      <h5 style="font-size: 20px;">
        <strong>Mi reporte de asistencias </strong>
      </h5>
      <p>Módulo</p>
    </div>
    <div class="icon">
      <i class="fa fa-area-chart" aria-hidden="true"></i>
    </div>&nbsp;
     <div class="small-box-footer">
           <i class="fa"></i>
     </div>

    </a>
  </div>
</div>
<?php } ?>

<?php if ($_SESSION['tipousuario']!='Administrador') {
?>
<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
  <div class="small-box bg-red">
    
    <a href="papeletau.php" class="small-box-footer">
    <div class="inner">
      <h5 style="font-size: 20px;">
        <strong>Mis Papeletas </strong>
      </h5>
      <p>Módulo</p>
    </div>
    <div class="icon">
      <i class="fa fa-edit" aria-hidden="true"></i>
    </div>&nbsp;
     <div class="small-box-footer">
           <i class="fa"></i>
     </div>

    </a>
  </div>
</div>
<?php } ?>

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
}
ob_end_flush();
?>