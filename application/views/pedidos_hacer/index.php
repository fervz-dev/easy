<?php $this->load->view('hed');?>
<script>

function finalizar_producto(id) {
  $.ajax({
          async:true,cache: false,
          beforeSend:function(objeto){$('#loading').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');},
          type:"POST",
          url:"<?php echo base_url();?>pedidos_hacer/cerrar_producto/"+id,
          datatype:"html",
          success:function(data, textStatus){

              switch(data){
                case "0":
                  notify("Error al procesar los datos " ,500,5000,'error');
                break;
                case "1":
                  $( "#dialogo" ).dialog( "close" );
                  $("#tbl_p_prove").trigger("reloadGrid");
                  notify('Pedido cerrado satisfactoriamente',500,5000,'aviso');

              break;

              default:
              $( "#dialogo").dialog( "close" );

              break;

              }//switch
              },
              error:function(datos){
              notify("Error inesperado" ,500,5000,'error');
              }//Error
              });//Ajax

}
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
          url:"<?php echo base_url();?>pedidos_hacer/cerrar_pedido/"+id,
          datatype:"html",
          success:function(data, textStatus){

              switch(data){
                case "0":
                  notify("Error al procesar los datos " ,500,5000,'error');
                break;
                case "1":
                  $( "#dialogo" ).dialog( "close" );
                  $("#tbl_p_prove").trigger("reloadGrid");
                  notify('Pedido cerrado satisfactoriamente',500,5000,'aviso');

              break;

              default:
              $( "#dialogo").dialog( "close" );

              break;

              }//switch
              },
              error:function(datos){
              notify("Error inesperado" ,500,5000,'error');
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




function cargar () {
    $("#tbl_p_prove").jqGrid({
    url:'<?php echo base_url();?>pedidos_hacer/paginacion',
    datatype: "json",
    mtype: 'POST',

                        colNames:['Acciones',
                                    'ID PEDIDO',
                                    'FECHA DE PEDIDO',
                                    'FECHA DE ENTREGA',
                                    'LUGAR DE ENVIO'
                                    ],
                        colModel:[{name:'acciones', index:'acciones', width:60, resizable:true, align:"center", search:false},
                                  {name:'id_pedido', index:'id_pedido', width:30,resizable:true, sortable:true,search:true,editable:true},
                                  {name:'fecha_pedido', index:'fecha_pedido', width:30,resizable:true, sortable:true,search:true,editable:true},
                                  {name:'fecha_entrega', index:'fecha_entrega', width:30,resizable:true, sortable:true,search:true,editable:true},
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
    caption: 'Pedidos Pendientes',
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

             {name:"largo",index:"largo",align:"left",search: false},
             {name:"ancho",index:"ancho",align:"left",search: false},
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
}
////////////////////////////////////////////////////////////////////////
  $(document).ready(function(){
  $("#tbl_p_prove").jqGrid({
    url:'<?php echo base_url();?>pedidos_hacer/paginacion',
    datatype: "json",
    mtype: 'POST',

                        colNames:['Acciones',
                                    'ID PEDIDO',
                                    'FECHA DE PEDIDO',
                                    'FECHA DE ENTREGA',
                                    'LUGAR DE ENVIO'
                                    ],
                        colModel:[{name:'acciones', index:'acciones', width:60, resizable:true, align:"center", search:false},
                                  {name:'id_pedido', index:'id_pedido', width:30,resizable:true, sortable:true,search:true,editable:true},
                                  {name:'fecha_pedido', index:'fecha_pedido', width:30,resizable:true, sortable:true,search:true,editable:true},
                                  {name:'fecha_entrega', index:'fecha_entrega', width:30,resizable:true, sortable:true,search:true,editable:true},
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
    caption: 'Pedidos Pendientes',
    multiselect: false,
    height:'auto',
    loadtext: 'Cargando',
  width:'950',
  subGrid: true,
    // searchurl:'<?php echo base_url();?>empresas/buscando',
    height:"auto",
   subGridRowExpanded: function(subgrid_id, row_id) {
   var subgrid_table_id, pager_id; subgrid_table_id = subgrid_id+"_t"; pager_id = "p_"+subgrid_table_id;

   $("#"+subgrid_id).html("<table id='"+subgrid_table_id+"' alt='subtabla' class='scroll'></table><div id='"+pager_id+"' class='scroll'></div>");

   $("#"+subgrid_table_id).jqGrid({
   //url:"subgrid.php?q=2&id="+row_id,
   url:"<?php echo base_url();?>pedidos_hacer/subpaginacion/"+row_id,
   datatype: "json",
   mtype: 'POST',
   colNames: ['ACCI&Oacute;N',
                          'No',
                          'cantidad',
                          'observaciones',
                          'fecha_entrega',
                          'nombre',
                          'largo',
                          'ancho',
                          'alto',
                          'resistencia',
                          'corrugado',
                          'score',
                          'descripcion',
                          'id_archivos'
                          ],
   colModel: [
             {name:"acciones",index:"acciones",width:56,align:"center"},
             {name:"No",index:"No",width:56,align:"center"},
             {name:"cantidad",index:"cantidad",search: false,align:"center"},
             {name:"observaciones",index:"observaciones",align:"left",search: false},
             {name:"fecha_entrega",index:"fecha_entrega",align:"left",search: false},
             {name:"nombre",index:"nombre",align:"left",search: false},
             {name:"largo",index:"largo",width:56,align:"center"},
             {name:"ancho",index:"ancho",width:56,align:"center"},
             {name:"alto",index:"alto",search: false,align:"center"},
             {name:"resistencia",index:"resistencia",align:"left",search: false},
             {name:"corrugado",index:"corrugado",align:"left",search: false},
             {name:"score",index:"score",align:"left",search: false},
             {name:"descripcion",index:"descripcion",width:56,align:"center"},
             {name:"id_archivos",index:"id_archivos",width:56,align:"center"}

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

function confirmacion_producto_ (id,msg) {
$('#dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>'+msg+'</p>');

    $( "#dialog-confirm" ).dialog({
      resizable: false,
      height: 'auto',
      width: 'auto',
      modal: true,
      buttons: {
        "Eliminar": function() {
          $( this ).dialog( "close" );
          eliminar_producto_(id);
        },
        Cancel: function() {
          $( this ).dialog( "close" );
        }
      }
    });
    }

</script>
<div id="dialog-confirm" title="Confirmacion" style="display: none;">
</div>

        <table id="tbl_p_prove"></table>
        <div id="paginacion"> </div>

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