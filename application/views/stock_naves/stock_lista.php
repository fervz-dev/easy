
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
  function paginacionOficina (oficina_id_oficina) {
  $("#tbl_stock_linea").jqGrid({
    url:'<?php echo base_url();?>stock_naves_linea/paginacion_linea/'+oficina_id_oficina,
    datatype: "json",
    mtype: 'POST',
                        colNames:['id',
                                  'NOMBRE',
                                  'LARGO',
                                  'ANCHO',
                                  'CORRUGADO',
                                  'RESISTENCIA',
                                  'CANTIDAD'
                                     ],
                        colModel:[
                                  
                                  {name:'acciones', index:'acciones', width:100,resizable:true,sortable:true,search:false,editable:false},
                                  {name:'nombre', index:'nombre', width:100,resizable:true,sortable:true,search:true,editable:false},
                                  {name:'largo', index:'largo', width:100,resizable:true,sortable:true,search:true,editable:false},
                                  {name:'ancho', index:'ancho', width:100,resizable:true,sortable:true,search:true,editable:false},
                                  {name:'corrugado', index:'corrugado', width:100,resizable:true,sortable:true,search:true,editable:false},
                                  {name:'resistencia', index:'resistencia', width:100,resizable:true,sortable:true,search:true,editable:false},
                                  {name:'cantidad', index:'cantidad', width:100,resizable:true,sortable:true,search:true,editable:false}
                                 ],
    pager: jQuery('#paginacion'),
    rownumbers:true,
  rowNum:15,
    rowList:[10,20,30],
    imgpath: '<?php echo base_url();?>img/editar.jpg',
    mtype: "POST",
    sortname: 'id_stock_linea',
    viewrecords: true,
     cache: false,
    sortorder: "asc",
  editable: true,
    caption: 'Stock de linea',
    multiselect: false,
    height:'auto',
    loadtext: 'Cargando',
  width:'auto',
  searchurl:'<?php echo base_url();?>stock_naves_linea/buscando/'+oficina_id_oficina,
        }).navGrid("#paginacion", { edit: false, add: false, search: false, del: false, refresh:true });
        $("#tbl_stock_linea").jqGrid('filterToolbar', { stringResult: true, searchOnEnter: false }) ;

  }

  $('#oficina_id_oficina').change(function() {
      $("#tbl_stock_linea").jqGrid('GridUnload');
  oficina_id_oficina=$('#oficina_id_oficina').val();

  if (oficina_id_oficina!=''){

    paginacionOficina(oficina_id_oficina);


  };
  // id_sucursal=$('#sucursales_cancelado').val();
  // id_usuario=$('#id_gestor_cancelar').val();
 //   returnFoliosCancelacion(id_usuario, id_sucursal);
});
</script>

    <table id="tbl_stock_linea"></table>
    <div id="paginacion"> </div>