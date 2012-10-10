<script>
function guardar_producto (id) {
  $.ajax({
          async:true,cache: false,
          beforeSend:function(objeto){$('#loading').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');},
           type:"POST",
            url:"<?php echo base_url();?>pedidos_bodega_prod_term/guardar?da="+Math.random()*2312,
          data:{
                  "catalogo_producto":id,
                  "cantidad":$("#cantidad").val(),
                  "id_pedido":$("#id_pedido").val(),
                  'fecha_entrega_pedido':$('#fecha_entrega_pedido').val(),
                  'oficina_pedido_hacer':$('#oficina_pedido_hacer').val(),
                  'observaciones_bodega_pedido':$('#observaciones_bodega_pedido').val(),

                },

                     datatype:"html",
                      success:function(data, textStatus){

                             switch(data){
                               case "0":
                             notify("Error al procesar los datos " ,500,5000,'error');
                      break;
                              case "1":
                            $("#tbl_p_prove_form").trigger("reloadGrid");
                               notify('El registro se guardado correctamente',500,5000,'aviso');
                         $( "#dialog-procesos_cantidad" ).dialog( "close" );
                     break;

                                   default:
                                   $( "#dialog-procesos_cantidad" ).dialog( "close" );
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
function agregar(id)
{
$( "#id_catalogo").val(id);
$( "#dialog-procesos_cantidad" ).dialog({
      autoOpen: false,
      height: 'auto',
      width: 'auto',
      modal: true,
      buttons: {
          Aceptar: function() {
            if (validarCamposForm1_producto()==true) {
              guardar_producto(id);
              $("#cantidad").val('');
              $("#oficina_pedido_hacer").val('');
              $("#observaciones_bodega_pedido").val('');
              $("#fecha_entrega_pedido").val('');
            $("#tbl_p_prove_form").trigger("reloadGrid")

            }
                    },
          Cancelar:function()
          {
        $( "#dialog-procesos_cantidad" ).dialog( "close" );
          }
      },
      close: function() {}
    });
        $( "#dialog-procesos_cantidad" ).dialog( "open" );
}
/*document.add_producto.reset();*/

  $("#tbl_p_prove_form").jqGrid({
    url:'<?php echo base_url();?>catalogo_producto/paginacion_productos',
   datatype: "json",
    mtype: 'POST',
                        colNames:['Acciones','NOMBRE','LARGO','ANCHO','ALTO','RESISTENCIA','CORRUGADO','SCORE','DESCRIPCION'],
                        colModel:[{name:'acciones', index:'acciones', width:60, resizable:true, align:"center", search:false},
                              {name:'nombre', index:'nombre', width:120,resizable:true, sortable:true,search:false,editable:false},
                              {name:'largo', index:'largo', width:50,resizable:true, sortable:true,search:false,editable:false},
                              {name:'ancho', index:'ancho', width:50,resizable:true, sortable:true,search:false,editable:false},
                              {name:'alto', index:'alto', width:50,resizable:true, sortable:true,search:false,editable:false},
                              {name:'resistencia', index:'resistencia', width:50,resizable:true, sortable:true,search:false,editable:false},
                              {name:'corrugado', index:'corrugado', width:60,resizable:true, sortable:true,search:false,editable:false},
                              {name:'score', index:'score', width:50,resizable:true, sortable:true,search:false,editable:false},
                              {name:'descripcion', index:'descripcion', width:170,resizable:true, sortable:true,search:false,editable:false}


                                ],
    pager: jQuery('#paginacion'),
    rownumbers:true,
  rowNum:5,
    rowList:[10,20,30],
    imgpath: '<?php echo base_url();?>img/editar.jpg',
    mtype: "POST",
    sortname: 'id_catalogo',
    viewrecords: true,
    sortorder: "asc",
editable: true,
    caption: 'Catalogo de Producto',
    multiselect: false,
    height:'auto',
    loadtext: 'Cargando',
  width:'100%',
    //searchurl:'<?php echo base_url();?>empresas/buscando',
                height:"auto"
        }).navGrid("#paginacion_form", { edit: false, add: false, search: false, del: false, refresh:true });
        $("#tbl_p_prove_form").jqGrid('filterToolbar', { stringResult: true, searchOnEnter: false }) ;
function validarCamposForm1_producto () {
cantidad=$('#cantidad').val();
if (validarVacio(cantidad)==false) {
  notify('* El campo <strong>CANTIDAD</strong> no puede estar vacio!!!',500,5000,'error');
    $("#cantidad").focus();
  return false;
}else if (validarNUmero(cantidad)==false) {
  notify('* El campo <strong>CANTIDAD</strong> no es un numero!!!',500,5000,'error');
    $("#cantidad").focus();
  return false
}else {
  return true;
}
}
   </script>

    <table id="tbl_p_prove_form"></table>
        <div id="paginacion_form"> </div>

        <div style="display:none" id="dialog-procesos_cantidad" title="Pedidos">
        <table>
          <form name="form_cantidad" id="form_cantidad">
        	<tr>
        		<td><label  id="labelRight">cantidad:</label></td>
        		<td><input type="text" name="cantidad" id="cantidad"></td>
          </tr>
          <tr>
            <td>
              <label for="" id="labelRight">Bodega a realizar:</label>
            </td>
            <td><select name="oficina_pedido_hacer"  id="oficina_pedido_hacer">
                    <option value="">Seleccione...</option>
                    <?php foreach ($oficinas as $ofn) { ?>
                    <option value="<?php echo $ofn['id_oficina']; ?>"><?php echo $ofn['nombre_oficina'] ?></option>
                    <?php } ?>
                  </select>
            </td>
          </tr>
          <tr>
            <td>
              <label for="" id="labelRight">Fecha de entrega:</label>
            </td>
           <td><input type="text" nombre="fecha_entrega_pedido"  id="fecha_entrega_pedido"></td>
            <td><input type="hidden" name="id_pedido" id="id_pedido"></td>
            <td><input type="hidden" name="id_catalogo" id="id_catalogo"></td>
        	</tr>
          <tr>
            <td><label for="" id="labelRight">Observaciones:</label> </td>
            <td>
              <textarea id="observaciones_bodega_pedido" name="observaciones_bodega_pedido" colspan="18" rowspan="30"></textarea>
            </td>
          </tr>
          </form>
        </table>
        </div>