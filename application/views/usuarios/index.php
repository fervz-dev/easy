<?php $this->load->view('hed');?>
<script>
function edit(id)
{
  document.nuevo_usuario.reset();
$.ajax({
                        async:true,cache: false,
                        beforeSend:function(objeto){$('#loading').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');},
                        type:"GET",
                        url:"<?php echo base_url();?>usuarios/get/"+id+"/"+Math.random()*10919939116744,
                        datatype:"html",
                        success:function(data, textStatus){
						//$("#carga_organismos").html(data);
                        //alert(data);
						dato= data.split('~');
						//alert(cadenaTexto);
						$("#sucursal").val(dato[0]);
						$("#usuario").val(dato[1]);
            $("#rol").val(dato[2]);
						$("#email").val(dato[3]);
            $("#nombre_completo").val(dato[4]);



						},
                        error:function(datos){
                           var error='Error'+data;
                          notify(error ,500,5000,'error');
                          return false;
                        }//Error
                        });//Ajax
$( "#dialog-alta" ).dialog({
			autoOpen: false,
			height: 320,
			width: 550,
			modal: true,
			buttons: {
					Aceptar: function() {
				if (validarCamposForm1()==true) {
          editar(id);
        }
				    },
					Cancelar:function()
					{
        			$( "#dialog-alta" ).dialog( "close" );
					}
			},
			close: function() {}
		});
				$( "#dialog-alta" ).dialog( "open" );

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
                          url:"<?php echo base_url();?>usuarios/borrar/"+id,
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
                                $( "#dialog-alta" ).dialog( "close" );

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
                          url:"<?php echo base_url();?>usuarios/editar/"+id,
                          data:{"id_oficina":$("#sucursal").val(),
                          "id_roles":$("#rol").val(),
                          "usuario":$("#usuario").val(),
                          "password":$("#password").val(),
                          "email":$("#email").val(),
                          "nombre":$("#nombre_completo").val()},

                     datatype:"html",
                      success:function(data, textStatus){

                             switch(data){
                               case "0":

                               notify("Error al procesar los datos " ,500,5000,'error');
                               break;
                               case "1":
                               $( "#dialog-alta" ).dialog( "close" );
                               reloading();
                               notify('El registro se edito correctamente',500,5000,'aviso');
                               break;
                               default:
                               $( "#dialog-alta" ).dialog( "close" );

                               break;

                              }//switch
                             },
                        error:function(datos){
                              notify("Error al procesar los datos " ,500,5000,'error');
                             }//Error
                         });//Ajax



}


function reloading()
	{
	$("#tbl").trigger("reloadGrid")
	}

function alta() {
document.nuevo_usuario.reset();
$("#nombre_grupo").val('');
$( "#dialog-alta" ).dialog({
			autoOpen: false,
			height: 320,
			width: 550,
			modal: true,
			buttons: {
					Aceptar: function() {
					 if (validarCamposForm1()==true) {
          guardar();
        }
					},
					Cancelar:function()
					{
				$( "#dialog-alta" ).dialog( "close" );
					}
			},
			close: function() {}
		});

				$( "#dialog-alta" ).dialog( "open" );
}

