
<script>
////////////////////////////////  Alta directorio ///////////////////////////////////////////////////
function alta_directorio()
{
document.directorio.reset();
///se  reinicializan los contenedores de municipios y localidades///////////////////////////
$("#localidad_d").html("");
$("#municipio_d").html("");
////////////////////////////////////////////////////////////////////////////////////////////
$( "#editar_directorio" ).dialog({
      autoOpen: false,
      height:'auto',
      width: 'auto',
      modal: true,
      buttons: {
          Aceptar: function() {
            if (validarCampos_direccion()==true) {
          guardar_nuevo();
        }
          },
          Cancelar:function()
          {   
        $( "#editar_directorio" ).dialog( "close" );
          }
      },
      close: function() {}
    });
        $( "#editar_directorio" ).dialog( "open" );
}
/*function alta_directorio()
{

$.ajax({
          async:true,cache: false,
          beforeSend:function(objeto){$('#loading').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');},
          type:"GET",
          url:"<?php echo base_url();?>clientes/comparar/"+id+"/"+Math.random()*10919939116744,
          datatype:"html",
          success:function(data, textStatus){
                    $("#id_cliente").val(data);
                                },
          error:function(datos){
          notify("Error al procesar los datos " ,500,5000,'error');
          return false;
          }//Error
          });//Ajax
$( "#editar_directorio" ).dialog('open');

// $("#guardar_edit").fadeIn;
}*/
function delet_dir (id) {
  msg="Este artículo se eliminara. ¿Estás seguro?";
  confirmacion(id,msg);
}
function delete_dir (id) {
  $.ajax({
                      async:true,cache: false,
                      beforeSend:function(objeto){$('#loading').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');},
                      type:"POST",
                      url:"<?php echo base_url();?>clientes/eliminar_direccion/"+id,
                      datatype:"html",
                      success:function(data, textStatus){

                             switch(data){
                               case "0": 
                                notify("Error al procesar los datos " ,500,5000,'error');
                               break;
                               case "1": 
                                $( "#editar_directorio" ).dialog( "close" );
                                notify('El registro se ha eliminado correctamente',500,5000,'aviso');
                                 $("#tbl_directorio").jqGrid('GridUnload');
                                 id_direccion=$("#id_cliente_").val();
                                  setTimeout("directorio(id_direccion)",1000);

                               break;
                               default:
                                $( "#editar_directorio" ).dialog( "close" );
                               break; 

                              }//switch
                             },
                        error:function(datos){
                              notify("Error inesperado" ,500,5000,'error');
                             }//Error
                         });//Ajax
  
}

///////////////////////////////  Guardar Directorio ////////////////////////////////////////////////

function guardar_nuevo()
{

$.ajax({
          async:true,cache: false,
          beforeSend:function(objeto){$('#loading').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');},
          type:"POST",
          url:"<?php echo base_url();?>clientes/guardar_nuevo?da="+Math.random()*2312,
          data:{"clientes_id_clientes":$("#id_cliente_").val(),
                  "estado_d":$("#estado_d").val(),
                  "municipio_d":$("#municipio_d").val(),
                  "localidad_d":$("#localidad_d").val(),
                  "direccion_d":$("#direccion_d").val(),
                  "comentario_d":$("#comentario_d").val()},

          cache: false,
          datatype:"html",
          
          success:function(data, textStatus){
          
          switch(data){
          case "0": 
                  notify("Error al procesar los datos " ,500,5000,'error');
          break;
          
          case "1": 
                  $( "#tbl_directorio" ).trigger("reloadGrid");
                  notify('El registro se ha guardado correctamente',500,5000,'aviso');
                  $( "#editar_directorio" ).dialog( "close" );
          break;
          default:
             $( "#editar_directorio" ).dialog( "close" );
             var error='Error'+data;
             notify(error ,500,5000,'error');
             break; 
          
          }//switch
          },
          error:function(datos)
                {
                  notify("Error al inesperado" ,500,5000,'error');
                }//Error
          });//Ajax
           


}
///////////////////////////////////////////////////////////////////////////////////////
function edit_dir(id)
{

document.directorio.reset();


$.ajax({
                        async:true,cache: false,
                        beforeSend:function(objeto){$('#loading').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');},
                        type:"GET",
                        url:"<?php echo base_url();?>clientes/get_directorio/"+id+"/"+Math.random()*10919939116744,
                        datatype:"html",
                        success:function(data, textStatus){

            dato= data.split('~');
                                  $("#id_direcciones").val(dato[0]);
                                  $("#estado_d").val(dato[1]);
                                  cargarMunicipio_direccion(dato[1],dato[2]);              
                                  cargarLocalidad_direccion(dato[2],dato[3]);
                                  $("#direccion_d").val(dato[4]);
                                  $("#comentario_d").val(dato[5]);
                                              },
                        error:function(datos){
                         var error='Error'+data;
                          notify(error ,500,5000,'error');
                          return false;
                        }//Error
                        });//Ajax
$( "#editar_directorio" ).dialog({
      autoOpen: false,
      height:'auto',
      width: 'auto',
      modal: true,
      buttons: {
          Aceptar: function() {
            if (validarCampos_direccion()==true) {
          editar_directorio_all(id);
        }
          },
          Cancelar:function()
          {   
        $( "#editar_directorio" ).dialog( "close" );
          }
      },
      close: function() {}
    });
        $( "#editar_directorio" ).dialog( "open" );
}


//////////////////////////////////////////////////////////////////////////////////////


////////////////////////////////// Editar ///////////////////////////////////////////

function editar_directorio_all()
{
  $.ajax({
                        async:true,
                        beforeSend:function(objeto){$('#loading').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');},
                         type:"POST",
                          url:"<?php echo base_url();?>clientes/editar_directorio_all/",
                          data:{                                
                                "estado_d":$("#estado_d").val(),
                                "municipio_d":$("#municipio_d").val(),
                                "localidad_d":$("#localidad_d").val(),
                                "direccion_d":$("#direccion_d").val(),
                                "comentario_d":$("#comentario_d").val(),
                                "id_direcciones":$("#id_direcciones").val(),
                              },
                    cache: false,
                     datatype:"html",
                      success:function(data, textStatus){

                             switch(data){
                               case "0": 
                                  notify("Error al procesar los datos " ,500,5000,'error');
                               break;
                               case "1": 
                            $( "#tbl_directorio" ).trigger("reloadGrid");
                            $( "#editar_directorio" ).dialog( "close" );
                            notify('El registro se edito correctamente',500,5000,'aviso');
                            break;
                              }//switch
                             },
                        error:function(datos){
                              notify("Error al procesar los datos " ,500,5000,'error');
                             }//Error
                         });//Ajax
}


////////////////////////////////////////////////////////////////////////////////////
function directorio (id) {
  $("#id_cliente_").val(id);
  $("#tbl_directorio").jqGrid('GridUnload');


  
	$("#tbl_directorio").jqGrid({
    url:'<?php echo base_url();?>clientes/paginacion_directorio/',
    datatype: "json",
    mtype: 'POST',
		      //  $data->rows[$i]['cell']=array($acciones,strtoupper($row->nombre),strtoupper($row->descripcion),strtoupper($row->direccion),strtoupper($row->colonia),strtoupper($row->poblacion),strtoupper($row->contacto));
                        colNames:['Acciones',
                                    'ESTADO',
                                    'MUNICIPIO',
                                    'LOCALIDAD',
                                    'DIRECCION', 
                                    'COMENTARIO'
                                     ],
                        colModel:[{name:'acciones', index:'acciones', width:60, resizable:false, align:"center", search:false},
                                  {name:'estado', index:'estado', width:100,resizable:false, sortable:true,search:false,editable:false},
                                  {name:'municipio', index:'municipio', width:80,resizable:false, sortable:true,search:false,editable:false},
                                  {name:'localidad', index:'localidad', width:80,resizable:false, sortable:true,search:false,editable:false},
                                  {name:'direccion', index:'direccion', width:90,resizable:false, sortable:true,search:false,editable:true},
                                  {name:'comentario', index:'comentario', width:100,resizable:false, sortable:true,search:false,editable:true}
                                ],                             
    pager: jQuery('#paginacion_directorio'),
    postData: {id: id},  
    rownumbers:true,
	  rowNum:15,
    rowList:[10,20,30],
    imgpath: '<?php echo base_url();?>img/editar.jpg',
    mtype: "POST",
    sortname: 'id_direcciones',
    viewrecords: true,
    sortorder: "asc",
	  editable: true,
    caption: 'directorio',
    multiselect: false,
    height:'auto',
    loadtext: 'Cargando',
	width:'100%',
    //searchurl:'<?php echo base_url();?>empresas/buscando',
                height:"auto"
        }).navGrid("#paginacion_directorio", { edit: false, add: false, search: false, del: false, refresh:true });
        $("#tbl_directorio").jqGrid('filterToolbar', { stringResult: true, searchOnEnter: false }) ;
   //});
//$("#tbl_directorio").jqGrid('setGridParam', {id: id}).trigger("reloadGrid");
    // console.log( typeof($('#tb1_directorio')));
    
}
function cargarLocalidad_direccion (municipio, localidad) {
     $.ajax({
                    url:"<?php echo base_url();?>direcciones/localidad/"+municipio,
                    type:"POST",
                    beforeSend: function(){
                       $("#ajax_localidad_d").html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');
                    },
                    success: function(html){
                            $("#localidad_d").html(html);
                            $("#ajax_localidad_d").html("");
                            $("#localidad_d").val(localidad);
                    }
                    });
    
  }
  function cargarMunicipio_direccion (estado,municipio) {
      $.ajax({
                    url:"<?php echo base_url();?>direcciones/municipio/"+estado,
                    type:"POST",  
                    beforeSend: function(){
                       $("#ajax_municipio_d").html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');
                    },
                    success: function(html){
                            $("#municipio_d").html(html);
                            $("#ajax_municipio_d").html("");
                            $("#localidad_d").html("");
                            $("#municipio_d").val(municipio);

                    }
                    });
  }
////////////////////////////cargar combos municipios y localidades//////////////////////////////////////
function cargar_datos_municipios_direccion (id) {
     $.ajax({
                    url:"<?php echo base_url();?>direcciones/municipio/"+id,
                    type:"POST",  
                    beforeSend: function(){
                       $("#ajax_municipio_d").html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');
                    },
                    success: function(html){
                            $("#municipio_d").html(html);
                            $("#ajax_municipio_d").html("");
                            $("#localidad_d").html("");
                    }
                    });
  }
  function cargar_datos_localidad_direccion (id) {
     $.ajax({
                    url:"<?php echo base_url();?>direcciones/localidad/"+id,
                    type:"POST",
                    beforeSend: function(){
                       $("#ajax_localidad_d").html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');
                    },
                    success: function(html){
                            $("#localidad_d").html(html);
                            $("#ajax_localidad_d").html("");
                    }
                    });
    
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
          delete_dir(id);
        },
        Cancel: function() {
          $( this ).dialog( "close" );
        }
      }
    });
    }
