<?php $this->load->view('hed');?>
<script type="text/javascript">
function editar(id)
{
  // tabla ala que se modificara
  // 1= tabla productos complemento
  table=$('#tipoIngreso').val();

productoFinal=$('#productoFinal').val();
// clientes_hiden=$('#clientes_hiden').val();
// productos_hiden=$$('#productos_hiden').val();
// $("#clientesdb").val(),
// $("#clientesdb").val(),

  if (table=='1') {

  $.ajax({
                        async:true,
                        beforeSend:function(objeto){$('#loading').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');},
                         type:"POST",
                          url:"<?php echo base_url();?>catalogo_producto/editar_producto/"+id,
                          data:{
                                  "productosBD":$("#productosBD").val(),
                                  "clientesdb":$("#clientesdb").val(),
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
// 2=producto catalogo final
//
  }else if (table=='2') {

  $.ajax({
                        async:true,
                        beforeSend:function(objeto){$('#loading').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');},
                         type:"POST",
                          url:"<?php echo base_url();?>producto_final/editar_producto/"+id,
                          data:{
                                  "clientesdb":$("#clientesdb").val(),
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

}
function delet (id,tipo) {
 if (tipo=='1') {
    msg='<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span><div style="text-align:center; color:red;"><strong>¿Estás seguro de elimar el Producto?</div><strong>';
 confirmacion(id,msg,tipo);
 }else if (tipo=='2') {
  msg='<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>ATENCIÓN: Al eliminar el producto se eliminan los componentes.</p> <div style="text-align:center; color:red;"><strong>"Se aconseja primero cambiar los componentes a otro producto."<strong></br>¿Estás seguro de elimar el Producto?</div>';
 confirmacion(id,msg,tipo);
 };



}
function delete_id(id,tipo)
{
  if (tipo=='1') {

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
  }else if (tipo=='2') {

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

}
  ///////////////////dialogo de confirmacion////////////////////////////////////
  function confirmacion (id,msg,tipo) {
$('#dialog-confirm').html(msg);

    $( "#dialog-confirm" ).dialog({
      resizable: false,
      height: 'auto',
      width: 'auto',
      modal: true,
      buttons: {
        "Eliminar": function() {
          $( this ).dialog( "close" );
          delete_id(id,tipo);
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
    url:'<?php echo base_url();?>producto_final/paginacion',
    datatype: "json",
    mtype: 'POST',
                        colNames:['Acciones','CLIENTE','NOMBRE','LARGO','ANCHO','ALTO','RESISTENCIA','CORRUGADO','SCORE','DESCRIPCION'],
                        colModel:[{name:'acciones', index:'acciones', width:60, resizable:true, align:"center", search:false},
                              {name:'nombre_empresa', index:'nombre_empresa', width:170,resizable:true, sortable:true,search:true,editable:false},
                              {name:'nombre', index:'nombre', width:170,resizable:true, sortable:true,search:true,editable:false},
                              {name:'largo', index:'largo', width:50,resizable:true, sortable:true,search:true,editable:false},
                              {name:'ancho', index:'ancho', width:50,resizable:true, sortable:true,search:true,editable:false},
                              {name:'alto', index:'alto', width:50,resizable:true, sortable:true,search:true,editable:false},
                              {name:'resistencia', index:'resistencia', width:100,resizable:true, sortable:true,search:true,editable:false},
                              {name:'corrugado', index:'corrugado', width:80,resizable:true, sortable:true,search:true,editable:false},
                              {name:'score', index:'score', width:50,resizable:true, sortable:true,search:true,editable:false},
                              {name:'descripcion', index:'descripcion', width:170,resizable:true, sortable:true,search:true,editable:false}
                                ],
    pager: jQuery('#paginacion'),
    rownumbers:true,
  rowNum:30,
    rowList:[10,20,30,40,50],
    imgpath: '<?php echo base_url();?>img/editar.jpg',
    mtype: "POST",
    sortname: 'nombre',
    viewrecords: true,
    sortorder: "asc",
  editable: true,
    caption: 'Catalogo de Productos',
    multiselect: false,
    height:'auto',
    loadtext: 'Cargando',
  width:'100%',
    subGrid: true,
   grouping: false,
   groupingView : {
                    groupField : ['nombre_empresa'],
                    groupColumnShow : [true, true],
                    groupText : ['<b>{0}</b>', '{0}'],
                    groupCollapse : false, groupOrder: ['asc', 'asc'],
                    groupSummary : [false, false],
                    groupDataSorted : true
                  },
    searchurl:'<?php echo base_url();?>producto_final/buscando',
               height:"auto",
   subGridRowExpanded: function(subgrid_id, row_id) {
   var subgrid_table_id, pager_id; subgrid_table_id = subgrid_id+"_t"; pager_id = "p_"+subgrid_table_id;

   $("#"+subgrid_id).html("<table id='"+subgrid_table_id+"' alt='subtabla' class='scroll'></table><div id='"+pager_id+"' class='scroll'></div>");

   $("#"+subgrid_table_id).jqGrid({
   //url:"subgrid.php?q=2&id="+row_id,
   url:"<?php echo base_url();?>catalogo_producto/paginacionID/"+row_id,
   datatype: "json",
    mtype: 'POST',
                        colNames:['Acciones','NOMBRE','LARGO','ANCHO','ALTO','RESISTENCIA','CORRUGADO','SCORE','DESCRIPCION'],
                        colModel:[{name:'acciones', index:'acciones', width:60, resizable:true, align:"center", search:false},
                             // {name:'nombre_empresa', index:'nombre_empresa', width:170,resizable:true, sortable:true,search:true,editable:false},
                              {name:'nombre', index:'nombre', width:170,resizable:true, sortable:true,search:true,editable:false},
                              {name:'largo', index:'largo', width:50,resizable:true, sortable:true,search:true,editable:false},
                              {name:'ancho', index:'ancho', width:50,resizable:true, sortable:true,search:true,editable:false},
                              {name:'alto', index:'alto', width:50,resizable:true, sortable:true,search:true,editable:false},
                              {name:'resistencia', index:'resistencia', width:100,resizable:true, sortable:true,search:true,editable:false},
                              {name:'corrugado', index:'corrugado', width:80,resizable:true, sortable:true,search:true,editable:false},
                              {name:'score', index:'score', width:50,resizable:true, sortable:true,search:true,editable:false},
                              {name:'descripcion', index:'descripcion', width:170,resizable:true, sortable:true,search:true,editable:false}
                                ],
  rows:10,
  rowNum:10,
    rowList:[10,20],
    pager: pager_id,
    sortname: 'nombre',
    height:'auto',
   sortorder: "asc" });

   $("#"+subgrid_table_id).jqGrid('navGrid',"#"+pager_id,{edit:false,add:false,del:false,search:false}) }
        }).navGrid("#paginacion", { edit: false, add: false, search: false, del: false, refresh:true });
        $("#tbl").jqGrid('filterToolbar', { stringResult: true, searchOnEnter: false }) ;
      $("#tbl").jqGrid('navGrid','#paginacion',{add:false,edit:false,del:false,search:false});
      }
// guardar formulario
function guardar_componente()
{

$.ajax({
          async:true,cache: false,
          beforeSend:function(objeto){$('#loading').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');},
           type:"POST",
            url:"<?php echo base_url();?>catalogo_producto/guardar?da="+Math.random()*2312,
            data:{
                  "clientesdb":$("#clientesdb").val(),
                  "productosBD":$("#productosBD").val(),
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

function guardar_producto()
{

$.ajax({
          async:true,cache: false,
          beforeSend:function(objeto){$('#loading').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');},
           type:"POST",
            url:"<?php echo base_url();?>producto_final/guardar?da="+Math.random()*2312,
            data:{
                  "clientesdb":$("#clientesdb").val(),
                  "productosBD":$("#productosBD").val(),
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
function edit (id,tipo) {
  document.cat_producto.reset();

  if (tipo=='1') {
$('#tipoIngreso').attr('disabled', true);
    $.ajax({
                        async:true,cache: false,
                        beforeSend:function(objeto){$('#loading').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');},
                        type:"GET",
                        url:"<?php echo base_url();?>catalogo_producto/get/"+id+"/"+Math.random()*10919939116744,
                        datatype:"html",
                        success:function(data, textStatus){

            dato= data.split('~');
            $("#clientesdb").val(dato[0]);
            $('#clientes_hiden').val(dato[0]);
            $('#productos_hiden').val(dato[9]);
            $('#tipoIngreso').val(1);
            validaTipoIngreso(1);
            cargarProductos();
            cargarProductos1(dato[9]);
            $('#productosBD').val(dato[9]);
            $("#nombre").val(dato[1]);
            $("#largo").val(dato[2]);
            $("#ancho").val(dato[3]);
            $("#alto").val(dato[4]);
            $('#resistencia_mprima_id_resistencia_mprima').val(dato[5]);
            $('#corrugado').val(dato[6]);
            $('#score').val(dato[7]);
            $('#descripcion').val(dato[8]);
            $('#productoFinal').val(dato[9]);


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
  }else if (tipo=='2') {
        $('#tipoIngreso').attr('disabled', true);
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
            $("#largo").val(dato[2]);
            $("#ancho").val(dato[3]);
            $("#alto").val(dato[4]);
            $('#resistencia_mprima_id_resistencia_mprima').val(dato[5]);
            $('#corrugado').val(dato[6]);
            $('#score').val(dato[7]);
            $('#descripcion').val(dato[8]);
            // cargarProductos(dato[0]);
            $('#tipoIngreso').val(2);
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
  };



}
function reloading()
{

  $("#tbl").trigger("reloadGrid")
}
//si existe la imagen la mandamos a mostrar
//1= a componentes del catalogo
//2= a producto principal del catalogo
//
function picture_existe(id,id_cata,tipo)
{
  if (tipo==1) {
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
          <?php  if (($this->permisos->permisos(8,1)==1)&&($this->permisos->permisos(8,3)==1)) {?>
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

          }<?php } ?>
      },
      close: function() {
        $('#img_catalogo img:last-child').remove();
      }
    });
        $( "#dialog-procesos-picture_view" ).dialog( "open" );
////////////////////////////////////////////////////// condicion pra verificar si es del catalofo final la imagen
  }else if (tipo==2) {
    $.ajax({
                        async:true,cache: false,
                        beforeSend:function(objeto){$('#loading').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');},
                        type:"GET",
                        url:"<?php echo base_url();?>producto_final/get_imagen/"+id,
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
          <?php  if (($this->permisos->permisos(8,1)==1)&&($this->permisos->permisos(8,3)==1)) {?>
          Eliminar:function()
          {
            $( "#dialog-procesos-picture_view" ).dialog( "close" );
              $.ajax({
                      async:true,cache: false,
                      beforeSend:function(objeto){$('#loading').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');},
                      type:"POST",
                      url:"<?php echo base_url();?>producto_final/eliminar_imagen/"+id+"/"+id_cata,
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

          }<?php } ?>
      },
      close: function() {
        $('#img_catalogo img:last-child').remove();
      }
    });
        $( "#dialog-procesos-picture_view" ).dialog( "open" );
  }

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
function pictureCatalogoFinal(id)
{
 document.archivoCatalogoFinal.reset();
 $("#id_catCatalogoFinal").val(id);
$( "#dialog-procesos-picture_catalogoFinal" ).dialog({
      autoOpen: false,
      height: 'auto',
      width: 'auto',
      modal: true,
      buttons: {
          Aceptar: function() {

             if (validarCamposPictureCatalogoFinal()==true) {
              // guardar();
              document.archivoCatalogoFinal.submit();
             }


          },
          Cancelar:function()
          {
        $( "#dialog-procesos-picture_catalogoFinal" ).dialog( "close" );
          }
      },
      close: function() {}
    });
        $( "#dialog-procesos-picture_catalogoFinal" ).dialog( "open" );
}

function alta()
{
$('#tipoIngreso').attr('disabled', false);
$('#hideProductos').hide();
document.cat_producto.reset();

$( "#dialog-procesos" ).dialog({
      autoOpen: false,
      height: 'auto',
      width: 'auto',
      modal: true,
      buttons: {
          Aceptar: function() {
             if (validarCampos()==true) {
                          tipoProducto=$('#tipoIngreso').val();
                          if (tipoProducto==2) {

                              guardar_producto();

                          }else if(tipoProducto==1){

                              guardar_componente();
                          }

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

}
// else if (validarVacio(descripcion_archivo)==false) {

//   notify('* El campo <strong>DESCRIPCION</strong> no puede estar vacio!!!',500,5000,'error');
//   $("#descripcion_archivo").focus();
//   return false;

// }
else if (validarVacio(userfile)==false) {

  notify('* Debe de seleccionar un archivos!!!',500,5000,'error');
  $("#userfile").focus();
  return false;

}else {

  return true;

}

}
//////////////////////////////////////validar compos picture catalogo final////////////
function validarCamposPictureCatalogoFinal () {
nombre_archivo=$('#nombre_archivoCatalogoFinal').val();
descripcion_archivo=$('#descripcion_archivoCatalogoFinal').val();
userfile=$('#userfileCatalogoFinal').val();

if (validarVacio(nombre_archivo)==false) {

  notify('* El campo <strong>NOMBRE</strong> no puede estar vacio!!!',500,5000,'error');
  $("#nombre_archivoCatalogoFinal").focus();
  return false;

}
// else if (validarVacio(descripcion_archivo)==false) {

//   notify('* El campo <strong>DESCRIPCION</strong> no puede estar vacio!!!',500,5000,'error');
//   $("#descripcion_archivo").focus();
//   return false;

// }
else if (validarVacio(userfile)==false) {

  notify('* Debe de seleccionar un archivos!!!',500,5000,'error');
  $("#userfileCatalogoFinal").focus();
  return false;

}else {

  return true;

}

}
////////////////////////////////////// validacion //////////////////////
function validarCampos () {
            clientesdb=$('#clientesdb').val();
            productosBD=$('#productosBD').val();
            nombre=$("#nombre").val();
            ancho=$("#ancho").val();
            largo=$("#largo").val();
            corrugado=$("#corrugado").val();
            tipoProducto=$("#tipoIngreso").val();

            resistencia=$("#resistencia_mprima_id_resistencia_mprima").val();
            if (validarCombo(tipoProducto)==false) {
              notify('* El campo <strong>Tipo de Ingreso</strong> no puede estar vacio!!!',500,5000,'error');
              $("#tipoIngreso").focus();
              return false;
            }else if (validarCombo(clientesdb)==false) {
              notify('* El campo <strong>CLIENTE</strong> no puede estar vacio!!!',500,5000,'error');
              $("#clientesdb").focus();
              return false;
            }else if ((validarCombo(productosBD)==false)&&(tipoProducto==1)) {
              notify('* El campo <strong>PRODUCTOS</strong> no puede estar vacio!!!',500,5000,'error');
              $("#clientesdb").focus();
              return false;
            }else if (validarVacio(nombre)==false) {
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
  ////////////////////////////////cargar productos por cleinte
  function cargarProductos () {
    tipoIngreso=$('#tipoIngreso').val();
    clientesdb=$('#clientesdb').val();
    if (tipoIngreso==1 && clientesdb!='') {
      $.ajax({
                    url:"<?php echo base_url();?>producto_final/productosCliente/"+clientesdb,
                    type:"POST",
                    beforeSend: function(){
                       $("#ajax_productos").html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');
                    },
                    success: function(html){
                            $("#productosBD").html(html);
                            $("#ajax_productos").html("");
                    }
    });
    }else if(tipoIngreso==1 && clientesdb==''){
       notify('* Debes de seleccionar un cliente!!!',500,5000,'error');
              $("#clientesdb").focus();
    }

  }
    function cargarProductos1 (producto) {
    tipoIngreso=$('#tipoIngreso').val();
    clientesdb=$('#clientesdb').val();
    if (tipoIngreso==1 && clientesdb!='') {
      $.ajax({
                    url:"<?php echo base_url();?>producto_final/productosCliente/"+clientesdb,
                    type:"POST",
                    beforeSend: function(){
                       $("#ajax_productos").html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');
                    },
                    success: function(html){
                            $("#productosBD").html(html);
                            $("#ajax_productos").html("");
                             $("#productosBD").val(producto);
                    }
    });
    }else{
       notify('* Debes de seleccionar un cliente!!!',500,5000,'error');
              $("#clientesdb").focus();
    }

  }
  $(document).ready(function(){
  $("#tbl").jqGrid({
    url:'<?php echo base_url();?>producto_final/paginacion',
    datatype: "json",
    mtype: 'POST',
                        colNames:['Acciones','CLIENTE','NOMBRE','LARGO','ANCHO','ALTO','RESISTENCIA','CORRUGADO','SCORE','DESCRIPCION'],
                        colModel:[{name:'acciones', index:'acciones', width:60, resizable:true, align:"center", search:false},
                              {name:'nombre_empresa', index:'nombre_empresa', width:170,resizable:true, sortable:true,search:true,editable:false},
                              {name:'nombre', index:'nombre', width:170,resizable:true, sortable:true,search:true,editable:false},
                              {name:'largo', index:'largo', width:50,resizable:true, sortable:true,search:true,editable:false},
                              {name:'ancho', index:'ancho', width:50,resizable:true, sortable:true,search:true,editable:false},
                              {name:'alto', index:'alto', width:50,resizable:true, sortable:true,search:true,editable:false},
                              {name:'resistencia', index:'resistencia', width:100,resizable:true, sortable:true,search:true,editable:false},
                              {name:'corrugado', index:'corrugado', width:80,resizable:true, sortable:true,search:true,editable:false},
                              {name:'score', index:'score', width:50,resizable:true, sortable:true,search:true,editable:false},
                              {name:'descripcion', index:'descripcion', width:170,resizable:true, sortable:true,search:true,editable:false}
                                ],
    pager: jQuery('#paginacion'),
    rownumbers:true,
  rowNum:30,
    rowList:[10,20,30,40,50],
    imgpath: '<?php echo base_url();?>img/editar.jpg',
    mtype: "POST",
    sortname: 'nombre',
    viewrecords: true,
    sortorder: "asc",
  editable: true,
    caption: 'Catalogo de Productos',
    multiselect: false,
    height:'auto',
    loadtext: 'Cargando',
  width:'100%',
    subGrid: true,
   grouping: false,
   groupingView : {
                    groupField : ['nombre_empresa'],
                    groupColumnShow : [true, true],
                    groupText : ['<b>{0}</b>', '{0}'],
                    groupCollapse : false, groupOrder: ['asc', 'asc'],
                    groupSummary : [false, false],
                    groupDataSorted : true
                  },
    searchurl:'<?php echo base_url();?>producto_final/buscando',
               height:"auto",
   subGridRowExpanded: function(subgrid_id, row_id) {
   var subgrid_table_id, pager_id; subgrid_table_id = subgrid_id+"_t"; pager_id = "p_"+subgrid_table_id;

   $("#"+subgrid_id).html("<table id='"+subgrid_table_id+"' alt='subtabla' class='scroll'></table><div id='"+pager_id+"' class='scroll'></div>");

   $("#"+subgrid_table_id).jqGrid({
   //url:"subgrid.php?q=2&id="+row_id,
   url:"<?php echo base_url();?>catalogo_producto/paginacionID/"+row_id,
   datatype: "json",
    mtype: 'POST',
                        colNames:['Acciones','NOMBRE','LARGO','ANCHO','ALTO','RESISTENCIA','CORRUGADO','SCORE','DESCRIPCION'],
                        colModel:[{name:'acciones', index:'acciones', width:60, resizable:true, align:"center", search:false},
                             // {name:'nombre_empresa', index:'nombre_empresa', width:170,resizable:true, sortable:true,search:true,editable:false},
                              {name:'nombre', index:'nombre', width:170,resizable:true, sortable:true,search:true,editable:false},
                              {name:'largo', index:'largo', width:50,resizable:true, sortable:true,search:true,editable:false},
                              {name:'ancho', index:'ancho', width:50,resizable:true, sortable:true,search:true,editable:false},
                              {name:'alto', index:'alto', width:50,resizable:true, sortable:true,search:true,editable:false},
                              {name:'resistencia', index:'resistencia', width:100,resizable:true, sortable:true,search:true,editable:false},
                              {name:'corrugado', index:'corrugado', width:80,resizable:true, sortable:true,search:true,editable:false},
                              {name:'score', index:'score', width:50,resizable:true, sortable:true,search:true,editable:false},
                              {name:'descripcion', index:'descripcion', width:170,resizable:true, sortable:true,search:true,editable:false}
                                ],
  rows:10,
  rowNum:10,
    rowList:[10,20],
    pager: pager_id,
    sortname: 'nombre',
    height:'auto',
   sortorder: "asc" });

   $("#"+subgrid_table_id).jqGrid('navGrid',"#"+pager_id,{edit:false,add:false,del:false,search:false}) }
        }).navGrid("#paginacion", { edit: false, add: false, search: false, del: false, refresh:true });
        $("#tbl").jqGrid('filterToolbar', { stringResult: true, searchOnEnter: false }) ;
      $("#tbl").jqGrid('navGrid','#paginacion',{add:false,edit:false,del:false,search:false});
   });

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
        <?php $this->load->view('catalogo_producto/formulario');?>
      </div>
      <div style="display:none" id="dialog-procesos-picture" title="Imagen para Producto">
      <?php $this->load->view('catalogo_producto/archivo');?>
      </div>
<!-- arcivo documento final -->
      <div style="display:none" id="dialog-procesos-picture_catalogoFinal" title="Imagen para Producto">
      <?php $this->load->view('catalogo_producto/archivo_final');?>
      </div>
      <div style="display:none" id="dialog-procesos-picture_view" title="Imagen">
      <div id="img_catalogo"></div>
      </div>
