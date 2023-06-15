//evitar que se pueda enviar el form con enter
document.addEventListener('DOMContentLoaded', function () {
    let formulario = document.getElementById('miFormulario');
  
    formulario.addEventListener('keydown', function (event) {
      if (event.key === 'Enter') {
        event.preventDefault(); // Evitar el envío del formulario
      }
    });
  
    formulario.addEventListener('input', function () {
        validarInputs();
      });
      validarInputs();
  });

    
  function validarInputs() {
    var inputs = document.querySelectorAll('input[type="text"]:not(#imagenOculta):not(#dia0):not(#dia1):not(#dia2):not(#dia3):not(#fecha0):not(#fecha1):not(#fecha2):not(#fecha3):not(#telefonoFijo):not(#telefonoMovil):not(#correoElectronico)');
    var fechaInputs = document.querySelectorAll('input[id^="fecha"]');
    var imagenOculta = document.getElementById('imagenOculta');
    var botonFirma = document.getElementById('firma');

    var camposValidos = Array.from(inputs).every(function(input) {
        return validarCampo(input.id);
    });

    var camposVacios = Array.from(inputs).some(function(input) {
        return input.value.trim() === '';
    });

    var camposFechaLlenos = Array.from(fechaInputs).some(function(input) {
        return input.value.trim() !== '';
    });

    var firmaVacia = imagenOculta.value.trim() === '';

    if (!camposVacios && (camposFechaLlenos || !firmaVacia) && camposValidos) {
        botonFirma.style.display = 'inherit';
    } else {
        botonFirma.style.display = 'none';
    }
}

  //Validar nada mas cargar la pagina
//   validarInputs(); 



//Onblur
function funcionOnBlur() {

    let fechas = [];

    for (let i = 0; i < 4; i++) {
        if (document.getElementById('dia' + i).value != "") {
            fechas.push(document.getElementById('dia' + i).value);
        }
    }
    for (let i = 0; i < fechasEscogidas.length; i++) {
        if (fechasEscogidas[i] != fechas[i]) {
            fechasEscogidas.splice([i], 1);

        }

    }
    borrarFormularioFechas();
    actualizarFormularioFechas(fechasEscogidas);
    formulario(fechasEscogidas);
}
// Tercer modal ,aceptar
document.getElementById("aceptarTercerModal").addEventListener('click', function () {

    window.location.reload();

})


//Validar Formulario

function validarCampo(campo) {
   
     var valor = document.getElementById(campo);


    switch (campo) {
        case 'nombre':
        case 'apellidoUno':
        case 'apellidoDos':
            if (valor.value.trim() === '') {
                valor.classList.remove('is-valid');
                valor.classList.add('is-invalid');
                return false;
            } else {
                valor.classList.remove('is-invalid');
                valor.classList.add('is-valid');
                return true;
            }
            break;
        case 'dni':
            if (!validarDNI_NIE(valor.value)) {
                valor.classList.remove('is-valid');
                valor.classList.add('is-invalid');
                return false;
            } else {
                valor.classList.remove('is-invalid');
                valor.classList.add('is-valid');
                return true;
            }
            break;
        case 'nombreDeVia':
            if (valor.value.trim() === '') {
                valor.classList.remove('is-valid');
                valor.classList.add('is-invalid');
                return false;
            } else {
                valor.classList.remove('is-invalid');
                valor.classList.add('is-valid');
                return true;
            }
            break;
        case 'escalera':
        case 'numero':
        case 'puerta':
        case 'tipoDeVia':
            if (valor.value === '') {
                valor.classList.remove('is-valid');
                valor.classList.add('is-invalid');
                return false;
            } else {
                valor.classList.remove('is-invalid');
                valor.classList.add('is-valid');
                return true;
            }
            break;
        case 'codigoPostal':
            if (isNaN(valor.value) || valor.value.trim() === '' || valor.value.length !== 5) {
                valor.classList.remove('is-valid');
                valor.classList.add('is-invalid');
                return false;
            } else {
                valor.classList.remove('is-invalid');
                valor.classList.add('is-valid');
                return true;
            }
            break;
        case 'provincia':
            if (valor.value.trim() === '') {
                valor.classList.remove('is-valid');
                valor.classList.add('is-invalid');
                return false;
            } else {
                valor.classList.remove('is-invalid');
                valor.classList.add('is-valid');
                return true;
            }
            break;
        case 'localidad':
            if (valor.value.trim() === '') {
                valor.classList.remove('is-valid');
                valor.classList.add('is-invalid');
                return false;
            } else {
                valor.classList.remove('is-invalid');
                valor.classList.add('is-valid');
                return true;
            }
            break;
        case 'telefonoFijo':
        case 'telefonoMovil':
            if (!validarNumeroTelefono(valor.value)) {
                valor.classList.remove('is-valid');
                valor.classList.add('is-invalid');
                // return false;
            } else {
                valor.classList.remove('is-invalid');
                valor.classList.add('is-valid');
                // return true;
            }
            break;
        case 'correoElectronico':
            if (!validarCorreoElectronico(valor.value)) {
                valor.classList.remove('is-valid');
                valor.classList.add('is-invalid');
                // return false;
            } else {
                valor.classList.remove('is-invalid');
                valor.classList.add('is-valid');
                // return true;
            }
            break;
        default:
            return true;
            break;
    }

}
// Validar DNI/NIE
function validarDNI_NIE(valor) {
    valor = valor.toUpperCase();

    // Validar formato
    var dniRegex = /^([XYZ]?\d{7,8})([A-Z])$/;
    if (!dniRegex.test(valor)) {
        return false;
    }

    // Extraer número y letra de control
    var numero = valor.substr(0, valor.length - 1);
    var letraControl = valor.substr(-1);

    // Validar letra de control
    var letrasValidas = "TRWAGMYFPDXBNJZSQVHLCKE";
    var indiceLetra = parseInt(numero) % 23;
    var letraEsperada = letrasValidas.charAt(indiceLetra);

    if (letraEsperada !== letraControl) {
        return false;
    }

    return true;
}
// Validar correo
function validarCorreoElectronico(correo) {
    // Validar formato usando una expresión regular
    var formatoCorreo = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return formatoCorreo.test(correo);
}

//Validar numero de telefono
function validarNumeroTelefono(numero) {
    // Eliminar espacios en blanco y caracteres especiales del número de teléfono
    var numeroLimpio = numero.replace(/\s+/g, '').replace(/[-()+]/g, '');

    // Validar formato usando expresiones regulares
    var formatosValidos = [
        /^(?:\+34|0034|34)?[6-9]\d{8}$/, // Móvil español sin prefijo
        /^(?:\+34|0034|34)?[89]\d{8}$/, // Número fijo español sin prefijo
        /^(?:\+34|0034|34)?[67]\d{8}$/, // Móvil español con prefijo +34
        /^(?:\+34|0034|34)?[7]\d{8}$/, // Móvil español con prefijo 7
        /^(?:\+34|0034|34)?[89]\d{8}$/, // Número fijo español con prefijo +34
        /^(?:\+34|0034|34)?[9]\d{8}$/, // Número fijo español con prefijo 9
    ];

    for (var i = 0; i < formatosValidos.length; i++) {
        if (formatosValidos[i].test(numeroLimpio)) {
            return true;
        }
    }

    return false;
}
