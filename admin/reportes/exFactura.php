<?php 
//activamos almacenamiento en el buffer
ob_start();
if (strlen(session_id())<1) 
  session_start();

if (!isset($_SESSION['nombre'])) {
  echo "debe ingresar al sistema correctamente para visualizar el reporte";
}else{

if ($_SESSION['tipousuario']=='Administrador') {

//incluimos el archivo factura
require('Factura.php');

//datos de la empresa
/*require_once "../modelos/Negocio.php";
$cnegocio = new Negocio();
$rsptan = $cnegocio->listar();
$regn=$rsptan->fetch_object();*/

$empresa = 'Empresa SAC';
$ndocumento = 5;
$documento = 'documento';
$direccion = 'Condominios los jardines';
$telefono = '999999999';  
$email = 'user@test.com';
$pais = 'Peru';
$ciudad = 'Andahuaylas';
$nombre_impuesto = 'Impue';
$monto_impuesto = 50;
$moneda = 'Soles';
$simbolo = 'S/.';
$new_simbolo='';
$sim_euro='€';
$sim_yen='¥';
$sim_libra='£';
if ($simbolo==$sim_euro) {
  $new_simbolo=EURO;
}elseif($simbolo==$sim_yen){
  $new_simbolo=JPY;
}elseif ($simbolo==$sim_libra) {
  $new_simbolo=GBP;
}else{
  $new_simbolo=$simbolo;
}


$logoe="../files/img_asis/".'logo'."";
$ext_logo="png";

//obtenemos los datos de la cabecera de la venta actual
/*require_once "../modelos/Venta.php";
$venta= new Venta();
$rsptav=$venta->ventacabecera($_GET["id"]);

//recorremos todos los valores que obtengamos
$regv=$rsptav->fetch_object();*/

//configuracion de la factura
$pdf = new PDF_Invoice('p','mm','A4');
$pdf->AddPage();

//enviamos datos de la empresa al metodo addSociete de la clase factura
$pdf->addSociete(utf8_decode($empresa),
                 $ndocumento. ": "  .$documento."\n".
                 utf8_decode("Direccion: "). utf8_decode($direccion)."\n".
                 utf8_decode("Telefono: ").$telefono."\n".
                 "Email: ".$email,$logoe,$ext_logo);

$pdf->fact_dev("Factura ","Serie- 33");
$pdf->temporaire( "" );
$pdf->addDate("2020-06-09");

//enviamos los datos del cliente al metodo addClientAddresse de la clase factura
$pdf->addClientAdresse(utf8_decode('Nombre del Cliente'),
                       "Domicilio: ".utf8_decode('Tienda de la esquina'), 
                       'tipo_documento'.": ".'123', 
                       "Email: ".'venta@test.com', 
                       "Telefono: ".'888888888');

//establecemos las columnas que va tener la seccion donde mostramos los detalles de la venta
$cols=array( "CODIGO"=>23,
	         "DESCRIPCION"=>78,
	         "CANTIDAD"=>22,
	         "P.U."=>25,
	         "DSCTO"=>20,
	         "SUBTOTAL"=>22);
$pdf->addCols( $cols);
$cols=array( "CODIGO"=>"L",
             "DESCRIPCION"=>"L",
             "CANTIDAD"=>"C",
             "P.U."=>"R",
             "DSCTO"=>"R",
             "SUBTOTAL"=>"C" );
$pdf->addLineFormat( $cols);
$pdf->addLineFormat($cols); 

//actualizamos el valor de la coordenada "y" quie sera la ubicacion desde donde empecemos a mostrar los datos 
$y=85;

//obtenemos todos los detalles del a venta actual
//$rsptad=$venta->ventadetalles($_GET["id"]);

//while($regd=$rsptad->fetch_object()){
  $line = array( "CODIGO"=>"111",
                 "DESCRIPCION"=>utf8_decode("Articulos de Higiene"),
                 "CANTIDAD"=>"5",
                 "P.U."=>"10",
                 "DSCTO"=>"5",
                 "SUBTOTAL"=>"50");
  $size = $pdf->addLine( $y, $line );
  $y += $size +2;

//}  

/*aqui falta codigo de letras*/
require_once "Letras.php";
$V = new EnLetras();

$total=45; 
$V=new EnLetras(); 
$V->substituir_un_mil_por_mil = true;

 $con_letra=strtoupper($V->ValorEnLetras($total," $moneda")); 
$pdf->addCadreTVAs("SON ".$con_letra,55);

//mostramos el impuesto
$pdf->addTVAs( 18, 45, $new_simbolo);
$pdf->addCadreEurosFrancs($nombre_impuesto." 18 %");
$pdf->Output('Reporte de Venta' ,'I');

	}else{
echo "No tiene permiso para visualizar el reporte";
}

}

ob_end_flush();
  ?>