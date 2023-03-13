<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Security-Policy" content="font-src data:" />
    <title>IES GM Jovellanos</title>
    <link rel="apple-touch-icon" href="http://secretaria.iesjovellanos.org/wp-content/uploads/2022/03/cropped-LF75-180x180.png">
    <link rel="icon" href="http://secretaria.iesjovellanos.org/wp-content/uploads/2022/03/cropped-LF75-32x32.png" sizes="32x32">
    <link href="./css/bootstrap.min.css" rel="stylesheet" />
    <script src="./js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="cssPropio.css" />
    <script src="js.js"></script>
    <script src="./fullcalendar-6.1.4/dist/index.global.js"></script>
    <script>
      document.addEventListener("DOMContentLoaded", function () {
        let calendarEl = document.getElementById('calendar');
        let calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: "dayGridMonth",
          locale:"es",
          firstDay: 1,
          headerToolbar: {
            start: 'title',
            end:'prev,next'
          },
          businessHours: {
            daysOfWeek: [ 1, 2, 3, 4 ,5], // Lunes - Viernes
           eventBackgroundColor: '#000000'
          },
          dateClick: function (info) {
            // mostrar dia seleccionado
            alert("Clicked on: " +  formatDate(info.dateStr));
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
      return date.split("-").reverse();
  }
  </script>
  </head>

  <body>
    <?php
    require("./componentes/header.php")
    ?>

<div class="d-flex justify-content-center ">

  <div id="calendar" class="w-50 h-75" ></div>

</div>
    <?php
    require("./componentes/footer.php")
    ?>
  </body>
</html>
