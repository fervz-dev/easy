<?php $this->load->view('hed');?>
<script>
//////////////////////////////////////////// Alerta Pedido cerrado ///////////////////////////////////////////////////////////
function cerrado () {

   $( "#dialogo_cerrado" ).dialog({
      autoOpen: false,
      height: 'auto',
      width: 'auto',
      modal: true,
      buttons: {
          
          Cerrar:function()
          {   
        $( "#dialogo_cerrado" ).dialog( "close" );
          }
      },
      close: function() {}
    });
        $( "#dialogo_cerrado" ).dialog( "open" );
   
}
//////////////////////////////////////////// Alerta producto - Pedido cerrado ////////////////////////////////////////////////

function pedido_cerrado () {

   $( "#dialogo_cerrado" ).dialog({
      autoOpen: false,
      height: 'auto',
      width: 'auto',
      modal: true,
      buttons: {
          
          Cerrar:function()
          {   
        $( "#dialogo_cerrado" ).dialog( "close" );
          }
      },
      close: function() {}
    });
        $( "#dialogo_cerrado" ).dialog( "open" );
   
}
//////////////////////////////////////////// Espera id del pedido y confirmacion para cerrarlo ////////////////////
function cerrar_pedido(id,confirmacion)
{
if(confirmacion==true)
{
  $.ajax({
          async:true,cache: false,
          beforeSend:function(objeto){$('#loading').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');},
          type:"POST",
          url:"<?php echo base_url();?>pedidos_proveedor/cerrar_pedido/"+id,
          datatype:"html",
          success:function(data, textStatus){
                                            
                                            switch(data){
                                                          case "0": 
                                                                  $("#ErrorDatos").fadeIn();
                                                                  $("#ErrorDatos").html("Error al procesar los datos.");
                                                                  //alert("Error al procesar los datos ");
                                                          break;
                                             
                                                          case "1": 
                                                          
                                                                  $( "#dialogo" ).dialog( "close" );
                                                                  // alert('editado');
                                                                  // guardar_paciente(data);
                                                                  $("#tbl_p_prove").trigger("reloadGrid"); 
                                                                  msg('Pedido cerrado satisfacotiramente');
                                                          break;
                                                 
                                                          default:
                                                                  $( "#dialogo").dialog( "close" );
                                                                  //alert('Vacante guardada');
                                                                  // reloading();
                                                          break; 
                                            
                                                        }//switch
                                            },
          error:function(datos){
                                alert("Error inesparado");
                             }//Error
          });//Ajax
}

}
//////////////////////////////////////////// Funcion para cerrar Pedido a proveedores /////////////////////////////
function abierto (id) {
  $( "#dialogo" ).dialog({
      autoOpen: false,
      height: 'auto',
      width: 'auto',
      modal: true,
      buttons: {
          Aceptar: function() {
            var confirmacion=true;
           cerrar_pedido(id,confirmacion);        
          },
          Cancelar:function()
          {   
        $( "#dialogo" ).dialog( "close" );
          }
      },
      close: function() {}
    });
        $( "#dialogo" ).dialog( "open" );

}

////////////////////////////////////////////agregar producto///////////////////////////////////////////////////////
function add(id)
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
          $("#tbl_p_prove").trigger("reloadGrid");     
          }
      },
      close: function() {}
    });
        $( "#dialog-procesos_producto" ).dialog( "open" );
        $("#tbl_p_prove").trigger("reloadGrid");
}



/////////////////////////////////////////////////////////////////
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

