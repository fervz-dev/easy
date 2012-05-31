<?php $this->load->view('hed');?>
<script>
//////////////////////////////////////////GUARDAR ID EDITADO//////////////////////////
function editar(id)
{

$.ajax({
          async:true,cache: false,
          beforeSend:function(objeto){$('#loading').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');},
           type:"POST",
            url:"<?php echo base_url();?>pedidos_reutilizable/editar_pedido/"+id,
           data:{"fecha_entrega":$("#fecha_entrega").val(),
                "proveedor_id_proveedor":$("#proveedor_id_proveedor").val(),
                  "oficina":$("#oficina").val(),
                  "cantidad":$("#cantidad").val()},

                     datatype:"html",
                      success:function(data, textStatus){

                          switch(data){
                              case "0": 
                                  alert("Error al procesar los datos ");
                              break;
                              
                              case "1": 
                                  $("#tbl_p_prove").trigger("reloadGrid");
                                  msg('El registro se ha guardado correctamente');
                                  $( "#dialog-procesos" ).dialog( "close" );
                              break;

                              default:
                                  $( "#dialog-procesos" ).dialog( "close" );
                                  alert("Error "+data);
                              break; 
                              }//switch
                             },
                        error:function(datos){
                              alert("Error inesperado");
                             }//Error
                         });//Ajax      


}



//////////////////////////////////////////GUARDAR PEDIDO//////////////////////////////
function guardar_pedido()
{
$.ajax({
          async:true,cache: false,
          beforeSend:function(objeto){$('#loading').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');},
           type:"POST",
            url:"<?php echo base_url();?>pedidos_reutilizable/guardar_pedido?da="+Math.random()*2312,
          data:{"fecha_entrega":$("#fecha_entrega").val(),
                "proveedor_id_proveedor":$("#proveedor_id_proveedor").val(),
                  "oficina":$("#oficina").val(),
                  "cantidad":$("#cantidad").val()},

                     datatype:"html",
                      success:function(data, textStatus){

                      switch(data){
                               case "0": 
                                  alert("Error al procesar los datos ");
                                break;
                                
                                case "1": 
                                   $("#tbl_p_prove").trigger("reloadGrid");
                                    msg('El registro se ha guardado correctamente');
                                   $( "#dialog-procesos" ).dialog( "close" );
                                break;

                                default:
                                   $( "#dialog-procesos" ).dialog( "close" );
                                  alert("Error "+data);
                                break; 

                              }//switch
                             },
                        error:function(datos){
                              alert("Error inesperado");
                             }//Error
                         });//Ajax      

}



//////////////////////////////////////////ELIMINAR PEDIDO////////////////////////////

function eliminar_pedido(id)
{
r=confirm('Esta seguro de eliminar el registro?');
if(r==true)
{
  $.ajax({
                      async:true,cache: false,
                      beforeSend:function(objeto){$('#loading').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');},
                      type:"POST",
                      url:"<?php echo base_url();?>pedidos_reutilizable/eliminar_pedido/"+id,
                      datatype:"html",
                      success:function(data, textStatus){

                             switch(data){
                               case "0": 
                                  alert("Error al procesar los datos ");
                                break;
                               case "1": 
                                    $( "#dialog-procesos" ).dialog( "close" );
                  
                                 $("#tbl_p_prove").trigger("reloadGrid");
                                 msg('Registro eliminado correctamente');
                                break;

                                   default:
                                   $( "#dialog-procesos" ).dialog( "close" );                   
                                 break; 

                              }//switch
                             },
                        error:function(datos){
                              alert("Error inesparado");
                             }//Error
                         });//Ajax
}

}

//////////////////////////////////////////EDITAR PEDIDO//////////////////////////////
function edit(id)
{
document.editar_pedido.reset();
$.ajax({
            async:true,cache: false,
            beforeSend:function(objeto){$('#loading').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');},
            type:"GET",
            url:"<?php echo base_url();?>pedidos_reutilizable/get/"+id+"/"+Math.random()*10919939116744,
            datatype:"html",
            success:function(data, textStatus){ 
            dato= data.split('~');
            $("#fecha_entrega").val(dato[0]);
            $("#proveedor_id_proveedor").val(dato[1]);
            $("#oficina").val(dato[2]);
            $("#cantidad").val(dato[3]);
            },
        error:function(datos){
        alert("Error al procesar los datos ");
          return false;
        }//Error
        });//Ajax


$( "#dialog-procesos" ).dialog({
      autoOpen: false,
      height: 'auto',
      width: 'auto',
      modal: true,
      buttons: {
          Aceptar: function() {
          editar(id);
          msg('El registro se ha editado correctamente');
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






///////////////////////////////////////////////////////aLTA DE NUEVO PEDIDO REUTILIZABLE////////////

function alta()
{

document.editar_pedido.reset();

$( "#dialog-procesos" ).dialog({
      autoOpen: false,
      height: 'auto',
      width: 'auto',
      modal: true,
      buttons: {
          Aceptar: function() {
          guardar_pedido();        
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


////////////////////////////PAGINACIONES////////////////////////////////////////////   
  $(document).ready(function(){
	$("#tbl_p_prove").jqGrid({
    url:'<?php echo base_url();?>pedidos_reutilizable/paginacion',
    datatype: "json",
    mtype: 'POST',
		      
                        colNames:['Acciones',
                                    'FECHA DE PEDIDO',
                                    'FECHA DE ENTREGA',
                                    'CANTIDAD',
                                    'PROVEEDOR',
                                    'LUGAR DE ENVIO'
                                    ],
                        colModel:[{name:'acciones', index:'acciones', width:60, resizable:true, align:"center", search:false},
                                  {name:'fecha_pedido', index:'fecha_pedido', width:30,resizable:true, sortable:true,search:true,editable:true},
                                  {name:'fecha_entrega', index:'fecha_entrega', width:30,resizable:true, sortable:true,search:true,editable:true},
                                  {name:'cantidad', index:'cantidad', width:30,resizable:true, sortable:true,search:true,editable:true},
                                  {name:'nombre_empresa', index:'nombre_empresa', width:100,resizable:true, sortable:true,search:true,editable:true},
                                  {name:'nombre_oficina', index:'nombre_oficina', width:90,resizable:true, sortable:true,search:true,editable:true}
                                ],                             
    pager: jQuery('#paginacion'),
    rownumbers:true,
  rowNum:15,
    rowList:[10,20,30],
    imgpath: '<?php echo base_url();?>img/editar.jpg',
    mtype: "POST",
    sortname: 'id_pedido_reutilizable',
    viewrecords: true,
    sortorder: "asc",
  editable: true,
    caption: 'Pedido Reutilizable',
    multiselect: false,
    height:'auto',
    loadtext: 'Cargando',
  width:'950',  
        }).navGrid("#paginacion", { edit: false, add: false, search: false, del: false, refresh:true });
        $("#tbl_p_prove").jqGrid('filterToolbar', { stringResult: true, searchOnEnter: false }) ; 
   });                
</script>

<table align="center"  width="90%">
<tr>
<td><div onclick="alta()" id="alta"><img src="<?php '.base_url().' ?>img/nuevo.ico"></div>
</td>
<td></td>
<td >&nbsp;</td>
</tr>
</table>
        <table id="tbl_p_prove"></table>
        <div id="paginacion"> </div>    
        <div style="display:none" id="dialog-procesos" title="Pedidos">
        <?php 
        $this->load->view('pedidos_reutilizable/formulario');?>
        </div>
