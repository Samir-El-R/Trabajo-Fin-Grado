

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
document.addEventListener("DOMContentLoaded", function() {
  let calendarEl = document.getElementById('calendar');
  let calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: "dayGridMonth",
    locale: "es",
    firstDay: 1,
    headerToolbar: {
      start: 'title',
      end: 'prev,next'
    },
    businessHours: {
      daysOfWeek: [1, 2, 3, 4, 5], // Lunes - Viernes
      eventBackgroundColor: '#000000'
    },
    dateClick: function(info) {
      // mostrar dia seleccionado
      alert("Clicked on: " + formatDate(info.dateStr));

      // colorear el dia seleccionado
      if (info.dayEl.style.backgroundColor == "red") {
        info.dayEl.style.backgroundColor = "transparent"
      } else {

        info.dayEl.style.backgroundColor = "red";
      }

    },

  });

  calendar.render();
});

// dar formato fecha dia/mes/año
function formatDate(date) {
  return date.split("/");
}