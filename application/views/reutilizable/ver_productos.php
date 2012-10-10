<script type="text/javascript">


function select_producto (id_producto) {
$( "#dialog-procesos_cantidad" ).dialog({
      autoOpen: false,
      height: 'auto',
      width: 'auto',
      modal: true,
      buttons: {
          Aceptar: function() {
            id=$('#id_reutilizable').val();
            cantidad_select=$('#cantidad_reutilizable').val();
            if (validarCampos()==true) {
              guardar_select(id, cantidad_select, id_producto);
            };
          }
      },
      close: function() {}
    });
        $( "#dialog-procesos_cantidad" ).dialog( "open" );
        $("#tbl_p_prove").trigger("reloadGrid");
}

function validarCampos () {
  cantidad_select=$('#cantidad_reutilizable').val();

  if (validarNUmero(cantidad_select)==false) {
                notify('* El campo <strong>CANTIDAD</strong> no es numero!!!',500,5000,'error');
                $("#cantidad_reutilizable").focus();
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
            url:"<?php echo base_url();?>reutilizable_ingreso/guardar_select?da="+Math.random()*2312,
          data:{
                  "cantidad":cantidad,
                  "id_reutilizable":id,
                  "id_producto":id_producto,
                },

                     datatype:"html",
                      success:function(data, textStatus){

                              switch(data){
                              case "0":
                                  notify("Error al procesar los datos " ,500,5000,'error');
                                  $( "#dialog-procesos_cantidad" ).dialog( "close" );
                                  $( "#dialog-procesos_producto" ).dialog( "close" );
                                   $('#cantidad_reutilizable').val('');
                              break;
                              case "1":
                                  $("#tbl").trigger("reloadGrid");
                                  notify('El registro se guardado correctamente',500,5000,'aviso');
                                  $( "#dialog-procesos_cantidad" ).dialog( "close" );
                                  $( "#dialog-procesos_producto" ).dialog( "close" );
                                   $('#cantidad_reutilizable').val('');
                              break;
                              case "2":
                                  $("#tbl").trigger("reloadGrid");
                                  notify("Error al procesar los datos " ,500,5000,'error');
                                  $( "#dialog-procesos_cantidad" ).dialog( "close" );
                                  $( "#dialog-procesos_producto" ).dialog( "close" );
                                   $('#cantidad_reutilizable').val('');
                              break;
                              case "4":
                                   // $("#tbl_stock_linea").trigger("reloadGrid")
                                  notify("Error al procesar los datos " ,500,5000,'error');
                                  // $( "#dialog-procesos_cantidad" ).dialog( "close" );
                                  // $( "#dialog-procesos_producto" ).dialog( "close" );
                                  $('#cantidad_reutilizable').val('');
                              break;
                              default:
                                   $( "#dialog-procesos_cantidad" ).dialog( "close" );
                                   var error='Error'+data;
                                   notify(error ,500,5000,'error');
                         	        $( "#dialog-procesos_producto" ).dialog( "close" );
                              break;

                              }//switch
                             },
                        error:function(datos){
                              notify("Error inesperado" ,500,5000,'error');
                             }//Error
     });//Ajax
}

	 $("#tbl_p_prove").jqGrid({
    url:'<?php echo base_url();?>pedidos_hacer/paginacionUsar',
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
   url:"<?php echo base_url();?>pedidos_hacer/subpaginacionUsar/"+row_id,
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
</script>
        <table id="tbl_p_prove"></table>
        <div id="paginacion"> </div>

       <div style="display:none" id="dialog-procesos_cantidad" title="Cantidad a usar">
        <table>
          <form name="form_cantidad" id="form_cantidad">
          <tr>
            <td><label  id="labelRight">cantidad:</label></td>
            <td><input type="text" name="cantidad_reutilizable" id="cantidad_reutilizable"></td>

             <td><input type="hidden" name="id_reutilizable" id="id_reutilizable"></td>
          </tr>
          </form>
        </table>
        </div>