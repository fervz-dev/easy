/**
 * Notificaciones animadas con jQuery
 * @autor Osiris Magro
 * @fecha 05/03/2010
 * Ejemplos y documentación:
 *  http://innominepixel.wordpress.com/2010/03/05/tutorial-notificaciones-animadas-con-jquery/
 *
 * Bajo licencia GPL
 * http://www.gnu.org/licenses/gpl.html
**/

$(document).ready(function(){

   //Función que crea las notificaciones
   function notify(msg,speed,fadeSpeed,type){

       //Borra cualquier mensaje existente
       $('.notify').remove();

       //Si el temporizador para hacer desaparecer el mensaje está
       //activo, lo desactivamos.
       if (typeof fade != "undefined"){
           clearTimeout(fade);
       }

       //Creamos la notificación con la clase (type) y el texto (msg)
       $('body').append('<div class="notify '+type+'" style="display:none;position:fixed;right: 10px;"><p>'+msg+'</p></div>');

       //Calculamos la altura de la notificación.
       notifyHeight = $('.notify').outerHeight();

       //Creamos la animación en la notificación con la velocidad
       //que pasamos por el parametro speed
       $('.notify').css('top',-notifyHeight).animate({top:30,opacity:'toggle'},speed);

       //Creamos el temporizador para hacer desaparecer la notificación
       //con el tiempo almacenado en el parametro fadeSpeed
       fade = setTimeout(function(){

           $('.notify').animate({top:notifyHeight+10,opacity:'toggle'}, speed);

       }, fadeSpeed);

   }

/*function mensajes (textMess,speed,fadeSpeed,type) {
  
  if (type=='error') {
    
    notify(textMess,speed,fadeSpeed,type);

  }else if (type=='aviso') {
    
    notify(textMess,speed,fadeSpeed,type);

  }else if (type=='precaucion') {
    
    notify(textMess,speed,fadeSpeed,type);
  }
}
   //Crea un mensaje normal
   $('#standard').click(function(){
        
        return false;
   });

   //Crea un mensaje de error
   $('#error').click(function(){
        notify('Ha ocurrido un error inesperado',500,5000,'error');
        return false;
   });*/

  
});