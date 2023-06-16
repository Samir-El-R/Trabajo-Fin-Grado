
function cambiarTipo($tipo) {
  if ($tipo) {
     document.getElementById("motivo").style.display = "block";
     document.getElementById("motivo").required = true;
      
    }else{
       document.getElementById("motivo").style.display = "none";
       document.getElementById("motivo").required = false;

    }
}




function mostrarInformacionUsuario(name, date, status, path) {
  document.getElementById("elementName").innerText = name;
  document.getElementById("elementDate").innerText = date;
  document.getElementById("elementStatus").innerText = status;
  document.getElementById("pdfIframe").src = path;
  document.getElementById("path").value = path;
  // document.getElementById("path2").value = path;
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

