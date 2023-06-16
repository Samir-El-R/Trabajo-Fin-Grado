const canvas = document.getElementById('signature-canvas');
const context = canvas.getContext('2d');
let isDrawing = false;

canvas.width = 400; // Ancho del lienzo
canvas.height = 200; // Alto del lienzo

canvas.addEventListener('mousedown', startDrawing);
canvas.addEventListener('mousemove', draw);
canvas.addEventListener('mouseup', stopDrawing);
canvas.addEventListener('mouseout', stopDrawing);

document.getElementById('cerrarFirma').addEventListener('click', clearCanvas);
document.getElementById('save-button').addEventListener('click', saveSignature);
document.getElementById('limpiarFirma').addEventListener('click', limpiarFirma);

function startDrawing(e) {
  isDrawing = true;
  draw(e);
}

function draw({ offsetX, offsetY }) {
  if (!isDrawing) return;

  context.lineWidth = 2;
  context.lineCap = 'round';
  context.strokeStyle = '#000';

  context.lineTo(offsetX, offsetY);
  context.stroke();
  context.beginPath();
  context.moveTo(offsetX, offsetY);
}

function stopDrawing() {
  isDrawing = false;
  context.beginPath();
}
//Limpiar el canvas
function limpiarFirma() {
  const canvas = document.getElementById('signature-canvas');
  const context = canvas.getContext('2d');

  // Establecer el tamaño del canvas al tamaño original
  canvas.width = canvas.width;

  // Opcionalmente, puedes establecer un color de fondo
  // context.fillStyle = '#ffffff';
  // context.fillRect(0, 0, canvas.width, canvas.height);
}
//Reiniciar el canvas
function clearCanvas() {
  const canvas = document.getElementById('signature-canvas');
  const context = canvas.getContext('2d');
  
  context.clearRect(0, 0, canvas.width, canvas.height);
}
//Guardar el canvas
function saveSignature() {
  const imagen = canvas.toDataURL('image/png');
  if (imagen) {
    const imagenOculta = document.getElementById('imagenOculta');
    imagenOculta.value = imagen;
    var fechaInputs = document.querySelectorAll('input[id="imagenOculta"]');
    var campoImagen = Array.from(fechaInputs).some(input => input.value.trim() !== '');
    debugger;
    if (campoImagen) {
      document.getElementById("generarPDF").style.display="inherit"
    } else {
      document.getElementById("generarPDF").style.display="none"
    }
   
  }else{
    alert("No se pudo guardar la firma");
  }

}

