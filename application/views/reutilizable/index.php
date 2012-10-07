<script type="text/javascript">
function cargar () {
  $("#tbl").jqGrid({
    url:'<?php echo base_url();?>reutilizable_ingreso/paginacion',
    datatype: "json",
    mtype: 'POST',
                        colNames:['Acciones','NOMBRE','CORRUGADO','ANCHO','LARGO','PESO','RESISTENCIA','CANTIDAD', 'PESO TOTAL', 'RESTAN'],
                        colModel:[{name:'id_cat_mprima', index:'id_cat_mprima', width:170,resizable:false, sortable:true,search:false,editable:false},
                                  {name:'nombre', index:'nombre', width:100,resizable:false, sortable:true,search:true,editable:true},
                                  {name:'tipo_m', index:'tipo_m', width:100,resizable:false, sortable:true,search:true,editable:true},
                                  {name:'largo', index:'largo', width:40,resizable:false, sortable:true,search:true,editable:true},
                                  {name:'ancho', index:'ancho', width:40,resizable:false, sortable:true,search:true,editable:true},
                                  {name:'peso', index:'peso', width:40,resizable:false, sortable:true,search:true,editable:true},
                                  {name:'resistencia', index:'resistencia', width:80,resizable:false, sortable:true,search:true,editable:true},
                                  {name:'cantidad', index:'cantidad', width:40,resizable:false, sortable:true,search:true,editable:true},
                                  {name:'peso_total', index:'peso_total', width:40,resizable:false, sortable:true,search:true,editable:true},
                                  {name:'restan', index:'restan', width:80,resizable:false, sortable:true,search:true,editable:true}
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
    //searchurl:'<?php echo base_url();?>empresas/buscando',
                height:"auto"
        }).navGrid("#paginacion", { edit: false, add: false, search: false, del: false, refresh:true });
        $("#tbl").jqGrid('filterToolbar', { stringResult: true, searchOnEnter: false }) ;
}
  $(document).ready(function(){
	$("#tbl").jqGrid({
    url:'<?php echo base_url();?>reutilizable_ingreso/paginacion',
    datatype: "json",
    mtype: 'POST',
                        colNames:['Acciones','NOMBRE','CORRUGADO','ANCHO','LARGO','PESO','RESISTENCIA','CANTIDAD', 'PESO TOTAL', 'RESTAN'],
                        colModel:[{name:'id_cat_mprima', index:'id_cat_mprima', width:170,resizable:false, sortable:true,search:false,editable:false},
                                  {name:'nombre', index:'nombre', width:100,resizable:false, sortable:true,search:true,editable:true},
                                  {name:'tipo_m', index:'tipo_m', width:100,resizable:false, sortable:true,search:true,editable:true},
                                  {name:'ancho', index:'ancho', width:40,resizable:false, sortable:true,search:true,editable:true},
                                  {name:'largo', index:'largo', width:40,resizable:false, sortable:true,search:true,editable:true},
                                  {name:'peso', index:'peso', width:40,resizable:false, sortable:true,search:true,editable:true},
                                  {name:'resistencia', index:'resistencia', width:80,resizable:false, sortable:true,search:true,editable:true},
                                  {name:'cantidad', index:'cantidad', width:40,resizable:false, sortable:true,search:true,editable:true},
                                  {name:'peso_total', index:'peso_total', width:40,resizable:false, sortable:true,search:true,editable:true},
                                  {name:'restan', index:'restan', width:80,resizable:false, sortable:true,search:true,editable:true}
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
    //searchurl:'<?php echo base_url();?>empresas/buscando',
                height:"auto"
        }).navGrid("#paginacion", { edit: false, add: false, search: false, del: false, refresh:true });
        $("#tbl").jqGrid('filterToolbar', { stringResult: true, searchOnEnter: false }) ;
   });

function edit(id)
{
document.cat_mprima.reset();
$.ajax({
                        async:true,cache: false,
                        beforeSend:function(objeto){$('#loading').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');},
                        type:"GET",
                        url:"<?php echo base_url();?>reutilizable_ingreso/get/"+id+"/"+Math.random()*10919939116744,
                        datatype:"html",
                        success:function(data, textStatus){
            dato= data.split('~');
            $("#nombre").val(dato[0]);
            $("#tipo_m").val(dato[1]);
            $("#ancho").val(dato[2]);
            $("#largo").val(dato[3]);
            $("#resistencia_mprima_id_resistencia_mprima").val(dato[4]);
              div_peso=dato[5].split('.');
            $("#kilos").val(div_peso[0]);
            $("#gramos").val(div_peso[1]);
            $("#peso").val(dato[6]);
            $("#cantidad").val(dato[7]);
            $("#peso_total").val(dato[8]);
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
          editar(id);

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
//Funcion editar empleado

function reloading()
{
  $("#tbl").trigger("reloadGrid")
}

function editar(id)
{
  $.ajax({
                        async:true,
                        beforeSend:function(objeto){$('#loading').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');},
                         type:"POST",
                          url:"<?php echo base_url();?>reutilizable_ingreso/editar_mprima/"+id,
                          data:{"nombre":$("#nombre").val(),
                                "caracteristica":$("#caracteristica").val(),
                                "tipo_m":$("#tipo_m").val(),
                                "ancho":$("#ancho").val(),
                                "largo":$("#largo").val(),
                                "resistencia_mprima_id_resistencia_mprima":$("#resistencia_mprima_id_resistencia_mprima").val(),
                                "peso":$("#peso").val(),
                                "cantidad":$("#cantidad").val(),
                                "peso_total":$("#peso_total").val()
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
function delet (id) {
  msg="Este registro se eliminara. ¿Estás seguro?";
  confirmacion(id,msg);
}
function delete_id(id)
{
r=confirm('Esta seguro de eliminar el registro?');
if(r==true)
{
  $.ajax({
                      async:true,cache: false,
                      beforeSend:function(objeto){$('#loading').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');},
                      type:"POST",
                      url:"<?php echo base_url();?>reutilizable_ingreso/eliminar/"+id,
                      datatype:"html",
                      success:function(data, textStatus){

                             switch(data){
                               case "0":
                               notify("Error al procesar los datos " ,500,5000,'error');
                               break;
                               case "1":
                               $( "#dialog-procesos" ).dialog( "close" );
                               notify('El registro se elimino correctamente',500,5000,'aviso');
                               $("#tbl").jqGrid('GridUnload');
                                  setTimeout("cargar()",1000);;
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

}

function guardar()
{
$.ajax({
          async:true,cache: false,
          beforeSend:function(objeto){$('#loading').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');},
           type:"POST",
            url:"<?php echo base_url();?>reutilizable_ingreso/guardar?da="+Math.random()*2312,
            data:{"nombre":$("#nombre").val(),
                  "caracteristica":$("#caracteristica").val(),
                  "tipo_m":$("#tipo_m").val(),
                  "ancho":$("#ancho").val(),
                  "largo":$("#largo").val(),
                  "resistencia_mprima_id_resistencia_mprima":$("#resistencia_mprima_id_resistencia_mprima").val(),
                  "peso":$("#peso").val(),
                  "cantidad":$("#cantidad").val(),
                  "peso_total":$("#peso_total").val()
                },

                     datatype:"html",
                      success:function(data, textStatus){

                             switch(data){
                               case "0":
                               notify("Error al procesar los datos " ,500,5000,'error');
                               break;
                               case "1":
                               reloading();
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

function alta()
{
document.cat_mprima.reset();
$( "#dialog-procesos" ).dialog({
      autoOpen: false,
      height: 'auto',
      width: 'auto',
      modal: true,
      buttons: {
          Aceptar: function() {
            if (validarCampos()==true) {
                                var peso_=$("#peso").val();
                  var cantidad=$("#cantidad").val();
                  var total1=peso_*cantidad;
                  var calcu=total1;
                  $("#peso_total").val(calcu);
                  alert(calcu);
;
          guardar();
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
  //////////////////////////////////////////////////////////////////////////////


////////////////////////////////////// validacion //////////////////////
function validarCampos () {

            nombre=$("#nombre").val();
            tipo_m=$("#tipo_m").val();
            ancho=$("#ancho").val();
            largo=$("#largo").val();
            resistencia=$("#resistencia_mprima_id_resistencia_mprima").val();
            cantidad=$('#cantidad').val();
            if (validarVacio(nombre)==false) {
              notify('* El campo <strong>NOMBRE</strong> no puede estar vacio!!!',500,5000,'error');
              $("#nombre").focus();
              return false;
            }else if (validarCombo(tipo_m)==false) {
              notify('* Debe seleccionar almenos una opcion de la lista <strong>CORRUGADO</strong>',500,5000,'error');
              $("#tipo_m").focus();
              return false;
            }else if (validarVacio(ancho)==false) {
              notify('* El campo <strong>ANCHO</strong> no puede estar vacio!!!',500,5000,'error');
              $("#ancho").focus();
              return false;

            }else if (validarVacio(largo)==false) {
              notify('* El campo <strong>LARGO</strong> no puede estar vacio!!!',500,5000,'error');
              $("#largo").focus();
              return false;
            }else if (validarCombo(resistencia)==false) {
              notify('* Debe seleccionar almenos una opcion de la lista <strong>RESISTENCIA</strong>',500,5000,'error');
              $("#resistencia").focus();
              return false;
            }else if (validarNUmero(largo)==false) {
              notify('* El campo <strong>LARGO</strong> no es numero!!!',500,5000,'error');
              $("#largo").focus();
              return false;
            }else if (validarNUmero(ancho)==false) {
              notify('* El campo <strong>ANCHO</strong> no es numero!!!',500,5000,'error');
              $("#ancho").focus();
              return false;
            }else if (validarVacio(cantidad)==false) {
                notify('* El campo <strong>CANTIDAD</strong> no puede estar vacio!!!',500,5000,'error');
              $("#cantidad").focus();
              return false;
            }else if (validarNUmero(cantidad)==false) {
              notify('* El campo <strong>CANTIDAD</strong> no es numero!!!',500,5000,'error');
              $("#cantidad").focus();
            }else{
              return true;
            }
  }
</script>
<div id="dialog-confirm" title="Confirmacion" style="display: none;">

</div>
<table >
<tr>
<td><div onclick="alta()" id="alta"><img src="<?php '.base_url().' ?>img/nuevo.ico" title="Nuevo Registro"></div>
</td>
<td >&nbsp;</td>
</tr>
</table>
        <table id="tbl"></table>
        <div id="paginacion"> </div>
        <div style="display:none" id="dialog-procesos" title="Reutilizable">
        <?php

        $this->load->view('reutilizable/formulario');?>
