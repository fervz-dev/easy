<script type="text/javascript">
//////////////////////////////////////////// Espera id del pedido y confirmacion para terminarlo ////////////////////
function terminar_pedido(id,confirmacion)
{
if(confirmacion==true)
{
  $.ajax({
          async:true,cache: false,
          beforeSend:function(objeto){$('#loading').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');},
          type:"POST",
          url:"<?php echo base_url();?>pedidos_bodega_prod_term/terminar_pedido/"+id,
          datatype:"html",
          success:function(data, textStatus){

              switch(data){
                case "0":
                  notify("Error al procesar los datos " ,500,5000,'error');
                break;
                case "1":
                  $( "#dialogo_pedido" ).dialog( "close" );
                  $("#tbl_p_prove").trigger("reloadGrid");
                  notify('Pedido se marco como terminado satisfactoriamente',500,5000,'aviso');

              break;

              default:
              $( "#dialogo_pedido").dialog( "close" );

              break;

              }//switch
              },
              error:function(datos){
              notify("Error inesperado" ,500,5000,'error');
              }//Error
              });//Ajax
}

}
//////////////////////////////////////////// Espera id del producto y confirmacion para terminarlo ////////////////////
function terminar_producto(id,confirmacion)
{
if(confirmacion==true)
{
  $.ajax({
          async:true,cache: false,
          beforeSend:function(objeto){$('#loading').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');},
          type:"POST",
          url:"<?php echo base_url();?>pedidos_bodega_prod_term/terminar_producto/"+id,
          datatype:"html",
          success:function(data, textStatus){

              switch(data){
                case "0":
                   notify("El pedido aun no es enviado de la bodega " ,500,5000,'error');
                break;
                case "1":
                  $( "#dialogo_producto" ).dialog( "close" );
                  $("#tbl_p_prove").trigger("reloadGrid");
                  notify('Producto se marco como terminado satisfactoriamente',500,5000,'aviso');

              break;

              default:
              $( "#dialogo_producto").dialog( "close" );

              break;

              }//switch
              },
              error:function(datos){
              notify("Error inesperado" ,500,5000,'error');
              }//Error
              });//Ajax
}

}

//////////////////////////////////////////// Alerta Pedido cerrado ///////////////////////////////////////////////////////////
function cerrado () {

   $( "#dialogo_cerrado" ).dialog({
      autoOpen: false,
      height: 'auto',
      width: 'auto',
      modal: true,
      buttons: {
      Cerrar:function()
        {
         $( "#dialogo_cerrado" ).dialog( "close" );
        }
      },
      close: function() {}
    });
        $( "#dialogo_cerrado" ).dialog( "open" );

}
///////////////////dialogo de confirmacion////////////////////////////////////
  function confirmacion_eliminar (id,msg) {
$('#dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>'+msg+'</p>');

    $( "#dialog-confirm" ).dialog({
      resizable: false,
      height: 'auto',
      width: 'auto',
      modal: true,
      buttons: {
        "Eliminar": function() {
          $( this ).dialog( "close" );
          eliminar_pedido_(id);
        },
        Cancel: function() {
          $( this ).dialog( "close" );
        }
      }
    });
    }
function confirmacion_producto_ (id,msg) {
$('#dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>'+msg+'</p>');

    $( "#dialog-confirm" ).dialog({
      resizable: false,
      height: 'auto',
      width: 'auto',
      modal: true,
      buttons: {
        "Eliminar": function() {
          $( this ).dialog( "close" );
          eliminar_producto_(id);
        },
        Cancel: function() {
          $( this ).dialog( "close" );
        }
      }
    });
    }
///eliminar producto
function eliminar_producto(id) {
  msg="Este producto se eliminara. ¿Estás seguro?";
  confirmacion_producto_(id,msg);
}
function eliminar_producto_(id)
{

  $.ajax({
                      async:true,cache: false,
                      beforeSend:function(objeto){$('#loading').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');},
                      type:"POST",
                      url:"<?php echo base_url();?>pedidos_bodega_prod_term/eliminar_producto/"+id,
                      datatype:"html",
                      success:function(data, textStatus){

                             switch(data){
                               case "0":
                                  notify("Error al procesar los datos " ,500,5000,'error');
                                break;
                               case "1":
                                    $( "#dialog-procesos" ).dialog( "close" );

                                 $("#tbl_p_prove").trigger("reloadGrid");
                                 notify('El registro se elimino correctamente',500,5000,'aviso');
                                break;

                                   default:
                                   $( "#dialog-procesos" ).dialog( "close" );
                                 break;

                              }//switch
                             },
                        error:function(datos){
                              notify("Error inesperado" ,500,5000,'error');
                             }//Error
                         });//Ajax
}

//////////////////////////////////////////// Espera id del pedido y confirmacion para cerrarlo ////////////////////
function cerrar_pedido(id,confirmacion)
{
if(confirmacion==true)
{
  $.ajax({
          async:true,cache: false,
          beforeSend:function(objeto){$('#loading').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');},
          type:"POST",
          url:"<?php echo base_url();?>pedidos_bodega_prod_term/cerrar_pedido/"+id,
          datatype:"html",
          success:function(data, textStatus){

              switch(data){
                case "0":
                  notify("Error al procesar los datos " ,500,5000,'error');
                break;
                case "1":
                  $( "#dialogo" ).dialog( "close" );
                  $("#tbl_p_prove").trigger("reloadGrid");
                  notify('Pedido cerrado satisfactoriamente',500,5000,'aviso');

              break;

              default:
              $( "#dialogo").dialog( "close" );

              break;

              }//switch
              },
              error:function(datos){
              notify("Error inesperado" ,500,5000,'error');
              }//Error
              });//Ajax
}

}

//////////////////////////////////////////// Alerta producto - Pedido cerrado ////////////////////////////////////////////////

function pedido_cerrado () {

   $( "#dialogo_cerrado" ).dialog({
      autoOpen: false,
      height: 'auto',
      width: 'auto',
      modal: true,
      buttons: {

          Cerrar:function()
          {
        $( "#dialogo_cerrado" ).dialog( "close" );
          }
      },
      close: function() {}
    });
        $( "#dialogo_cerrado" ).dialog( "open" );

}
//////////////////////////////////////////// Funcion para cerrar Pedido a bodegas /////////////////////////////
function abierto (id) {
  $( "#dialogo" ).dialog({
      autoOpen: false,
      height: 'auto',
      width: 'auto',
      modal: true,
      buttons: {
          Aceptar: function() {
            var confirmacion=true;
           cerrar_pedido(id,confirmacion);
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
//eliminar pedido
function eliminar_pedido(id) {
  msg="Este pedido se eliminara. ¿Estás seguro?";
  confirmacion_eliminar(id,msg);
}
///////////////////////////////////////eliminar pedido con sus productos ////////////////////////////////////////
function eliminar_pedido_(id)
{
  $.ajax({
                      async:true,cache: false,
                      beforeSend:function(objeto){$('#loading').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');},
                      type:"POST",
                      url:"<?php echo base_url();?>pedidos_bodega_prod_term/eliminar_pedido/"+id,
                      datatype:"html",
                      success:function(data, textStatus){

                             switch(data){
                               case "0":
                                  notify("Error al procesar los datos " ,500,5000,'error');
                                break;
                               case "1":
                               $("#tbl_p_prove").jqGrid("GridUnload");
                                    $( "#dialog-procesos" ).dialog( "close" );
                                 notify('El registro se elimino correctamente',500,5000,'aviso');
                                  setTimeout("cargar()",1000);
                                break;

                                   default:
                                   $( "#dialog-procesos" ).dialog( "close" );
                                 break;

                              }//switch
                             },
                        error:function(datos){
                              notify("Error inesperado" ,500,5000,'error');
                             }//Error
                         });//Ajax
}
function editar(id)
{

$.ajax({
          async:true,cache: false,
          beforeSend:function(objeto){$('#loading').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');},
           type:"POST",
            url:"<?php echo base_url();?>pedidos_bodega_prod_term/editar_pedido/"+id,
          data:{"fecha_entrega":$("#fecha_entrega").val(),
                "clientes":$("#clientes").val(),
                  "oficina_pedido":$("#oficina_pedido").val(),
                  "oficina":$("#oficina").val()},

                     datatype:"html",
                      success:function(data, textStatus){

                          switch(data){
                              case "0":
                                  notify("Error al procesar los datos " ,500,5000,'error');
                              break;

                              case "1":
                                  $("#tbl_p_prove").trigger("reloadGrid");
                                  notify('El registro se guardado correctamente',500,5000,'aviso');
                                  $( "#dialog-procesos" ).dialog( "close" );
                              break;

                              default:
                                  $( "#dialog-procesos" ).dialog( "close" );
                                  var error='Error'+data;
                                 notify(error ,500,5000,'error');
                              break;
                              }//switch
                             },
                        error:function(datos){
                             notify("Error inesperado" ,500,5000,'error');
                             }//Error
                         });//Ajax


}
function edit(id)
{
document.editar_pedido.reset();
$.ajax({
            async:true,cache: false,
            beforeSend:function(objeto){$('#loading').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');},
            type:"GET",
            url:"<?php echo base_url();?>pedidos_bodega_prod_term/get/"+id+"/"+Math.random()*10919939116744,
            datatype:"html",
            success:function(data, textStatus){
            dato= data.split('~');
            $("#fecha_entrega").val(dato[0]);
            $("#clientes").val(dato[2]);
            $("#oficina_pedido").val(dato[1]);
            },
        error:function(datos){
        notify("Error al procesar los datos " ,500,5000,'error');
          return false;
        }//Error
        });//Ajax


$( "#dialog-procesos" ).dialog({
      autoOpen: false,
      height: 'auto',
      width: 'auto',
      modal: true,
      buttons: {
          Aceptar: function() {
            if (validarCamposForm1()==true) {
          editar(id);
           }
            },
          Cancelar:function()
          {
              $( "#dialog-procesos" ).dialog( "close" );
          }
      },
      close: function() {}
    });
        $( "#dialog-procesos" ).dialog( "open" );

}

///////////////////////Guardar pedido
function guardar_pedido()
{
    var p=0;
    var c=0;
    var t=0;
    var e=0;
    var resultProductos=document.getElementsByName('inputHideProductos[]');
    var arrayProductos=new Array();
    while(p< resultProductos.length){
      arrayProductos[p]=resultProductos[p].value;
      p++
    }

// alert(arrayProductos);
    var resultComponentes=document.getElementsByName('inputHideComponentes[]');
    var arrayComponentes=new Array();
    while(c< resultComponentes.length){
      arrayComponentes[c]=resultComponentes[c].value

      c++
    }
// array show
    var resultProductosShow=document.getElementsByName('inputShowProductos[]');
    var arrayProductosShow=new Array();
    while(t< resultProductosShow.length){
      arrayProductosShow[t]=resultProductosShow[t].value;
      t++
    }

// alert(arrayProductos);
    var resultComponentesShow=document.getElementsByName('inputShowComponentes[]');
    var arrayComponentesShow=new Array();
    while(e< resultComponentesShow.length){
      arrayComponentesShow[e]=resultComponentesShow[e].value

      e++
    }
// alert(arrayComponentes);
$.ajax({
          async:true,cache: false,
          beforeSend:function(objeto){$('#loading').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');},
           type:"POST",
            url:"<?php echo base_url();?>pedidos_bodega_prod_term/guardar_pedido?da="+Math.random()*2312,
          data:{"fecha_entrega":$("#fecha_entrega").val(),
                "clientes":$("#clientes").val(),
                "oficina_pedido":$("#oficina_pedido").val(),
                "clientes":$("#clientes").val(),
                "arrayProductos":arrayProductos,
                "arrayComponentes":arrayComponentes,

                "arrayProductosShow":arrayProductosShow,
                "arrayComponentesShow":arrayComponentesShow
                },
                 datatype:"html",
                      success:function(data, textStatus){

                      switch(data){
                               case "0":
                                  notify("Error al procesar los datos " ,500,5000,'error');
                                break;

                                case "1":
                                   $("#tbl_p_prove").trigger("reloadGrid");
                                    notify('El registro se guardado correctamente',500,5000,'aviso');
                                   $( "#dialog-procesos" ).dialog( "close" );
                                break;

                                default:
                                   $( "#dialog-procesos" ).dialog( "close" );
                                  var error='Error'+data;
                                 notify(error ,500,5000,'error');
                                break;

                              }//switch
                             },
                        error:function(datos){
                             notify("Error inesperado" ,500,5000,'error');
                             }//Error
                         });//Ajax

 }
////////////////////////////////////////////agregar producto///////////////////////////////////////////////////////
function add(id,tipo)
{

$( "#id_pedido").val(id);

cargarListaProdutos(id);
LoadListaProductos();
 $("#tbl_p_prove_form").trigger("reloadGrid");
$( "#dialog-procesos_producto" ).dialog({
      autoOpen: false,
      height: 'auto',
      width: 'auto',
      modal: true,
      buttons: {
          Aceptar: function() {
          $( "#dialog-procesos_producto" ).dialog( "close" );
          $("#tbl_p_prove").trigger("reloadGrid");
          $("#tbl_p_prove_form").jqGrid('GridUnload');
          $("#tbl_lista_productos").jqGrid('GridUnload');



          }
      },
      close: function() {
                  $("#tbl_p_prove_form").jqGrid('GridUnload');
          $("#tbl_lista_productos").jqGrid('GridUnload');
      }
    });
        $( "#dialog-procesos_producto" ).dialog( "open" );
}

////////////////////////////////////////////ver producto///////////////////////////////////////////////////////
function verPedido(id,tipo)
{

verLista(id);
 $("#tbl_verListaPedido").trigger("reloadGrid");
$( "#dialog-procesos_productoLista" ).dialog({
      autoOpen: false,
      height: 'auto',
      width: 'auto',
      modal: true,
      buttons: {
          Aceptar: function() {
          $( "#dialog-procesos_productoLista" ).dialog( "close" );
          $("#tbl_verListaPedido").jqGrid('GridUnload');



          }
      },
      close: function() {
                  $("#tbl_verListaPedido").jqGrid('GridUnload');
      }
    });
        $( "#dialog-procesos_productoLista" ).dialog( "open" );
}



/////////////////////////////////////////////////////////////////
function alta()
{

document.editar_pedido.reset();

$( "#dialog-procesos" ).dialog({
      autoOpen: false,
      height: 'auto',
      width: 'auto',
      modal: true,
      buttons: {
          Aceptar: function() {
            // if (validarCamposForm1()==true) {
              guardar_pedido();
            // }

          },
          Cancelar:function()
          {
        $( "#dialog-procesos" ).dialog( "close" );
          }
      },
      close: function() {}
    });
        $( "#dialog-procesos" ).dialog( "open" );
}
  ////////////////////////////////////////////////////////////////////////
  $(document).ready(function(){
  $("#tbl_p_prove").jqGrid({
    url:'<?php echo base_url();?>pedidos_bodega_prod_term/paginacion',
    datatype: "json",
    mtype: 'POST',

                        colNames:['Acciones',
                                    // 'ID PEDIDO',
                                    // 'FECHA DE PEDIDO',
                                    'FECHA DE ENTREGA',
                                    'BODEGA',
                                    'CLIENTE',
                                    'PRODUCTO'
                                    ],
                        colModel:[{name:'acciones', index:'acciones', width:60, resizable:true, align:"center", search:false},
                                  // {name:'id pedido', index:'id_pedido', width:30,resizable:true, sortable:true,search:false,editable:true},
                                  // {name:'fecha pedido', index:'fecha_pedido', width:30,resizable:true, sortable:true,search:false,editable:true},
                                  {name:'fecha entrega', index:'fecha_entrega', width:30,resizable:true, sortable:true,search:false,editable:true},
                                  {name:'Nombre Bodega', index:'nombre_oficina', width:100,resizable:true, sortable:true,search:false,editable:true},
                                  {name:'Cliente', index:'nombre_empresa', width:100,resizable:true, sortable:true,search:false,editable:true},
                                  {name:'nombre', index:'nombre', width:90,resizable:true, sortable:true,search:false,editable:true}
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
    caption: 'Pedidos Clientes',
    multiselect: false,
    height:'auto',
    loadtext: 'Cargando',
  width:'950',
  subGrid: false,
    //searchurl:'<?php echo base_url();?>empresas/buscando',
    height:"auto",
   subGridRowExpanded: function(subgrid_id, row_id) {
   var subgrid_table_id, pager_id; subgrid_table_id = subgrid_id+"_t"; pager_id = "p_"+subgrid_table_id;

   $("#"+subgrid_id).html("<table id='"+subgrid_table_id+"' alt='subtabla' class='scroll'></table><div id='"+pager_id+"' class='scroll'></div>");

   $("#"+subgrid_table_id).jqGrid({
   //url:"subgrid.php?q=2&id="+row_id,
   url:"<?php echo base_url();?>pedidos_bodega_prod_term/subpaginacion/"+row_id,
   datatype: "json",
   mtype: 'POST',
   colNames: ['ACCI&Oacute;N', 'No', 'NOMBRE','CANTIDAD','OBSERVACIONES','NOMBRE BODEGA','FECHA ENTREGA'],
   colModel: [
             {name:"acciones",index:"acciones",width:56,align:"center"},
             {name:"No",index:"No",width:56,align:"center"},
             {name:"nombre",index:"nombre",search: false,align:"center"},
             {name:"cantidad",index:"ancho",width:70,align:"left",search: false},
             {name:"observaciones",index:"observaciones",align:"left",search: false},
             {name:"Bodega a hacer",index:"nombre_oficina",align:"left",search: false},
             {name:"Fecha de entrega",index:"fecha_entrega",width:100,align:"left",search: false}

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
   });


//////////////////////////////////////////////////////////////////////////////
function validarCamposForm1 () {
  fecha_entrega=$('#fecha_entrega').val();
  proveedor_id_proveedor=$('#oficina_pedido').val();
  oficina=$('#oficina').val();

  if (validarVacio(fecha_entrega)==false) {
      notify('* El campo <strong>FECHA DE ENTREGA</strong> no puede estar vacio!!!',500,5000,'error');
    $("#fecha_entrega").focus();
    return false;
  }else if (validarCombo(proveedor_id_proveedor)==false) {
      notify('* Debe seleccionar almenos una opcion de la lista <strong>PROVEEDORES</strong>',500,5000,'error');
    $("#oficina_pedido").focus();
    return false;
  }else if (validarCombo(oficina)==false) {
      notify('* Debe seleccionar almenos una opcion de la lista <strong>OFICINAS</strong>',500,5000,'error');
    $("#oficina").focus();
    return false;
  }else{
    return true;
  }
}

function verificaEnvio(id) {
  $( "#dialogo_pedido" ).dialog({
      autoOpen: false,
      height: 'auto',
      width: 'auto',
      modal: true,
      buttons: {
          Aceptar: function() {
            var confirmacion=true;
           terminar_pedido(id,confirmacion);
          },
          Cancelar:function()
          {
        $( "#dialogo_pedido" ).dialog( "close" );
          }
      },
      close: function() {}
    });
        $( "#dialogo_pedido" ).dialog( "open" );
}
function verificadoEnvio () {
  $( "#dialogo_pedido_terminado" ).dialog({
      autoOpen: false,
      height: 'auto',
      width: 'auto',
      modal: true,
      buttons: {
      Cerrar:function()
        {
         $( "#dialogo_pedido_terminado" ).dialog( "close" );
        }
      },
      close: function() {}
    });
        $( "#dialogo_pedido_terminado" ).dialog( "open" );
}
function verficaPrudctoPedido (id) {
  $( "#dialogo_producto" ).dialog({
      autoOpen: false,
      height: 'auto',
      width: 'auto',
      modal: true,
      buttons: {
          Aceptar: function() {
            var confirmacion=true;
           terminar_producto(id,confirmacion);
          },
          Cancelar:function()
          {
        $( "#dialogo_producto" ).dialog( "close" );
          }
      },
      close: function() {}
    });
        $( "#dialogo_producto" ).dialog( "open" );

}
function verficadoPrudctoPedido () {
  $( "#dialogo_producto_termina" ).dialog({
      autoOpen: false,
      height: 'auto',
      width: 'auto',
      modal: true,
      buttons: {
      Cerrar:function()
        {
         $( "#dialogo_producto_termina" ).dialog( "close" );
        }
      },
      close: function() {}
    });
        $( "#dialogo_producto_termina" ).dialog( "open" );
}
</script>
<div id="dialog-confirm" title="Confirmacion" style="display: none;">
</div>
<table >
<tr>
<td>
  <?php
if (!isset($_GET['submain'])) {
}  elseif (($this->permisos->permisos_submenus($_GET['m'],$_GET['submain'],0)==1)&&($this->permisos->permisos($_GET['submain'],2)==1)) {?>

  <div onclick="alta()" id="alta"><img src="<?php '.base_url().' ?>img/nuevo.ico" title="Nuevo Registro"></div>
<?php  }?>
</td>
<td></td>
<td >&nbsp;</td>
</tr>
</table>
        <table id="tbl_p_prove"></table>
        <div id="paginacion"> </div>
        <div style="display:none" id="dialog-procesos" title="Pedidos">
        <?php
        $this->load->view('pedidos_bodega_prod_term/formulario');?>
        </div>
<!-- formulario de nuevo producto -->
        <div style="display:none" id="dialog-procesos_producto" title="Pedidos">
        <?php
        // $this->load->view('pedidos_bodega_prod_term/formulario_producto');
        $this->load->view('pedidos_bodega_prod_term/lista_productos');
        ?>
        </div>
<!-- formulario lista pedidos-->
        <div style="display:none" id="dialog-procesos_productoLista" title="Ver lista">
        <?php
        // $this->load->view('pedidos_bodega_prod_term/formulario_producto');
        $this->load->view('pedidos_bodega_prod_term/verListaPedido');
        ?>
        </div>
        <!-- Funcion dialogo -->
        <div style="display:none;" id="dialogo" >
          <div class="ui-widget">
            <div class="ui-state-error ui-corner-all" style="padding: 0 .7em;">
              <p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>
              <strong>Precaución:</strong> Esta seguro de cerrar el pedido?</p>
            </div>
          </div>
        </div>
        <!-- Funcion dialogo pedido-->
        <div style="display:none;" id="dialogo_pedido" >
          <div class="ui-widget">
            <div class="ui-state-error ui-corner-all" style="padding: 0 .7em;">
              <p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>
              <strong>Precaución:</strong> Esta seguro de marcar como terminado el pedido?</p>
            </div>
          </div>
        </div>
        <!-- Funcion dialogo producto -->
        <div style="display:none;" id="dialogo_producto" >
          <div class="ui-widget">
            <div class="ui-state-error ui-corner-all" style="padding: 0 .7em;">
              <p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>
              <strong>Precaución:</strong> Esta seguro de marcar como terminado el producto?</p>
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

                <!-- Pedido terminado -->
        <div style="display:none;" id="dialogo_pedido_terminado" >
          <div class="ui-widget">
            <div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;">
              <p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
              <strong>Alerta:</strong> El Pedido ya esta finalizado!!!</p>
            </div>
          </div>
        </div>

                <!-- Producto terminado -->
        <div style="display:none;" id="dialogo_producto_termina" >
          <div class="ui-widget">
            <div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;">
              <p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
              <strong>Alerta:</strong> El Pedido ya esta finalizado!!!</p>
            </div>
          </div>
        </div>