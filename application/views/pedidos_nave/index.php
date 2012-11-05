<script type="text/javascript">

function enviado (id) {
    $.ajax({
          async:true,cache: false,
          beforeSend:function(objeto){$('#loading').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');},
          type:"POST",
          url:"<?php echo base_url();?>pedidos_bodega/enviado/"+id,
          datatype:"html",
          success:function(data, textStatus){

              switch(data){
                case "0":
                  notify("Error al procesar los datos " ,500,5000,'error');
                break;
                case "1":

                  $( "#dialogo" ).dialog( "close" );
                  $("#tbl_listaHacer").jqGrid('GridUnload');
                  notify('Pedido cerrado satisfactoriamente',500,5000,'aviso');
                  setTimeout("cargar()",1000);

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


function cargar () {
   $("#tbl_listaHacer").jqGrid({
    url:'<?php echo base_url();?>pedidos_nave/paginacionLista',
    datatype: "json",
    mtype: 'POST',

                        colNames:[  'Acciones',
                                    'ID PEDIDO',
                                    'FECHA DE PEDIDO',
                                    'FECHA DE ENTREGA',
                                    'PROVEEDOR',
                                    'LUGAR DE ENVIO'
                                    ],
                        colModel:[
                                  {name:'acciones', index:'acciones', width:30,resizable:true, sortable:true,search:true,editable:true},
                                  {name:'id_pedido', index:'id_pedido', width:30,resizable:true, sortable:true,search:true,editable:true},
                                  {name:'fecha_pedido', index:'fecha_pedido', width:30,resizable:true, sortable:true,search:true,editable:true},
                                  {name:'fecha_entrega', index:'fecha_entrega', width:30,resizable:true, sortable:true,search:true,editable:true},
                                  {name:'nombre_oficina', index:'nombre_oficina', width:100,resizable:true, sortable:true,search:true,editable:true},
                                  {name:'nombre_oficina', index:'nombre_oficina', width:90,resizable:true, sortable:true,search:true,editable:true}
                                ],
    pager: jQuery('#paginacionLista'),
    rownumbers:true,
  rowNum:15,
    rowList:[10,20,30],
    imgpath: '<?php echo base_url();?>img/editar.jpg',
    mtype: "POST",
    sortname: 'id_pedido',
    viewrecords: true,
    sortorder: "asc",
  editable: true,
    caption: 'Pedidos a Bodega Materia Prima',
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
   url:"<?php echo base_url();?>pedidos_nave/subpaginacionLista/"+row_id,
   datatype: "json",
   mtype: 'POST',
   colNames: ['ACCI&Oacute;N', 'No', 'NOMBRE','LARGO','ANCHO','CANTIDAD'],
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
        }).navGrid("#paginacionLista", { edit: false, add: false, search: false, del: false, refresh:true });
        $("#tbl_listaHacer").jqGrid('filterToolbar', { stringResult: true, searchOnEnter: false }) ;
      $("#tbl_listaHacer").jqGrid('navGrid','#paginacionLista',{add:false,edit:false,del:false,search:false});
}
   $(document).ready(function(){
  $("#tbl_listaHacer").jqGrid({
    url:'<?php echo base_url();?>pedidos_nave/paginacionLista',
    datatype: "json",
    mtype: 'POST',

                        colNames:[  'Acciones',
                                    'ID PEDIDO',
                                    'FECHA DE PEDIDO',
                                    'FECHA DE ENTREGA',
                                    'PROVEEDOR',
                                    'LUGAR DE ENVIO'
                                    ],
                        colModel:[
                                  {name:'acciones', index:'acciones', width:30,resizable:true, sortable:true,search:true,editable:true},
                                  {name:'id_pedido', index:'id_pedido', width:30,resizable:true, sortable:true,search:true,editable:true},
                                  {name:'fecha_pedido', index:'fecha_pedido', width:30,resizable:true, sortable:true,search:true,editable:true},
                                  {name:'fecha_entrega', index:'fecha_entrega', width:30,resizable:true, sortable:true,search:true,editable:true},
                                  {name:'nombre_oficina', index:'nombre_oficina', width:100,resizable:true, sortable:true,search:true,editable:true},
                                  {name:'nombre_oficina', index:'nombre_oficina', width:90,resizable:true, sortable:true,search:true,editable:true}
                                ],
    pager: jQuery('#paginacionLista'),
    rownumbers:true,
  rowNum:15,
    rowList:[10,20,30],
    imgpath: '<?php echo base_url();?>img/editar.jpg',
    mtype: "POST",
    sortname: 'id_pedido',
    viewrecords: true,
    sortorder: "asc",
  editable: true,
    caption: 'Pedidos a Bodega Materia Prima',
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
   url:"<?php echo base_url();?>pedidos_nave/subpaginacionLista/"+row_id,
   datatype: "json",
   mtype: 'POST',
   colNames: ['ACCI&Oacute;N', 'No', 'NOMBRE','LARGO','ANCHO','CANTIDAD'],
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
        }).navGrid("#paginacionLista", { edit: false, add: false, search: false, del: false, refresh:true });
        $("#tbl_listaHacer").jqGrid('filterToolbar', { stringResult: true, searchOnEnter: false }) ;
      $("#tbl_listaHacer").jqGrid('navGrid','#paginacionLista',{add:false,edit:false,del:false,search:false});
   });
</script>

        <table id="tbl_listaHacer"></table>
        <div id="paginacionLista"> </div>