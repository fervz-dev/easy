
<?php $this->load->view('hed');?>
<script type="text/javascript">
function usarLinea(id)
{
  $("#id_linea").val(id);
$( "#dialog-procesos_producto" ).dialog({
      autoOpen: false,
      height: 'auto',
      width: 'auto',
      modal: true,
      buttons: {
          Aceptar: function() {
          $( "#dialog-procesos_producto" ).dialog( "close" );
          $("#tbl_p_prove").trigger("reloadGrid");
          }
      },
      close: function() {}
    });
        $( "#dialog-procesos_producto" ).dialog( "open" );
        $("#tbl_p_prove").trigger("reloadGrid");
}
////////////////////////////////////ver pedido de bodega////
function ver_pedidos_bodega()
{

 $( "#grid_bodega" ).dialog({
      autoOpen: false,
      height: "auto" ,
      width: "auto",
      modal: true,
      close: function() {reloading();}
    });
        $( "#grid_bodega" ).dialog( "open" );

}
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
                        colNames:['id',
                                  'ACCIONES',
                                  'NOMBRE',
                                  'LARGO',
                                  'ANCHO',
                                  'CORRUGADO',
                                  'RESISTENCIA',
                                  'CANTIDAD'
                                     ],
                        colModel:[
                                  {name:'id_stock_linea', index:'id_stock_linea', width:20,resizable:true,sortable:true,search:false,editable:false},
                                  {name:'acciones', index:'acciones', width:100,resizable:true,sortable:true,search:false,editable:false},
                                  {name:'nombre', index:'nombre', width:100,resizable:true,sortable:true,search:false,editable:false},
                                  {name:'largo', index:'largo', width:100,resizable:true,sortable:true,search:false,editable:false},
                                  {name:'ancho', index:'ancho', width:100,resizable:true,sortable:true,search:false,editable:false},
                                  {name:'corrugado', index:'corrugado', width:100,resizable:true,sortable:true,search:false,editable:false},
                                  {name:'resistencia', index:'resistencia', width:100,resizable:true,sortable:true,search:false,editable:false},
                                  {name:'cantidad', index:'cantidad', width:100,resizable:true,sortable:true,search:false,editable:false}
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
  ////////////////////////////////////////funcion para ver el gid de almacen reutilizable/////////////////////////////////////////////////
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
                        colModel:[{name:'proveedor', index:'proveedor', width:100,resizable:true
                        ,sortable:true,search:false,editable:false},
                                  {name:'cantidad', index:'cantidad', width:100,resizable:true
                                  ,sortable:true,search:false,editable:false},
                                  {name:'fecha_ingreso', index:'fecha_ingreso', width:100,resizable:true
                                  ,sortable:true,search:false,editable:false}
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

function envios() {
  var id_stock_linea = $("#tbl_stock_linea").jqGrid('getGridParam','selrow');
  if (id_stock_linea) {
    var ret = jQuery("#tbl_stock_linea").jqGrid('getRowData',id_stock_linea);
    // alert("id="+ret.id_stock_linea+"...");


  } else { alert("D");
}
}
function ver_pedidosLista ()
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
</script>

<div class="demo">
<div id="tabs">
  <ul>
    <li><a href="#linea">Linea</a></li>
    <li><a href="#reutilizable" onclick="ver_pedidos_reutilizable();">Reutilizable</a></li>
  </ul>
  <div id="linea">
<div id="controles" style="floas:left; width:800px; height:90px;" >
  <fieldset style="width: 350px; float:left;">
          <legend>
             Descargar pedidos a Stock
          </legend>
    <table>

      <tr>

                <table>
                    <td>
                      <button onclick="javascrip:ver_pedidos();" title="Bajar pedido de linea">
                        <div style="width:120px; height:30px;"><img src="img/bajar_stock.png" width="30" height="30" style="float:left;"><div style="float:left;"><p style="font-size:12px; color:#108de2; margin-top: 10px; margin-bottom: 0px;">&nbsp &nbsp Proveedor</p></div></div>
                      </button>
                    </td>
                    <td>
                      <button onclick="javascrip:ver_pedidos_bodega();" title="Bajar pedido de bodega">
                        <div style="width:120px; height:30px;"><img src="img/bajar_stock.png" width="30" height="30" style="float:left;"><div style="float:left;"><p style="font-size:12px; color:#108de2; margin-top: 10px; margin-bottom: 0px;">&nbsp &nbsp Nave</p></div></div>
                      </button>
                    </td>
                </table>

      </tr>

    </table>
</fieldset>
<fieldset style="width: 350px; float:left;">
          <legend>
             Descontar para envios a Nave
          </legend>
    <table>

    <tr>

        <table>
            <td>
              <button onclick="envios()" title="Pedidos para enviar a Nave">
                <div style="width:120px; height:30px;"><img src="img/envio.png" width="30" height="30" style="float:left;"><div style="float:left;"><p style="font-size:12px; color:#108de2; margin-top: 10px; margin-bottom: 0px;">&nbsp &nbsp Lista</p></div></div>
              </button>
            </td>

        </table>

    </tr>

    </table>
</fieldset>

</div>



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
          <button onclick="ver_pedidos_reutilizable_dialog();" title="Bajar Pedidos Reutilizable">
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

<table id="tbl_stock_bodega">
      <div id="paginacion_bodega"></div>
      <div style="display:none" id="dialog-procesos_bodega" title="ingresos Bodega">

      </div>
</table>
<!-- Entrega pedidos de linea -->
<div style="display:none" id="grid_linea" title="Lista de pedidos de linea">
  <?php
    $this->load->view('stock/bajar_stock_linea');
   ?>
</div>
<!-- Entrega de pedido reutilizable -->
<div style="display:none" id="grid_reutilizable" title="Lista de pedidos reutilizable">
  <?php
    $this->load->view('stock/bajar_stock_reutilizable');
   ?>
</div>
<!-- Entrega de pedido de bodega -->
<div style="display:none" id="grid_bodega" title="Lista de pedidos de Bodega">
  <?php
    $this->load->view('stock/bajar_stock_bodega');
   ?>
</div>
        <div style="display:none" id="dialog-procesos_producto" title="Pedidos">
        <?php
        $this->load->view('stock/ver_productos');?>
        </div>

