
<script>

function alta()
{
document.editar_clientes.reset();
$( "#dialog-procesos" ).dialog({
      autoOpen: false,
      height:'auto',
      width: 'auto',
      modal: true,
      buttons: {
          Aceptar: function() {
            if (validarCamposForm1()==true) {
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

//////////////////////////////////////////////////////   Directorio  ///////////////////////////////////////
function dire(id)
{

 $( "#dialog-directorio" ).dialog({
      autoOpen: false,
      height: "auto" ,
      width: "auto",
      modal: true,
      close: function() {reloading();}
    });
      $( "#dialog-directorio" ).dialog( "open" );
      $( "#editar_directorio" ).fadeOut();
      $( "#id_cliente" ).val(id); 
      directorio(id); 

}
//////////////////////////////////////////////////////////////////////////////////////////////////////
function edit(id)
{
document.editar_clientes.reset();
$.ajax({
                        async:true,cache: false,
                        beforeSend:function(objeto){$('#loading').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');},
                        type:"GET",
                        url:"<?php echo base_url();?>clientes/get/"+id+"/"+Math.random()*10919939116744,
                        datatype:"html",
                        success:function(data, textStatus){
                        dato= data.split('~');
                                  $("#nombre_empresa").val(dato[0]);
                                  $("#nombre_contacto").val(dato[1]);
                                  $("#tipo_persona").val(dato[2]);
                                  $("#rfc").val(dato[3]);
                                  $("#estado").val(dato[4]);
                                  cargarMunicipio('clientes',dato[4],dato[5]);              
                                  cargarLocalidad('clientes',dato[5],dato[6]);
                                  $("#cp").val(dato[8]);
                                  $("#direccion").val(dato[7]);
                                  $("#lada").val(dato[9]);
                                  $("#num_telefono").val(dato[10]);
                                  $("#ext").val(dato[11]);
                                  $("#fax").val(dato[12]);
                                  $("#email_").val(dato[13]);     
                                  $("#comentario").val(dato[14]);

      },
                        error:function(datos){
                          var error='Error'+data;
                          notify(error ,500,5000,'error');
                          return false;
                        }//Error
                      });//Ajax


$( "#dialog-procesos" ).dialog({
      autoOpen: false,
      height: "auto",
      width: "auto",
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
//Funcion editar empleado


function editar(id)
{
  $.ajax({
                        async:true,
                        beforeSend:function(objeto){$('#loading').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');},
                         type:"POST",
                          url:"<?php echo base_url();?>clientes/editar_clientes/"+id,
                          data:{"nombre_empresa":$("#nombre_empresa").val(),
                                "nombre_contacto":$("#nombre_contacto").val(),    
                                "tipo_persona":$("#tipo_persona").val(),
                                "rfc":$("#rfc").val(),
                                "estado":$("#estado").val(),
                                "municipio":$("#municipio").val(),
                                "localidad":$("#localidad").val(),
                                "cp":$("#cp").val(),
                                "direccion":$("#direccion").val(),
                                "lada":$("#lada").val(),
                                "num_telefono":$("#num_telefono").val(),
                                "ext":$("#ext").val(),
                                "fax":$("#fax").val(),
                                "email":$("#email_").val(),
                                "comentario":$("#comentario").val()},
                      cache: false,
                      datatype:"html",
                      success:function(data, textStatus){

                             switch(data){
                               case "0": 
                                var error='Error'+data;
                                notify(error ,500,5000,'error');
                               break;
                               case "1": 
                                $( "#dialog-procesos" ).dialog( "close" );
                                notify('El registro se edito correctamente',500,5000,'aviso');
                                reloading();
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
            url:"<?php echo base_url();?>clientes/guardar?da="+Math.random()*2312,
                          data:{"nombre_empresa":$("#nombre_empresa").val(),
                                "nombre_contacto":$("#nombre_contacto").val(),    
                                "tipo_persona":$("#tipo_persona").val(),
                                "rfc":$("#rfc").val(),
                                "estado":$("#estado").val(),
                                "municipio":$("#municipio").val(),
                                "localidad":$("#localidad").val(),
                                "cp":$("#cp").val(),
                                "direccion":$("#direccion").val(),
                                "lada":$("#lada").val(),
                                "num_telefono":$("#num_telefono").val(),
                                "ext":$("#ext").val(),
                                "fax":$("#fax").val(),
                                "email":$("#email_").val(),
                                "comentario":$("#comentario").val()},

                     datatype:"html",
                      success:function(data, textStatus){

                             switch(data){
                               case "0": 
                                notify("Error al procesar los datos " ,500,5000,'error');
                               break;
                               case "1": 
                               reloading();
                               notify('El registro se ha guardado correctamente',500,5000,'aviso');
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
                      url:"<?php echo base_url();?>clientes/eliminar/"+id,
                      datatype:"html",
                      success:function(data, textStatus){

                             switch(data){
                               case "0": 
                                notify("Error al procesar los datos " ,500,5000,'error');
                               break;
                               case "1": 
                                $( "#dialog-procesos" ).dialog( "close" );
                                notify('El registro se ha eliminado correctamente',500,5000,'aviso');
                                 $("#tbl_clientes").jqGrid('GridUnload');
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
function cargar(){

  $("#tbl_clientes").jqGrid({
    url:'<?php echo base_url();?>clientes/paginacion',
    datatype: "json",
    mtype: 'POST',
                        colNames:['Acciones',
                                    'NOMBRE DE LA EMPRESA',
                                    'CONTACTO',
                                    'TIPO DE CLIENTE',
                                    'RFC',
                                    'ESTADO',
                                    'MUNICIPIO',
                                    'LOCALIDAD',
                                    'DIRECCION', 
                                    'CP',
                                    'LADA', 
                                    'TELEFONO', 
                                    'EXT',
                                    'FAX',
                                    'EMAIL',
                                    'COMENTARIO',
                                    'FECHA DE REGISTRO'
                                     ],
                                colModel:[{name:'acciones', index:'acciones', width:60, resizable:false, align:"center", search:false},
                                  {name:'nombre_empresa', index:'nombre_empresa', width:150,resizable:false, sortable:true,search:false,editable:false},
                                  {name:'nombre_contacto', index:'nombre_contacto', width:130,resizable:false, sortable:true,search:false,editable:false},
                                  {name:'tipo_persona', index:'tipo_persona', width:100,resizable:false, sortable:true,search:false,editable:false},
                                  {name:'rfc', index:'rfc', width:90,resizable:false, sortable:true,search:false,editable:false},
                                  {name:'estado', index:'estado', width:100,resizable:false, sortable:true,search:false,editable:false},
                                  {name:'municipio', index:'municipio', width:80,resizable:false, sortable:true,search:false,editable:false},
                                  {name:'localidad', index:'localidad', width:80,resizable:false, sortable:true,search:false,editable:false},
                                  {name:'direccion', index:'direccion', width:90,resizable:false, sortable:true,search:false,editable:true},
                                  {name:'cp', index:'cp', width:40,resizable:false, sortable:true,search:false,editable:true},
                                  {name:'lada', index:'lada', width:30,resizable:false, sortable:true,search:false,editable:true},
                                  {name:'num_telefono', index:'num_telefono', width:70,resizable:false, sortable:true,search:false,editable:true},
                                  {name:'ext', index:'ext', width:25,resizable:false, sortable:true,search:false,editable:true},
                                  {name:'fax', index:'fax', width:70,resizable:false, sortable:true,search:false,editable:true},
                                  {name:'email', index:'email', width:180,resizable:false, sortable:true,search:false,editable:true},
                                  {name:'comentario', index:'comentario', width:90,resizable:false, sortable:true,search:false,editable:true},
                                  {name:'fecha_ingreso', index:'fecha_ingreso', width:90,resizable:false, sortable:true,search:false,editable:true}
                                ],                             
    pager: jQuery('#paginacion'),
    rownumbers:true,
  rowNum:15,
    rowList:[10,20,30],
    imgpath: '<?php echo base_url();?>img/editar.jpg',
    mtype: "POST",
    sortname: 'id_clientes',
    viewrecords: true,
     cache: false,
    sortorder: "asc",
  editable: true,
    caption: 'clientes',
    multiselect: false,
    height:'auto',
    loadtext: 'Cargando',
  width:"auto",
        }).navGrid("#paginacion", { edit: false, add: false, search: false, del: false, refresh:true });
        $("#tbl_clientes").jqGrid('filterToolbar', { stringResult: true, searchOnEnter: false }) ; 

}

////////////////////////////////////////////////////////////////////////   
    $(document).ready(function(){
       reloading();
	$("#tbl_clientes").jqGrid({
    url:'<?php echo base_url();?>clientes/paginacion',
    datatype: "json",
    mtype: 'POST',
                        colNames:['Acciones',
                                    'NOMBRE DE LA EMPRESA',
                                    'CONTACTO',
                                    'TIPO DE CLIENTE',
                                    'RFC',
                                    'ESTADO',
                                    'MUNICIPIO',
                                    'LOCALIDAD',
                                    'DIRECCION', 
                                    'CP',
                                    'LADA', 
                                    'TELEFONO', 
                                    'EXT',
                                    'FAX',
                                    'EMAIL',
                                    'COMENTARIO',
                                    'FECHA DE REGISTRO'
                                     ],
                        colModel:[{name:'acciones', index:'acciones', width:60, resizable:false, align:"center", search:false},
                                  {name:'nombre_empresa', index:'nombre_empresa', width:150,resizable:false, sortable:true,search:false,editable:false},
                                  {name:'nombre_contacto', index:'nombre_contacto', width:130,resizable:false, sortable:true,search:false,editable:false},
                                  {name:'tipo_persona', index:'tipo_persona', width:100,resizable:false, sortable:true,search:false,editable:false},
                                  {name:'rfc', index:'rfc', width:100,resizable:false, sortable:true,search:false,editable:false},
                                  {name:'estado', index:'estado', width:100,resizable:false, sortable:true,search:false,editable:false},
                                  {name:'municipio', index:'municipio', width:80,resizable:false, sortable:true,search:false,editable:false},
                                  {name:'localidad', index:'localidad', width:80,resizable:false, sortable:true,search:false,editable:false},
                                  {name:'direccion', index:'direccion', width:90,resizable:false, sortable:true,search:false,editable:true},
                                  {name:'cp', index:'cp', width:40,resizable:false, sortable:true,search:false,editable:true},
                                  {name:'lada', index:'lada', width:35,resizable:false, sortable:true,search:false,editable:true},
                                  {name:'num_telefono', index:'num_telefono', width:60,resizable:false, sortable:true,search:false,editable:true},
                                  {name:'ext', index:'ext', width:25,resizable:false, sortable:true,search:false,editable:true},
                                  {name:'fax', index:'fax', width:60,resizable:false, sortable:true,search:false,editable:true},
                                  {name:'email', index:'email', width:180,resizable:false, sortable:true,search:false,editable:true},
                                  {name:'comentario', index:'comentario', width:90,resizable:false, sortable:true,search:false,editable:true},
                                  {name:'fecha_ingreso', index:'fecha_ingreso', width:90,resizable:false, sortable:true,search:false,editable:true}
                                ],                             
    pager: jQuery('#paginacion'),
    rownumbers:true,
	rowNum:15,
    rowList:[10,20,30],
    imgpath: '<?php echo base_url();?>img/editar.jpg',
    mtype: "POST",
    sortname: 'id_clientes',
    viewrecords: true,
     cache: false,
    sortorder: "asc",
	editable: true,
    caption: 'clientes',
    multiselect: false,
    height:'auto',
    loadtext: 'Cargando',
	width:"auto",
        }).navGrid("#paginacion", { edit: false, add: false, search: false, del: false, refresh:true });
        $("#tbl_clientes").jqGrid('filterToolbar', { stringResult: true, searchOnEnter: false }) ; 
   });

function reloading()
  {
  $("#tbl_clientes").trigger("reloadGrid")
  }
  
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
  }else if (tipo=='rfc') {
      tipCampos('* El campo <strong>RFC</strong> debe de estar en Mayusculas y tener <strong>"12"</strong> ó <strong>"13"</strong> dígitos, <strong>Homoclave</strong> obligatoria.' ,500,8000,'tip');
  }else if (tipo=='lada') {
      tipCampos('* El campo <strong>LADA</strong> debe de tener <strong>"3"</strong> dígitos toda república, excepto D.F., MTY y GDL que son <strong>"2"</strong>. sin guiones, ni espacios' ,500,8000,'tip');
  }else if (tipo=='telefono') {
      tipCampos('* El campo <strong>TELEFONO</strong> debe de tener 7 dígitos toda la república formato (XXXXXXX) ó (xxx-xxxxx), excepto D.F., MTY y GDL que son 8 formato (XXXXXXXx) ó (xxxx-xxxxx)' ,500,8000,'tip');
  }else if (tipo=='email') {
      tipCampos('* El campo <strong>EMAIL</strong> es obligatorio. formato (ejemplo@servidor.com)' ,500,8000,'tip');
  }else if (tipo=='cp') {
       tipCampos('* El campo <strong>CODIGO POSTAL</strong> debe de tener <strong>"5"</strong> dígitos.' ,500,8000,'tip');
  }
}
//////////////////////////////validacion////////////////////////////////////////////////////////////////
function validarCamposForm1() {
  nombre_empresa=$("#nombre_empresa").val();
  nombre_contacto=$("#nombre_contacto").val();
  tipo_persona=$("#tipo_persona").val();
  rfc=$("#rfc").val();
  estado=$("#estado").val();
  municipio=$("#municipio").val();
  localidad=$("#localidad").val();
  direccion=$("#direccion").val();
  cp=$("#cp").val();  
  lada=$("#lada").val();
  num_telefono=$("#num_telefono").val();
  ext=$("#ext").val();
  fax=$("#fax").val();
  email=$("#email_").val();     
  comentario=$("#comentario").val();
  /*validar nombre empresa*/
  if (validarVacio(nombre_empresa)==false) {
    notify('* El campo <strong>Nombre de la Empresa</strong> no puede estar vacio!!!',500,5000,'error');
    $("#nombre_empresa").focus();
    return false;
  }
  /*validar nombre contacto*/
  else if (validarVacio(nombre_contacto)==false) {
    notify('* El campo <strong>Nombre del Contacto</strong> no puede estar vacio!!!',500,5000,'error');
    $("#nombre_contacto").focus();
    return false;
  }
  /*validar tipo de persona*/
  else if (validarCombo(tipo_persona)==false) {
    notify('* Debe seleccionar almenos una opcion de la lista <strong>Tipo de Persona</strong>',500,5000,'error');
    $("#tipo_persona").focus();
    return false;
  }
  /*validar rfc*/
  else if (validarVacio(rfc)==false) {
    notify('* El campo <strong>RFC</strong> no puede estar vacio!!!',500,5000,'error');
    $("#rfc").focus();
    return false;
  }else if (validarRFC(rfc)==false) {
    notify('* El campo <strong>RFC</strong> no es valido',500,5000,'error');
    $("#rfc").focus();
    return false;
  }
  /*validacion estado*/
  else if (validarCombo(estado)==false) {
    notify('Debe seleccionar almenos una opcion de la lista <strong>ESTADOS</strong>',500,5000,'error');
    $("#estado").focus();
    return false;
  }
  /*validar municipio*/
  else if (validarCombo(municipio)==false) {
    notify('Debe seleccionar almenos una opcion de la lista <strong>MUNICIPIO</strong>',500,5000,'error');
    $("#municipio").focus();
    return false;
  }
  /*validar localidad*/
  else if (validarCombo(localidad)==false) {
    notify('Debe seleccionar almenos una opcion de la lista <strong>LOCALIDAD</strong>',500,5000,'error');
    $("#localidad").focus();
    return false;
  }
  /*validar direccion*/
  else if (validarVacio(direccion)==false) {
    notify('* El campo <strong>DIRECCION</strong> no puede estar vacio!!!',500,5000,'error');
    $("#direccion").focus();
    return false;
  }
  /*validacion Codigo Postal*/
  else if (validarVacio(cp)==false) {
    notify('* El campo <strong>CODIGO POSTAL</strong> no puede estar vacio!!!',500,5000,'error');
    $("#cp").focus();
    return false;
  }else if (validarNUmero(cp)==false) {
    notify('* El campo <strong>CODIGO POSTAL</strong> no es un numero!!!',500,5000,'error');
    $("#cp").focus();
    return false;
  }else if (validarCp(cp)==false) {
    notify('* El campo <strong>CODIGO POSTAL</strong> no es valido.!!!',500,5000,'error');
   
    $("#cp").focus();
    return false;
  }
  /*validacion lada*/
  else if (validarVacio(lada)==false) {
    notify('* El campo <strong>LADA</strong> no puede estar vacio!!!',500,5000,'error');
    $("#lada").focus();
    return false;
  }
  else if (validarNUmero(lada)==false) {
    notify('* El campo <strong>LADA</strong> no es un numero!!!',500,5000,'error');
   
    $("#lada").focus();
    return false;
  }
  else if (validarLada(lada)==false) {
    notify('* El campo <strong>LADA</strong> no es un numero!!!',500,5000,'error');
    tipCampos('* El campo <strong>LADA</strong> debe de tener <strong>"3"</strong> dígitos toda república, excepto D.F., MTY y GDL que son <strong>"2"</strong>. sin guiones, ni espacios' ,500,8000,'tip');
    $("#lada").focus();
    return false;
  }
  /*validar telefono*/
  else if (validarVacio(num_telefono)==false) {
    notify('* El campo <strong>TELEFONO</strong> no puede estar vacio!!!',500,5000,'error');
    tipCampos('* El campo <strong>TELEFONO</strong> debe de tener 7 dígitos toda la república formato (XXXXXXX) ó (xxx-xxxxx), excepto D.F., MTY y GDL que son 8 formato (XXXXXXXx) ó (xxxx-xxxxx)' ,500,5000,'tip');
    $("#num_telefono").focus();
    return false;
  }
  else if (validarTelefono(num_telefono)==false) {
    notify('* El campo <strong>TELEFONO</strong> no es valido!!',500,5000,'error');
    $("#num_telefono").focus();
    return false;
  }else if (validarEmail(email)==false) {
    notify('* El campo <strong>EMAIL</strong> es invalido!!!',500,5000,'error');
    $("#email_").focus();
    return false;
  }else{
    return true;
  }

}
function cargarLocalidad (municipio, localidad) {
     $.ajax({
                    url:"<?php echo base_url();?>clientes/localidad/"+municipio,
                    type:"POST",
                    beforeSend: function(){
                       $("#ajax_localidad").html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');
                    },
                    success: function(html){
                            $("#localidad").html(html);
                            $("#ajax_localidad").html("");
                            $("#localidad").val(localidad);
                    }
                    });
    
  }
  function cargarMunicipio (estado,municipio) {
      $.ajax({
                    url:"<?php echo base_url();?>clientes/municipio/"+estado,
                    type:"POST",  
                    beforeSend: function(){
                       $("#ajax_municipio").html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');
                    },
                    success: function(html){
                            $("#municipio").html(html);
                            $("#ajax_municipio").html("");
                            $("#localidades").html("");
                            $("#municipio").val(municipio);

                    }
                    });
  }
////////////////////////////cargar combos municipios y localidades//////////////////////////////////////
function cargar_datos_municipios (id) {
     $.ajax({
                    url:"<?php echo base_url();?>clientes/municipio/"+id,
                    type:"POST",  
                    beforeSend: function(){
                       $("#ajax_municipio").html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');
                    },
                    success: function(html){
                            $("#municipio").html(html);
                            $("#ajax_municipio").html("");
                            $("#localidades").html("");
                    }
                    });
  }
  function cargar_datos_localidad (id) {
     $.ajax({
                    url:"<?php echo base_url();?>clientes/localidad/"+id,
                    type:"POST",
                    beforeSend: function(){
                       $("#ajax_localidad").html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');
                    },
                    success: function(html){
                            $("#localidad").html(html);
                            $("#ajax_localidad").html("");
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
          delete_id(id);
        },
        Cancel: function() {
          $( this ).dialog( "close" );
        }
      }
    });
    }
//////////////////////////////////////////////////////////////////////////////

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
        <table id="tbl_clientes"></table>
        <div id="paginacion"> </div>
        <div style="display:none" id="dialog-procesos" title="clientes">
        <?php 
        $this->load->view('clientes/formulario');?>
        </div>

        <div style="display:none" id="dialog-directorio" title="Directorio Clientes">
        <?php 
        $this->load->view('clientes/directorio');?>
        </div>