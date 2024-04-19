var tabla;

//funcion que se ejecuta al inicio
function init(){
   mostrarform(false,);
   mostrarformPapeleta(false);
   listar();

   $("#formulario").on("submit",function(e){
   	guardaryeditar(e);
   })

   $.post("../ajax/motivo_papeleta.php?op=selectMotivo", function(r){
   	$("#idmotivo").html(r);
   	$('#idmotivo').selectpicker('refresh'); 
   });

   $.post("../ajax/papeleta.php?op=selectPersona", function(r){
   	 	$("#idusuario").html(r);
   	 	$('#idusuario').selectpicker('refresh');
   	});

   $.post("../ajax/lugar_papeleta.php?op=selectLugar", function(r){
   	 	$("#idlugar").html(r);
   	 	$('#idlugar').selectpicker('refresh');
   	});
}

//funcion limpiar
function limpiar(){
	//alert(new Date());
	$("#idpapeleta").val("");
	$("#idmotivo").selectpicker('refresh');
	$("#idusuario").selectpicker('refresh');
	$("#idlugar").selectpicker('refresh');
	//$("#fecha_salida").val(""); 
	//$("#hora_salida").val("");
	$("#fundamento").val(""); 
	$("#retorno").selectpicker('refresh');
	//$("#fecha_retorno").val(""); 
	//$("#hora_retorno").val(""); 
}
 
//funcion mostrar formulario
function mostrarform(flag){
	limpiar();
	if(flag){
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		$("#btnGuardar").prop("disabled",false);
		$("#btnagregar").hide();
	}else{
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		$("#btnagregar").show();
	}
}

function mostrarformPapeleta(flag){
	limpiar();
	if(flag){
		$("#listadoregistros").hide();
		$("#encabezado").hide();
		$("#pie_pagina").hide();
		$("#papeletadesalida").show();
		$("#btnGuardar").prop("disabled",false);
		$("#btnagregar").hide();
	}else{
		$("#listadoregistros").show();
		$("#encabezado").show();
		$("#pie_pagina").show();
		$("#papeletadesalida").hide();
		$("#btnagregar").show();
	}
}

//cancelar form
function cancelarform(){
	limpiar();
	mostrarform(false);
}

function cancelarformPapeleta(){
	limpiar();
	$("#tituloPagina").text('SISCOA | RRHH');
	mostrarformPapeleta(false);
}

//funcion listar
function listar(){
	tabla=$('#tbllistado').dataTable({
		"aProcessing": true,//activamos el procedimiento del datatable
		"aServerSide": true,//paginacion y filrado realizados por el server
		dom: 'Bfrtip',//definimos los elementos del control de la tabla
		buttons: [
                  'copyHtml5',
                  'excelHtml5',
                  'csvHtml5',
                  'pdf'
		],
		"ajax":
		{
			url:'../ajax/papeleta.php?op=listar',
			type: "get",
			dataType : "json",
			error:function(e){
				console.log(e.responseText);
			}
		},
		"bDestroy":true,
		"iDisplayLength":10,//paginacion
		"order":[[0,"desc"]]//ordenar (columna, orden)
	}).DataTable();
}

function listaru(){
	tabla=$('#tbllistadou').dataTable({
		"aProcessing": true,//activamos el procedimiento del datatable
		"aServerSide": true,//paginacion y filrado realizados por el server
		dom: 'Bfrtip',//definimos los elementos del control de la tabla
		buttons: [
                  'copyHtml5',
                  'excelHtml5',
                  'csvHtml5',
                  'pdf'
		],
		"ajax":
		{
			url:'../ajax/papeleta.php?op=listaru',
			type: "get",
			dataType : "json",
			error:function(e){
				console.log(e.responseText);
			}
		},
		"bDestroy":true,
		"iDisplayLength":10,//paginacion
		"order":[[0,"desc"]]//ordenar (columna, orden)
	}).DataTable();
}
//funcion para guardaryeditar
function guardaryeditar(e){
     e.preventDefault();//no se activara la accion predeterminada 
     $("#btnGuardar").prop("disabled",true);
     var formData=new FormData($("#formulario")[0]);

     $.ajax({
     	url: "../ajax/papeleta.php?op=guardaryeditar",
     	type: "POST",
     	data: formData,
     	contentType: false,
     	processData: false,

     	success: function(datos){
     		bootbox.alert(datos);
     		mostrarform(false);
     		tabla.ajax.reload();
     	}
     });

     limpiar();
}

function mostrar(idpapeleta){
	
	$.post("../ajax/papeleta.php?op=mostrar",{idpapeleta : idpapeleta},

		function(data,status)
		{
			data=JSON.parse(data);
			mostrarform(true);

			$("#idmotivo").val(data.idMotivo);
            $("#idmotivo").selectpicker('refresh');
            $("#idusuario").val(data.idUsuario);
            $("#idusuario").selectpicker('refresh');
			$("#idlugar").val(data.idLugar);
            $("#idlugar").selectpicker('refresh');
			$("#fecha_salida").val(data.fecha_salida);
			$("#hora_salida").val(data.hora_salida);
			$("#fundamento").val(data.fundamento);
			$("#retorno").val(data.retorno);
			$("#retorno").selectpicker('refresh');
			$("#fecha_retorno").val(data.fecha_retorno);
			$("#hora_retorno").val(data.hora_retorno);
			$("#idpapeleta").val(data.idpapeletas);
		})
}

function mostrarPapeleta(idpapeleta){
	$.post("../ajax/papeleta.php?op=mostrarPapeleta",{idpapeleta : idpapeleta},
		function(data,status)
		{
			data=JSON.parse(data);
			mostrarformPapeleta(true);

			let numeroPapeleta = ('0000000' + data.idpapeletas).slice(-7);

			$("#tituloPagina").text('Papeleta de Salida N° '+numeroPapeleta);

			$("#numPapeleta").text(numeroPapeleta);
			$("#apellidos").text(data.apellido);
			$("#nombres").text(data.nombre);
			$("#cargo").text(data.cargo);
			$("#autorizado").text(data.aprobado);
			$("#adonde").text(data.lugar);
			$("#fechaSalida").text(data.fecha_salida);
			$("#horaSalida").text(data.hora_salida);
			$("#fechaRetorno").text(data.fecha_retorno);
			$("#horaRetorno").text(data.hora_retorno);
			$("#motivo").text(data.motivo);
			$("#fundamentacion").text(data.fundamento);
			

			$("#numPapeleta1").text(numeroPapeleta);
			$("#apellidos1").text(data.apellido);
			$("#nombres1").text(data.nombre);
			$("#cargo1").text(data.cargo);
			$("#autorizado1").text(data.aprobado);
			$("#adonde1").text(data.lugar);
			$("#fechaSalida1").text(data.fecha_salida);
			$("#horaSalida1").text(data.hora_salida);
			$("#fechaRetorno1").text(data.fecha_retorno);
			$("#horaRetorno1").text(data.hora_retorno);
			$("#motivo1").text(data.motivo);
			$("#fundamentacion1").text(data.fundamento);
		})
}


//funcion para desactivar
function desactivar(idpapeleta){
	bootbox.confirm("¿Esta seguro de DESAPROBRAR la Papeleta", function(result){
		if (result) {
			$.post("../ajax/papeleta.php?op=desactivar", {idpapeleta : idpapeleta}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}

function activar(idpapeleta){
	bootbox.confirm("¿Esta seguro de APROBAR la Papeleta?" , function(result){
		if (result) {
			$.post("../ajax/papeleta.php?op=activar" , {idpapeleta : idpapeleta}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}

init();