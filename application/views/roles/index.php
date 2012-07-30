<?php $this->load->view('hed');?>
<script>
function edit(id)
{
$("#dialog-alta").jqGrid('GridUnload');
document.form1.reset();
document.forms.form1.action= "<?php echo base_url();?>roles/editar/"+id;



$.ajax({
                        async:true,cache: false,
                        beforeSend:function(objeto){$('#loading').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');},
                        type:"GET",
                        url:"<?php echo base_url();?>roles/get/"+id+"/"+Math.random()*10919939116744,
                        datatype:"html",
                        success:function(data, textStatus){
                        dato= data.split('~');
                        $("#nombre").val(dato[0]);
                        $("#descripcion").val(dato[1]);
                        },
                        error:function(datos){
                        notify("Error al procesar los datos " ,500,5000,'error');
                          return false;
                        }//Error
                        });//Ajax

$("#respuesta_permisos").load('<?php echo base_url();?>roles/pantallas_permisos/'+id);



$( "#dialog-alta" ).dialog({
			autoOpen: false,
			height: 500,
			width: 800,
			modal: true,
			buttons: {
					Aceptar: function() {
        if (validarCamposForm1()==true) {
          document.form1.submit();
        }
      },
					Cancelar:function()
					{
        			$( "#dialog-alta" ).dialog( "close" );
					}
			},
			close: function() {}
		});
				$( "#dialog-alta" ).dialog( "open" );

}

function delet(id)
{
r=confirm('Esta seguro de eliminar el registro?');
if(r==true)
{
	$.ajax({
                      async:true,cache: false,
                      beforeSend:function(objeto){$('#loading').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');},
                      type:"POST",
                      url:"<?php echo base_url();?>roles/borrar/"+id,
                      datatype:"html",
                      success:function(data, textStatus){

                      switch(data){
                        case "0":                                          notify("Error al procesar los datos " ,500,5000,'error');
                      break;
                      case "1":
                        $( "#dialog-alta" ).dialog( "close" );

                        reloading();
                       notify('El registro se elimino correctamente',500,5000,'aviso');
                      break;

                      default:
                        $( "#dialog-alta" ).dialog( "close" );
                      break;

                              }//switch
                             },
                        error:function(datos){
                                notify("Error inesperado" ,500,5000,'error');
                             }//Error
                         });//Ajax
}

}



function reloading()
	{
	$("#tbl").trigger("reloadGrid")
	}

function alta() {
$("#dialog-alta").jqGrid('GridUnload');
document.form1.reset();
document.forms.form1.action= "<?php echo base_url();?>roles/guardar/";

 for (i=0;i<document.forms.form1.elements.length;i++){
      if(document.forms.form1.elements[i].type == "checkbox")
        { document.forms.form1.elements[i].checked=0; }
}

$("#nombre_especialidad").val('');
$( "#dialog-alta" ).dialog({
			autoOpen: false,
			height: 'auto',
			width: 'auto',
			modal: true,
			buttons: {
					Aceptar: function() {
					  if (validarCamposForm1()==true) {
               document.form1.submit();
            }

					},
					Cancelar:function()
					{
				$( "#dialog-alta" ).dialog( "close" );
					}
			},
			close: function() {}
		});

				$( "#dialog-alta" ).dialog( "open" );
}


</script>

     <script type="text/javascript">
    $(document).ready(function(){
	$("#tbl").jqGrid({
    url:'<?php echo base_url();?>roles/paginacion',
    datatype: "json",
    mtype: 'POST',

                        colNames:['ACCI&Oacute;N','NOMBRE','DESCRIPCI&Oacute;N'],
                        colModel:[
                        {name:'acciones', index:'acciones', width:100, resizable:false, align:"center", search:false},
                        {name:'nombre_rol', index:'nombre_rol', width:300,resizable:false, sortable:true,search:true,editable:true},
                        {name:'dsc_rol', index:'dsc_rol', width:300,resizable:false, sortable:true,search:false,editable:true}

                    ],
    pager: jQuery('#paginacion'),
    rownumbers:true,
	rowNum:15,
    rowList:[10,20,30],
    imgpath: '<?php echo base_url();?>img/editar.jpg',
    mtype: "POST",
    sortname: 'id_roles',
    viewrecords: true,
    sortorder: "asc",
	editable: true,
    caption: 'Roles',
    multiselect: false,
    height:'auto',
	width:700,
    loadtext: 'Cargando',
    searchurl:'<?php echo base_url();?>roles/buscando',
                height:"100%"
        }).navGrid("#paginacion", { edit: false, add: false, search: false, del: false, refresh:true });
        $("#tbl").jqGrid('filterToolbar', { stringResult: true, searchOnEnter: false }) ;
   });
function validarCamposForm1 () {
nombre=$('#nombre').val();
descripcion=$('#descripcion').val();
if (validarVacio(nombre)==false) {
    notify('* El campo <strong>NOMBRE</strong> no puede estar vacio!!!',500,5000,'error');
    $("#nombre").focus();
    return false;
}else if (validarVacio(descripcion)==false) {
    notify('* El campo <strong>DESCRIPCION</strong> no puede estar vacio!!!',500,5000,'error');
    $("#descripcion").focus();
    return false;
}else {
  return true;
}
}
</script>
<div id="dialog-confirm" title="Confirmacion" style="display: none;">
</div>
<table >
<tr>
<td><div onclick="alta()" id="alta"><img src="<?php '.base_url().' ?>img/nuevo.ico"></div>
</td>
<td >&nbsp;</td>
</tr>
</table>



        <table id="tbl"></table>
        <div id="paginacion"> </div>
<div style="display:none" id="dialog-alta" title="Roles">


<?php

$this->load->view('roles/alta');?>
</div>