function mostrarInformacionUsuario(nombre, fecha, descripcion, motivo) {
    // Actualiza la información del usuario en la sección de información
    document.getElementById('usuario-nombre').textContent = nombre;
    document.getElementById('usuario-fecha').textContent = fecha;
    document.getElementById('usuario-descripcion').textContent = descripcion;
    document.getElementById('usuario-motivo').textContent = motivo;
  }
  