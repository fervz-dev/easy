<script type="text/javascript">


  function confirmacion_eliminarProducto (id,msg) {
$('#dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>'+msg+'</p>');

    $( "#dialog-confirm" ).dialog({
      resizable: false,
      height: 'auto',
      width: 'auto',
      modal: true,
      buttons: {
        "Eliminar": function() {
          $( this ).dialog( "close" );

          eliminarProductoPedidoAjax(id);
        },
        Cancel: function() {
          $( this ).dialog( "close" );
        }
      }
    });
    }


function eliminarProductoPedido (id) {
  msg="Este registro se eliminara. ¿Estás seguro?";
  confirmacion_eliminarProducto(id,msg);
}

function eliminarProductoPedidoAjax (id) {
  $.ajax({
          async:true,cache: false,
          beforeSend:function(objeto){$('#loading').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');},
          type:"POST",
          url:"<?php echo base_url();?>pedidos_bodega_prod_term/eliminarPorductoPedido/"+id,
           datatype:"html",
          success:function(data, textStatus){

              switch(data){
                case "0":
                  notify("Error al procesar los datos " ,500,5000,'error');
                     $("#tbl_lista_productos").trigger("reloadGrid");
                break;
                case "1":
                  // $( "#dialogo_pedido" ).dialog( "close" );
                  $("#tbl_lista_productos").trigger("reloadGrid");
                  notify('Pedido se marco como terminado satisfactoriamente',500,5000,'aviso');

              break;

              default:
              // $( "#dialogo_pedido").dialog( "close" );
               $("#tbl_lista_productos").trigger("reloadGrid");

              break;

              }//switch
              },
              error:function(datos){
              notify("Error inesperado" ,500,5000,'error');
                 $("#tbl_lista_productos").trigger("reloadGrid");
              }//Error
              });//Ajax
}
	 $(document).ready(function(){
  $("#tbl_p_prove_form").jqGrid({
    url:'<?php echo base_url();?>producto_final/paginacionProductosPedido',
    datatype: "json",
    mtype: 'POST',
                        colNames:['CLIENTE','NOMBRE','LARGO','ANCHO','ALTO','RESISTENCIA','CORRUGADO','SCORE','DESCRIPCION'],
                        colModel:[
                              {name:'nombre_empresa', index:'nombre_empresa', width:170,resizable:true, sortable:true,search:true,editable:false},
                              {name:'nombre', index:'nombre', width:170,resizable:true, sortable:true,search:true,editable:false},
                              {name:'largo', index:'largo', width:50,resizable:true, sortable:true,search:true,editable:false},
                              {name:'ancho', index:'ancho', width:50,resizable:true, sortable:true,search:true,editable:false},
                              {name:'alto', index:'alto', width:50,resizable:true, sortable:true,search:true,editable:false},
                              {name:'resistencia', index:'resistencia', width:100,resizable:true, sortable:true,search:true,editable:false},
                              {name:'corrugado', index:'corrugado', width:80,resizable:true, sortable:true,search:true,editable:false},
                              {name:'score', index:'score', width:50,resizable:true, sortable:true,search:true,editable:false},
                              {name:'descripcion', index:'descripcion', width:170,resizable:true, sortable:true,search:true,editable:false}
                                ],
    pager: jQuery('#paginacion_form'),
    rownumbers:true,
  rowNum:10,
    rowList:[10,20,30,40,50],
    imgpath: '<?php echo base_url();?>img/editar.jpg',
    mtype: "POST",
    sortname: 'nombre',
    viewrecords: true,
    sortorder: "asc",
  editable: true,
    caption: 'Catalogo de Productos',
    multiselect: true,
    height:'auto',
    loadtext: 'Cargando',
  width:'110%',
    subGrid: true,
    hiddengrid: true,
    searchurl:'<?php echo base_url();?>producto_final/buscandoListaCatalogo',
               height:"auto",
   subGridRowExpanded: function(subgrid_id, row_id) {
   var subgrid_table_id, pager_id; subgrid_table_id = subgrid_id+"_t"; pager_id = "p_"+subgrid_table_id;

   $("#"+subgrid_id).html("<table id='"+subgrid_table_id+"' alt='subtabla' class='scroll'></table><div id='"+pager_id+"' class='scroll'></div>");

   $("#"+subgrid_table_id).jqGrid({
   //url:"subgrid.php?q=2&id="+row_id,
   url:"<?php echo base_url();?>catalogo_producto/paginacionComponentesPedido/"+row_id,
   datatype: "json",
    mtype: 'POST',
                        colNames:['NOMBRE','LARGO','ANCHO','ALTO','RESISTENCIA','CORRUGADO','SCORE','DESCRIPCION'],
                        colModel:[
                             // {name:'nombre_empresa', index:'nombre_empresa', width:170,resizable:true, sortable:true,search:true,editable:false},
                              {name:'nombre', index:'nombre', width:170,resizable:true, sortable:true,search:true,editable:false},
                              {name:'largo', index:'largo', width:50,resizable:true, sortable:true,search:true,editable:false},
                              {name:'ancho', index:'ancho', width:50,resizable:true, sortable:true,search:true,editable:false},
                              {name:'alto', index:'alto', width:50,resizable:true, sortable:true,search:true,editable:false},
                              {name:'resistencia', index:'resistencia', width:100,resizable:true, sortable:true,search:true,editable:false},
                              {name:'corrugado', index:'corrugado', width:80,resizable:true, sortable:true,search:true,editable:false},
                              {name:'score', index:'score', width:50,resizable:true, sortable:true,search:true,editable:false},
                              {name:'descripcion', index:'descripcion', width:170,resizable:true, sortable:true,search:true,editable:false}
                                ],
    rownumbers:false,
    rows:10,
    pager: pager_id,
    sortname: 'nombre',
    height:'auto',
    sortorder: "asc" });

   $("#"+subgrid_table_id).jqGrid('navGrid',"#"+pager_id,{edit:false,add:false,del:false,search:false}) }
        }).navGrid("#paginacion_form", { edit: false, add: false, search: false, del: false, refresh:true });
        $("#tbl_p_prove_form").jqGrid('filterToolbar', { stringResult: true, searchOnEnter: false }) ;
      $("#tbl_p_prove_form").jqGrid('navGrid','#paginacion_form',{add:false,edit:false,del:false,search:false});

   });

function cargarListaProdutos (id) {
	$("#tbl_lista_productos").jqGrid({
    url:'<?php echo base_url();?>pedidos_bodega_prod_term/listaPedidos/'+id,
    datatype: "json",
    mtype: 'POST',
                        colNames:['Acciones','NOMBRE','LARGO','ANCHO','ALTO','RESISTENCIA','CORRUGADO','SCORE'],
                        colModel:[{name:'acciones', index:'acciones', width:60, resizable:true, align:"center", search:false},
                              {name:'nombre', index:'nombre', width:170,resizable:true, sortable:true,search:true,editable:false},
                              {name:'largo', index:'largo', width:50,resizable:true, sortable:true,search:true,editable:false},
                              {name:'ancho', index:'ancho', width:50,resizable:true, sortable:true,search:true,editable:false},
                              {name:'alto', index:'alto', width:50,resizable:true, sortable:true,search:true,editable:false},
                              {name:'resistencia', index:'resistencia', width:100,resizable:true, sortable:true,search:true,editable:false},
                              {name:'corrugado', index:'corrugado', width:80,resizable:true, sortable:true,search:true,editable:false},
                              {name:'score', index:'score', width:50,resizable:true, sortable:true,search:true,editable:false}
                              // {name:'descripcion', index:'descripcion', width:170,resizable:true, sortable:true,search:true,editable:false}
                                ],
    pager: jQuery('#paginacionLista'),
    rownumbers:true,
  rowNum:10,
    rowList:[10,20,30,40,50],
    imgpath: '<?php echo base_url();?>img/editar.jpg',
    mtype: "POST",
    sortname: 'nombre',
    viewrecords: true,
    sortorder: "asc",
  editable: true,
    caption: 'Lista de productos agregados',
    multiselect: false,
    height:'auto',
    loadtext: 'Cargando',
  width:'110%',
    subGrid: true,
    searchurl:'<?php echo base_url();?>producto_final/buscando',
               height:"auto",
   subGridRowExpanded: function(subgrid_id, row_id) {
   var subgrid_table_id, pager_id; subgrid_table_id = subgrid_id+"_t"; pager_id = "p_"+subgrid_table_id;

   $("#"+subgrid_id).html("<table id='"+subgrid_table_id+"' alt='subtabla' class='scroll'></table><div id='"+pager_id+"' class='scroll'></div>");

   $("#"+subgrid_table_id).jqGrid({
   //url:"subgrid.php?q=2&id="+row_id,
   url:"<?php echo base_url();?>pedidos_bodega_prod_term/subpaginacionPedidoProducto/"+row_id,
   datatype: "json",
    mtype: 'POST',
                        // colNames:['NOMBRE','LARGO','ANCHO','ALTO','RESISTENCIA','CORRUGADO','SCORE'],
                        colModel:[
                             // {name:'nombre_empresa', index:'nombre_empresa', width:170,resizable:true, sortable:true,search:true,editable:false},
                              {name:'nombre', index:'nombre', width:232,resizable:true, sortable:true, aling:"center", search:false,editable:false},
                              {name:'largo', index:'largo', width:50,resizable:true, sortable:true,search:false,editable:false},
                              {name:'ancho', index:'ancho', width:50,resizable:true, sortable:true,search:false,editable:false},
                              {name:'alto', index:'alto', width:50,resizable:true, sortable:true,search:false,editable:false},
                              {name:'resistencia', index:'resistencia', width:100,resizable:true, sortable:true,search:false,editable:false},
                              {name:'corrugado', index:'corrugado', width:80,resizable:true, sortable:true,search:false,editable:false},
                              {name:'score', index:'score', width:50,resizable:true, sortable:true,search:false,editable:false},

                                ],
    rownumbers:false,
    rows:10,
    pager: pager_id,
    sortname: 'nombre',
    height:'auto',
    sortorder: "asc" });

   $("#"+subgrid_table_id).jqGrid('navGrid',"#"+pager_id,{edit:false,add:false,del:false,search:false}) }
        }).navGrid("#paginacionLista", { edit: false, add: false, search: false, del: false, refresh:true });
        $("#tbl_lista_productos").jqGrid('filterToolbar', { stringResult: true, searchOnEnter: false }) ;
      $("#tbl_lista_productos").jqGrid('navGrid','#paginacionLista',{add:false,edit:false,del:false,search:false});
}
function addLIsta () {
	arrayRows=selecRow();
  alert(arrayRows);
	id=$('#id_pedido').val();
	$.ajax({
          async:true,cache: false,
          beforeSend:function(objeto){$('#loading').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');},
          type:"POST",
          url:"<?php echo base_url();?>pedidos_bodega_prod_term/guardarListArray/"+id,
          data:{"arrayRows":arrayRows
                },

                     datatype:"html",
                      success:function(data, textStatus){

                      switch(data){
                               case "0":
                                  notify("Error al procesar los datos " ,500,5000,'error');
                                break;

                                case "1":
                                   $("#tbl_p_prove").trigger("reloadGrid");
                                    notify('El registro se guardado correctamente',500,5000,'aviso');
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

function selecRow () {
	SelectRows=$('#tbl_p_prove_form').jqGrid('getGridParam','selarrrow');
	return SelectRows;
}
</script>
<table>
  <caption style="font-size: 18px; color: #2E6E9E;"> Seleccionar los productos para el pedido</caption>
  <tr>
    <td>
       <table id="tbl_p_prove_form"></table>
        <div id="paginacion_form"> </div>

    </td>
  </tr>
  <tr>
    <td align="center">
              <table>
          <tr>

            <td>
              <button name="addLista" id="addLista" onclick="addLIsta()" style="width:300px; height:68px;">
                <img src="<?php echo base_url();?>img/checklist-icon.png" alt="" style="float:left">
                <p style="font-size: 18px; color: #2E6E9E;"> Agregar a la lista</p></button>
            <td><input type="hidden" name="id_pedido" id="id_pedido"></td>
            </td>
          </tr>
          <tr>
            <table id="tbl_lista_productos"></table>
            <div id="paginacionLista"></div>
          </tr>
        </table>
    </td>
  </tr>
</table>


