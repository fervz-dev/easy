<script type="text/javascript">   
    $(document).ready(function(){
	$("#tbl").jqGrid({
    url:'<?php echo base_url();?>catalogo_mprima1/paginacion',
    datatype: "json",
    mtype: 'POST',
		      //  $data->rows[$i]['cell']=array($acciones,strtoupper($row->nombre),strtoupper($row->descripcion),strtoupper($row->direccion),strtoupper($row->colonia),strtoupper($row->poblacion),strtoupper($row->rfc));

                        colNames:['NOMBRE','ANCHO','LARGO','RESISTENCIA','CARACTERISTICA'],
                        colModel:[
                                  {name:'nombre', index:'nombre', width:170,resizable:false, sortable:true,search:true,editable:true},
                                  {name:'ancho', index:'ancho', width:200,resizable:false, sortable:true,search:true,editable:true},
                                  {name:'largo', index:'largo', width:200,resizable:false, sortable:true,search:true,editable:true},
                                  {name:'resistencia', index:'resistencia', width:200,resizable:false, sortable:true,search:true,editable:true},
                                  {name:'caracteristicas', index:'caracteristicas', width:90,resizable:false, sortable:true,search:true,editable:true}
                                ],
                                
    pager: jQuery('#paginacion'),
    rownumbers:true,
	rowNum:15,
    rowList:[10,20,30],
    imgpath: '<?php echo base_url();?>img/editar.jpg',
    mtype: "POST",
    sortname: 'id',
    viewrecords: true,
    sortorder: "asc",
	editable: true,
    caption: 'Empresas',
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
        <table id="tbl"></table>
        <div id="paginacion"> </div>