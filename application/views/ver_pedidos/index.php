<table>
  <tr>
      <td><label id="labelRight" style="color:#000000; font-size:16px;">Naves:</label></td>
        <td><select name="oficina_id_oficina"  id="oficina_id_oficina">
              <option value="">Seleccione...</option>
    <?php foreach ($oficinas as $ofn) { ?>
    <option value="<?php echo $ofn['id_oficina']; ?>"><?php echo $ofn['nombre_oficina'] ?></option>
    <?php } ?>
  </select>
  </td>

  </tr>
</table>

<script type="text/javascript">

function cargar (oficina_id_oficina) {

    $("#tbl_p_prove").jqGrid({
    url:'<?php echo base_url();?>ver_pedidos/paginacionVer/'+oficina_id_oficina,
    datatype: "json",

    mtype: 'POST',

                        colNames:[
                                    'ID PEDIDO',
                                    'FECHA DE PEDIDO',
                                    'FECHA DE ENTREGA',
                                    'LUGAR DE ENVIO'
                                    ],
                        colModel:[
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
   url:"<?php echo base_url();?>ver_pedidos/subpaginacionVer/"+row_id,
   datatype: "json",
   mtype: 'POST',
   colNames: ['No','NOMBRE','LARGO','ANCHO','ALTO','CORRUGADO','RESISTENCIA','SCORE','OBSERVACIONES','CANTIDAD','FECHA DE ENTREGA'],
   colModel: [

             {name:"No",index:"No",width:10,align:"center"},
             {name:"nombre",index:"nombre",width:80,search: false,align:"center"},
             {name:"largo",index:"largo",width:43,align:"left",search: false},
             {name:"ancho",index:"ancho",width:43,align:"left",search: false},
             {name:"alto",index:"alto",width:43,align:"left",search: false},
             {name:"corrugado",index:"corrugado",width:84,align:"center"},
             {name:"resistencia",index:"resistencia",width:78,search: false,align:"center"},
             {name:"score",index:"score",align:"left",width:42,search: false},
             {name:"observaciones",index:"observaciones",align:"left",search: false},
             {name:"cantidad",index:"cantidad",width:56,align:"center"},
             {name:"fecha_entrega",index:"fecha_entrega",search: false,align:"center"}

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
}

</script>
        <table id="tbl_p_prove"></table>
        <div id="paginacion"> </div>


<script type="text/javascript">

$('#oficina_id_oficina').change(function() {
      $("#tbl_p_prove").jqGrid('GridUnload');
  oficina_id_oficina=$('#oficina_id_oficina').val();

  if (oficina_id_oficina!=''){

    cargar(oficina_id_oficina);


  };
  // id_sucursal=$('#sucursales_cancelado').val();
  // id_usuario=$('#id_gestor_cancelar').val();
 //   returnFoliosCancelacion(id_usuario, id_sucursal);
});

</script>