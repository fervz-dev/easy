<?php $this->load->view('hed');?>
<script type="text/javascript">
function editar(id)
{

  $.ajax({
                        async:true,
                        beforeSend:function(objeto){$('#loading').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');},
                         type:"POST",
                          url:"<?php echo base_url();?>catalogo_producto/editar_producto/"+id,
                          data:{
                                  "nombre":$("#nombre").val(),
                                  "largo":$("#largo").val(),
                                  "ancho":$("#ancho").val(),
                                  "alto":$("#alto").val(),
                                  "resistencia":$("#resistencia_mprima_id_resistencia_mprima").val(),
                                  "corrugado":$("#corrugado").val(),
                                  "score":$("#score").val(),
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
function delet (id) {
  msg="Este artículo se eliminara. ¿Estás seguro?";
  confirmacion(id,msg);
}
function delete_id(id)
{

  $.ajax({
                      async:true,cache: false,
                      beforeSend:function(objeto){$('#loading').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');},
                      type:"POST",
                      url:"<?php echo base_url();?>catalogo_producto/eliminar/"+id,
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

// Recargar grid
function cargar () {
  $("#tbl").jqGrid({
    url:'<?php echo base_url();?>catalogo_producto/paginacion',
    datatype: "json",
    mtype: 'POST',
                        colNames:['Acciones','NOMBRE','LARGO','ANCHO','ALTO','RESISTENCIA','CORRUGADO','SCORE','DESCRIPCION'],
                        colModel:[{name:'acciones', index:'acciones', width:60, resizable:false, align:"center", search:false},
                              {name:'nombre', index:'nombre', width:170,resizable:false, sortable:true,search:false,editable:false},
                              {name:'largo', index:'largo', width:170,resizable:false, sortable:true,search:false,editable:false},
                              {name:'ancho', index:'ancho', width:170,resizable:false, sortable:true,search:false,editable:false},
                              {name:'alto', index:'alto', width:170,resizable:false, sortable:true,search:false,editable:false},
                              {name:'resistencia', index:'resistencia', width:170,resizable:false, sortable:true,search:false,editable:false},
                              {name:'corrugado', index:'corrugado', width:170,resizable:false, sortable:true,search:false,editable:false},
                              {name:'score', index:'score', width:170,resizable:false, sortable:true,search:false,editable:false},
                              {name:'descripcion', index:'descripcion', width:170,resizable:false, sortable:true,search:false,editable:false}


                                ],
    pager: jQuery('#paginacion'),
    rownumbers:true,
  rowNum:15,
    rowList:[10,20,30],
    imgpath: '<?php echo base_url();?>img/editar.jpg',
    mtype: "POST",
    sortname: 'id_catalogo',
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
      }
// guardar formulario
function guardar()
{

$.ajax({
          async:true,cache: false,
          beforeSend:function(objeto){$('#loading').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');},
           type:"POST",
            url:"<?php echo base_url();?>catalogo_producto/guardar?da="+Math.random()*2312,
            data:{
                  "nombre":$("#nombre").val(),
                  "largo":$("#largo").val(),
                  "ancho":$("#ancho").val(),
                  "alto":$("#alto").val(),
                  "resistencia":$("#resistencia_mprima_id_resistencia_mprima").val(),
                  "corrugado":$("#corrugado").val(),
                  "score":$("#score").val(),
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

// editar
function edit (id) {
  document.cat_producto.reset();
$.ajax({
                        async:true,cache: false,
                        beforeSend:function(objeto){$('#loading').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');},
                        type:"GET",
                        url:"<?php echo base_url();?>catalogo_producto/get/"+id+"/"+Math.random()*10919939116744,
                        datatype:"html",
                        success:function(data, textStatus){

            dato= data.split('~');

            $("#nombre").val(dato[0]);
            $("#largo").val(dato[1]);
            $("#ancho").val(dato[2]);
            $("#alto").val(dato[3]);
            $('#resistencia_mprima_id_resistencia_mprima').val(dato[4]);
            $('#corrugado').val(dato[5]);
            $('#score').val(dato[6]);
            $('#descripcion').val(dato[7]);
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
function reloading()
{

  $("#tbl").trigger("reloadGrid")
}
//si existe la imagen la mandamos a most
function picture_existe(id,id_cata)
{
 $.ajax({
                        async:true,cache: false,
                        beforeSend:function(objeto){$('#loading').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');},
                        type:"GET",
                        url:"<?php echo base_url();?>catalogo_producto/get_imagen/"+id,
                        datatype:"html",
                        success:function(data, textStatus){

            dato= data.split('~');
            var img = $('<img />').attr({ 'id': dato[0], 'src':'<?php echo base_url();?>uploads/'+dato[1] }).appendTo($('#img_catalogo'));
            },
                        error:function(datos){
                        notify("Error al procesar los datos " ,500,5000,'error');
            return false;
                        }//Error
                        });//Ajax
$( "#dialog-procesos-picture_view" ).dialog({
      autoOpen: false,
      height: 'auto',
      width: 'auto',
      modal: true,
      buttons: {
          Cerrar: function() {
        $( "#dialog-procesos-picture_view" ).dialog( "close" );
         $('#img_catalogo img:last-child').remove();
          }
          ,
          Eliminar:function()
          {
            $( "#dialog-procesos-picture_view" ).dialog( "close" );
              $.ajax({
                      async:true,cache: false,
                      beforeSend:function(objeto){$('#loading').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');},
                      type:"POST",
                      url:"<?php echo base_url();?>catalogo_producto/eliminar_imagen/"+id+"/"+id_cata,
                      datatype:"html",
                      success:function(data, textStatus){

                             switch(data){
                               case "0":

                               notify("Error al procesar los datos " ,500,5000,'error');
                               break;
                               case "1":
                               $( "#dialog-procesos-picture_view" ).dialog( "close" );
                               notify('El registro se ha eliminado correctamente',500,5000,'aviso');
                                 $("#tbl").jqGrid('GridUnload');
                                  setTimeout("cargar()",1000);

                               break;
                               default:
                               $( "#dialog-procesos-picture_view" ).dialog( "close" );

                               break;

                              }//switch
                             },
                        error:function(datos){
                              var error='Error'+data;
                                 notify(error ,500,5000,'error');
                             }//Error
                         });//Ajax

          }
      },
      close: function() {
        $('#img_catalogo img:last-child').remove();
      }
    });
        $( "#dialog-procesos-picture_view" ).dialog( "open" );
}
// alta de producto
function picture(id)
{
 document.archivo.reset();
 $("#id_cat").val(id);
$( "#dialog-procesos-picture" ).dialog({
      autoOpen: false,
      height: 'auto',
      width: 'auto',
      modal: true,
      buttons: {
          Aceptar: function() {

             if (validarCamposPicture()==true) {
              // guardar();
              document.archivo.submit();
             }


          },
          Cancelar:function()
          {
        $( "#dialog-procesos-picture" ).dialog( "close" );
          }
      },
      close: function() {}
    });
        $( "#dialog-procesos-picture" ).dialog( "open" );
}
function alta()
{
document.cat_producto.reset();
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
//////////////////////////////////////validar compos picture////////////
function validarCamposPicture () {
nombre_archivo=$('#nombre_archivo').val();
descripcion_archivo=$('#descripcion_archivo').val();
userfile=$('#userfile').val();

if (validarVacio(nombre_archivo)==false) {

  notify('* El campo <strong>NOMBRE</strong> no puede estar vacio!!!',500,5000,'error');
  $("#nombre_archivo").focus();
  return false;

}else if (validarVacio(descripcion_archivo)==false) {

  notify('* El campo <strong>DESCRIPCION</strong> no puede estar vacio!!!',500,5000,'error');
  $("#descripcion_archivo").focus();
  return false;

}else if (validarVacio(userfile)==false) {

  notify('* Debe de seleccionar un archivos!!!',500,5000,'error');
  $("#userfile").focus();
  return false;

}else {

  return true;

}

}
////////////////////////////////////// validacion //////////////////////
function validarCampos () {

            nombre=$("#nombre").val();
            ancho=$("#ancho").val();
            largo=$("#largo").val();
            corrugado=$("#corrugado").val();
            resistencia=$("#resistencia_mprima_id_resistencia_mprima").val();

            if (validarVacio(nombre)==false) {
              notify('* El campo <strong>NOMBRE</strong> no puede estar vacio!!!',500,5000,'error');
              $("#nombre").focus();
              return false;
            }else if (validarVacio(ancho)==false) {
              notify('* El campo <strong>ANCHO</strong> no puede estar vacio!!!',500,5000,'error');
              $("#ancho").focus();
              return false;

            }else if (validarVacio(largo)==false) {
              notify('* El campo <strong>LARGO</strong> no puede estar vacio!!!',500,5000,'error');
              $("#largo").focus();
              return false;
            }else if (validarCombo(corrugado)==false) {
              notify('* Debe seleccionar almenos una opcion de la lista <strong>CORRUGADO</strong>',500,5000,'error');
              $("#tipo_m").focus();
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
            }else{
              return true;
            }
  }
  $(document).ready(function(){
  $("#tbl").jqGrid({
    url:'<?php echo base_url();?>catalogo_producto/paginacion',
    datatype: "json",
    mtype: 'POST',
                        colNames:['Acciones','NOMBRE','LARGO','ANCHO','ALTO','RESISTENCIA','CORRUGADO','SCORE','DESCRIPCION'],
                        colModel:[{name:'acciones', index:'acciones', width:60, resizable:false, align:"center", search:false},
                              {name:'nombre', index:'nombre', width:170,resizable:false, sortable:true,search:false,editable:false},
                              {name:'largo', index:'largo', width:170,resizable:false, sortable:true,search:false,editable:false},
                              {name:'ancho', index:'ancho', width:170,resizable:false, sortable:true,search:false,editable:false},
                              {name:'alto', index:'alto', width:170,resizable:false, sortable:true,search:false,editable:false},
                              {name:'resistencia', index:'resistencia', width:170,resizable:false, sortable:true,search:false,editable:false},
                              {name:'corrugado', index:'corrugado', width:170,resizable:false, sortable:true,search:false,editable:false},
                                    {name:'score', index:'score', width:170,resizable:false, sortable:true,search:false,editable:false},
                                    {name:'descripcion', index:'descripcion', width:170,resizable:false, sortable:true,search:false,editable:false}


                                ],
    pager: jQuery('#paginacion'),
    rownumbers:true,
  rowNum:15,
    rowList:[10,20,30],
    imgpath: '<?php echo base_url();?>img/editar.jpg',
    mtype: "POST",
    sortname: 'id_catalogo',
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
        <?php $this->load->view('catalogo_producto/formulario');?>
      </div>
      <div style="display:none" id="dialog-procesos-picture" title="Archivo de catalogo">
      <?php $this->load->view('catalogo_producto/archivo');?>
      </div>
      <div style="display:none" id="dialog-procesos-picture_view" title="Imagen">
      <div id="img_catalogo"></div>
      </div>
