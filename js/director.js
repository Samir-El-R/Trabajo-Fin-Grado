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
});


function validarInputs() {
  let motivo = document.getElementById('motivo');
  let imagenOculta = document.getElementById('imagenOculta');
  let botonFirma = document.getElementById('firma');

  let camposValidos = validarCampo(motivo.id);

  let camposVacios = motivo.value.trim() === "";

  let firmaVacia = imagenOculta.value.trim() === '';

  if (!camposVacios && firmaVacia && camposValidos) {
    botonFirma.style.display = 'inherit';
  } else {
    botonFirma.style.display = 'none';
  }
}

function cambiarTipo($tipo) {
  if ($tipo) {
    document.getElementById("motivo").style.display = "block";
    document.getElementById("motivo").required = true;
    document.getElementById('firma').style.display = 'none';
    document.getElementById('contenedorDeMotivo').style.display = 'inherit';
    document.getElementById('modal1Label1').style.display = "inherit";
    document.getElementById('modal1Label2').style.display = "none";

  } else {
    document.getElementById("motivo").style.display = "none";
    document.getElementById("motivo").required = false;
    document.getElementById('firma').style.display = 'inherit';
    document.getElementById('contenedorDeMotivo').style.display = 'none';
    document.getElementById('modal1Label1').style.display = "none";
    document.getElementById('modal1Label2').style.display = "inherit";
  }
}




function mostrarInformacionUsuario(name, date, status, path, idProfesor,mail) {
  document.getElementById("elementName").innerText = name;
  document.getElementById("idProfesor").value = idProfesor;
  document.getElementById("elementDate").innerText = date;
  document.getElementById("elementStatus").innerText = status;
  if (status != 'Pendiente') {

    document.getElementById('aceptar_Solicitud').style.display = "none";
    document.getElementById('rechazar_Solicitud').style.display = "none";
  } else {
    document.getElementById('aceptar_Solicitud').style.display = "block";
    document.getElementById('rechazar_Solicitud').style.display = "block";

  }

  document.getElementById("pdfIframe").src = path;
  document.getElementById("path").value = path;
  document.getElementById("correo").value = mail;
  document.getElementById("fecha_profesor").value = date;
  document.getElementById("nombre_profesor").value = name;
}
let bool = true;
function mostrarPDF() {
  if (bool) {
    document.getElementById("pdfIframe").style.display = "block";
  } else {
    document.getElementById("pdfIframe").style.display = "none";
  }
  bool = !bool;
}
function cerrarPDF() {
  document.getElementById("pdfIframe").style.display = "none";
}

function validarCampo(campo) {

  let valor = document.getElementById(campo);

  if (valor.value.length > 10) {
    return true
  } else {
    return false

  }

}