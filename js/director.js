function mostrarInformacionUsuario(name, date, status, path) {

  document.getElementById('elementName').innerText = name;
  document.getElementById('elementDate').innerText = date;
  document.getElementById('elementStatus').innerText = status;
  document.getElementById('pdfIframe').src = "pdfDiasLibres/"+path;
  document.getElementById('path1').value = "pdfDiasLibres/"+path;
  document.getElementById('path2').value = "pdfDiasLibres/"+path;

}
function mostrarPDF() {
  document.getElementById('pdfIframe').style.display = 'block';
}