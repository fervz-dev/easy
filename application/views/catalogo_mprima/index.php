<script type="text/javascript">   
  $(document).ready(function(){
	$("#tbl").jqGrid({
    url:'<?php echo base_url();?>catalogo_mprima/paginacion',
    datatype: "json",
    mtype: 'POST',
                        colNames:['Acciones','NOMBRE','CARACTERISTICA','TIPO','GROSOR','ANCHO','LARGO','RESISTENCIA'],
                        colModel:[{name:'id_cat_mprima', index:'id_cat_mprima', width:170,resizable:false, sortable:true,search:false,editable:false},
                                  {name:'nombre', index:'nombre', width:100,resizable:false, sortable:true,search:true,editable:true},
                                  {name:'caracteristica', index:'caracteristica', width:100,resizable:false, sortable:true,search:true,editable:true},
                                  {name:'tipo', index:'tipo', width:100,resizable:false, sortable:true,search:true,editable:true},
                                  {name:'tipo_m', index:'tipo_m', width:100,resizable:false, sortable:true,search:true,editable:true},
                                  {name:'ancho', index:'ancho', width:40,resizable:false, sortable:true,search:true,editable:true},
                                  {name:'largo', index:'largo', width:40,resizable:false, sortable:true,search:true,editable:true},
                                  {name:'resistencia', index:'resistencia', width:80,resizable:false, sortable:true,search:true,editable:true}
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
    caption: 'Catalogo de Materia Prima',
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
                        url:"<?php echo base_url();?>catalogo_mprima/get/"+id+"/"+Math.random()*10919939116744,
                        datatype:"html",
                        success:function(data, textStatus){

            dato= data.split('~');

            $("#nombre").val(dato[0]);
            $("#caracteristica").val(dato[1]);
            $("#tipo").val(dato[2]);
            $("#tipo_m").val(dato[3]);
            $("#ancho").val(dato[4]);
            $("#largo").val(dato[5]);
            $("#resistencia_mprima_id_resistencia_mprima").val(dato[6]);
            },
                        error:function(datos){
                        notify("Error al procesar los datos " ,500,5000,'error');
            return false;
                        }//Error
                        });//Ajax


$( "#dialog-procesos" ).dialog({
      autoOpen: false,
      height: 250,
      width: 380,
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
                          url:"<?php echo base_url();?>catalogo_mprima/editar_mprima/"+id,
                          data:{"nombre":$("#nombre").val(),
                                "caracteristica":$("#caracteristica").val(),
                                "tipo":$("#tipo").val(),
                                "tipo_m":$("#tipo_m").val(),
                                "ancho":$("#ancho").val(),
                                "largo":$("#largo").val(),
                                "resistencia_mprima_id_resistencia_mprima":$("#resistencia_mprima_id_resistencia_mprima").val()               
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
                      url:"<?php echo base_url();?>catalogo_mprima/eliminar/"+id,
                      datatype:"html",
                      success:function(data, textStatus){

                             switch(data){
                               case "0": 

                               notify("Error al procesar los datos " ,500,5000,'error');
                               break;
                               case "1": 
                               $( "#dialog-procesos" ).dialog( "close" );

                               reloading();
                               notify('El registro se elimino correctamente',500,5000,'aviso');
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
function guardar()
{
  var sexo =   $("input[name='sexo']:checked").val(); 

$.ajax({
          async:true,cache: false,
          beforeSend:function(objeto){$('#loading').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');},
           type:"POST",
            url:"<?php echo base_url();?>catalogo_mprima/guardar?da="+Math.random()*2312,
            data:{"nombre":$("#nombre").val(),
                  "caracteristica":$("#caracteristica").val(),
                  "tipo":$("#tipo").val(),
                  "tipo_m":$("#tipo_m").val(),
                  "ancho":$("#ancho").val(),
                  "largo":$("#largo").val(),
                  "resistencia_mprima_id_resistencia_mprima":$("#resistencia_mprima_id_resistencia_mprima").val()               
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
////////////////////////////////////// validacion //////////////////////


function validarCampos () {

            nombre=$("#nombre").val();
            caracteristica=$("#caracteristica").val();
            tipo=$("#tipo").val();
            tipo_m=$("#tipo_m").val();
            ancho=$("#ancho").val();
            largo=$("#largo").val();
            resistencia=$("#resistencia_mprima_id_resistencia_mprima").val();
            if (validarVacio(nombre)==false) {
              notify('* El campo <strong>Nombre</strong> no puede estar vacio!!!',500,5000,'error');
              $("#nombre").focus();
              return false;

            }else if (validarCombo(caracteristica)==false) {
              notify('* Debe seleccionar almenos una opcion de la lista <strong>Caracteristica</strong>',500,5000,'error');
              $("#caracteristica").focus();
              return false;
    
            }else if (validarCombo(tipo)==false) {
              notify('* Debe seleccionar almenos una opcion de la <strong>Tipo</strong>',500,5000,'error');
              $("#tipo").focus();
              return false;
              
            }else if (validarCombo(tipo_m)==false) {
              notify('* Debe seleccionar almenos una opcion de la lista <strong>Grosor</strong>',500,5000,'error');
              $("#tipo_m").focus();
              return false;
            }else if (validarVacio(ancho)==false) {
              notify('* El campo <strong>Ancho</strong> no puede estar vacio!!!',500,5000,'error');
              $("#ancho").focus();
              return false;

            }else if (validarVacio(largo)==false) {
              notify('* El campo <strong>Largo</strong> no puede estar vacio!!!',500,5000,'error');
              $("#largo").focus();
              return false;
            }else if (validarCombo(resistencia)==false) {
              notify('* Debe seleccionar almenos una opcion de la lista <strong>Resistencia</strong>',500,5000,'error');
              $("#resistencia").focus();
              return false;
            }else if (validarNUmero(largo)==false) {
              notify('* El campo <strong>Largo</strong> no es numero!!!',500,5000,'error');
              $("#largo").focus();
              return false;
            }else if (validarNUmero(ancho)==false) {
              notify('* El campo <strong>Ancho</strong> no es numero!!!',500,5000,'error');
              $("#ancho").focus();
              return false;
            }else{
              return true;
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
        <div style="display:none" id="dialog-procesos" title="Catalogo de Materia Prima">
        <?php 

        $this->load->view('catalogo_mprima/formulario');?>

