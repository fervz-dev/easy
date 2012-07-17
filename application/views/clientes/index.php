
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
          guardar();        
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
                                  $("#estado_id_estado").val(dato[4]);
                                  $("#cp").val(dato[5]);
                                  $("#direccion").val(dato[6]);
                                  $("#ciudad").val(dato[7]);
                                  $("#lada").val(dato[8]);
                                  $("#num_telefono").val(dato[9]);
                                  $("#ext").val(dato[10]);
                                  $("#fax").val(dato[11]);
                                  $("#email").val(dato[12]);     
                                  $("#comentario").val(dato[13]);
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
                                "estado_id_estado":$("#estado_id_estado").val(),
                                "cp":$("#cp").val(),
                                "direccion":$("#direccion").val(),
                                "ciudad":$("#ciudad").val(),
                                "lada":$("#lada").val(),
                                "num_telefono":$("#num_telefono").val(),
                                "ext":$("#ext").val(),
                                "fax":$("#fax").val(),
                                "email":$("#email").val(),
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
                                "estado_id_estado":$("#estado_id_estado").val(),
                                "cp":$("#cp").val(),
                                "direccion":$("#direccion").val(),
                                "ciudad":$("#ciudad").val(),
                                "lada":$("#lada").val(),
                                "num_telefono":$("#num_telefono").val(),
                                "ext":$("#ext").val(),
                                "fax":$("#fax").val(),
                                "email":$("#email").val(),
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
                                reloading();
                                notify('El registro se ha eliminado correctamente',500,5000,'aviso');
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
                                    'CIUDAD',
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
                                  {name:'nombre_empresa', index:'nombre_empresa', width:100,resizable:false, sortable:true,search:false,editable:false},
                                  {name:'nombre_contacto', index:'nombre_contacto', width:80,resizable:false, sortable:true,search:false,editable:false},
                                  {name:'tipo_persona', index:'tipo_persona', width:100,resizable:false, sortable:true,search:false,editable:false},
                                  {name:'rfc', index:'rfc', width:100,resizable:false, sortable:true,search:false,editable:false},
                                  {name:'dsc_estado', index:'dsc_estado', width:100,resizable:false, sortable:true,search:false,editable:false},
                                  {name:'ciudad', index:'ciudad', width:80,resizable:false, sortable:true,search:false,editable:false},
                                  {name:'direccion', index:'direccion', width:90,resizable:false, sortable:true,search:false,editable:true},
                                  {name:'cp', index:'cp', width:60,resizable:false, sortable:true,search:false,editable:true},
                                  {name:'lada', index:'lada', width:80,resizable:false, sortable:true,search:false,editable:true},
                                  {name:'num_telefono', index:'num_telefono', width:120,resizable:false, sortable:true,search:false,editable:true},
                                  {name:'ext', index:'ext', width:170,resizable:false, sortable:true,search:false,editable:true},
                                  {name:'fax', index:'fax', width:80,resizable:false, sortable:true,search:false,editable:true},
                                  {name:'email', index:'email', width:40,resizable:false, sortable:true,search:false,editable:true},
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
////////////////////////////////validacion//////////////////////////

  function validarNUmero (numero) {
    if (!/^([0-9])*[.]?[0-9]*$/.test(numero)){
      return false;
    }
  }
  function validarEmail (email) {
    if (!/^[a-zA-Z0-9._-]+@[a-zA-Z0-9]+\.([a-zA-Z0-9]{2,4})+$/.test(email)){
      return false;
    }
  }
    function validarVacio (id) {
      if (vacio(id)==false) {
        return false;
      }
    }

    function vacio (campo) {
      for (var i = 0; i < campo.length; i++) {
        if (campo.charAt(i)!="") {
            return true;
        }
      }
      return false;
    }
    function validarCombo (id) {
      if (id=='') {
        return false;
      };
    }
//////////////////////////////validacion////////////////////////////////////////////////////////////////
function validarCampos () {
  nombre_empresa=$("#nombre_empresa").val();
  nombre_contacto=$("#nombre_contacto").val();
  tipo_persona=$("#tipo_persona").val();
  rfc=$("#rfc").val();
  estado_id_estado=$("#estado_id_estado").val();
  cp=$("#cp").val();
  direccion=$("#direccion").val();
  ciudad=$("#ciudad").val();
  lada=$("#lada").val();
  num_telefono=$("#num_telefono").val();
  ext=$("#ext").val();
  fax=$("#fax").val();
  email=$("#email").val();     
  comentario=$("#comentario").val();
  if (validarVacio(nombre_empresa)==false) {
    notify('* El campo <strong>Nombre de la Empresa</strong> no puede estar vacio!!!',500,5000,'error');
    $("#nombre_empresa").focus();
    return false;
  }else if (validarVacio(nombre_contacto)==false) {
    notify('* El campo <strong>Nombre del COntacto</strong> no puede estar vacio!!!',500,5000,'error');
    $("#nombre_contacto").focus();
    return false;
  }else if (validarCombo(tipo_persona)==false) {
    notify('* Debe seleccionar almenos una opcion de la lista <strong>Tipo de Persona</strong>',500,5000,'error');
    $("#tipo_persona").focus();
    return false;
  }else if (validarVacio(rfc)==false) {
    notify('* El campo <strong>RFC</strong> no puede estar vacio!!!',500,5000,'error');
    $("#rfc").focus();
    return false;
  }

}
///////////////////dialogo de confirmacion////////////////////////////////////
  function confirmacion (id,msg) {
$('#dialog-confirm').append('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>'+msg+'</p>');

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