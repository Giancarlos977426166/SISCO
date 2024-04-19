<?php
$mi_pdf = 'MANUAL_SISCOA.pdf';
header('Content-type: application/pdf');
header('Content-Disposition: attachment; filename="'.$mi_pdf.'"');
readfile($mi_pdf);
?>