function edit(id)
{
document.editar_pedido.reset();
$.ajax({
            async:true,cache: false,
            beforeSend:function(objeto){$('#loading').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');},
            type:"GET",
            url:"<?php echo base_url();?>pedidos_proveedor/get/"+id+"/"+Math.random()*10919939116744,
            datatype:"html",
            success:function(data, textStatus){ 
            dato= data.split('~');
            $("#fecha_entrega").val(dato[0]);
            $("#proveedor_id_proveedor").val(dato[1]);
            $("#oficina").val(dato[2]);
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
//Funcion editar empleado

function editar(id)
{

$.ajax({
          async:true,cache: false,
          beforeSend:function(objeto){$('#loading').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');},
           type:"POST",
            url:"<?php echo base_url();?>pedidos_proveedor/editar_pedido/"+id,
          data:{"fecha_entrega":$("#fecha_entrega").val(),
                  "proveedor_id_proveedor":$("#proveedor_id_proveedor").val(),
                  "oficina":$("#oficina").val()},

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

  

function guardar_pedido()
{
$.ajax({
          async:true,cache: false,
          beforeSend:function(objeto){$('#loading').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');},
           type:"POST",
            url:"<?php echo base_url();?>pedidos_proveedor/guardar_pedido?da="+Math.random()*2312,
          data:{"fecha_entrega":$("#fecha_entrega").val(),
                            "proveedor_id_proveedor":$("#proveedor_id_proveedor").val(),
                  "oficina":$("#oficina").val()},

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


function eliminar_producto(id)
{
r=confirm('Esta seguro de eliminar el registro?');
if(r==true)
{
  $.ajax({
                      async:true,cache: false,
                      beforeSend:function(objeto){$('#loading').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');},
                      type:"POST",
                      url:"<?php echo base_url();?>pedidos_proveedor/eliminar_producto/"+id,
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


///////////////////////////////////////eliminar pedido con sus productos ////////////////////////////////////////
function eliminar_pedido(id)
{
r=confirm('Esta seguro de eliminar el registro?');
if(r==true)
{
  $.ajax({
                      async:true,cache: false,
                      beforeSend:function(objeto){$('#loading').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');},
                      type:"POST",
                      url:"<?php echo base_url();?>pedidos_proveedor/eliminar_pedido/"+id,
                      datatype:"html",
                      success:function(data, textStatus){

                             switch(data){
                               case "0": 
                                  alert("Error al procesar los datos ");
                                break;
                               case "1":
                               $("#tbl_p_prove").trigger("reloadGrid");
                                    $( "#dialog-procesos" ).dialog( "close" );
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

////////////////////////////////////////////////////////////////////////   
  $(document).ready(function(){
	$("#tbl_p_prove").jqGrid({
    url:'<?php echo base_url();?>pedidos_proveedor/paginacion',
    datatype: "json",
    mtype: 'POST',
		      
                        colNames:['Acciones',
                                    'ID PEDIDO',
                                    'FECHA DE PEDIDO',
                                    'FECHA DE ENTREGA',
                                    'PROVEEDOR',
                                    'LUGAR DE ENVIO'
                                    ],
                        colModel:[{name:'acciones', index:'acciones', width:60, resizable:true, align:"center", search:false},
                                  {name:'id_pedido', index:'id_pedido', width:30,resizable:true, sortable:true,search:true,editable:true},
                                  {name:'fecha_pedido', index:'fecha_pedido', width:30,resizable:true, sortable:true,search:true,editable:true},
                                  {name:'fecha_entrega', index:'fecha_entrega', width:30,resizable:true, sortable:true,search:true,editable:true},
                                  {name:'nombre_empresa', index:'nombre_empresa', width:100,resizable:true, sortable:true,search:true,editable:true},
                                  {name:'nombre_oficina', index:'nombre_oficina', width:90,resizable:true, sortable:true,search:true,editable:true}
                                ],                             
    pager: jQuery('#paginacion'),
    rownumbers:true,
  rowNum:15,
    rowList:[10,20,30],
    imgpath: '<?php echo base_url();?>img/editar.jpg',
    mtype: "POST",
    sortname: 'id_pedido',
    viewrecords: true,
    sortorder: "asc",
  editable: true,
    caption: 'Empresas',
    multiselect: false,
    height:'auto',
    loadtext: 'Cargando',
  width:'950',
  subGrid: true, 
    searchurl:'<?php echo base_url();?>empresas/buscando',
    height:"auto",
   subGridRowExpanded: function(subgrid_id, row_id) {
   var subgrid_table_id, pager_id; subgrid_table_id = subgrid_id+"_t"; pager_id = "p_"+subgrid_table_id;
   
   $("#"+subgrid_id).html("<table id='"+subgrid_table_id+"' alt='subtabla' class='scroll'></table><div id='"+pager_id+"' class='scroll'></div>"); 
   
   $("#"+subgrid_table_id).jqGrid({ 
   //url:"subgrid.php?q=2&id="+row_id, 
   url:"<?php echo base_url();?>pedidos_proveedor/subpaginacion/"+row_id,
   datatype: "json",
   mtype: 'POST',
   colNames: ['ACCI&Oacute;N', 'No', 'NOMBRE','ANCHO','LARGO','CANTIDAD'],    
   colModel: [
             {name:"acciones",index:"acciones",width:56,align:"center"},
             {name:"No",index:"No",width:56,align:"center"},
             {name:"nombre",index:"nombre",search: false,align:"center"},
             {name:"ancho",index:"ancho",align:"left",search: false},
             {name:"largo",index:"largo",align:"left",search: false},
             {name:"cantidad",index:"cantidad",align:"left",search: false}
              ],
   rows:10, 
   rowNum:10,
   rowList:[10,15],
   pager: pager_id,
   sortname: 'id_cantidad_pedido',
   height:'auto',
   sortorder: "asc" }); 
   
   $("#"+subgrid_table_id).jqGrid('navGrid',"#"+pager_id,{edit:false,add:false,del:false,search:false}) }
        }).navGrid("#paginacion", { edit: false, add: false, search: false, del: false, refresh:true });
        $("#tbl_p_prove").jqGrid('filterToolbar', { stringResult: true, searchOnEnter: false }) ; 
      $("#tbl_p_prove").jqGrid('navGrid','#paginacion',{add:false,edit:false,del:false,search:false});
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
        $this->load->view('pedidos_proveedores/formulario');?>
        </div>
<!-- formulario de nuevo producto -->
        <div style="display:none" id="dialog-procesos_producto" title="Pedidos">
        <?php 
        $this->load->view('pedidos_proveedores/formulario_producto');?>
        </div>
        <!-- Funcion dialogo -->
        <div style="display:none;" id="dialogo" >
          <div class="ui-widget">
            <div class="ui-state-error ui-corner-all" style="padding: 0 .7em;">
              <p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>
              <strong>Precaución:</strong> Esta seguro de cerrar el pedido?</p>
            </div>
          </div>
        </div>
        <!-- Pedido cerrado -->
        <div style="display:none;" id="dialogo_cerrado" >
          <div class="ui-widget">
            <div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;">
              <p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
              <strong>Alerta:</strong> El Pedido ya esta cerrado!!!</p>
            </div>
          </div>
        </div>