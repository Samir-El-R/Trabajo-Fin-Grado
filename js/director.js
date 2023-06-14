function mostrarInformacionUsuario(nombre, fecha, descripcion, motivo) {
  // Mostrar la sección de información del usuario
  // document.querySelector(".vacaciones-info").style.display = "block";
  
  // Actualizar los datos del usuario
    document.getElementById('usuario-nombre').textContent = nombre;
    document.getElementById('usuario-fecha').textContent = fecha;
    document.getElementById('usuario-descripcion').textContent = descripcion;
    document.getElementById('usuario-motivo').textContent = motivo;
  }