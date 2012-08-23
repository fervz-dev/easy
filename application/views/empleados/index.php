<?php $this->load->view('hed');?>
<script>
function cargar () {
  $("#tbl_empleado").jqGrid({
    url:'<?php echo base_url();?>empleados/paginacion',
    datatype: "json",
    mtype: 'POST',

                        colNames:['Acciones',
                                    'NOMBRE',
                                    'APELLIDO PATERNO',
                                    'APELLIDO MATERNO',
                                    'FECHA DE NACIMIENTO',
                                    'ESTADO CIVIL',
                                    'SEXO',
                                    'ESTADO',
                                    'MUNICIPIO',
                                    'LOCALIDAD',
                                    'CP',
                                    'DIRECCION',
                                    'LADA',
                                    'TELEFONO',
                                    'CELULAR',
                                    'EMAIL',
                                    'PUESTO',
                                    'OFICINA',
                                    'COMENTARIO',
                                    'FECHA DE INGRESO'],
                        colModel:[{name:'acciones', index:'acciones', width:60, resizable:false, align:"center", search:false},
                                  {name:'nombre_obrero', index:'nombre_obrero', width:80,resizable:false, sortable:true,search:true,editable:true},
                                  {name:'a_paterno', index:'a_paterno', width:100,resizable:false, sortable:true,search:true,editable:true},
                                  {name:'a_materno', index:'a_materno', width:100,resizable:false, sortable:true,search:true,editable:true},
                                  {name:'fecha_nacimiento', index:'fecha_nacimiento', width:60,resizable:false, sortable:true,search:true,editable:true},
                                  {name:'estado_civil', index:'estado_civil', width:80,resizable:false, sortable:true,search:true,editable:true},
                                  {name:'sexo', index:'sexo', width:40,resizable:false, sortable:true,search:true,editable:true},
                                  {name:'estado', index:'estado', width:100,resizable:false, sortable:true,search:false,editable:false},
                                  {name:'municipio', index:'municipio', width:80,resizable:false, sortable:true,search:false,editable:false},
                                  {name:'localidad', index:'localidad', width:80,resizable:false, sortable:true,search:false,editable:false},
                                  {name:'cp', index:'cp', width:40,resizable:false, sortable:true,search:false,editable:true},
                                  {name:'direccion', index:'direccion', width:90,resizable:false, sortable:true,search:false,editable:true},
                                  {name:'lada', index:'lada', width:30,resizable:false, sortable:true,search:false,editable:true},
                                  {name:'num_telefono', index:'num_telefono', width:70,resizable:false, sortable:true,search:false,editable:true},
                                  {name:'celular', index:'celular', width:80,resizable:false, sortable:true,search:true,editable:true},
                                  {name:'email', index:'email', width:180,resizable:false, sortable:true,search:false,editable:true},
                                  {name:'nombre', index:'nombre', width:120,resizable:false, sortable:true,search:true,editable:true},
                                  {name:'nombre_oficina', index:'nombre_oficina', width:170,resizable:false, sortable:true,search:true,editable:true},
                                  {name:'comentario',index:'comentario', width:90,resizable:false, sortable:true,search:false,editable:true},
                                  {name:'fecha_ingreso',index:'fecha_ingreso',width:90,resizable:false, sortable:true,search:false,editable:true}




                                ],
    pager: jQuery('#paginacion'),
    rownumbers:true,
  rowNum:15,
    rowList:[10,20,30],
    imgpath: '<?php echo base_url();?>img/editar.jpg',
    mtype: "POST",
    sortname: 'id_obrero',
    viewrecords: true,
    sortorder: "asc",
  editable: true,
    caption: 'Empleados',
    multiselect: false,
    height:'auto',
    loadtext: 'Cargando',
  width:'100%',
    //searchurl:'<?php echo base_url();?>empresas/buscando',
                height:"auto"
        }).navGrid("#paginacion", { edit: false, add: false, search: false, del: false, refresh:true });
        $("#tbl_empleados").jqGrid('filterToolbar', { stringResult: true, searchOnEnter: false }) ;

}
function alta()
{
document.editar_empleado.reset();
$( "#dialog-procesos" ).dialog({
      autoOpen: false,
      height: 'auto',
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
function edit(id)
{
document.editar_empleado.reset();
$.ajax({
                        async:true,cache: false,
                        beforeSend:function(objeto){$('#loading').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');},
                        type:"GET",
                        url:"<?php echo base_url();?>empleados/get/"+id+"/"+Math.random()*10919939116744,
                        datatype:"html",
                        success:function(data, textStatus){
            dato= data.split('~');

            $("#nombre_obrero").val(dato[0]);
            $("#a_paterno").val(dato[1]);
            $("#a_materno").val(dato[2]);
            $("#fecha_nacimiento").val(dato[3]);
            $("#estado_civil").val(dato[4]);
            document.getElementById('sexo_'+ dato[5]).setAttribute('checked','checked');
            $("#estado").val(dato[6]);
            cargarMunicipio(dato[6],dato[7]);
            cargarLocalidad(dato[7],dato[8]);
            $("#cp").val(dato[9]);
            $("#direccion").val(dato[10]);
            $("#lada").val(dato[11]);
            $("#num_telefono").val(dato[12]);
            $("#celular").val(dato[13]);
            $("#email").val(dato[14]);
            $("#puestos_id_tipo_puesto").val(dato[15]);
            $("#oficina_id_oficina").val(dato[16]);
            $("#comentario").val(dato[17]);

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
//Funcion editar empleado

function editar(id)
{
  var sexo =   $("input[name='sexo']:checked").val();
  $.ajax({
                        async:true,
                        beforeSend:function(objeto){$('#loading').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');},
                         type:"POST",
                          url:"<?php echo base_url();?>empleados/editar_empleado/"+id,
                          data:{"nombre_obrero":$("#nombre_obrero").val(),
                                "a_paterno":$("#a_paterno").val(),
                                "a_materno":$("#a_materno").val(),
                                "fecha_nacimiento":$("#fecha_nacimiento").val(),
                                "estado_civil":$("#estado_civil").val(),
                                "sexo":sexo,
                                "estado":$("#estado").val(),
                                "municipio":$("#municipio").val(),
                                "localidad":$("#localidad").val(),
                                "cp":$("#cp").val(),
                                "direccion":$("#direccion").val(),
                                "lada":$("#lada").val(),
                                "num_telefono":$("#num_telefono").val(),
                                "celular":$("#celular").val(),
                                "email":$("#email").val(),
                                "puestos_id_tipo_puesto":$("#puestos_id_tipo_puesto").val(),
                                "oficina_id_oficina":$("#oficina_id_oficina").val(),
                                "comentario":$("#comentario").val()},
                          cache: false,
                          datatype:"html",
                          success:function(data, textStatus){

                          switch(data){
                          case "0":

                           notify("Error al procesar los datos " ,500,5000,'error');
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
  var sexo =   $("input[name='sexo']:checked").val();

$.ajax({
          async:true,cache: false,
          beforeSend:function(objeto){$('#loading').html('<img src="<?php echo base_url();
            ?>img/ajax-loader.gif" width="28" height="28" />');},
          type:"POST",
          url:"<?php echo base_url();?>empleados/guardar?da="+Math.random()*2312,
          data:{"nombre_obrero":$("#nombre_obrero").val(),
                "a_paterno":$("#a_paterno").val(),
                "a_materno":$("#a_materno").val(),
                "fecha_nacimiento":$("#fecha_nacimiento").val(),
                "estado_civil":$("#estado_civil").val(),
                "sexo":sexo,
                "estado":$("#estado").val(),
                "municipio":$("#municipio").val(),
                "localidad":$("#localidad").val(),
                "cp":$("#cp").val(),
                "direccion":$("#direccion").val(),
                "lada":$("#lada").val(),
                "num_telefono":$("#num_telefono").val(),
                "celular":$("#celular").val(),
                "email":$("#email").val(),
                "puestos_id_tipo_puesto":$("#puestos_id_tipo_puesto").val(),
                "oficina_id_oficina":$("#oficina_id_oficina").val(),
                "comentario":$("#comentario").val()},

        datatype:"html",
        success:function(data, textStatus){

        switch(data) {
          case "0": notify("Error al procesar los datos ",500,5000,'error');
          break;
          case "1": reloading();
            notify('el registro se guardado correctamente',500,5000,'aviso');
            $( "#dialog-procesos" ).dialog( "close" );
          break;
          default: $( "#dialog-procesos" ).dialog( "close" );
          }
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
                      url:"<?php echo base_url();?>empleados/eliminar/"+id,
                      datatype:"html",
                      success:function(data, textStatus){

                             switch(data){
                               case "0":
                                notify("Error al procesar los datos " ,500,5000,'error');
                               break;
                               case "1":
                                $( "#dialog-procesos" ).dialog( "close" );
                                notify('El registro se ha eliminado correctamente',500,5000,'aviso');
                                 $("#tbl_empleado").jqGrid('GridUnload');
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

////////////////////////////////////////////////////////////////////////
    $(document).ready(function(){
	$("#tbl_empleado").jqGrid({
    url:'<?php echo base_url();?>empleados/paginacion',
    datatype: "json",
    mtype: 'POST',

                        colNames:['Acciones',
                                    'NOMBRE',
                                    'APELLIDO PATERNO',
                                    'APELLIDO MATERNO',
                                    'FECHA DE NACIMIENTO',
                                    'ESTADO CIVIL',
                                    'SEXO',
                                    'ESTADO',
                                    'MUNICIPIO',
                                    'LOCALIDAD',
                                    'CP',
                                    'DIRECCION',
                                    'LADA',
                                    'TELEFONO',
                                    'CELULAR',
                                    'EMAIL',
                                    'PUESTO',
                                    'OFICINA',
                                    'COMENTARIO',
                                    'FECHA DE INGRESO'],
                        colModel:[{name:'acciones', index:'acciones', width:60, resizable:false, align:"center", search:false},
                                  {name:'nombre_obrero', index:'nombre_obrero', width:80,resizable:false, sortable:true,search:true,editable:true},
                                  {name:'a_paterno', index:'a_paterno', width:100,resizable:false, sortable:true,search:true,editable:true},
                                  {name:'a_materno', index:'a_materno', width:100,resizable:false, sortable:true,search:true,editable:true},
                                  {name:'fecha_nacimiento', index:'fecha_nacimiento', width:60,resizable:false, sortable:true,search:true,editable:true},
                                  {name:'estado_civil', index:'estado_civil', width:80,resizable:false, sortable:true,search:true,editable:true},
                                  {name:'sexo', index:'sexo', width:40,resizable:false, sortable:true,search:true,editable:true},
                                  {name:'estado', index:'estado', width:100,resizable:false, sortable:true,search:false,editable:false},
                                  {name:'municipio', index:'municipio', width:80,resizable:false, sortable:true,search:false,editable:false},
                                  {name:'localidad', index:'localidad', width:80,resizable:false, sortable:true,search:false,editable:false},
                                  {name:'cp', index:'cp', width:40,resizable:false, sortable:true,search:false,editable:true},
                                  {name:'direccion', index:'direccion', width:90,resizable:false, sortable:true,search:false,editable:true},
                                  {name:'lada', index:'lada', width:30,resizable:false, sortable:true,search:false,editable:true},
                                  {name:'num_telefono', index:'num_telefono', width:70,resizable:false, sortable:true,search:false,editable:true},
                                  {name:'celular', index:'celular', width:80,resizable:false, sortable:true,search:true,editable:true},
                                  {name:'email', index:'email', width:180,resizable:false, sortable:true,search:false,editable:true},
                                  {name:'nombre', index:'nombre', width:120,resizable:false, sortable:true,search:true,editable:true},
                                  {name:'nombre_oficina', index:'nombre_oficina', width:170,resizable:false, sortable:true,search:true,editable:true},
                                  {name:'comentario',index:'comentario', width:90,resizable:false, sortable:true,search:false,editable:true},
                                  {name:'fecha_ingreso',index:'fecha_ingreso',width:90,resizable:false, sortable:true,search:false,editable:true}




                                ],
    pager: jQuery('#paginacion'),
    rownumbers:true,
	rowNum:15,
    rowList:[10,20,30],
    imgpath: '<?php echo base_url();?>img/editar.jpg',
    mtype: "POST",
    sortname: 'id_obrero',
    viewrecords: true,
    sortorder: "asc",
	editable: true,
    caption: 'Empleados',
    multiselect: false,
    height:'auto',
    loadtext: 'Cargando',
	width:'100%',
    //searchurl:'<?php echo base_url();?>empresas/buscando',
                height:"auto"
        }).navGrid("#paginacion", { edit: false, add: false, search: false, del: false, refresh:true });
        $("#tbl_empleados").jqGrid('filterToolbar', { stringResult: true, searchOnEnter: false }) ;
   });
function reloading()
  {
  $("#tbl_empleado").trigger("reloadGrid")
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
  nombre_obrero=$("#nombre_obrero").val();
  a_paterno=$("#a_paterno").val();
  a_materno=$("#a_materno").val();
  fecha_nacimiento=$("#fecha_nacimiento").val();
  estado_civil=$("#estado_civil").val();
  celular=$("#celular").val();
  puestos_id_tipo_puesto=$("#puestos_id_tipo_puesto").val();
  oficina_id_oficina=$("#oficina_id_oficina").val();
  estado=$("#estado").val();
  municipio=$("#municipio").val();
  localidad=$("#localidad").val();
  direccion=$("#direccion").val();
  cp=$("#cp").val();
  lada=$("#lada").val();
  num_telefono=$("#num_telefono").val();

  email=$("#email").val();
  comentario=$("#comentario").val();
  /*validar nombre obrero*/
if (validarVacio(nombre_obrero)==false) {
   notify('* El campo <strong>NOMBRE</strong> no puede estar vacio!!!',500,5000,'error');
    $("#nombre_obrero").focus();
}
/*validar apellido paterno*/
  else if (validarVacio(a_paterno)==false) {
    notify('* El campo <strong>APELLIDO PATERNO</strong> no puede estar vacio!!!',500,5000,'error');
    $("#a_paterno").focus();
    return false;
}
/*validar apellido materno*/
  else if (validarVacio(a_materno)==false) {
    notify('* El campo <strong>APELLIDO MATERNO</strong> no puede estar vacio!!!',500,5000,'error');
    $("#a_materno").focus();
    return false;
}/*validar validar fecha de nacimiento*/
  else if (validarVacio(fecha_nacimiento)==false) {
    notify('* El campo <strong>FECHA DE NACIMIENTO</strong> no puede estar vacio!!!',500,5000,'error');
    $("#fecha_nacimiento").focus();
    return false;
}/*validar validar estado civil*/
  else if (validarVacio(estado_civil)==false) {
    notify('* El campo <strong>ESTADO CIVIL</strong> no puede estar vacio!!!',500,5000,'error');
    $("#estado_civil").focus();
    return false;
}
  /*validar sexo*/
  else if(!$("#editar_empleado input[name='sexo']:radio").is(':checked')) {
       notify('* El Campo<strong>SEXO</strong> no esta seleccionado!!!',500,5000,'error');
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
  else if (lada!='') {
  if (validarLada(lada)==false) {
    notify('* El campo <strong>LADA</strong> no es un numero!!!',500,5000,'error');
    tipCampos('* El campo <strong>LADA</strong> debe de tener <strong>"3"</strong> dígitos toda república, excepto D.F., MTY y GDL que son <strong>"2"</strong>. sin guiones, ni espacios' ,500,8000,'tip');
    $("#lada").focus();
    return false;
  }
  return true;
}
  /*validar telefono*/
  else if (validarVacio(num_telefono)==false) {
    notify('* El campo <strong>TELEFONO</strong> no puede estar vacio!!!',500,5000,'error');
    tipCampos('* El campo <strong>TELEFONO</strong> debe de tener 7 dígitos toda la república formato (XXXXXXX) ó (xxx-xxxxx), excepto D.F., MTY y GDL que son 8 formato (XXXXXXXx) ó (xxxx-xxxxx)' ,500,5000,'tip');
    $("#num_telefono").focus();
    return false;
  }else if (num_telefono!='') {

  if (validarTelefono(num_telefono)==false) {
    notify('* El campo <strong>TELEFONO</strong> no es valido!!',500,5000,'error');
    $("#num_telefono").focus();
    return false;
  }
  return true;
  }
  /*validar celular*/
  else if (validarVacio(celular)==true) {
        if (validarCe(celular)==false) {
          notify('* El campo <strong>CELULAR</strong> no es valido!!',500,5000,'error');
          $("#celular").focus();
      return false;
  }
    return true;
  }
  else if (email!=''){
  if (validarEmail(email)==false) {
    notify('* El campo <strong>EMAIL</strong> es invalido!!!',500,5000,'error');
    $("#email").focus();
    return false;
  }
  return true;
  }/*validar puesto*/
  else if (validarCombo(puestos_id_tipo_puesto)==false) {
      notify('Debe seleccionar almenos una opcion de la lista <strong>PUESTO</strong>',500,5000,'error');
    $("#puestos_id_tipo_puesto").focus();
    return false;
  }/*validar puesto*/
  else if (validarCombo(oficina_id_oficina)==false) {
      notify('Debe seleccionar almenos una opcion de la lista <strong>OFICINA</strong>',500,5000,'error');
    $("#oficina_id_oficina").focus();
    return false;
  }
  else{
    return true;
  }

}
function cargarLocalidad (municipio, localidad) {
     $.ajax({
                    url:"<?php echo base_url();?>direcciones/localidad/"+municipio,
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
                    url:"<?php echo base_url();?>direcciones/municipio/"+estado,
                    type:"POST",
                    beforeSend: function(){
                       $("#ajax_municipio").html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');
                    },
                    success: function(html){
                            $("#municipio").html(html);
                            $("#ajax_municipio").html("");
                            $("#localidad").html("");
                            $("#municipio").val(municipio);

                    }
                    });
  }
////////////////////////////cargar combos municipios y localidades//////////////////////////////////////
function cargar_datos_municipios (id) {
     $.ajax({
                    url:"<?php echo base_url();?>direcciones/municipio/"+id,
                    type:"POST",
                    beforeSend: function(){
                       $("#ajax_municipio").html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');
                    },
                    success: function(html){
                            $("#municipio").html(html);
                            $("#ajax_municipio").html("");
                            $("#localidad").html("");
                    }
                    });
  }
  function cargar_datos_localidad (id) {
     $.ajax({
                    url:"<?php echo base_url();?>direcciones/localidad/"+id,
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
<td>
<?php
if (!isset($_GET['submain'])) {
}
elseif (($this->permisos->permisos_submenus($_GET['m'],$_GET['submain'],0)==1)&&($this->permisos->permisos($_GET['submain'],2)==1)) {?>
  <div onclick="alta()" id="alta"><img src="<?php '.base_url().' ?>img/add_empleado.png" width="30" height="30" alta="Agregar Empleado"></div>
<?php } ?>


</td>
<td >&nbsp;</td>
</tr>
</table>
        <table id="tbl_empleado"></table>
        <div id="paginacion"> </div>
        <div style="display:none" id="dialog-procesos" title="Empleados">
        <?php

        $this->load->view('empleados/formulario');?>
        </div>