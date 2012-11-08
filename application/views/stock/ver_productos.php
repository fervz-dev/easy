<script type="text/javascript">


function select_producto1 (id_producto) {
$( "#dialog-procesos_cantidad_mprima" ).dialog({
      autoOpen: false,
      height: 'auto',
      width: 'auto',
      modal: true,
      buttons: {
          Aceptar: function() {
            id=$('#id_linea').val();
          	cantidad_select=$('#cantidad_materia_prima').val();
            if (validarCampos_materia_prima()==true) {
              guardar_select(id, cantidad_select, id_producto);
            };

          }
      },
      close: function() {}
    });
        $( "#dialog-procesos_cantidad_mprima" ).dialog( "open" );
        $("#tbl").trigger("reloadGrid");
}
function validarCampos_materia_prima () {
  cantidad_select=$('#cantidad_materia_prima').val();

  if (validarNUmero(cantidad_select)==false) {
                notify('* El campo <strong>CANTIDAD</strong> no es numero!!!',500,5000,'error');
                $("#cantidad_materia_prima").focus();
                return false;
  }else if (validarVacio(cantidad_select)==false) {
              notify('* El campo <strong>CANTIDAD</strong> no puede estar vacio!!!',500,5000,'error');
              $("#cantidad_select").focus();
              return false;

  }else{
    return true;
  }
}
function guardar_select (id, cantidad, id_producto) {
$.ajax({
          async:true,cache: false,
          beforeSend:function(objeto){$('#loading').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');},
           type:"POST",
            url:"<?php echo base_url();?>stock_lista/guardar_select?da="+Math.random()*2312,
          data:{
                  "cantidad":cantidad,
                  "id_linea":id,
                  "id_producto":id_producto,
                },

                     datatype:"html",
                      success:function(data, textStatus){

                              switch(data){
                              case "0":
                                  notify("Error al procesar los datos " ,500,5000,'error');
                                  $( "#dialog-procesos_cantidad_mprima" ).dialog( "close" );
                                  $( "#dialog-procesos_producto" ).dialog( "close" );
                                  $("#tbl_stock_linea").trigger("reloadGrid")
                                  $('#cantidad_materia_prima').val('');
                              break;
                              case "1":
                                    $("#tbl_stock_linea").trigger("reloadGrid")
                                  notify('El registro se guardado correctamente',500,5000,'aviso');
                                  $( "#dialog-procesos_cantidad_mprima" ).dialog( "close" );
                                  $( "#dialog-procesos_producto" ).dialog( "close" );
                                  $('#cantidad_materia_prima').val('');
                              break;
                              case "2":
                                   $("#tbl_stock_linea").trigger("reloadGrid")
                                  notify("Error al procesar los datos " ,500,5000,'error');
                                  $( "#dialog-procesos_cantidad_mprima" ).dialog( "close" );
                                  $( "#dialog-procesos_producto" ).dialog( "close" );
                                  $('#cantidad_materia_prima').val('');
                              break;
                              case "4":
                                   // $("#tbl_stock_linea").trigger("reloadGrid")
                                  notify("Error al procesar los datos " ,500,5000,'error');
                                  // $( "#dialog-procesos_cantidad_mprima" ).dialog( "close" );
                                  // $( "#dialog-procesos_producto" ).dialog( "close" );
                                  $('#cantidad_materia_prima').val('');
                              break;
                              default:
                                   $( "#dialog-procesos_cantidad_mprima" ).dialog( "close" );
                                   var error='Error'+data;
                                   notify(error ,500,5000,'error');
                         	        $( "#dialog-procesos_producto" ).dialog( "close" );
                                    $("#tbl_stock_linea").trigger("reloadGrid")
                                    $('#cantidad_materia_prima').val('');
                              break;

                              }//switch
                             },
                        error:function(datos){
                              notify("Error inesperado" ,500,5000,'error');
                             }//Error
     });//Ajax
}


$(document).ready(function(){
  $("#tbl").jqGrid({
    url:'<?php echo base_url();?>catalogo_producto/paginacion_productos_Stock',
    datatype: "json",
    mtype: 'POST',
                        colNames:['Acciones','CLIENTE','NOMBRE','LARGO','ANCHO','ALTO','RESISTENCIA','CORRUGADO','SCORE','DESCRIPCION'],
                        colModel:[{name:'acciones', index:'acciones', width:60, resizable:true, align:"center", search:false},
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
    pager: jQuery('#paginacionProducto'),
    rownumbers:true,
  rowNum:10,
    rowList:[10,20,30],
    imgpath: '<?php echo base_url();?>img/editar.jpg',
    mtype: "POST",
    sortname: 'id_catalogo',
    viewrecords: true,
    sortorder: "asc",
  editable: true,
    caption: 'Catalogo de Productos',
    multiselect: false,
    height:'auto',
    loadtext: 'Cargando',
  width:'100%',
    searchurl:'<?php echo base_url();?>catalogo_producto/buscandoStock',
                height:"auto"
        }).navGrid("#paginacionProducto", { edit: false, add: false, search: false, del: false, refresh:true });
        $("#tbl").jqGrid('filterToolbar', { stringResult: true, searchOnEnter: false }) ;
   });


</script>

        <table id="tbl"></table>
        <div id="paginacion"> </div>


        <table id="tbl_p_prove1a"></table>
        <div id="paginacion1a"> </div>

       <div style="display:none" id="dialog-procesos_cantidad_mprima" title="Cantidad a usar">
        <table>
          <form name="form_cantidad" id="form_cantidad">
          <tr>
            <td><label  id="labelRight">cantidad:</label></td>
            <td><input type="text" name="cantidad_materia_prima" id="cantidad_materia_prima"></td>

             <td><input type="hidden" name="id_linea" id="id_linea"></td>
          </tr>
          </form>
        </table>
        </div>
