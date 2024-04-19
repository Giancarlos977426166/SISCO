<?php
//activamos almacenamiento en el buffer
ob_start();
session_start();
if (!isset($_SESSION['nombre'])) {
  header("Location: login.html");
}else{

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
<div class="box-header with-border" id="encabezado">
  <h1 class="box-title">Papeletas de Salida
    <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-square"></i> Generar Papeleta</button></h1>
  <div class="box-tools pull-right">
    
  </div>
</div>
<!--box-header-->
<!--centro-->
<div class="panel-body table-responsive" id="listadoregistros">
  <table id="tbllistadou" class="table table-striped table-bordered table-condensed table-hover">
    <thead>
      <th>Opciones</th>
      <th>DNI</th>
      <th>N° de Papeleta</th>
      <th>Fecha/Salida</th>
      <th>Hora/Salida</th>
      <th>Fecha/Salida</th>
      <th>Hora/Retorno</th>
      <th>Motivo</th>
      <th>Fundamento</th>
      <th>Estado</th>
    </thead>
    <tbody>
    </tbody>
    <tfoot>
      <th>Opciones</th>
      <th>DNI</th>
      <th>N° de Papeleta</th>
      <th>Fecha/Salida</th>
      <th>Hora/Salida</th>
      <th>Fecha/Salida</th>
      <th>Hora/Retorno</th>
      <th>Motivo</th>
      <th>Fundamento</th>
      <th>Estado</th>
    </tfoot>  
  </table>
</div>


<div class="panel-body" id="formularioregistros">
  <form action="" name="formulario" id="formulario" method="POST">
    <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">Motivo de la Papeleta de Salida(*):</label>
     <select name="idmotivo" id="idmotivo" class="form-control select-picker" required>

     </select>
    </div>
    
    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
      <label>Lugar(*)</label>
      <input class="form-control" type="hidden" name="idpapeleta" id="idpapeleta">
      <select name="idlugar" id="idlugar" class="form-control selectpicker" data-live-search="true" required>
      </select>
    </div>

    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
      <label>Fecha de Salida</label>
      <input type="date" class="form-control" name="fecha_salida" id="fecha_salida" value="<?php echo date("Y-m-d"); ?>" required>
    </div>

    <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label>Hora de Salida (Use Formato de 24 horas)</label>
      <input type="time" class="form-control" name="hora_salida" id="hora_salida" value="<?php echo date("H:i"); ?>" required>
    </div>
    <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">Fundamento(*):</label>
      <textarea class="form-control" name="fundamento" id="fundamento" rows="3" placeholder="Escriba el fundamento de su salida" required></textarea>
    </div>

    <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
      <label>Retornar:</label>
      <select name="retorno" id="retorno" class="form-control select-picker" required>
        <option value="1" selected>Sí</option> 
        <option value="0">No</option>
      </select>
    </div>

    <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
      <label>Fecha de Retorno</label>
      <input type="date" class="form-control" name="fecha_retorno" id="fecha_retorno" value="<?php echo date("Y-m-d"); ?>">
    </div>

    <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label>Hora de Retorno (Use Formato de 24 horas)</label>
      <input type="time" class="form-control" name="hora_retorno" id="hora_retorno" value="<?php echo date("H:i"); ?>">
    </div>


    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i>  Guardar</button>
      <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
    </div>
  </form>
</div>



<div class="panel-body" id="papeletadesalida">

  <table width="680" border="0">
    <tr>
      <td width="99">&nbsp;</td>
      <td colspan="3"><table width="490" height="52" border="1">
        <tr bgcolor="#F7F7F7">
          <td width="490"><table width="482" height="63" border="0">
            <tr>
              <td width="70">&nbsp;<img src="../public/img/logo_mdt.png" alt="" width="60" height="50"/></td>
              <td width="344" align="center"><strong>MUNICIPALIDAD DISTRITAL DE TALAVERA<br/>
  APURÍMAC - ANDAHUAYLAS<br/>
  20172968253 </strong></td>
              <td width="56"><img src="../public/img/mdt.png" alt="" width="60" height="50"/></td>
            </tr>
          </table></td>
        </tr>
      </table></td>
      <td width="118">&nbsp;</td>
    </tr>
  </table>

  <br>
  <table width="681" border="0">
    <tr>
      <td width="534" align="center"><strong><u>PAPELETA DE SALIDA</u></strong></td>
      <td width="180"><table width="184" height="34" border="1">
        <tr bgcolor="#F7EAEA">
          <td width="170" align="center"><strong>PAPELETA N° 
            <label id="numPapeleta">0</label>
          </strong></td>
          </tr>
      </table></td>
    </tr>
  </table>

  <table width="679" border="1">
    <tr>
      <td><table width="679" border="0">
        <tr>
          <td colspan="2">&nbsp; Apellidos y Nombres:
            <label id="apellidos"></label>
            <label id="nombres"></label>
          </td>
          </tr>
        <tr>
          <td width="340">&nbsp; Cargo:
            <label id="cargo"></label>
          </td>
          <td width="340">Autorizado Por: RECURSOS HUMANOS</td>
        </tr>
        <tr>
          <td colspan="2">&nbsp; A dónde se dirige:
            <label id="adonde"></label>
          </td>
          </tr>
      </table></td>
    </tr>
  </table>


  <table width="681" border="0">
    <tr>
      <td width="335"><table width="326" border="1">
        <tr bgcolor="#F5F2F2">
          <td width="156" align="center"><strong>Fecha de Salida<br><label id="fechaSalida"></label></strong></td>
          <td width="129" align="center"><strong>Hora de Salida<br><label id="horaSalida"></label></strong></td>
        </tr>
        
      </table></td>
      <td width="346"><table width="346" border="1">
        <tr bgcolor="#F5F2F2">
          <td width="173" align="center"><strong>Fecha de Retorno<br><label id="fechaRetorno"></label></strong></td>
          <td width="173" align="center"><strong>Hora de Retorno<br><label id="horaRetorno"></label></strong></td>
        </tr>
      </table></td>
    </tr>
  </table>

  
  <table width="681" border="1">
    <tr bgcolor="#F5F2F2">
      <td width="331" align="center"><strong>MOTIVO</strong></td>
      <td width="350" align="center"><strong>FUNDAMENTACIÓN</strong></td>
    </tr>
    <tr>
      <td height="52" align="center"><p id="motivo">&nbsp;</p></td>
      <td align="center"><p id="fundamentacion">&nbsp;</p></td>
    </tr>
  </table>
  <br>
  <br>
  <br>
  <br>
  <table width="680" border="0">
    <tr>
      <td width="220"><img src="../public/img/papeleta/trabajador.png" width="200" height="25" /></td>
      <td width="220"><img src="../public/img/papeleta/jefe_area.png" width="200" height="27" /></td>
      <td width="220"><img src="../public/img/papeleta/jefe_personal.png" width="270" height="26" /></td>
    </tr>
  </table>


  <br>
  <br>
  <br>


  <table width="680" border="0">
    <tr>
      <td width="99">&nbsp;</td>
      <td colspan="3"><table width="490" height="52" border="1">
        <tr bgcolor="#F7F7F7">
          <td width="490"><table width="482" height="63" border="0">
            <tr>
              <td width="70">&nbsp;<img src="../public/img/logo_mdt.png" alt="" width="60" height="50"/></td>
              <td width="344" align="center"><strong>MUNICIPALIDAD DISTRITAL DE TALAVERA<br/>
  APURÍMAC - ANDAHUAYLAS<br/>
  20172968253 </strong></td>
              <td width="56"><img src="../public/img/mdt.png" alt="" width="60" height="50"/></td>
            </tr>
          </table></td>
        </tr>
      </table></td>
      <td width="118">&nbsp;</td>
    </tr>
  </table>

  <br>
  <table width="681" border="0">
    <tr>
      <td width="534" align="center"><strong><u>PAPELETA DE SALIDA</u></strong></td>
      <td width="180"><table width="184" height="34" border="1">
        <tr bgcolor="#F7EAEA">
          <td width="170" align="center"><strong>PAPELETA N° 
            <label id="numPapeleta1">0</label>
          </strong></td>
          </tr>
      </table></td>
    </tr>
  </table>

  <table width="679" border="1">
    <tr>
      <td><table width="679" border="0">
        <tr>
          <td colspan="2">&nbsp; Apellidos y Nombres:
            <label id="apellidos1"></label>
            <label id="nombres1"></label>
          </td>
          </tr>
        <tr>
          <td width="340">&nbsp; Cargo:
            <label id="cargo1"></label>
          </td>
          <td width="340">Autorizado Por: RECURSOS HUMANOS</td>
        </tr>
        <tr>
          <td colspan="2">&nbsp; A dónde se dirige:
            <label id="adonde1"></label>
          </td>
          </tr>
      </table></td>
    </tr>
  </table>


  <table width="681" border="0">
    <tr>
      <td width="335"><table width="326" border="1">
        <tr bgcolor="#F5F2F2">
          <td width="156" align="center"><strong>Fecha de Salida<br><label id="fechaSalida1"></label></strong></td>
          <td width="129" align="center"><strong>Hora de Salida<br><label id="horaSalida1"></label></strong></td>
        </tr>
        
      </table></td>
      <td width="346"><table width="346" border="1">
        <tr bgcolor="#F5F2F2">
          <td width="173" align="center"><strong>Fecha de Retorno<br><label id="fechaRetorno1"></label></strong></td>
          <td width="173" align="center"><strong>Hora de Retorno<br><label id="horaRetorno1"></label></strong></td>
        </tr>
      </table></td>
    </tr>
  </table>

  
  <table width="681" border="1">
    <tr bgcolor="#F5F2F2">
      <td width="331" align="center"><strong>MOTIVO</strong></td>
      <td width="350" align="center"><strong>FUNDAMENTACIÓN</strong></td>
    </tr>
    <tr>
      <td height="52" align="center"><p id="motivo1">&nbsp;</p></td>
      <td align="center"><p id="fundamentacion1">&nbsp;</p></td>
    </tr>
  </table>
  <br>
  <br>
  <br>
  <br>
  <table width="680" border="0">
    <tr>
      <td width="220"><img src="../public/img/papeleta/trabajador.png" width="200" height="25" /></td>
      <td width="220"><img src="../public/img/papeleta/jefe_area.png" width="200" height="27" /></td>
      <td width="220"><img src="../public/img/papeleta/jefe_personal.png" width="270" height="26" /></td>
    </tr>
  </table>


  
  <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <button class="btn btn-info" onclick="cancelarformPapeleta()" type="button"><i class="fa fa-arrow-circle-left"></i></button>
  </div>
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
 <script src="scripts/papeletau.js"></script>
 <?php 
}

ob_end_flush();
  ?>

