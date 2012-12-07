<script type="text/javascript">
	function verLista (id) {
	$("#tbl_verListaPedido").jqGrid({
    url:'<?php echo base_url();?>pedidos_bodega_prod_term/verListaPedidos/'+id,
    datatype: "json",
    mtype: 'POST',
                        colNames:['CANTIDAD','NOMBRE','LARGO','ANCHO','ALTO','RESISTENCIA','CORRUGADO','SCORE'],
                        colModel:[
                              {name:'cantidad', index:'cantidad', width:90,resizable:true, sortable:true,search:false,editable:false},
                              {name:'nombre', index:'nombre', width:170,resizable:true, sortable:true,search:false,editable:false},
                              {name:'largo', index:'largo', width:50,resizable:true, sortable:true,search:false,editable:false},
                              {name:'ancho', index:'ancho', width:50,resizable:true, sortable:true,search:false,editable:false},
                              {name:'alto', index:'alto', width:50,resizable:true, sortable:true,search:false,editable:false},
                              {name:'resistencia', index:'resistencia', width:100,resizable:true, sortable:true,search:false,editable:false},
                              {name:'corrugado', index:'corrugado', width:80,resizable:true, sortable:true,search:false,editable:false},
                              {name:'score', index:'score', width:50,resizable:true, sortable:true,search:false,editable:false}
                              
                                ],
    pager: jQuery('#paginacion_verListaPedido'),
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
   url:"<?php echo base_url();?>pedidos_bodega_prod_term/subpaginacionPedidoProductoLista/"+row_id,
   datatype: "json",
    mtype: 'POST',
                        // colNames:['NOMBRE','LARGO','ANCHO','ALTO','RESISTENCIA','CORRUGADO','SCORE'],
                        colModel:[
                             // {name:'nombre_empresa', index:'nombre_empresa', width:170,resizable:true, sortable:true,search:true,editable:false},
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
        }).navGrid("#paginacion_verListaPedido", { edit: false, add: false, search: false, del: false, refresh:true });
        $("#tbl_verListaPedido").jqGrid('filterToolbar', { stringResult: true, searchOnEnter: false }) ;
      $("#tbl_verListaPedido").jqGrid('navGrid','#paginacion_verListaPedido',{add:false,edit:false,del:false,search:false});
}
</script>
       <table id="tbl_verListaPedido"></table>
        <div id="paginacion_verListaPedido"> </div>