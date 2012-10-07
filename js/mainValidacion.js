////////////////////////////////validacion//////////////////////////
  function validarFloat (numero) {
    if (!/^([0-9])*[.]?[0-9]*$/.test(numero)) {
      return false;
    }
  }
  function validarNUmero (numero) {
    if (!/^([0-9])*[.]?[0-9]*$/.test(numero)){
      return false;
    }
  }
  function validarEmail(email) {
    if (!/^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.[a-zA-Z]{2,3})$/.test(email)){
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
    function validarCp (cp) {
      if (!/^([1-9]{2}|[0-9][1-9]|[1-9][0-9])[0-9]{3}$/.test(cp)) {
        return false;
      }
    }
    function validarLada (lada) {
      if (!/^[0-9]{2,3}$/.test(lada)){
        return false;
       }
     }
    function validarTelefono (telefono) {
      if (!/^[0-9]{3,4}-? ?[0-9]{4}$/.test(telefono)) {
        return false;
      };
    }
    function validarCelular (celular) {
      if (!/^[0-9]{3}-? ?[0-9]{3}-? ?[0-9]{2}-? ?[0-9]{2}$/.test(celular)) {
        return false;
      };
    }
    function validarRFC(rfc) {
      // validacion 12 o 13 dígitos con homoclave obligatoria
      if (!/^([A-ZÑ\x26]{3,4}([0-9]{2})(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])[A-Z|\d]{3})$/.test(rfc)) {
        return false;

      }
    }
