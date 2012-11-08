<script>
//////////////////////////////////////////// agrega el producto verificado a stock ////////////////////////////////
function add_stock_bodega (id) {
   $.ajax({
            async:true,
            beforeSend:function(objeto){$('#loading').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');},
            type:"POST",
            url:"<?php echo base_url();?>stock_lista/add_stock_bodega/"+id,
            data:{"nombre":$("#nombre").val(),
                  "largo":$("#largo").val(),
                  "ancho":$("#ancho").val(),
                  "tipo_m":$("#corrugado").val(),
                  "resistencia":$("#resistencia").val(),
                  "cantidad":$("#cantidadmprima").val(),
                  "descripcion":$("#descripcionB").val()
                },
            cache: false,
            datatype:"html",
            success:function(data, textStatus){

            switch(data){
                        case "0":
                                 notify("Error al procesar los datos " ,500,5000,'error');
                        break;
                        case "1":
                                  $( "#dialog-procesosmPrima1" ).dialog( "close" );
                        $("#tbl_bodega").trigger("reloadGrid");
                        notify("El registro se agrego correctamente." ,500,5000,'aviso');
                        break;
                        default:
                                  $( "#dialog-procesosmPrima1" ).dialog( "close" );
                           break;

                              }//switch
                             },
                        error:function(data){
                              notify("Error al procesar los datos " ,500,5000,'error');
                             }//Error
                         });//Ajax
}


///////////////////////////////////////////////Verificacion producto proveedor de linea //////////////////////////////////////////
function verificacion_producto_pedido_materiaprima(id) {
$("#cantidadmprima").val('');
$.ajax({
                        async:true,cache: false,
                        beforeSend:function(objeto){$('#loading').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');},
                        type:"GET",
                        url:"<?php echo base_url();?>pedidos_bodega/verificacion_pedido_mprima/"+id+"/"+Math.random()*10919939116744,
                        datatype:"html",
                        success:function(data, textStatus){
                                  dato= data.split('~');
                                  $("#nombre").val(dato[0]);
                                  $("#largo").val(dato[1]);
                                  $("#ancho").val(dato[2]);
                                  $("#corrugado").val(dato[3]);
                                  //$("#cantidad").val(dato[4]);
                                  $("#resistencia").val(dato[4]);
                                  $("#descripcionB").val(dato[5]);

                                  },
                        error:function(datos){
                        notify("Error al procesar los datos " ,500,5000,'error');
            return false;
                        }//Error
                        });//Ajax


$( "#dialog-procesosmPrima1" ).dialog({
      autoOpen: false,
      height: 'auto',
      width: 'auto',
      modal: true,
      buttons: {
          Aceptar: function() {
            if (validarCamposForm1_producto()==true) {
              add_stock_bodega(id);
              $("#cantidadmprima").val('');
              };
            },
          Cancelar:function()
          {
              $( "#dialog-procesosmPrima1" ).dialog( "close" );
              $("#cantidadmprima").val('');
          }
      },
      close: function() {}
    });
        $( "#dialog-procesosmPrima1" ).dialog( "open" );
        $("#cantidadmprima").val('');


}
////////////////////////////



  $("#tbl_p_prove_form").jqGrid({
    url:'<?php echo base_url();?>catalogo_mprima/paginacion_productos_Stock',
    datatype: "json",
    mtype: 'POST',
                        colNames:['Acciones','NOMBRE','DESCRIPCION','CORRUGADO','LARGO','ANCHO','RESISTENCIA'],
                        colModel:[{name:'id_cat_mprima', index:'id_cat_mprima', width:50,resizable:true, sortable:true,search:false,editable:false},
                                  {name:'nombre', index:'nombre', width:160,resizable:true, sortable:true,search:true,editable:true},
                                  {name:'descripcion', index:'descripcion', width:160,resizable:true, sortable:true,search:true,editable:true},
                                  {name:'tipo_m', index:'tipo_m', width:100,resizable:true, sortable:true,search:true,editable:true},
                                  {name:'largo', index:'largo', width:60,resizable:true, sortable:true,search:true,editable:true},
                                  {name:'ancho', index:'ancho', width:60,resizable:true, sortable:true,search:true,editable:true},
                                  {name:'resistencia', index:'resistencia', width:120,resizable:true, sortable:true,search:true,editable:true}
                                ],
    pager: jQuery('#paginacion'),
    rownumbers:true,
  rowNum:15,
    rowList:[10,20,30],
    imgpath: '<?php echo base_url();?>img/editar.jpg',
    mtype: "POST",
    sortname: 'id_cat_mprima',
    viewrecords: true,
    sortorder: "asc",
  editable: true,
    caption: 'Catalogo de Materia Prima',
    multiselect: false,
    height:'auto',
    loadtext: 'Cargando',
  width:'100%',
  searchurl:'<?php echo base_url();?>catalogo_mprima/buscando_pedidos_proveedor',
                height:"auto"
        }).navGrid("#tbl_p_prove_form", { edit: false, add: false, search: false, del: false, refresh:true });
        $("#tbl_p_prove_form").jqGrid('filterToolbar', { stringResult: true, searchOnEnter: false }) ;


function validarCamposForm1_producto () {
cantidad=$('#cantidadmprima').val();
if (validarVacio(cantidad)==false) {
  notify('* El campo <strong>CANTIDAD</strong> no puede estar vacio!!!',500,5000,'error');
    $("#cantidadmprima").focus();
  return false;
}else if (validarNUmero(cantidad)==false) {
  notify('* El campo <strong>CANTIDAD</strong> no es un numero!!!',500,5000,'error');
    $("#cantidadmprima").focus();
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
        		<td><label>cantidad</label></td>
        		<td><input type="text" name="cantidad" id="cantidad"></td>
            <td><input type="hidden" name="id_pedido" id="id_pedido"></td>
            <td><input type="hidden" name="id_catalogo" id="id_catalogo"></td>


        	</tr>
          </form>
        </table>
      </div>

          <div style="display:none" id="dialog-procesosmPrima1" title="Verificar producto">
                            <form  name="producto" id="producto">
                <table>



                  <tr>
                    <td><label>Nombre</label></td>
                    <td><input type="text" id="nombre" name="nombre" readonly="readonly" ></td>
                  </tr>

                  <tr>
                    <td><label>Descripcion</label></td>
                       <td> <textarea name="descripcionB" id="descripcionB" cols="30" rows="4" readonly="readonly"></textarea>

                  </tr>


                  <tr>
                    <td><label>Largo</label></td>
                    <td><input type="text" id="largo" name="largo" readonly="readonly" ></td>
                  </tr>
                  <tr>
                    <td><label>Ancho</label></td>
                    <td><input type="text" id="ancho" name="ancho" readonly="readonly" ></td>
                  </tr>


                  <tr>
                    <td><label>Corrugado</label></td>
                    <td><input type="text" id="corrugado" name="corrugado" readonly="readonly" ></td>
                  </tr>
                  <tr>
                    <td><label>Resistencia</label></td>
                    <td><input type="text" id="resistencia" name="resistencia" readonly="readonly" ></td>
                  </tr>

                  <tr>
                    <td><label>Cantidad</label></td>
                    <td><input type="text" id="cantidadmprima" name="cantidadmprima"  ></td>
                  </tr>

                <!--  <tr>
                    <td><label>Observaciones</label></td>
                    <td><textarea rows="2" cols="20"></textarea></td>
                  </tr> -->

                  <!-- <input type="hidden"  id="id_producto" name="id_produto" > -->

                </table>
                </form>
          </div>