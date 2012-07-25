function notify(msg,speed,fadeSpeed,type){

       //Borra cualquier mensaje existente
       $('.notify').remove();
       $('.tipCampos').remove();

       //Si el temporizador para hacer desaparecer el mensaje está
       //activo, lo desactivamos.
       if (typeof hiden != "undefined"){
           clearTimeout(hiden);
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
       hiden = setTimeout(function(){

           $('.notify').animate({top:-10,opacity:'toggle'}, speed);

       }, fadeSpeed);


   }
    function tipCampos(msg,speed,fadeSpeed,type){

       //Borra cualquier mensaje existente
       $('.tipCampos').remove();

       //Si el temporizador para hacer desaparecer el mensaje está
       //activo, lo desactivamos.
       if (typeof fade != "undefined"){
           clearTimeout(fade);
       }

       //Creamos la notificación con la clase (type) y el texto (msg)
       $('#footer').append('<div class="tipCampos '+type+'" style="display:none;position:fixed;right: 10px;"><p>'+msg+'</p></div>');

       //Calculamos la altura de la notificación.
       notifyHeight = $('.tipCampos').outerHeight();

       //Creamos la animación en la notificación con la velocidad
       //que pasamos por el parametro speed
       $('.tipCampos').css('footer',-notifyHeight).animate({bottom:45,opacity:'toggle'},speed);

       //Creamos el temporizador para hacer desaparecer la notificación
       //con el tiempo almacenado en el parametro fadeSpeed
       hiden = setTimeout(function(){

           $('.tipCampos').animate({bottom:0,opacity:'toggle'}, speed);

       }, fadeSpeed);


   }