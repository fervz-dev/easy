<script type="text/javascript">
   $(document).ready(function(){
  $("#tbl_listaHacer").jqGrid({
    url:'<?php echo base_url();?>pedidos_bodega/paginacionLista',
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
   url:"<?php echo base_url();?>pedidos_bodega/subpaginacionLista/"+row_id,
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