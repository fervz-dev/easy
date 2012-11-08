<?php $this->load->view('hed');?>
<script type="text/javascript">
//////////////////////////////////////////// agrega el producto verificado a stock ////////////////////////////////
function add_stock (id) {
   $.ajax({
            async:true,
            beforeSend:function(objeto){$('#loading').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');},
            type:"POST",
            url:"<?php echo base_url();?>stock_lista/add_stock/"+id,
            data:{"nombre":$("#nombre1").val(),
                  "largo":$("#largo1").val(),
                  "ancho":$("#ancho1").val(),
                  "tipo_m":$("#corrugado1").val(),
                  "resistencia":$("#resistencia1").val(),
                  "cantidad":$("#cantidad1").val(),
                  "descripcion":$("#descripcion1").val()
                },
            cache: false,
            datatype:"html",
            success:function(data, textStatus){

            switch(data){
                        case "0":
                                 notify("Error al procesar los datos " ,500,5000,'error');
                        break;
                        case "1":
                                  $( "#dialog-procesos12" ).dialog( "close" );
                        $("#tbl_linea").trigger("reloadGrid");
                        notify("El registro se agrego correctamente." ,500,5000,'aviso');
                        break;
                        default:
                                  $( "#dialog-procesos12" ).dialog( "close" );
                           break;

                              }//switch
                             },
                        error:function(data){
                              notify("Error al procesar los datos " ,500,5000,'error');
                             }//Error
                         });//Ajax
}
//////////////////////////////////////////// Funcion para verificar que llego  PEDIDO /////////////////////////////
function abierto (id) {
  $( "#dialogo" ).dialog({
      autoOpen: false,
      height: 'auto',
      width: 'auto',
      modal: true,
      buttons: {
          Aceptar: function() {
            var confirmacion=true;
           verificacion_pedido(id,confirmacion);
          },
          Cancelar:function()
          {
        $( "#dialogo" ).dialog( "close" );
          }
      },
      close: function() {}
    });
        $( "#dialogo" ).dialog( "open" );

}
///////////////////////////////////////////////Verificacion producto proveedor de linea //////////////////////////////////////////
function verificacion_producto_pedido_pedido(id) {

$.ajax({
                        async:true,cache: false,
                        beforeSend:function(objeto){$('#loading').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');},
                        type:"GET",
                        url:"<?php echo base_url();?>pedidos_proveedor/verificacion_pedido_pedido/"+id+"/"+Math.random()*10919939116744,
                        datatype:"html",
                        success:function(data, textStatus){
                                  dato= data.split('~');
                                  $("#nombre1").val(dato[0]);
                                  $("#largo1").val(dato[1]);
                                  $("#ancho1").val(dato[2]);
                                  $("#corrugado1").val(dato[3]);
                                  $("#cantidad1").val(dato[4]);
                                  $("#resistencia1").val(dato[5]);
                                  $("#descripcion1").val(dato[6]);


                                  },
                        error:function(datos){
                        notify("Error al procesar los datos " ,500,5000,'error');
            return false;
                        }//Error
                        });//Ajax


$( "#dialog-procesos12" ).dialog({
      autoOpen: false,
      height: 'auto',
      width: 'auto',
      modal: true,
      buttons: {
          Aceptar: function() {
               $(".ui-dialog-buttonpane button:contains('Aceptar')").button("disable");
                $(".ui-dialog-buttonpane button:contains('Cancelar')").button("disable");
              add_stock(id);
            },
          Cancelar:function()
          {
              $( "#dialog-procesos12" ).dialog( "close" );
          }
      },
      close: function() {}
    });
        $( "#dialog-procesos12" ).dialog( "open" );


}
///////////////////////////////////////////////Verificar pedido proveedor de linea ///////////////////////////////////////////////
function verificacion_pedido (id, confirmacion) {
  if (confirmacion==true && id !='') {
     $.ajax({
          async:true,cache: false,
          beforeSend:function(objeto){$('#loading').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');},
          type:"POST",
          url:"<?php echo base_url();?>almacen_linea/verificacion_pedido/"+id,
          datatype:"html",
          success:function(data, textStatus){

                                            switch(data){
                                                          case "0":
                                                                  $("#ErrorDatos").show();
                                                                  setTimeout("$('#ErrorDatos').fadeOut(6000)", 8000);
                                                          break;

                                                          case "1":

                                                                  $( "#dialogo" ).dialog( "close" );
                                                                  $("#verificadoPedido").show();

                                                                 setTimeout("$('#verificadoPedido').fadeOut(6000)", 8000);
                                                                  $("#tbl_linea").trigger("reloadGrid");

                                                          break;

                                                          default:
                                                                  $( "#dialogo").dialog( "close" );
                                                                  //alert('Vacante guardada');
                                                                  // reloading();
                                                          break;

                                                        }//switch
                                            },
          error:function(datos){
                                alert("Error inesparado");
                             }//Error
          });//Ajax
  };
}
/////////////////////////////////////////////// inicia la paginacion y subpaginacion ////////////////////////////////////////////////////////////////////
	$(document).ready(function(){
  $("#tbl_linea").jqGrid('GridUnload');
		$("#tbl_linea").jqGrid({
			url:'<?php echo base_url();?>almacen_linea/paginacion',
			 datatype: "json",
    mtype: 'POST',

                        colNames:['Acciones',
                                    'ID PEDIDO',
                                    'FECHA DE PEDIDO',
                                    'FECHA DE ENTREGA',
                                    'PROVEEDOR',
                                    'LUGAR DE ENVIO'
                                    ],
                        colModel:[{name:'acciones', index:'acciones', width:22, resizable:true, align:"center",sortable:true,search:false,editable:false},
                                  {name:'id_pedido', index:'id_pedido', width:30,resizable:true,sortable:true,search:false,editable:false},
                                  {name:'fecha_pedido', index:'fecha_pedido', width:30,resizable:true,sortable:true,search:false,editable:false},
                                  {name:'fecha_entrega', index:'fecha_entrega', width:30,resizable:true,sortable:true,search:false,editable:false},
                                  {name:'nombre_empresa', index:'nombre_empresa', width:60,resizable:true,sortable:true,search:false,editable:false},
                                  {name:'nombre_oficina', index:'nombre_oficina', width:90,resizable:true,sortable:true,search:false,editable:false}
                                ],
    pager: jQuery('#paginacion1'),
    rownumbers:true,
  rowNum:15,
    rowList:[10,20,30],
    imgpath: '<?php echo base_url();?>img/editar.jpg',
    mtype: "POST",
    sortname: 'id_pedido',
    viewrecords: true,
    sortorder: "desc",
  editable: true,
    caption: 'Pedido de linea',
    multiselect: false,
    height:'auto',
    loadtext: 'Cargando',
  width:960,
  subGrid: true,
    // searchurl:'<?php echo base_url();?>empresas/buscando',
    height:"auto",
   subGridRowExpanded: function(subgrid_id, row_id) {
   var subgrid_table_id, pager_id; subgrid_table_id = subgrid_id+"_t"; pager_id = "p_"+subgrid_table_id;

   $("#"+subgrid_id).html("<table id='"+subgrid_table_id+"' alt='subtabla' class='scroll'></table><div id='"+pager_id+"' class='scroll'></div>");

   $("#"+subgrid_table_id).jqGrid({
   //url:"subgrid.php?q=2&id="+row_id,
   url:"<?php echo base_url();?>almacen_linea/subpaginacion/"+row_id,
   datatype: "json",
   mtype: 'POST',
   colNames: ['ACCI&Oacute;N', 'No', 'NOMBRE','LARGO','ANCHO','CORRUGADO','RESISTENCIA','CANTIDAD'],
   colModel: [
             {name:"acciones",index:"acciones",width:56,align:"center",sortable:true,search:false,editable:false},
             {name:"No",index:"No",width:56,align:"center",sortable:true,search:false,editable:false},
             {name:"nombre",index:"nombre",width:80,align:"center",sortable:true,search:false,editable:false},

             {name:"largo",index:"largo",width:56,align:"left",sortable:true,search:false,editable:false},
             {name:"ancho",index:"ancho",width:56,align:"left",sortable:true,search:false,editable:false},
             {name:"tipo_m",index:"tipo_m",width:65,align:"left",sortable:true,search:false,editable:false},
             {name:"resistencia",index:"resistencia",width:65,align:"left",sortable:true,search:false,editable:false},
             {name:"cantidad",index:"cantidad",width:65,align:"left",sortable:true,search:false,editable:false}
              ],
   rows:10,
   rowNum:10,
   rowList:[10,15],
   pager: pager_id,
   sortname: 'id_cantidad_pedido',
   height:'auto',
   sortorder: "asc" });

   $("#"+subgrid_table_id).jqGrid('navGrid',"#"+pager_id,{edit:false,add:false,del:false,search:false}) }
        }).navGrid("#paginacion1", { edit: false, add: false, search: false, del: false, refresh:true });
        $("#tbl_linea").jqGrid('filterToolbar', { stringResult: true, searchOnEnter: false }) ;
      $("#tbl_linea").jqGrid('navGrid','#paginacion1',{add:false,edit:false,del:false,search:false});


	});


</script>

		<table id="tbl_linea"></table>
        <div id="paginacion1"> </div>
  <!-- Funcion dialogo -->
        <div style="display:none;" id="dialogo" >
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
        </div>
          <div style="display:none" id="dialog-procesos12" title="Verificar producto">
             <form  name="producto" id="producto">
                <table>



                  <tr>
                    <td><label>Nombre</label></td>
                    <td><input type="text" id="nombre1" name="nombre1" readonly="readonly" ></td>
                  </tr>

                  <tr>
                    <td><label>Descripcion</label></td>
                       <td> <textarea name="descripcion1" id="descripcion1" cols="30" rows="4" readonly="readonly"></textarea>

                  </tr>

                  <tr>
                    <td><label>Largo</label></td>
                    <td><input type="text" id="largo1" name="largo1" readonly="readonly" ></td>
                  </tr>
                  <tr>
                    <td><label>Ancho</label></td>
                    <td><input type="text" id="ancho1" name="ancho1" readonly="readonly" ></td>
                  </tr>


                  <tr>
                    <td><label>Corrugado</label></td>
                    <td><input type="text" id="corrugado1" name="corrugado1" readonly="readonly" ></td>
                  </tr>
                  <tr>
                    <td><label>Resistencia</label></td>
                    <td><input type="text" id="resistencia1" name="resistencia1" readonly="readonly" ></td>
                  </tr>

                  <tr>
                    <td><label>Cantidad</label></td>
                    <td><input type="text" id="cantidad1" name="cantidad1"  ></td>
                  </tr>

                <!--  <tr>
                    <td><label>Observaciones</label></td>
                    <td><textarea rows="2" cols="20"></textarea></td>
                  </tr> -->

                  <!-- <input type="hidden"  id="id_producto" name="id_produto" > -->

                </table>
                </form>
          </div>