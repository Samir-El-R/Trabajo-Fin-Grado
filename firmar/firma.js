const canvas = document.getElementById('signature-canvas');
const context = canvas.getContext('2d');
let isDrawing = false;

canvas.width = 400; // Ancho del lienzo
canvas.height = 200; // Alto del lienzo

canvas.addEventListener('mousedown', startDrawing);
canvas.addEventListener('mousemove', draw);
canvas.addEventListener('mouseup', stopDrawing);
canvas.addEventListener('mouseout', stopDrawing);

// document.getElementById('clear-button').addEventListener('click', clearCanvas);
document.getElementById('save-button').addEventListener('click', saveSignature);

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

function clearCanvas() {
  context.clearRect(0, 0, canvas.width, canvas.height);
}

function saveSignature() {
  const imagen = canvas.toDataURL('image/png');
  if (imagen) {
    const imagenOculta = document.getElementById('imagenOculta');
    imagenOculta.value = imagen;
    document.getElementById("generarPDF").style.display="inherit"
  }else{
    alert("No se pudo guardar la firma");
  }

}

