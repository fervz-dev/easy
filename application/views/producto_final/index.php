<script type="text/javascript">
function delet (id) {
  msg="Este registro se eliminara. ¿Estás seguro?";
  confirmacion(id,msg);
}
function delete_id(id)
{

  $.ajax({
                      async:true,cache: false,
                      beforeSend:function(objeto){$('#loading').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');},
                      type:"POST",
                      url:"<?php echo base_url();?>producto_final/eliminar/"+id,
                      datatype:"html",
                      success:function(data, textStatus){

                             switch(data){
                               case "0":

                               notify("Error al procesar los datos " ,500,5000,'error');
                               break;
                               case "1":
                               $( "#dialog-procesos" ).dialog( "close" );
                               notify('El registro se ha eliminado correctamente',500,5000,'aviso');
                                 $("#tbl").jqGrid('GridUnload');
                                  setTimeout("cargar()",1000);

                               break;
                               default:
                               $( "#dialog-procesos" ).dialog( "close" );

                               break;

                              }//switch
                             },
                        error:function(datos){
                              var error='Error'+data;
                                 notify(error ,500,5000,'error');
                             }//Error
                         });//Ajax
}
  ///////////////////dialogo de confirmacion////////////////////////////////////
  function confirmacion (id,msg) {
$('#dialog-confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>'+msg+'</p>');

    $( "#dialog-confirm" ).dialog({
      resizable: false,
      height: 'auto',
      width: 'auto',
      modal: true,
      buttons: {
        "Eliminar": function() {
          $( this ).dialog( "close" );
          delete_id(id);
        },
        Cancel: function() {
          $( this ).dialog( "close" );
        }
      }
    });
    }


function edit (id) {
  document.cat_producto_final.reset();
$.ajax({
                        async:true,cache: false,
                        beforeSend:function(objeto){$('#loading').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');},
                        type:"GET",
                        url:"<?php echo base_url();?>producto_final/get/"+id+"/"+Math.random()*10919939116744,
                        datatype:"html",
                        success:function(data, textStatus){

            dato= data.split('~');
            $("#clientesdb").val(dato[0]);
            $("#nombre").val(dato[1]);
            $('#descripcion').val(dato[2]);
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
             if (validarCampos()==true) {
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
function editar(id)
{

  $.ajax({
                        async:true,
                        beforeSend:function(objeto){$('#loading').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');},
                         type:"POST",
                          url:"<?php echo base_url();?>producto_final/editar_producto/"+id,
                          data:{
                                  "clientesdb":$("#clientesdb").val(),
                                  "nombre":$("#nombre").val(),
                                  "descripcion":$("#descripcion").val()
                               },
                        cache: false,
                        datatype:"html",
                        success:function(data, textStatus){

                        switch(data){
                        case "0":
                          notify("Error al procesar los datos " ,500,5000,'error');
                        break;
                        case "1":
                          $( "#dialog-procesos" ).dialog( "close" );
                         reloading();
                         notify('El registro se edito correctamente',500,5000,'aviso');
                        break;

                        default:
                          $( "#dialog-procesos" ).dialog( "close" );

                        break;

                        }//switch
                        },
                        error:function(datos){
                        notify("Error al procesar los datos " ,500,5000,'error');
                        }//Error
                        });//Ajax
}
function guardar()
{

$.ajax({
          async:true,cache: false,
          beforeSend:function(objeto){$('#loading').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');},
           type:"POST",
            url:"<?php echo base_url();?>producto_final/guardar?da="+Math.random()*2312,
            data:{
                  "clientesdb":$("#clientesdb").val(),
                  "nombre":$("#nombre").val(),
                  "descripcion":$("#descripcion").val()
                },

                     datatype:"html",
                      success:function(data, textStatus){

                             switch(data){
                               case "0":
                                notify("Error al procesar los datos " ,500,5000,'error');
                               break;
                               case "1":
                                reloading();
                                notify('El registro se guardo correctamente',500,5000,'aviso');
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
function reloading()
{

  $("#tbl").trigger("reloadGrid")
}
function alta()
{
document.cat_producto_final.reset();
$( "#dialog-procesos" ).dialog({
      autoOpen: false,
      height: 'auto',
      width: 'auto',
      modal: true,
      buttons: {
          Aceptar: function() {
             if (validarCampos()==true) {
              guardar();
             }
// document.archivo.submit();


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

function cargar () {
	 $("#tbl").jqGrid({
    url:'<?php echo base_url();?>producto_final/paginacion',
    datatype: "json",
    mtype: 'POST',
                        colNames:['CLIENTE','Acciones','NOMBRE','DESCRIPCION'],
                        colModel:[
								{name:'nombre_empresa', index:'nombre_empresa', width:170,resizable:true, sortable:true,search:true,editable:false},
                        	  {name:'acciones', index:'acciones', width:130, resizable:true, align:"right", search:false},

                              {name:'nombre_producto', index:'nombre_producto', width:170,resizable:true, sortable:true,search:true,editable:false},
                              {name:'descripcion', index:'descripcion', width:170,resizable:true, sortable:true,search:true,editable:false}
                                ],
    pager: jQuery('#paginacion'),
    rownumbers:true,
  rowNum:10,
    rowList:[10,20,30],
    imgpath: '<?php echo base_url();?>img/editar.jpg',
    mtype: "POST",
    sortname: 'id_productoFinal',
    viewrecords: true,
    sortorder: "asc",
  editable: true,
    caption: 'Catalogo de Productos',
    multiselect: false,
    height:'auto',
    loadtext: 'Cargando',
  width:'100%',
  grouping:true,
  groupingView : { groupField : ['nombre_empresa'],
  groupColumnShow : [false],
  groupText : ['<b>{0} - {1} Producto(s)</b>'],
  groupCollapse : true, groupOrder: ['asc']
  },
    searchurl:'<?php echo base_url();?>catalogo_producto/buscando',
                height:"auto"
        }).navGrid("#paginacion", { edit: false, add: false, search: false, del: false, refresh:true });
        $("#tbl").jqGrid('filterToolbar', { stringResult: true, searchOnEnter: false }) ;
}
$(document).ready(function(){
  $("#tbl").jqGrid({
    url:'<?php echo base_url();?>producto_final/paginacion',
    datatype: "json",
    mtype: 'POST',
                        colNames:['CLIENTE','Acciones','NOMBRE','DESCRIPCION'],
                        colModel:[
								{name:'nombre_empresa', index:'nombre_empresa', width:170,resizable:true, sortable:true,search:true,editable:false},
                        	  {name:'acciones', index:'acciones', width:130, resizable:true, align:"right", search:false},

                              {name:'nombre_producto', index:'nombre_producto', width:170,resizable:true, sortable:true,search:true,editable:false},
                              {name:'descripcion', index:'descripcion', width:170,resizable:true, sortable:true,search:true,editable:false}
                                ],
    pager: jQuery('#paginacion'),
    rownumbers:true,
  rowNum:10,
    rowList:[10,20,30],
    imgpath: '<?php echo base_url();?>img/editar.jpg',
    mtype: "POST",
    sortname: 'id_productoFinal',
    viewrecords: true,
    sortorder: "asc",
  editable: true,
    caption: 'Catalogo de Productos',
    multiselect: false,
    height:'auto',
    loadtext: 'Cargando',
  width:'100%',
  grouping:true,
  groupingView : { groupField : ['nombre_empresa'],
  groupColumnShow : [false],
  groupText : ['<b>{0} - {1} Producto(s)</b>'],
  groupCollapse : true, groupOrder: ['asc']
  },
    searchurl:'<?php echo base_url();?>catalogo_producto/buscando',
                height:"auto"
        }).navGrid("#paginacion", { edit: false, add: false, search: false, del: false, refresh:true });
        $("#tbl").jqGrid('filterToolbar', { stringResult: true, searchOnEnter: false }) ;
   });
////////////////////////////////////// validacion //////////////////////
function validarCampos () {

            clientesdb=$('#clientesdb').val();
            nombre=$("#nombre").val();
            if (validarCombo(clientesdb)==false) {
              notify('* El campo <strong>CLIENTE</strong> no puede estar vacio!!!',500,5000,'error');
              $("#clientesdb").focus();
              return false;
            }else if (validarVacio(nombre)==false) {
              notify('* El campo <strong>NOMBRE</strong> no puede estar vacio!!!',500,5000,'error');
              $("#nombre").focus();
              return false;
            }else{
              return true;
            }
  }
</script>
<div id="dialog-confirm" title="Confirmacion" style="display: none;">

</div>
<table >
<tr>
<td><?php if (!isset($_GET['submain'])) {
}  elseif (($this->permisos->permisos_submenus($_GET['m'],$_GET['submain'],0)==1)&&($this->permisos->permisos($_GET['submain'],2)==1)) {?>

  <div onclick="alta()" id="alta"><img src="<?php '.base_url().' ?>img/nuevo.ico" title="Nuevo Registro"></div>
  <?php  }?>
</td>
<td >&nbsp;</td>
</tr>
</table>
        <table id="tbl"></table>
        <div id="paginacion"> </div>
       <div style="display:none" id="dialog-procesos" title="Formulario Producto">
        <?php $this->load->view('producto_final/formulario');?>
      </div>