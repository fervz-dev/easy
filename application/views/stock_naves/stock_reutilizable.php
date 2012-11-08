
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
  $("#tbl").jqGrid({
    url:'<?php echo base_url();?>stock_naves_reutilizable/paginacion_reutilizable/'+oficina_id_oficina,
    datatype: "json",
    mtype: 'POST',
                        colNames:['NOMBRE','CORRUGADO','LARGO','ANCHO','RESISTENCIA','CANTIDAD'],
                        colModel:[
                                  {name:'nombre', index:'nombre', width:100,resizable:true, sortable:true,search:true,editable:true},
                                  {name:'tipo_m', index:'tipo_m', width:100,resizable:true, sortable:true,search:true,editable:true},
                                  {name:'largo', index:'largo', width:40,resizable:true, sortable:true,search:true,editable:true},
                                  {name:'ancho', index:'ancho', width:40,resizable:true, sortable:true,search:true,editable:true},
                                  // {name:'peso', index:'peso', width:40,resizable:true, sortable:true,search:true,editable:true},
                                  {name:'resistencia', index:'resistencia', width:80,resizable:true, sortable:true,search:true,editable:true},
                                  {name:'cantidad', index:'cantidad', width:40,resizable:true, sortable:true,search:true,editable:true}
                                  // {name:'peso_total', index:'peso_total', width:40,resizable:true, sortable:true,search:true,editable:true},
                                  // {name:'restan', index:'restan', width:80,resizable:true, sortable:true,search:true,editable:true}
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
    caption: 'Catalogo de Reutilizable',
    multiselect: false,
    height:'auto',
    loadtext: 'Cargando',
  width:'100%',
    searchurl:'<?php echo base_url();?>stock_naves_reutilizable/buscando/'+oficina_id_oficina,
                height:"auto"
        }).navGrid("#paginacion", { edit: false, add: false, search: false, del: false, refresh:true });
        $("#tbl").jqGrid('filterToolbar', { stringResult: true, searchOnEnter: false }) ;
}


  $('#oficina_id_oficina').change(function() {
      $("#tbl").jqGrid('GridUnload');
  oficina_id_oficina=$('#oficina_id_oficina').val();

  if (oficina_id_oficina!=''){

    cargar(oficina_id_oficina);


  };
  // id_sucursal=$('#sucursales_cancelado').val();
  // id_usuario=$('#id_gestor_cancelar').val();
 //   returnFoliosCancelacion(id_usuario, id_sucursal);
});
</script>

        <table id="tbl"></table>
        <div id="paginacion"> </div>