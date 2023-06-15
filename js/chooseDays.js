




const MONTH_NAMES = [
  "January",
  "February",
  "March",
  "April",
  "May",
  "June",
  "July",
  "August",
  "September",
  "October",
  "November",
  "December"
];
const DAYS = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];

function app() {
  return {
    month: "",
    year: "",
    no_of_days: [],
    blankdays: [],
    days: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
    events: [],
    event_title: "",
    event_date: "",
    event_theme: "blue",
    themes: [
      {
        value: "blue",
        label: "Blue Theme"
      },
      {
        value: "red",
        label: "Red Theme"
      },
      {
        value: "yellow",
        label: "Yellow Theme"
      },
      {
        value: "green",
        label: "Green Theme"
      },
      {
        value: "purple",
        label: "Purple Theme"
      }
    ],
    openEventModal: false,
    initDate() {
      let today = new Date();
      this.month = today.getMonth();
      this.year = today.getFullYear();
      this.datepickerValue = new Date(
        this.year,
        this.month,
        today.getDate()
      ).toDateString();
    },
    isToday(date) {
      const today = new Date();
      const d = new Date(this.year, this.month, date);
      return today.toDateString() === d.toDateString() ? true : false;
    },
    showEventModal(date) {
      // open the modal
      this.openEventModal = true;
      this.event_date = new Date(this.year, this.month, date).toDateString();
    },
    addEvent() {
      if (this.event_title == "") {
        return;
      }
      this.events.push({
        event_date: this.event_date,
        event_title: this.event_title,
        event_theme: this.event_theme
      });
      console.log(this.events);
      // clear the form data
      this.event_title = "";
      this.event_date = "";
      this.event_theme = "blue";
      //close the modal
      this.openEventModal = false;
    },
    getNoOfDays() {
      let daysInMonth = new Date(this.year, this.month + 1, 0).getDate();
      // find where to start calendar day of week
      let dayOfWeek = new Date(this.year, this.month).getDay();
      let blankdaysArray = [];
      for (var i = 1; i <= dayOfWeek; i++) {
        blankdaysArray.push(i);
      }
      let daysArray = [];
      for (var i = 1; i <= daysInMonth; i++) {
        daysArray.push(i);
      }
      this.blankdays = blankdaysArray;
      this.no_of_days = daysArray;
    }
  };
}
//Variable global de Llas fechas escogidas
var fechasEscogidas = [];
document.addEventListener("DOMContentLoaded", function () {
  const today = new Date();
  const futureDate = new Date(today.getTime() + (90 * 24 * 60 * 60 * 1000));

  let calendarEl = document.getElementById('calendar');
  let calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: "dayGridMonth",
    locale: "es",
    firstDay: 1,
    headerToolbar: {
      start: 'title',
      end: 'today,prev,next'
    },
    contentHeight: 'auto',
    businessHours: {
      daysOfWeek: [1, 2, 3, 4, 5], // Lunes - Viernes
      eventBackgroundColor: '#000000'
    }, validRange: {

      end: futureDate.toISOString().slice(0, 10)
    },

    dateClick: function (info) {
      const today = new Date();
       
      if (info.date < today || info.date.getDay() === 0 || info.date.getDay() === 6) {
        return; // No hacer nada si la fecha es anterior a hoy o es sábado/domingo
      }
      let fechasComprobadas = comprobarFechas(formatDate(info.dateStr), fechasEscogidas);
      if (!fechasComprobadas && fechasEscogidas.length <= 3) {
        
        fechasEscogidas.push(formatDate(info.dateStr));
      } else {
      
        // info.dayEl.style.backgroundColor = "red";
        borrarFecha(formatDate(info.dateStr), fechasEscogidas);

        if (fechasEscogidas.length == 4) {
          document.getElementById("error").style.display = "inherit";
        }
      }
      // colorear el dia seleccionado
      // if (info.dayEl.style.backgroundColor == "red") {
      //   info.dayEl.style.backgroundColor = "transparent";
      // } else {
        info.dayEl.style.backgroundColor = "red";
        setTimeout(function() {
          info.dayEl.style.backgroundColor = "transparent";
        }, 100);
      // }

      actualizarFormularioFechas(fechasEscogidas, info.dayEl.style.backgroundColor);
      if (fechasEscogidas.length >= 1) {
        document.getElementById("botonFormulario").style.display = "inherit";
        formulario(fechasEscogidas);
      } else {
        document.getElementById("botonFormulario").style.display = "none";
      }



    }
  });

// Funcion provisional y a completar por que las propias funciones internas no estan creadas, lo que haria seria al darle submit para mandar los dias a la base de datos comprobaria si ya hay 4 campos a ese usuario y de ser asi aborta el submit


  calendar.render();
});

// dar formato fecha dia/mes/año
function formatDate(date) {
  return date.split("-").reverse().join("/");
}

//comprobar si hay dos fechas iguales
function comprobarFechas(fechaSeleccionada, fechasEscogidas) {
  for (let i = 0; i < fechasEscogidas.length; i++) {
    if (fechaSeleccionada == fechasEscogidas[i]) {
      return true;
    }
  }
  return false;
}
//borrar fecha seleccionada
function borrarFecha(fechaSeleccionada, fechasEscogidas) {
  for (let i = 0; i < fechasEscogidas.length; i++) {
    if (fechaSeleccionada == fechasEscogidas[i]) {
      fechasEscogidas.splice([i], 1);
      borrarFormularioFechas();
    }
  }
}

