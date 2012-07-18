<?php $this->load->view('hed');?>
<script type="text/javascript">
//////////////////////////////////////////// agrega el producto verificado a stock ////////////////////////////////
function add_stock_reutilizable (id) {
   $.ajax({
            async:true,
            beforeSend:function(objeto){$('#loading').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');},
            type:"POST",
            url:"<?php echo base_url();?>stock_lista/add_stock_reutilizable/"+id,
            data:{"proveedor_":$("#proveedor_").val(),
                  "cantidad_":$("#cantidad_").val()
                },
            cache: false,
            datatype:"html",
            success:function(data, textStatus){

            switch(data){
                        case "0": 
                                 notify("Error al procesar los datos " ,500,5000,'error');
                        break;
                        case "1": 
                                  $( "#dialog-procesos_reutilizable" ).dialog( "close" );
                                  $("#tbl_reutilizable_bajar").trigger("reloadGrid"); 
                                  notify("El registro se agrego correctamente." ,500,5000,'aviso');
                        break;
                        default:
                                  $( "#dialog-procesos_reutilizable" ).dialog( "close" );
                        break; 

                              }//switch
                             },
                        error:function(data){
                              notify("Error al procesar los datos " ,500,5000,'error');
                             }//Error
                         });//Ajax
           
}
//////////////////////////////////////////// Funcion para verificar que llego  PEDIDO /////////////////////////////
function abierto_reutilizable (id) {
  $( "#dialogo_reutilizable" ).dialog({
      autoOpen: false,
      height: 'auto',
      width: 'auto',
      modal: true,
      buttons: {
          Aceptar: function() {
            var confirmacion=true;
           verificacion_producto_pedido_reutilizable(id,confirmacion); 
           $( "#dialogo_reutilizable" ).dialog( "close" );       
          },
          Cancelar:function()
          {   
        $( "#dialogo_reutilizable" ).dialog( "close" );
          }
      },
      close: function() {}
    });
        $( "#dialogo_reutilizable" ).dialog( "open" );

}
///////////////////////////////////////////////Verificacion producto proveedor de linea //////////////////////////////////////////
function verificacion_producto_pedido_reutilizable(id) {

$.ajax({
                        async:true,cache: false,
                        beforeSend:function(objeto){$('#loading').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');},
                        type:"GET",
                        url:"<?php echo base_url();?>pedidos_reutilizable/verificacion_pedido/"+id+"/"+Math.random()*10919939116744,
                        datatype:"html",
                        success:function(data, textStatus){
                                  dato= data.split('~');
                                  $("#proveedor_").val(dato[0]);
                                  $("#cantidad_").val(dato[1]);

                                  
                                  },
                        error:function(datos){
                        notify("Error al procesar los datos " ,500,5000,'error');
            return false;
                        }//Error
                        });//Ajax


$( "#dialog_stock_reutilizable" ).dialog({
      autoOpen: false,
      height: 'auto',
      width: 'auto',
      modal: true,
      buttons: {
          Aceptar: function() {
              add_stock_reutilizable(id);
              $( "#dialog_stock_reutilizable" ).dialog( "close" );
                $("#tbl_reutilizable_bajar").jqGrid('GridUnload');
                setTimeout("grid_reutilizable()",1000);

                 

            },
          Cancelar:function()
          {
              $( "#dialog_stock_reutilizable" ).dialog( "close" );
          }
      },
      close: function() {}
    });
        $( "#dialog_stock_reutilizable" ).dialog( "open" );


}
////////////////////////////////////////////// inicia la paginacion y subpaginacion ////////////////////////////////////////////////////////////////////
	function grid_reutilizable () {

    $("#tbl_reutilizable_bajar").jqGrid({
    url:'<?php echo base_url();?>pedidos_reutilizable/paginacion_stock_reutilizable',
    datatype: "json",
    mtype: 'POST',
          
                        colNames:['Acciones',
                                    'FECHA DE PEDIDO',
                                    'FECHA DE ENTREGA',
                                    'CANTIDAD',
                                    'PROVEEDOR',
                                    'LUGAR DE ENVIO'
                                    ],
                        colModel:[{name:'acciones', index:'acciones', width:60, resizable:true, align:"center", search:false},
                                  {name:'fecha_pedido', index:'fecha_pedido', width:30,resizable:true, sortable:true,search:false,editable:true},
                                  {name:'fecha_entrega', index:'fecha_entrega', width:30,resizable:true, sortable:true,search:false,editable:true},
                                  {name:'cantidad', index:'cantidad', width:30,resizable:true, sortable:true,search:false,editable:false},
                                  {name:'nombre_empresa', index:'nombre_empresa', width:100,resizable:true, sortable:true,search:false,editable:true},
                                  {name:'nombre_oficina', index:'nombre_oficina', width:90,resizable:true, sortable:true,search:false,editable:true}
                                ],                             
    pager: jQuery('#paginacion_reutilizable_bajar'),
    rownumbers:true,
    rowNum:15,
    rowList:[10,20,30],
    imgpath: '<?php echo base_url();?>img/editar.jpg',
    mtype: "POST",
    sortname: 'id_pedido_reutilizable',
    viewrecords: true,
    sortorder: "asc",
    editable: true,
    caption: 'Pedido Reutilizable',
    multiselect: false,
    height:'auto',
    loadtext: 'Cargando',
    width:'950',  
        }).navGrid("#paginacion_reutilizable_bajar", { edit: false, add: false, search: false, del: false, refresh:true });
        $("#tbl_reutilizable_bajar").jqGrid('filterToolbar', { stringResult: true, searchOnEnter: false }) ; 

  }
  $(document).ready(function(){
  $("#tbl_reutilizable_bajar").jqGrid({
    url:'<?php echo base_url();?>pedidos_reutilizable/paginacion_stock_reutilizable',
    datatype: "json",
    mtype: 'POST',
          
                        colNames:['Acciones',
                                    'FECHA DE PEDIDO',
                                    'FECHA DE ENTREGA',
                                    'CANTIDAD',
                                    'PROVEEDOR',
                                    'LUGAR DE ENVIO'
                                    ],
                        colModel:[{name:'acciones', index:'acciones', width:60, resizable:true, align:"center", search:false},
                                  {name:'fecha_pedido', index:'fecha_pedido', width:30,resizable:true, sortable:true,search:false,editable:true},
                                  {name:'fecha_entrega', index:'fecha_entrega', width:30,resizable:true, sortable:true,search:false,editable:true},
                                  {name:'cantidad', index:'cantidad', width:30,resizable:true, sortable:true,search:false,editable:false},
                                  {name:'nombre_empresa', index:'nombre_empresa', width:100,resizable:true, sortable:true,search:false,editable:true},
                                  {name:'nombre_oficina', index:'nombre_oficina', width:90,resizable:true, sortable:true,search:false,editable:true}
                                ],                             
    pager: jQuery('#paginacion_reutilizable_bajar'),
    rownumbers:true,
    rowNum:15,
    rowList:[10,20,30],
    imgpath: '<?php echo base_url();?>img/editar.jpg',
    mtype: "POST",
    sortname: 'id_pedido_reutilizable',
    viewrecords: true,
    sortorder: "asc",
    editable: true,
    caption: 'Pedido Reutilizable',
    multiselect: false,
    height:'auto',
    loadtext: 'Cargando',
    width:'950',  
        }).navGrid("#paginacion_reutilizable_bajar", { edit: false, add: false, search: false, del: false, refresh:true });
        $("#tbl_reutilizable_bajar").jqGrid('filterToolbar', { stringResult: true, searchOnEnter: false }) ; 
   });  


</script>

		<table id="tbl_reutilizable_bajar"></table>
        <div id="paginacion_reutilizable_bajar"> </div>    
  <!-- Funcion dialogo -->
        <div style="display:none;" id="dialogo_reutilizable" >
          <div class="ui-widget">
            <div class="ui-state-error ui-corner-all" style="padding: 0 .7em;">
              <p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>
              <strong>Precaución:</strong> Esta seguro de verificar el pedido?</p>
            </div>
          </div>
        </div>
        <!-- Pedido cerrado -->
        <div style="display:none;" id="dialogo_cerrado" >
          <div class="ui-widget">
            <div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;">
              <p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
              <strong>Alerta:</strong> El Pedido ya esta cerrado!!!</p>
            </div>
          </div>
        </div>
        <!-- error al procesar los datos -->
        <div style="display:none;" id="verificadoPedido" >
          <div class="ui-widget">
            <div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;"> 
              <p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
              <strong>Ok!</strong> Pedido verificado correctamente, ahora puede verificar los productos!!!.</p>
            </div>
          </div>
        </div>

        <!-- Èrro no se verifico el pedido -->
        <div style="display:none;" id="ErrorDatos" >
          <div class="ui-widget">
            <div class="ui-state-error ui-corner-all" style="padding: 0 .7em;">
              <p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>
              <strong>Error:</strong> No se pudo verificar el pedido!!!</p>
            </div>
          </div>
          <div style="display:none" id="dialog_stock_reutilizable" title="Verificar producto">
            <?php $this->load->view('stock/formulario_validar_pedido_reutilizable');?>
          </div>