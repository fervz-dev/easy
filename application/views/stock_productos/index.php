<script type="text/javascript">
	// Recargar grid
	// 
function alta(id)
{

$( "#id_pedido").val(id);
$( "#dialog-procesos_producto" ).dialog({
      autoOpen: false,
      height: 'auto',
      width: 'auto',
      modal: true,
      buttons: {
          Aceptar: function() {
          $( "#dialog-procesos_producto" ).dialog( "close" );
          $("#tbl").trigger("reloadGrid");
          }
      },
      close: function() {}
    });
        $( "#dialog-procesos_producto" ).dialog( "open" );
        $("#tbl").trigger("reloadGrid");
}
function cargar () {
  $("#tbl").jqGrid({
url:'<?php echo base_url();?>stock_productos/paginacion',
    datatype: "json",
    mtype: 'POST',
                        colNames:['Acciones','CLIENTE','NOMBRE','LARGO','ANCHO','ALTO','RESISTENCIA','CORRUGADO','SCORE','DESCRIPCION','CANTIDAD'],
                        colModel:[{name:'acciones', index:'acciones', width:60, resizable:true, align:"center", search:false},
                              {name:'nombre_cliente', index:'nombre_cliente', width:170,resizable:true, sortable:true,search:false,editable:false},
                              {name:'nombre', index:'nombre', width:170,resizable:true, sortable:true,search:false,editable:false},
                              {name:'largo', index:'largo', width:50,resizable:true, sortable:true,search:false,editable:false},
                              {name:'ancho', index:'ancho', width:50,resizable:true, sortable:true,search:false,editable:false},
                              {name:'alto', index:'alto', width:50,resizable:true, sortable:true,search:false,editable:false},
                              {name:'resistencia', index:'resistencia', width:100,resizable:true, sortable:true,search:false,editable:false},
                              {name:'corrugado', index:'corrugado', width:80,resizable:true, sortable:true,search:false,editable:false},
                              {name:'score', index:'score', width:50,resizable:true, sortable:true,search:false,editable:false},
                              {name:'descripcion', index:'descripcion', width:170,resizable:true, sortable:true,search:false,editable:false},
                              {name:'cantidad', index:'cantidad', width:170,resizable:true, sortable:true,search:false,editable:false}



                                ],
    pager: jQuery('#paginacion'),
    rownumbers:true,
  rowNum:10,
    rowList:[10,20,30],
    imgpath: '<?php echo base_url();?>img/editar.jpg',
    mtype: "POST",
    sortname: 'id_catalogo',
    viewrecords: true,
    sortorder: "asc",
  editable: true,
    caption: 'Stock de Productos',
    multiselect: false,
    height:'auto',
    loadtext: 'Cargando',
  width:'100%',
    //searchurl:'<?php echo base_url();?>empresas/buscando',
                height:"auto"
        }).navGrid("#paginacion", { edit: false, add: false, search: false, del: false, refresh:true });
        $("#tbl").jqGrid('filterToolbar', { stringResult: true, searchOnEnter: false }) ;
      }
$(document).ready(function(){
  $("#tbl").jqGrid({
    url:'<?php echo base_url();?>stock_productos/paginacion',
    datatype: "json",
    mtype: 'POST',
                        colNames:['Acciones','CLIENTE','NOMBRE','LARGO','ANCHO','ALTO','RESISTENCIA','CORRUGADO','SCORE','DESCRIPCION','CANTIDAD'],
                        colModel:[{name:'acciones', index:'acciones', width:60, resizable:true, align:"center", search:false},
                              {name:'nombre_cliente', index:'nombre_cliente', width:170,resizable:true, sortable:true,search:false,editable:false},
                              {name:'nombre', index:'nombre', width:170,resizable:true, sortable:true,search:false,editable:false},
                              {name:'largo', index:'largo', width:50,resizable:true, sortable:true,search:false,editable:false},
                              {name:'ancho', index:'ancho', width:50,resizable:true, sortable:true,search:false,editable:false},
                              {name:'alto', index:'alto', width:50,resizable:true, sortable:true,search:false,editable:false},
                              {name:'resistencia', index:'resistencia', width:100,resizable:true, sortable:true,search:false,editable:false},
                              {name:'corrugado', index:'corrugado', width:80,resizable:true, sortable:true,search:false,editable:false},
                              {name:'score', index:'score', width:50,resizable:true, sortable:true,search:false,editable:false},
                              {name:'descripcion', index:'descripcion', width:170,resizable:true, sortable:true,search:false,editable:false},
                              {name:'cantidad', index:'cantidad', width:170,resizable:true, sortable:true,search:false,editable:false}



                                ],
    pager: jQuery('#paginacion'),
    rownumbers:true,
  rowNum:10,
    rowList:[10,20,30],
    imgpath: '<?php echo base_url();?>img/editar.jpg',
    mtype: "POST",
    sortname: 'id_catalogo',
    viewrecords: true,
    sortorder: "asc",
  editable: true,
    caption: 'Stock de Productos',
    multiselect: false,
    height:'auto',
    loadtext: 'Cargando',
  width:'100%',
    //searchurl:'<?php echo base_url();?>empresas/buscando',
                height:"auto"
        }).navGrid("#paginacion", { edit: false, add: false, search: false, del: false, refresh:true });
        $("#tbl").jqGrid('filterToolbar', { stringResult: true, searchOnEnter: false }) ;
   });