//////////////////////////////////////////////////////////////////////////////
///////////////////////////////eventos input//////////////////////////////////////////////////////////
$(function(){
$('ul#icons li').hover(
function() { $(this).addClass('ui-state-hover'); },
function() { $(this).removeClass('ui-state-hover'); }
); 
});
function tip (tipo) {
  if (tipo=='direccion') {
    tipCampos('Tipo de vialidad, Nombre vialidad, Numero interior y/o exterior, Asentamiento' ,500,8000,'tip');
  }
}
//////////////////////////////validacion////////////////////////////////////////////////////////////////
function validarCampos_direccion() {

  estado=$("#estado_d").val();
  municipio=$("#municipio_d").val();
  localidad=$("#localidad_d").val();
  direccion=$("#direccion_d").val();
  comentario=$("#comentario_d").val();
  
  /*validacion estado*/
  if (validarCombo(estado)==false) {
    notify('Debe seleccionar almenos una opcion de la lista <strong>ESTADOS</strong>',500,5000,'error');
    $("#estado_d").focus();
    return false;
  }
  /*validar municipio*/
  else if (validarCombo(municipio)==false) {
    notify('Debe seleccionar almenos una opcion de la lista <strong>MUNICIPIO</strong>',500,5000,'error');
    $("#municipio_d").focus();
    return false;
  }
  /*validar localidad*/
  else if (validarCombo(localidad)==false) {
    notify('Debe seleccionar almenos una opcion de la lista <strong>LOCALIDAD</strong>',500,5000,'error');
    $("#localidad_d").focus();
    return false;
  }
  /*validar direccion*/
  else if (validarVacio(direccion)==false) {
    notify('* El campo <strong>DIRECCION</strong> no puede estar vacio!!!',500,5000,'error');
    $("#direccion_d").focus();
    return false;
  }
 else{
    return true;
  }

}
   </script>
   <div>
     <table>
       <tr>
         <td> 
          <button onclick="alta_directorio()">
            <div style="width:135x; height:25px;"><img src="<?php echo base_url();?>img/add_address.png" width="30" height="30" style="float:left;"><div style="float:left;"><p style="font-size:12px; color:#108de2; margin-top: 10px; margin-bottom: 0px;">&nbsp &nbsp Nueva dirección</p></div></div>  

         </button>

          </td>
       </tr>
     </table>
   </div>
   <table id="tbl_directorio"></table>
   
        <div id="paginacion_directorio"></div>

<div id="editar_directorio" style="display:none">

        <?php 
        $this->load->view('clientes/editar_directorio');?>

</div>
<input type="hidden" id="id_cliente_" name="id_cliente_">