function guardar()
{
$.ajax({
                        async:true,cache: false,
                        beforeSend:function(objeto){$('#loading').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');},
                         type:"POST",
                          url:"<?php echo base_url();?>usuarios/guardar?da="+Math.random()*2312,
                          data:{"id_oficina":$("#sucursal").val(),
                            "id_roles":$("#rol").val(),
                            "usuario":$("#usuario").val(),
                            "password":$("#password").val(),
                            "email":$("#email").val(),
                            "nombre":$("#nombre_completo").val()},

                     datatype:"html",
                      success:function(data, textStatus){

                             switch(data){
                               case "0":
                               notify("Error al procesar los datos " ,500,5000,'error');
                               break;
                               case "1":
                               notify('El registro se guardado correctamente',500,5000,'aviso');
                               $( "#dialog-alta" ).dialog( "close" );
                               reloading();
                               break;
                               default:
                               $( "#dialog-alta" ).dialog( "close" );
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
</script>

     <script type="text/javascript">
     function cargar () {
        $("#tbl").jqGrid({
    url:'<?php echo base_url();?>usuarios/paginacion',
    datatype: "json",
    mtype: 'POST',


            colNames:['ACCI&Oacute;N','NOMBRE','USUARIO','EMAIL','ROL'],
                        colModel:[
                        {name:'acciones', index:'acciones', width:100, resizable:false, align:"center", search:false},
                        {name:'nombre', index:'nombre', width:230,resizable:false, sortable:true,search:true,editable:true},
                        {name:'user', index:'user', width:180,resizable:false, sortable:true,search:true,editable:true},
                        {name:'email', index:'email', width:180,resizable:false, sortable:true,search:true,editable:true},
                       {name:'rol', index:'id_roles', width:120,resizable:false, sortable:true,search:true, stype:"select", searchoptions:{"value":":Seleccione;<?php $query=$this->db->query('select * from roles where status = 1 order by nombre_rol'); $q=$query->result_array(); $coma=';'; for($i=0; $i<count($q); $i++) { if($i==count($q)-1){$coma='';} echo $q[$i]['id_roles'].':'.$q[$i]['nombre_rol'].$coma; }?>"}}
                    ],
    pager: jQuery('#paginacion'),
    rownumbers:true,
  rowNum:15,
    rowList:[10,20,30],
    imgpath: '<?php echo base_url();?>img/editar.jpg',
    mtype: "POST",
    sortname: 'id',
    viewrecords: true,
    sortorder: "asc",
  editable: true,
    caption: 'Usuarios',
    multiselect: false,
    height:'auto',
  width:730,
    loadtext: 'Cargando',
    searchurl:'<?php echo base_url();?>usuarios/buscando',
                height:"100%"
        }).navGrid("#paginacion", { edit: false, add: false, search: false, del: false, refresh:true });
        $("#tbl").jqGrid('filterToolbar', { stringResult: true, searchOnEnter: false }) ;
     }
$(document).ready(function(){
	$("#tbl").jqGrid({
    url:'<?php echo base_url();?>usuarios/paginacion',
    datatype: "json",
    mtype: 'POST',


						colNames:['ACCI&Oacute;N','NOMBRE','USUARIO','EMAIL','ROL'],
                        colModel:[
                        {name:'acciones', index:'acciones', width:100, resizable:false, align:"center", search:false},
                        {name:'nombre', index:'nombre', width:230,resizable:false, sortable:true,search:true,editable:true},
                        {name:'user', index:'user', width:180,resizable:false, sortable:true,search:true,editable:true},
                        {name:'email', index:'email', width:180,resizable:false, sortable:true,search:true,editable:true},
					             {name:'rol', index:'id_roles', width:120,resizable:false, sortable:true,search:true, stype:"select", searchoptions:{"value":":Seleccione;<?php $query=$this->db->query('select * from roles where status = 1 order by nombre_rol'); $q=$query->result_array(); $coma=';'; for($i=0; $i<count($q); $i++) { if($i==count($q)-1){$coma='';} echo $q[$i]['id_roles'].':'.$q[$i]['nombre_rol'].$coma; }?>"}}
                    ],
    pager: jQuery('#paginacion'),
    rownumbers:true,
	rowNum:15,
    rowList:[10,20,30],
    imgpath: '<?php echo base_url();?>img/editar.jpg',
    mtype: "POST",
    sortname: 'id',
    viewrecords: true,
    sortorder: "asc",
	editable: true,
    caption: 'Usuarios',
    multiselect: false,
    height:'auto',
	width:730,
    loadtext: 'Cargando',
    searchurl:'<?php echo base_url();?>usuarios/buscando',
                height:"100%"
        }).navGrid("#paginacion", { edit: false, add: false, search: false, del: false, refresh:true });
        $("#tbl").jqGrid('filterToolbar', { stringResult: true, searchOnEnter: false }) ;
   });

///////////////////////////////eventos input//////////////////////////////////////////////////////////
$(function(){
$('ul#icons li').hover(
function() { $(this).addClass('ui-state-hover'); },
function() { $(this).removeClass('ui-state-hover'); }
);
});
function tip (tipo) {
  if (tipo=='email') {
      tipCampos('* El campo <strong>EMAIL</strong> es obligatorio. formato (ejemplo@servidor.com)' ,500,8000,'tip');
  }else if (tipo=='cp') {
       tipCampos('* El campo <strong>CODIGO POSTAL</strong> debe de tener <strong>"5"</strong> dígitos.' ,500,8000,'tip');
  }else if (tipo=='pass') {
      tipCampos('La contraseña debe contener al menos  una letra <strong>MAYUSCULA</strong>, <BR />una letra <strong>MINUSCULA</strong>, <BR />un <strong>NUMERO</strong> ó <strong>CARACTER ESPECIAL.</strong>.<BR /> Su longitud minima es de <strong>8</strong> caracteres y maxima <strong>16</strong> caracteres.' ,500,8000,'tip');
  };
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
function valPass (pass) {
  if (!/(?=^.{8,16}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/.test(pass)) {
    return false;
  }
}
//////////////////////////////////////////////////////////////////////////////
function validarCamposForm1 () {
sucursal=$('#sucursal').val();
roles=$('#rol').val();
nombre_completo=$('#nombre_completo').val();
usuario=$('#usuario').val();
password=$('#password').val();
password2=$('#password2').val();
email=$('#email').val();

if (validarCombo(sucursal)==false) {
    notify('* Debe seleccionar almenos una opcion de la lista <strong>OFICINA</strong>',500,5000,'error');
    $("#sucursal").focus();
    return false;
}else if (validarCombo(roles)==false) {
    notify('* Debe seleccionar almenos una opcion de la lista <strong>ROLES</strong>',500,5000,'error');
    $("#rol").focus();
    return false;

}else if (validarVacio(nombre_completo)==false) {
    notify('* El campo <strong>NOMBRE</strong> no puede estar vacio!!!',500,5000,'error');
    $("#nombre_completo").focus();
    return false;
}else if (validarVacio(usuario)==false) {
    notify('* El campo <strong>USUARIO</strong> no puede estar vacio!!!',500,5000,'error');
    $("#usuario").focus();
    return false;
}else if (valPass(password)==false) {
    notify('* La Contraseña no es segura!!!',500,5000,'error');
    $("#password").focus();
    return false;
}else if (password!=password2) {
    notify('* La contraseña no coincide!!!',500,5000,'error');

    $("#password2").focus();
    return false;
}else if (validarEmail(email)==false) {
    notify('* El campo <strong>EMAIL</strong> es invalido!!!',500,5000,'error');
    $("#email").focus();
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
<td><div onclick="alta()" id="alta"><img src="<?php '.base_url().' ?>img/add_user.png" width="30" height="30"></div>
</td>
<td >&nbsp;</td>
</tr>
</table>



        <table id="tbl"></table>
        <div id="paginacion"> </div>
<div style="display:none" id="dialog-alta" title="Usuarios">
<?php $this->load->view('usuarios/alta');?>
</div>