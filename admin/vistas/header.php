 <?php 
if (strlen(session_id())<1) 
  session_start();
  ?>
 <!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title id="tituloPagina">SISCOA | RRHH</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3 -->
    <link rel="stylesheet" href="../public/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../public/css/font-awesome.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../public/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../public/css/_all-skins.min.css">
    <link rel="apple-touch-icon" href="../public/img/apple-touch-icon.png">
    <link rel="shortcut icon" href="../public/img/favicon.ico">

    <!-- DATATABLES -->
    <link rel="stylesheet" type="text/css" href="../public/datatables/jquery.dataTables.min.css">    
    <link href="../public/datatables/buttons.dataTables.min.css" rel="stylesheet"/>
    <link href="../public/datatables/responsive.dataTables.min.css" rel="stylesheet"/>

    <link rel="stylesheet" type="text/css" href="../public/css/bootstrap-select.min.css">

  </head>

<body class="hold-transition skin-yellow sidebar-mini">


<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="escritorio.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>MDT</b> SISCOA</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>SISCOA</b> MDT</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Navegación</span>
          </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="../files/usuarios/<?php echo $_SESSION['imagen']; ?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $_SESSION['nombre']; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="../files/usuarios/<?php echo $_SESSION['imagen']; ?>" class="img-circle" alt="User Image">

                <p>
                  <?php echo $_SESSION['nombre'].' '.$_SESSION['apellido']; ?>
                  <small><?php echo $_SESSION['cargo']; ?></small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <!--<a href="#" class="btn btn-default btn-flat">Perfil</a>-->
                </div>
                <div class="pull-right">
                  <a href="../ajax/usuario.php?op=salir" class="btn btn-default btn-flat">Salir</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->

        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
<div class="user-panel">
        <div class="pull-left image">
          <img src="../files/usuarios/<?php echo $_SESSION['imagen']; ?>" class="img-circle" style="width: 50px; height: 50px;" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $_SESSION['nombre']; ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu tree" data-widget="tree">
      <li class="header">MENÚ DE NAVEGACIÓN</li>


      <li><a href="escritorio.php"><i class="fa  fa-dashboard (alias)"></i> <span>Panel Principal</span></a></li>

<!--
      <li class="treeview">
          <a href="#">
            <i class="fa fa-envelope"></i> <span>Mensajes</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="mensaje.php"><i class="fa fa-circle-o"></i> Mensaje</a></li>
          </ul>
      </li>

-->

<?php if ($_SESSION['tipousuario']=='Administrador') {
?>
      <li class="treeview">
          <a href="#">
            <i class="fa fa-clock-o"></i> <span>Asistencias</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="asistencia.php"><i class="fa fa-calendar-plus-o"></i> Asistencia</a></li>
            <li><a href="rptasistencia.php"><i class="fa fa-calendar"></i> Reportes</a></li>
           
          </ul>
      </li>

      <li class="treeview">
          <a href="#">
            <i class="fa fa-clipboard"></i> <span>Papeletas de Salida</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="papeleta.php"><i class="fa fa-file-text"></i> Papeletas</a></li>
            <li><a href="motivo_papeleta.php"><i class="fa fa-list-ol"></i> Motivos Papeleta</a></li>
            <li><a href="lugar_papeleta.php"><i class="fa fa-map-pin"></i> Lugares Autorizados</a></li>
           
          </ul>
      </li>

      <li class="treeview">
          <a href="#">
            <i class="fa fa-users"></i> <span>Personal</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="usuario.php"><i class="fa fa-group"></i> Usuarios</a></li>
            <li><a href="turno.php"><i class="fa fa-calendar-check-o"></i> Turnos</a></li>
            <li><a href="tipousuario.php"><i class="fa fa-sitemap"></i> Tipo de Usuario</a></li>
          </ul>
      </li>

      <li class="treeview">
          <a href="#">
            <i class="fa fa-institution"></i> <span>Áreas/Oficinas | Cargos</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="departamento.php"><i class="fa fa-suitcase"></i> Oficinas</a></li>  
            <li><a href="cargo.php"><i class="fa fa-mortar-board"></i> Cargos</a></li>            
          </ul>
      </li>

      <li class="treeview">
          <a href="#">
            <i class="fa fa-save"></i> <span>Respaldos</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../backups/generarRespaldo.php"><i class="fa fa-database"></i> Generar Backup</a></li>
          </ul>
      </li>

          
<?php } ?>
<?php if ($_SESSION['tipousuario']!='Administrador') {
?>
          <li class="treeview">
              <a href="#">
                <i class="fa fa-clock-o"></i> <span>Mis Asistencias</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="asistenciau.php"><i class="fa fa-calendar-plus-o"></i> Asistencia</a></li>
                <li><a href="rptasistenciau.php"><i class="fa fa-calendar"></i> Reportes</a></li>
               
              </ul>
          </li>

          <li class="treeview">
              <a href="#">
                <i class="fa fa-clipboard"></i> <span>Mis Papeletas</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="papeletau.php"><i class="fa fa-file-text"></i> Papeletas</a></li>
               
              </ul>
          </li>
<?php } ?>
  
      <li><a href="#"><i class="fa fa-question-circle"></i> <span>Ayuda</span><small class="label pull-right bg-yellow">PDF</small></a></li>  
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>