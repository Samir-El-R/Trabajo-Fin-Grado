function mostrarInformacionUsuario(nombre, fecha, descripcion, motivo) {
  // Mostrar la sección de información del usuario
  // document.querySelector(".vacaciones-info").style.display = "block";
  
  // Actualizar los datos del usuario
    document.getElementById('elementName').textContent = nombre;
    document.getElementById('uelementDate').textContent = fecha;
    document.getElementById('elementStatus').textContent = descripcion;
    document.getElementById('usuario-motivo').textContent = motivo;
  }
  function setModalData(name, date, status) {
    document.getElementById('elementName').textContent = name;
    document.getElementById('elementDate').textContent = date;
    document.getElementById('elementStatus').textContent = status;
  }