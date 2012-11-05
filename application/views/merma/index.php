<script type="text/javascript">
function guardar()
{

$.ajax({
          async:true,cache: false,
          beforeSend:function(objeto){$('#loading').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');},
           type:"POST",
            url:"<?php echo base_url();?>merma/guardar?da="+Math.random()*2312,
            data:{"oficina":$("#oficina").val(),
                  "cantidad":$("#cantidad").val(),
                  "fecha_venta":$("#fecha_ingreso").val(),
                  "clientes":$("#clientes").val()
                },

                     datatype:"html",
                      success:function(data, textStatus){

                             switch(data){
                               case "0":
                                notify("Error al procesar los datos " ,500,5000,'error');
                               break;
                               case "1":
                                reloading();
                                notify('El registro se guardo correctamente',500,5000,'aviso');
                                $( "#dialog-procesos" ).dialog( "close" );
                               break;
                               default:
                                $( "#dialog-procesos" ).dialog( "close" );
                                 var error='Error'+data;
                                 notify(error ,500,5000,'error');
                               break;

                              }//switch
                             },
                        error:function(datos){
                              notify("Error inesperado" ,500,5000,'error');
                             }//Error
                         });//Ajax

}

function reloading()
{

  $("#tbl").trigger("reloadGrid")
}
function alta()
	{
	document.venta_merma.reset();
	$( "#dialog-procesos" ).dialog({
      autoOpen: false,
      height: 'auto',
      width: 'auto',
      modal: true,
      buttons: {
          Aceptar: function() {
            if (validarCampos()==true) {
              guardar();
            }


          },
          Cancelar:function()
          {
        $( "#dialog-procesos" ).dialog( "close" );
          }
      },
      close: function() {}
    });
        $( "#dialog-procesos" ).dialog( "open" );

}
	$(document).ready(function(){
	$("#tbl").jqGrid({
    url:'<?php echo base_url();?>merma/paginacion',
    datatype: "json",
    mtype: 'POST',
                        colNames:['Acciones','OFICINA','CANTIDAD','FECHA DE VENTA','CLIENTE'],
                        colModel:[{name:'acciones', index:'acciones', width:50,resizable:true, sortable:true,search:false,editable:false},
                                  {name:'oficina_id_oficina', index:'oficina_id_oficina', width:70,resizable:true, sortable:true,search:false,editable:true},
                                  {name:'cantidad', index:'cantidad', width:100,resizable:true, sortable:true,search:false,editable:true},
                                  {name:'fecha_venta', index:'fecha_venta', width:60,resizable:true, sortable:true,search:false,editable:true},
                                  {name:'nombre_empresa', index:'nombre_empresa', width:60,resizable:true, sortable:true,search:false,editable:true}
                                ],
    pager: jQuery('#paginacion'),
    rownumbers:true,
	rowNum:10,
    rowList:[10,20,30],
    imgpath: '<?php echo base_url();?>img/editar.jpg',
    mtype: "POST",
    sortname: 'id_merma',
    viewrecords: true,
    sortorder: "asc",
	editable: true,
    caption: 'Venta de Merma',
    multiselect: false,
    height:'auto',
    loadtext: 'Cargando',
	width:'100%',
    //searchurl:'<?php echo base_url();?>empresas/buscando',
                height:"auto"
        }).navGrid("#paginacion", { edit: false, add: false, search: false, del: false, refresh:true });
        $("#tbl").jqGrid('filterToolbar', { stringResult: true, searchOnEnter: false }) ;
   });

function validarCampos () {
	oficina=$('#oficina').val();
	cantidad=$('#cantidad').val();
	fecha_ingreso=$('#fecha_ingreso').val();
	clientes=$('#clientes').val();

	if (validarCombo(oficina)==false) {
 			notify('* Debe seleccionar almenos una opcion de la lista <strong>OFICINA</strong>',500,5000,'error');
              $("#oficina").focus();
              return false;
	}else if (validarVacio(cantidad)==false) {
			notify('* El campo <strong>CANTIDAD</strong> no puede estar vacio!!!',500,5000,'error');
              $("#cantidad").focus();
              return false;
	}else if (validarNUmero(cantidad)==false) {
			notify('* El campo <strong>CANTIDAD</strong> no es numero!!!',500,5000,'error');
              $("#cantidad").focus();
              return false;
	}else if (validarVacio(fecha_ingreso)==false) {

				notify('* El campo <strong>FECHA DE VENTA</strong> no puede estar vacio!!!',500,5000,'error');
              $("#fecha_ingreso").focus();
              return false;
	}else if (validarCombo(clientes)==false) {
			 notify('* Debe seleccionar almenos una opcion de la lista <strong>CLIENTES</strong>',500,5000,'error');
              $("#clientes").focus();
              return false;
	}else{
		return true;
	}

}
</script>
<table >
<tr>
<td>
  <?php
if (!isset($_GET['submain'])) {
}  elseif (($this->permisos->permisos_submenus($_GET['m'],$_GET['submain'],0)==1)&&($this->permisos->permisos($_GET['submain'],2)==1)) {?>
        <div onclick="alta()" id="alta"><img src="<?php '.base_url().' ?>img/nuevo.ico" title="Nuevo Registro"></div>
  <?php  }?>

</td>
<td >&nbsp;</td>
</tr>
</table>
        <table id="tbl"></table>
        <div id="paginacion"> </div>
         <div style="display:none" id="dialog-procesos" title="Formulario Venta de Merma">
        <?php

        $this->load->view('merma/formulario');?>
