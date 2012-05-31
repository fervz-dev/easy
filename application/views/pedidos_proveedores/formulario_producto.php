<script>
function guardar_producto (id) {
  $.ajax({
          async:true,cache: false,
          beforeSend:function(objeto){$('#loading').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');},
           type:"POST",
            url:"<?php echo base_url();?>pedidos_proveedor/guardar?da="+Math.random()*2312,
          data:{"catalogo_producto":id,
                  "cantidad":$("#cantidad").val(),
                  "id_pedido":$("#id_pedido").val()},

                     datatype:"html",
                      success:function(data, textStatus){

                             switch(data){
                               case "0": 
                            alert("Error al procesar los datos ");
                      break;
                              case "1": 
                            $("#tbl_p_prove_form").trigger("reloadGrid");
                               alert('El registro se ha guardado correctamente');
                         $( "#dialog-procesos_cantidad" ).dialog( "close" );
                     break;

                                   default:
                                   $( "#dialog-procesos_cantidad" ).dialog( "close" );
                            alert("Error "+data);
                    break; 

                              }//switch
                             },
                        error:function(datos){
                              alert("Error inesperado");
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
          guardar_producto(id);
              $("#cantidad").val('');          
            $("#tbl_p_prove_form").trigger("reloadGrid")        
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
    url:'<?php echo base_url();?>catalogo_mprima/paginacion_productos',
    datatype: "json",
    mtype: 'POST',
                        colNames:['Agregar','NOMBRE','CARACTERISTICA','TIPO','GROSOR','ANCHO','LARGO','RESISTENCIA'],
                        colModel:[{name:'id_cat_mprima', index:'id_cat_mprima', width:50,resizable:false,align:"center", sortable:true,search:false,editable:false},
                                  {name:'nombre', index:'nombre', width:150,resizable:false, sortable:true,search:false,editable:false,search:false,},
                                  {name:'caracteristica', index:'caracteristica', width:120,resizable:false, sortable:true,search:false,editable:true},
                                  {name:'tipo', index:'tipo', width:90,resizable:false, sortable:true,align:"center",editable:true,search:false,},
                                  {name:'tipo_m', index:'tipo_m', width:90,resizable:false, sortable:true,align:"center",editable:true,search:false,},
                                  {name:'ancho', index:'ancho', width:50,resizable:false, sortable:true,align:"center",editable:true,search:false,},
                                  {name:'largo', index:'largo', width:50,resizable:false, sortable:true,align:"center",editable:true,search:false,},
                                  {name:'resistencia', index:'resistencia', width:90,resizable:false, align:"center",sortable:true,search:false,editable:true}
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
    //searchurl:'<?php echo base_url();?>empresas/buscando',
                height:"auto"
        }).navGrid("#paginacion_form", { edit: false, add: false, search: false, del: false, refresh:true });
        $("#tbl_p_prove_form").jqGrid('filterToolbar', { stringResult: true, searchOnEnter: false }) ; 
   
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