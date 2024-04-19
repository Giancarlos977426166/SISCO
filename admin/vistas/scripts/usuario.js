var tabla;

//funcion que se ejecuta al inicio
function init(){
   mostrarform(false);
   mostrarform_clave(false);
   listar();
$("#formularioc").on("submit",function(c){
   	editar_clave(c);
   })
   $("#formulario").on("submit",function(e){
   	guardaryeditar(e);
   })

   $("#imagenmuestra").hide();
//mostramos los permisos
$.post("../ajax/usuario.php?op=permisos&id=", function(r){
	$("#permisos").html(r);
});

   //cargamos los items al select departamento
   $.post("../ajax/departamento.php?op=selectDepartamento", function(r){
   	$("#iddepartamento").html(r);
   	$('#iddepartamento').selectpicker('refresh'); 
   });

   //cargamos los items al select cargo
   $.post("../ajax/cargo.php?op=selectCargo", function(r){
   	$("#idcargo").html(r);
   	$('#idcargo').selectpicker('refresh'); 
   });

   //cargamos los items al select turno
   $.post("../ajax/turno.php?op=selectTurno", function(r){
   	$("#idturno").html(r);
   	$('#idturno').selectpicker('refresh'); 
   });

   //cargamos los items al select tipousuario
   $.post("../ajax/tipousuario.php?op=selectTipousuario", function(r){
   	$("#idtipousuario").html(r);
   	$('#idtipousuario').selectpicker('refresh'); 
   });

}

//funcion limpiar
function limpiar(){
	$("#nombre").val("");
    $("#apellidos").val("");
	//$("#direccion").val("");
	$("#iddepartamento").selectpicker('refresh');
	$("#idtipousuario").selectpicker('refresh');
	$("#idcargo").selectpicker('refresh');
	$("#idturno").selectpicker('refresh');
	$("#email").val("");
	$("#login").val("");
	$("#clave").val("");
	$("#codigo_asistencia").val("");
	$("#imagenmuestra").attr("src","");
	$("#imagenactual").val("");
	$("#idusuario").val("");
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
function mostrarform_clave(flag){
	limpiar();
	if(flag){
		$("#listadoregistros").hide();
		$("#formulario_clave").show();
		$("#btnGuardar_clave").prop("disabled",false);
		$("#btnagregar").hide();
	}else{
		$("#listadoregistros").show();
		$("#formulario_clave").hide();
		$("#btnagregar").show();
	}
}
//cancelar form
function cancelarform(){
	$("#claves").show();
	limpiar();
	mostrarform(false);
}
function cancelarform_clave(){
	limpiar();
	mostrarform_clave(false);

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
			url:'../ajax/usuario.php?op=listar',
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
     	url: "../ajax/usuario.php?op=guardaryeditar",
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
$("#claves").show();
     limpiar();
}

function editar_clave(c){
     c.preventDefault();//no se activara la accion predeterminada 
     $("#btnGuardar_clave").prop("disabled",true);
     var formData=new FormData($("#formularioc")[0]);

     $.ajax({
     	url: "../ajax/usuario.php?op=editar_clave",
     	type: "POST",
     	data: formData,
     	contentType: false,
     	processData: false,

     	success: function(datos){
     		bootbox.alert(datos);
     		mostrarform_clave(false);
     		tabla.ajax.reload();
     	}
     });

     limpiar();
	 $("#getCodeModal").modal('hide');
}
function mostrar(idusuario){
	$.post("../ajax/usuario.php?op=mostrar",{idusuario : idusuario},
		function(data,status)
		{
			data=JSON.parse(data);
			mostrarform(true);
			if ($("#idusuario").val(data.idusuarios).length==0) {
           	$("#claves").show();
           	
           }else{
			$("#claves").hide();
			}
			$("#nombre").val(data.nombre);
            $("#iddepartamento").val(data.iddepartamento);
            $("#iddepartamento").selectpicker('refresh');
            $("#idtipousuario").val(data.idTipousuario);
            $("#idtipousuario").selectpicker('refresh');
            $("#idcargo").val(data.idCargo);
            $("#idcargo").selectpicker('refresh');
            $("#idturno").val(data.idTurno);
            $("#idturno").selectpicker('refresh');
            $("#apellidos").val(data.apellido);
            $("#email").val(data.email);
            $("#login").val(data.idusuarios);
            $("#codigo_asistencia").val(data.codigo_asistencia);
            $("#imagenmuestra").show();
            $("#imagenmuestra").attr("src","../files/usuarios/"+data.imagen);
            $("#imagenactual").val(data.imagen);
            $("#idusuario").val(data.idusuarios);

 
		});
	$.post("../ajax/usuario.php?op=permisos&id="+idusuario, function(r){
	$("#permisos").html(r);
});
}

function mostrar_clave(idusuario){
	//alert(idusuario);
	$("#getCodeModal").modal('show');
	$.post("../ajax/usuario.php?op=mostrar_clave",{idusuario : idusuario},
		function(data,status)
		{
			data=JSON.parse(data);
            $("#idusuarioc").val(data.idusuarios);
		});
}

//funcion para desactivar
function desactivar(idusuario){
	bootbox.confirm("¿Esta seguro de desactivar este dato?", function(result){
		if (result) {
			$.post("../ajax/usuario.php?op=desactivar", {idusuario : idusuario}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}

function activar(idusuario){
	bootbox.confirm("¿Esta seguro de activar este dato?" , function(result){
		if (result) {
			$.post("../ajax/usuario.php?op=activar", {idusuario : idusuario}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}

function generar(longitud)
{
  long=parseInt(longitud);
  var caracteres = "abcdefghijkmnpqrtuvwxyzABCDEFGHIJKLMNPQRTUVWXYZ2346789";
  var contraseña = "";
  for (i=0; i<long; i++) contraseña += caracteres.charAt(Math.floor(Math.random()*caracteres.length));
    $("#codigo_asistencia").val(contraseña);
}

init();