

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
document.addEventListener("DOMContentLoaded", function () {
  var fechasEscogidas = [];
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
    },  validRange: {
  
      end: futureDate.toISOString().slice(0, 10)
    },

    dateClick: function (info) {
      const today = new Date();
      if (info.date < today || info.date.getDay() === 0 || info.date.getDay() === 6) {
        return; // No hacer nada si la fecha es anterior a hoy o es sábado/domingo
      }
      let fechasComprobadas = comprobarFechas(info.dateStr, fechasEscogidas);
      if (!fechasComprobadas && fechasEscogidas.length <= 3) {
        fechasEscogidas.push(info.dateStr);
      } else {
        info.dayEl.style.backgroundColor = "red";

        borrarFecha(info.dateStr, fechasEscogidas);
        // diasMayorACuatro(info.dateStr,fechasEscogidas);
        if (fechasEscogidas.length == 4) {
          document.getElementById("error").style.display = "inherit";
        }
      }
      // colorear el dia seleccionado
      if (info.dayEl.style.backgroundColor == "red") {
        info.dayEl.style.backgroundColor = "transparent";
      } else {
        info.dayEl.style.backgroundColor = "red";
      }

      actualizarFormularioFechas(fechasEscogidas);

      console.log(fechasEscogidas);

    }
  });

  calendar.render();
});

// dar formato fecha dia/mes/año
function formatDate(date) {
  return date.split("/");
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
//Cuando el array es mayor a 4 (maximo de dias disponibles)
function diasMayorACuatro(fechaSeleccionada, fechasEscogidas) {

  if (fechasEscogidas.length == 4) {

    fechasEscogidas.shift();
    fechasEscogidas.push(fechaSeleccionada);

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
document.getElementById("error").addEventListener('click',function() {
  document.getElementById("error").style.display="none";
})
