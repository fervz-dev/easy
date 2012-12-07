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

            $("#tbl_lista_productos").trigger("reloadGrid");
            notify('El registro se elimino correctamente',500,5000,'aviso');
            // setTimeout("LoadListaProductos()",1000);

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
function LoadListaProductos () {
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
}

function cargarListaProdutos (id) {
	$("#tbl_lista_productos").jqGrid({
    url:'<?php echo base_url();?>pedidos_bodega_prod_term/listaPedidos/'+id,
    datatype: "json",
    mtype: 'POST',
                        colNames:['Acciones','CANTIDAD','NOMBRE','LARGO','ANCHO','ALTO','RESISTENCIA','CORRUGADO','SCORE'],
                        colModel:[{name:'acciones', index:'acciones', width:60, resizable:true, align:"center", search:false},
                              {name:'cantidad', index:'cantidad', width:90,resizable:true, sortable:true,search:false,editable:false},
                              {name:'nombre', index:'nombre', width:170,resizable:true, sortable:true,search:false,editable:false},
                              {name:'largo', index:'largo', width:50,resizable:true, sortable:true,search:false,editable:false},
                              {name:'ancho', index:'ancho', width:50,resizable:true, sortable:true,search:false,editable:false},
                              {name:'alto', index:'alto', width:50,resizable:true, sortable:true,search:false,editable:false},
                              {name:'resistencia', index:'resistencia', width:100,resizable:true, sortable:true,search:false,editable:false},
                              {name:'corrugado', index:'corrugado', width:80,resizable:true, sortable:true,search:false,editable:false},
                              {name:'score', index:'score', width:50,resizable:true, sortable:true,search:false,editable:false}
                              
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
                              {name:'#', index:'AddCantidad', width:30,resizable:true, sortable:true, aling:"center", search:false,editable:false},
                              {name:'cantidad', index:'cantidad', width:90,resizable:true, sortable:true,search:false,editable:false},
                              {name:'nombre', index:'nombre', width:232,resizable:true, sortable:true, aling:"center", search:false,editable:false},
                              {name:'largo', index:'largo', width:50,resizable:true, sortable:true,search:false,editable:false},
                              {name:'ancho', index:'ancho', width:50,resizable:true, sortable:true,search:false,editable:false},
                              {name:'alto', index:'alto', width:50,resizable:true, sortable:true,search:false,editable:false},
                              {name:'resistencia', index:'resistencia', width:100,resizable:true, sortable:true,search:false,editable:false},
                              {name:'corrugado', index:'corrugado', width:80,resizable:true, sortable:true,search:false,editable:false},
                              {name:'score', index:'score', width:50,resizable:true, sortable:true,search:false,editable:false}

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
                                 $("#tbl_lista_productos").trigger("reloadGrid");
                                  notify("Error al procesar los datos " ,500,5000,'error');
                                  jQuery("#tbl_p_prove_form").jqGrid('resetSelection');
                                break;

                                case "1":
                                   $("#tbl_lista_productos").trigger("reloadGrid");
                                    notify('El registro se guardado correctamente',500,5000,'aviso');
                                     $("#tbl_p_prove_form").jqGrid('resetSelection');

                                break;

                                default:

                                  var error='Error'+data;
                                 notify(error ,500,5000,'error');
                                $("#tbl_lista_productos").trigger("reloadGrid");
                                 $("#tbl_p_prove_form").jqGrid('resetSelection');
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
function hidenColumnas () {
    jQuery("#tbl_lista_productos").jqGrid('hideCol',["largo","ancho","alto","resistencia","corrugado","score"]);
}

function showColumnas () {
    jQuery("#tbl_lista_productos").jqGrid('showCol',["largo","ancho","alto","resistencia","corrugado","score"]);
}

//////////////////////////////////////////// Alerta Pedido cerrado ///////////////////////////////////////////////////////////
function addCantidadListado (id, tipo, idTIpo) {
  $('#cantidadInput').val('');
if (tipo=='1') {

  $('#cantidadDiv').html('Cantidad para el producto:');
    
    $( "#dialogo_cantidadLIstado" ).dialog({
      autoOpen: false,
      height: 'auto',
      width: 'auto',
      modal: true,
      buttons: {
        Aceptar:function() {  
          cantidadInput=$('#cantidadInput').val();
          if (validarVacio(cantidadInput)==false) {
            notify("Campo <strong>CANTIDAD</strong> requerido!!! " ,500,5000,'error');
          }else if (validarNUmero(cantidadInput)==false) {
            notify("El campo <strong>CANTIDAD</strong> solo acepta numeros!!! " ,500,5000,'error');
          }else{
            sendCantidad(id, cantidadInput, tipo);
            $( "#dialogo_cantidadLIstado" ).dialog( "close" );
            $("#tbl_lista_productos").trigger("reloadGrid");
            // $("#tbl_lista_productos").expandSubGridRow(id);
          }
        }, 
      Cerrar:function()
        {
         $( "#dialogo_cantidadLIstado" ).dialog( "close" );
        }
      },
      close: function() {}
    });
        $( "#dialogo_cantidadLIstado" ).dialog( "open" );
}else if (tipo == '2') {

    $('#cantidadDiv').html('Cantidad para componente:');
    $( "#dialogo_cantidadLIstado" ).dialog({
      autoOpen: false,
      height: 'auto',
      width: 'auto',
      modal: false,
      buttons: {
        Aceptar:function() {
          cantidadInput=$('#cantidadInput').val();
          if (validarVacio(cantidadInput)==false) {
           notify("Campo <strong>CANTIDAD</strong> requerido!!! " ,500,5000,'error');
          }else if (validarNUmero(cantidadInput)==false) {
            notify("El campo solo <strong>CANTIDAD</strong> acepta numeros!!! " ,500,5000,'error');
          }else{
            sendCantidad(id, cantidadInput, tipo);
            // alert(idTIpo);
            $( "#dialogo_cantidadLIstado" ).dialog( "close" );
            $('#tbl_lista_productos').jqGrid('collapseSubGridRow',idTIpo);
            $("#tbl_lista_productos").jqGrid('expandSubGridRow',idTIpo);
            // $("#tbl_lista_productos").jqGrid('setSelection',idTIpo);
          }
        },
      Cerrar:function()
        {
         $( "#dialogo_cantidadLIstado" ).dialog( "close" );
        }
      },
      close: function() {}
    });
        $( "#dialogo_cantidadLIstado" ).dialog( "open" );

}

}
function sendCantidad (id, cantidad, tipo) {
  if (tipo=='1') {
    $.ajax({
          async:true,cache: false,
          beforeSend:function(objeto){$('#loading').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');},
          type:"POST",
          url:"<?php echo base_url();?>pedidos_bodega_prod_term/guardarCantidadProducto/"+id,
          data:{"cantidad":cantidad
                },
                     datatype:"html",
                      success:function(data, textStatus){

                      switch(data){
                               case "0":
                                    $("#tbl_lista_productos").trigger("reloadGrid");
                                    notify("Error al procesar los datos " ,500,5000,'error');
                                    

                                break;

                                case "1":
                                    
                                    notify('Se agrego la cantidad correctamente',500,5000,'aviso');
                                    

                                break;

                                default:

                                  var error='Error'+data;
                                  notify(error ,500,5000,'error');
                                  $("#tbl_lista_productos").trigger("reloadGrid");
                                  $( "#dialogo_cantidadLIstado" ).dialog( "close" );
                                break;

                              }//switch
                             },
                        error:function(datos){
                             notify("Error inesperado" ,500,5000,'error');
                             }//Error
                         });//Ajax
  }else if (tipo=='2') {
    $.ajax({
          async:true,cache: false,
          beforeSend:function(objeto){$('#loading').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');},
          type:"POST",
          url:"<?php echo base_url();?>pedidos_bodega_prod_term/guardarCantidadComponente/"+id,
          data:{"cantidad":cantidad
                },

                     datatype:"html",
                      success:function(data, textStatus){

                      switch(data){
                               case "0":
                                 $("#tbl_lista_productos").trigger("reloadGrid");
                                  notify("Error al procesar los datos " ,500,5000,'error');
                                  jQuery("#tbl_p_prove_form").jqGrid('resetSelection');
                                break;

                                case "1":
                                   // $("#tbl_lista_productos").trigger("reloadGrid");
                                    notify('El registro se guardado correctamente',500,5000,'aviso');
                                     // $("#tbl_p_prove_form").jqGrid('resetSelection');

                                break;

                                default:

                                  var error='Error'+data;
                                 notify(error ,500,5000,'error');
                                $("#tbl_lista_productos").trigger("reloadGrid");
                                 $("#tbl_p_prove_form").jqGrid('resetSelection');
                                break;

                              }//switch
                             },
                        error:function(datos){
                             notify("Error inesperado" ,500,5000,'error');
                             }//Error
                         });//Ajax
  }
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

            <td  colspan="2" align="center">
              <button name="addLista" id="addLista" onclick="addLIsta()" style="width:300px; height:68px;">
                <img src="<?php echo base_url();?>img/checklist-icon.png" alt="" style="float:left">
                <p style="font-size: 18px; color: #2E6E9E;"> Agregar a la lista</p></button>
            <td><input type="hidden" name="id_pedido" id="id_pedido"></td>
            </td>
          </tr>
          <tr>
            <td>
            <table id="tbl_lista_productos"></table>
            <div id="paginacionLista"></div>
          </td>
            <td align="top">
                <button name="editarCantidad" id="editarCantidad" onclick="hidenColumnas()" style="width:180px; height:30px;">
                <!-- <img src="<?php echo base_url();?>img/checklist-icon.png" alt="" style="float:left"> -->
                Esconder Columnas</button> <br/>
                <button name="editarCantidad" id="editarCantidad" onclick="showColumnas()" style="width:180px; height:30px;">
                <!-- <img src="<?php echo base_url();?>img/checklist-icon.png" alt="" style="float:left"> -->
                Mostrar Columnas</button>
            </td>
          </tr>
        </table>
    </td>
  </tr>
</table>

<div style="display:none;" id="dialogo_cantidadLIstado" >
  <div class="ui-widget">
    <div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;">
        <table>
          <tr>
            <td id="cantidadDiv"></td>
            <td> <input type="text" name="cantidadInput" id="cantidadInput"></td>
          </tr>
        </table>
    </div>
  </div>
</div>
