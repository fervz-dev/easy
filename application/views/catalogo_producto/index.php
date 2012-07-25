<script type="text/javascript">
	$(document).ready(function(){
	$("#tbl").jqGrid({
    url:'<?php echo base_url();?>catalogo_mprima/paginacion',
    datatype: "json",
    mtype: 'POST',
                        colNames:['Acciones','PRODUCTO','MATERIAL','RESISTENCIA','CORRUGADO','DESCRIPCION','ARCHIVO'],
                        colModel:[
                        			{name:'nombre_producto', index:'nombre_producto', width:170,resizable:false, sortable:true,search:false,editable:false},
                        			{name:'tipo_material', index:'tipo_material', width:170,resizable:false, sortable:true,search:false,editable:false},
                        			{name:'resistencia', index:'resistencia', width:170,resizable:false, sortable:true,search:false,editable:false},
                        			{name:'corrugado', index:'corrugado', width:170,resizable:false, sortable:true,search:false,editable:false},
                        			{name:'descripcion', index:'descripcion', width:170,resizable:false, sortable:true,search:false,editable:false},
                        			{name:'id_archvio', index:'id_archvio', width:170,resizable:false, sortable:true,search:false,editable:false}
                                
                                
                                ],                             
    pager: jQuery('#paginacion'),
    rownumbers:true,
	rowNum:15,
    rowList:[10,20,30],
    imgpath: '<?php echo base_url();?>img/editar.jpg',
    mtype: "POST",
    sortname: 'id_producto',
    viewrecords: true,
    sortorder: "asc",
	editable: true,
    caption: 'Catalogo de Producto',
    multiselect: false,
    height:'auto',
    loadtext: 'Cargando',
	width:'100%',
    //searchurl:'<?php echo base_url();?>empresas/buscando',
                height:"auto"
        }).navGrid("#paginacion", { edit: false, add: false, search: false, del: false, refresh:true });
        $("#tbl").jqGrid('filterToolbar', { stringResult: true, searchOnEnter: false }) ; 
   });

</script>
<div id="dialog-confirm" title="Confirmacion" style="display: none;">
  
</div>
<table >
<tr>
<td><div onclick="alta()" id="alta"><img src="<?php '.base_url().' ?>img/nuevo.ico"></div>
</td>
<td >&nbsp;</td>
</tr>
</table>
        <table id="tbl"></table>
        <div id="paginacion"> </div>
        <div style="display:none" id="dialog-procesos" title="Catalogo de Producto">
        <?php 

        $this->load->view('catalogo_producto/formulario');?>