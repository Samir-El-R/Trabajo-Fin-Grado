<?php
include 'includes/header.php';
?>



      <main class="pub_main">>
        <div class="pub_general">
          <form class="pub_form" action="" method="post">
          <div class="pub_tipo_casa">
            <h2>Tipo de casa</h2>
            <div class="pub_iconos_casa">
              <label for="pub_casa">
                <input type="radio" name="opciones_casa" class="pub_casa" id="pub_casa">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-home-2 svg_casa" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                  <polyline points="5 12 3 12 12 3 21 12 19 12" />
                  <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                  <rect x="10" y="12" width="4" height="4" />
                </svg>
              </label>



              <label for="pub_piso">
                <input type="radio" name="opciones_casa" class="pub_piso" id="pub_piso">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-building-community svg_piso" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                  <path d="M8 9l5 5v7h-5v-4m0 4h-5v-7l5 -5m1 1v-6a1 1 0 0 1 1 -1h10a1 1 0 0 1 1 1v17h-8" />
                  <line x1="13" y1="7" x2="13" y2="7.01" />
                  <line x1="17" y1="7" x2="17" y2="7.01" />
                  <line x1="17" y1="11" x2="17" y2="11.01" />
                  <line x1="17" y1="15" x2="17" y2="15.01" />
                </svg>
              </label>
            </div>
            <div class="pub_opciones_casa">
              <input type="radio" name="opciones_casa" id="">
              <input type="radio" name="opciones_casa" id="">
            </div>
          </div>


          <div class="modalidades" >
            <h2>Tipo de alquiler</h2>
            <label for="alquilar"> Alquilar
              <input type="checkbox" name="" id="">
            </label>




            </form>
          </div>
          
              
   






        </div>
      </main>

      <?php
include 'includes/footer.php';
?>