//Borrar las fechas del formulario
function borrarFormularioFechas() {
  for (let i = 0; i < 4; i++) {
    document.getElementById("dia" + i).value = "";
  }
  
}
//Actualizar el formulario de las fechas
function actualizarFormularioFechas(fechasEscogidas) {
  for (let i = 0; i < fechasEscogidas.length; i++) {

    if (document.getElementById("dia" + i).value == "") {
      document.getElementById("dia" + i).value = fechasEscogidas[i];
    }
  }
}

//esconder el error
document.getElementById("error").addEventListener('click', function () {
  document.getElementById("error").style.display = "none";
})


// Formulario al hacer click en el boton

function formulario(fechasEscogidas) {
//Limpiar formulario
for (let i = 0; i < 4; i++) {
  document.getElementById('fecha'+ i).value = "";
  
}
//Añadir al formulario
    for (let i = 0; i < fechasEscogidas.length; i++) {
      document.getElementById('fecha'+ i).value = fechasEscogidas[i];

    }
  }








  
    
  document.getElementById('miFormulario').addEventListener('submit', function(event) {
    event.preventDefault();
    var elemento = document.getElementById('generarPDF');
    var valorDataBsTarget = '#modal3'; // El valor que deseas asignar
    var valorDataBsTaoggle = 'modal'; // El valor que deseas asignar

    // data-bs-target="#modal3" data-bs-toggle="modal"

    elemento.classList.add('data-bs-target');
    elemento.setAttribute('data-bs-target', valorDataBsTarget);

    elemento.classList.add('data-bs-toggle');
    elemento.setAttribute('data-bs-toggle', valorDataBsTaoggle);
  
    // Aquí puedes agregar la lógica adicional antes de enviar el formulario
    // ...
     let userId = document.getElementById("userId").value;    
     enviarDatos(userId);

    // let datos = enviarDatos(userId);
    // const recordCount = getRecordCount(userId); // Obtiene la cantidad de registros del usuario
    // console.log(recordCount);
    //   if (recordCount > 4) {
    //     // Mostrar un mensaje de error o tomar alguna acción si hay más de 4 registros
    //     console.log("¡Ya se han registrado más de 4 veces!");
    //     return;
    //   }

    //   event.target.submit();
    
    // Ejemplo: Mostrar un mensaje de confirmación
    // const confirmacion = confirm('¿Estás seguro de enviar el formulario?');
    
    // if (confirmacion) {
    //   formulario.submit();
    // } else {
    //   // No se hace nada si el usuario cancela
    // }
  });
  
  // funcion para contar registros por usuario
  
  function enviarDatos(idProfesor) {
    // Crear un objeto XMLHttpRequest
    var xhr = new XMLHttpRequest();
  
    var parametro = idProfesor;
    // Configurar la solicitud
    xhr.open('POST', '../class/recogerRegistros.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  
    var parametroCadena = 'idProfesor=' + encodeURIComponent(parametro);
  
    // Definir la función de callback para manejar la respuesta
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        let respuesta = xhr.responseText;
        if (respuesta) {
          alert('no puedes enviar mas peticiones para los dias libres')
        }
      }
    };
  
    // Enviar la solicitud con el parámetro
    xhr.send(parametroCadena);
  }
  


  // function isset(event) {
  //   event.preventDefault(); // Evita que el formulario se envíe automáticamente
  
  //   // Obtén el ID de usuario del formulario (debe estar en un campo hidden con el nombre "userId")

  //   // Realiza una petición a la base de datos para obtener la cantidad de registros del usuario
  //   // Puedes usar tu propio método para realizar la petición a la base de datos aquí
  //   // Supongamos que tienes una función llamada getRecordCount(userId) que devuelve la cantidad de registros
  
  //   const recordCount = getRecordCount(userId); // Obtiene la cantidad de registros del usuario
  // console.log(recordCount);
  //   if (recordCount > 4) {
  //     // Mostrar un mensaje de error o tomar alguna acción si hay más de 4 registros
  //     console.log("¡Ya se han registrado más de 4 veces!");
  //     return;
  //   }
  
  //   // Si no hay más de 4 registros, continúa con el envío de datos del formulario
  //   event.target.submit();
  // }
  // function enviarDatos() {
  //   var xhr = new XMLHttpRequest();
  
  //   var parametro = 'mi_parametro';
  
  //   xhr.open('POST', 'tu_archivo_php.php', true);
  //   xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  
  //   var parametroCadena = 'parametro=' + encodeURIComponent(parametro);
  
  //   xhr.onreadystatechange = function() {
  //     if (xhr.readyState === XMLHttpRequest.DONE) {
  //       if (xhr.status === 200) {
  //         // La solicitud se completó correctamente
  //         var respuesta = xhr.responseText;
  //         console.log(respuesta);
  //       } else {
  //         // Ocurrió un error durante la solicitud
  //         console.error('Error en la solicitud:', xhr.status);
  //       }
  //     }
  //   };
  
  //   xhr.send(parametroCadena);
  // }