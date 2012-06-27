
<?php $this->load->view('hed');?>
<script type="text/javascript">

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
                        colNames:['Acciones',
                                  'NOMBRE',
                                  'ANCHO',
                                  'LARGO',
                                  'CORRUGADO',
                                  'RESISTENCIA',
                                  'CANTIDAD'               
                                     ],
                        colModel:[{name:'acciones', index:'acciones', width:60, resizable:false, align:"center", search:false},
                                  {name:'nombre', index:'nombre', width:100,resizable:false, sortable:true,search:true,editable:true},
                                  {name:'ancho', index:'ancho', width:100,resizable:false, sortable:true,search:true,editable:true},
                                  {name:'largo', index:'largo', width:100,resizable:false, sortable:true,search:true,editable:true},
                                  {name:'corrugado', index:'corrugado', width:100,resizable:false, sortable:true,search:true,editable:true},
                                  {name:'resistencia', index:'resistencia', width:100,resizable:false, sortable:true,search:true,editable:true},
                                  {name:'cantidad', index:'cantidad', width:100,resizable:false, sortable:true,search:true,editable:true}
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
  width:'100%',
        }).navGrid("#paginacion", { edit: false, add: false, search: false, del: false, refresh:true });
        $("#tbl_stock_linea").jqGrid('filterToolbar', { stringResult: true, searchOnEnter: false }) ; 
   });
function reloading()
  {
  $("#tbl_stock_linea").trigger("reloadGrid")
  }

</script>

<div class="demo">
<div id="tabs">
  <ul>
    <li><a href="#linea" onclick="paginacion_linea">Linea</a></li>
    <li><a href="#reutilizable">Reutilizable</a></li>
    <li><a href="#productos_terminados">Productos terminados</a></li>
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
        $this->load->view('pedidos_proveedores/formulario');?>
        </div>
  </div>
  <div id="reutilizable">
    
  </div>
  <div id="productos_terminados">
  </div>
</div>

</div>

<!-- Entrega pedidos de linea -->
<div style="display:none" id="grid_linea" title="Lista de pedidos de linea">
  <?php 
    $this->load->view('stock/bajar_stock_linea');
   ?>
</div>