function restar (id) {
  $( "#dialog-procesos-cantidad" ).dialog({
 autoOpen: false,
      height: 'auto',
      width: 'auto',
      modal: true,
      buttons: {
          Aceptar: function() {
                         if (ValidarResta()==true) {
              guardar_Resta(id);
              $("#cantidadRestar").val('');

            }

            },
          Cancelar:function()
          {
              $( "#dialog-procesos-cantidad" ).dialog( "close" );
          }
      },
      close: function() {}
    });
        $( "#dialog-procesos-cantidad" ).dialog( "open" );

}
    
function ValidarResta () {
cantidad=$('#cantidadRestar').val();
if (validarVacio(cantidad)==false) {
  notify('* El campo <strong>CANTIDAD</strong> no puede estar vacio!!!',500,5000,'error');
    $("#cantidadRestar").focus();
  return false;
}else if (validarNUmero(cantidad)==false) {
  notify('* El campo <strong>CANTIDAD</strong> no es un numero!!!',500,5000,'error');
    $("#cantidadRestar").focus();
  return false
}else {
  return true;
}
}

function guardar_Resta (id) {
  $.ajax({
          async:true,cache: false,
          beforeSend:function(objeto){$('#loading').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');},
           type:"POST",
            url:"<?php echo base_url();?>stock_productos/guardarResta?da="+Math.random()*2312,
          data:{
                  "Id_stock":id,
                  "cantidadRestar":$("#cantidadRestar").val()
                },

                     datatype:"html",
                      success:function(data, textStatus){

                             switch(data){
                               case "0":
                               setTimeout("cargar()",1000);
                             notify("Error al procesar los datos " ,500,5000,'error');
                      break;
                              case "1":
                            setTimeout("cargar()",1000);
                               notify('El registro se guardado correctamente',500,5000,'aviso');
                         $( "#dialog-procesos-cantidad" ).dialog( "close" );
                     break;
                     case "2":
                            setTimeout("cargar()",1000);
                               notify('CANTIDAD MAYOR A LA DE STOCK',500,5000,'error');
                         $( "#dialog-procesos-cantidad" ).dialog( "close" );
                     break;

                                   default:
                                   setTimeout("cargar()",1000);
                                   $( "#dialog-procesos-cantidad" ).dialog( "close" );
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
</script>
<table >
<tr>
<td><?php if (!isset($_GET['submain'])) {
}  elseif (($this->permisos->permisos_submenus($_GET['m'],$_GET['submain'],0)==1)&&($this->permisos->permisos($_GET['submain'],2)==1)) {?>

  <div onclick="alta()" id="alta"><img src="<?php '.base_url().' ?>img/nuevo.ico" title="Nuevo Registro"></div>
  <?php  }?>
</td>
<td >&nbsp;</td>
</tr>
</table>
        <table id="tbl"></table>
        <div id="paginacion"> </div>
       <div style="display:none" id="dialog-procesos-cantidad" title="Cantidad a Retirar">
        <?php $this->load->view('stock_productos/restar.php');?>
      </div>
 <!-- formulario de nuevo producto -->
        <div style="display:none" id="dialog-procesos_producto" title="Pedidos">
        <?php
        $this->load->view('stock_productos/formulario_productos');?>
        </div>