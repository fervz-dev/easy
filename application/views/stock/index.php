
<?php $this->load->view('hed');?>
<script type="text/javascript">
////////////////////////////////////mostara la lista de pedidos para confirma y guardar en la lista////
function ver_pedidos_reutilizable_dialog()
{

 $( "#grid_reutilizable" ).dialog({
      autoOpen: false,
      height: "auto" ,
      width: "auto",
      modal: true,
      close: function() {$("#tbl_stock_reutilizable").trigger("reloadGrid");}
    });
        $( "#grid_reutilizable" ).dialog( "open" );

}

////////////////////////////////////mostara la lista de pedidos para confirma y guardar en la lista////
function ver_pedidos()
{

 $( "#grid_linea" ).dialog({
      autoOpen: false,
      height: "auto" ,
      width: "auto",
      modal: true,
      close: function() {reloading();}
    });
        $( "#grid_linea" ).dialog( "open" );

}

////////////////////////////////////Stock lista ////////////////////////////////////   
    $(document).ready(function(){
       reloading();
       $("#tabs").tabs();
  $("#tbl_stock_linea").jqGrid({
    url:'<?php echo base_url();?>stock_lista/paginacion',
    datatype: "json",
    mtype: 'POST',
          //  $data->rows[$i]['cell']=array($acciones,strtoupper($row->nombre),strtoupper($row->descripcion),strtoupper($row->direccion),strtoupper($row->colonia),strtoupper($row->poblacion),strtoupper($row->contacto));
                        colNames:[
                                  'NOMBRE',
                                  'ANCHO',
                                  'LARGO',
                                  'CORRUGADO',
                                  'RESISTENCIA',
                                  'CANTIDAD'               
                                     ],
                        colModel:[{name:'nombre', index:'nombre', width:100,resizable:false,sortable:true,search:false,editable:false},
                                  {name:'ancho', index:'ancho', width:100,resizable:false,sortable:true,search:false,editable:false},
                                  {name:'largo', index:'largo', width:100,resizable:false,sortable:true,search:false,editable:false},
                                  {name:'corrugado', index:'corrugado', width:100,resizable:false,sortable:true,search:false,editable:false},
                                  {name:'resistencia', index:'resistencia', width:100,resizable:false,sortable:true,search:false,editable:false},
                                  {name:'cantidad', index:'cantidad', width:100,resizable:false,sortable:true,search:false,editable:false}
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
        }).navGrid("#paginacion", { edit: false, add: false, search: false, del: false, refresh:true });
        $("#tbl_stock_linea").jqGrid('filterToolbar', { stringResult: true, searchOnEnter: false }) ; 
   });
function reloading()
  {
  $("#tbl_stock_linea").trigger("reloadGrid")
  }
  ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  ////////////////////////////////////////funcion para ver el gid dealmacen reutilizable/////////////////////////////////////////////////
  function ver_pedidos_reutilizable () {
    $(document).ready(function(){
    $("#tbl_stock_reutilizable").trigger("reloadGrid")
    $("#tbl_stock_reutilizable").jqGrid({
    url:'<?php echo base_url();?>stock_lista/paginacion_reutilizable',
    datatype: "json",
    mtype: 'POST',         
                        colNames:[
                                  'PROVEEDOR',
                                  'CANTIDAD',
                                  'FECHA DE INGRESO'       
                                     ],
                        colModel:[{name:'proveedor', index:'proveedor', width:100,resizable:false,sortable:true,search:false,editable:false},
                                  {name:'cantidad', index:'cantidad', width:100,resizable:false,sortable:true,search:false,editable:false},
                                  {name:'fecha_ingreso', index:'fecha_ingreso', width:100,resizable:false,sortable:true,search:false,editable:false}
                                 ],                             
    pager: jQuery('#paginacion_reutilizable'),
    rownumbers:true,
  rowNum:15,
    rowList:[10,20,30],
    imgpath: '<?php echo base_url();?>img/editar.jpg',
    mtype: "POST",
    sortname: 'id_stock_reutilizable',
    viewrecords: true,
     cache: false,
    sortorder: "asc",
  editable: true,
    caption: 'Stock de Reutilizable',
    multiselect: false,
    height:'auto',
    loadtext: 'Cargando',
  width:'600',
        }).navGrid("#paginacion_reutilizable", { edit: false, add: false, search: false, del: false, refresh:true });
        $("#tbl_stock_reutilizable").jqGrid('filterToolbar', { stringResult: true, searchOnEnter: false }) ; 
   });
  }

</script>

<div class="demo">
<div id="tabs">
  <ul>
    <li><a href="#linea" onclick="paginacion_linea">Linea</a></li>
    <li><a href="#reutilizable" onclick="ver_pedidos_reutilizable();">Reutilizable</a></li>
  </ul>
  <div id="linea">
    <table>
            <tr>
              <td>
                <button onclick="javascrip:ver_pedidos();" title="Bajar pedido de linea">
                  <div style="width:120px; height:30px;"><img src="img/bajar_stock.png" width="30" height="30" style="float:left;"><div style="float:left;"><p style="font-size:12px; color:#108de2; margin-top: 10px; margin-bottom: 0px;">&nbsp &nbsp Proveedor</p></div></div>  
                </button>
              </td>
              <td>
                <button onclick="javascrip:stock();" title="Bajar pedido de linea">
                  <div style="width:120px; height:30px;"><img src="img/bajar_stock.png" width="30" height="30" style="float:left;"><div style="float:left;"><p style="font-size:12px; color:#108de2; margin-top: 10px; margin-bottom: 0px;">&nbsp &nbsp Nave</p></div></div>  
                </button>
              </td>
            </tr>
          </table>
    <table id="tbl_stock_linea"></table>
        <div id="paginacion"> </div>    
        <div style="display:none" id="dialog-procesos" title="Pedidos">


        <?php 
        //$this->load->view('pedidos_proveedores/formulario');?>
        </div>
  </div>
  <div id="reutilizable">
    <table>
      <tr>
        <td>
          <button onclick="ver_pedidos_reutilizable_dialog();" title="bajar Pedidos Reutilizable">
            <div style="width:120px; height:30px;"><img src="img/bajar_stock.png" width="30" height="30" style="float:left;"><div style="float:left;"><p style="font-size:12px; color:#108de2; margin-top: 10px; margin-bottom: 0px;">&nbsp &nbsp Proveedor</p></div></div>     
          </button>
        </td>
      </tr>
    </table>
    <table id="tbl_stock_reutilizable">
      <div id="paginacion_reutilizable"></div>
      <div style="display:none" id="dialog-procesos_reutilizable" title="Pedidos Reutilizable">
        <?php 
          //$this->load->view()
        ?>
      </div>
    </table>
  </div>
</div>

</div>

<!-- Entrega pedidos de linea -->
<div style="display:none" id="grid_linea" title="Lista de pedidos de linea">
  <?php 
    $this->load->view('stock/bajar_stock_linea');
   ?>
</div>

<div style="display:none" id="grid_reutilizable" title="Lista de pedidos de linea">
  <?php 
    $this->load->view('stock/bajar_stock_reutilizable');
   ?>
</div>


