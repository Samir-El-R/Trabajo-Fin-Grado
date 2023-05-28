<?php
// <a class="nav-link" 
// data-bs-toggle="modal"
// data-bs-target="#iniciarSesion"
// >Iniciar Sesión</a>
echo'

        <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
            <div class="container">
              <a class="navbar-brand" href="http://secretaria.iesjovellanos.org/">Jovellanos</a>
              <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav"
                aria-controls="navbarNav"
                aria-expanded="false"
                aria-label="Toggle navigation"
              >
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                  <li class="nav-item logged-out">
  



                  </li>
                  <li class="nav-item logged-in">
                  <a href=""class="nav-link"
                  id="perfil"
                  >Perfil</a>
                </li>
                  <li class="nav-item logged-in">
                    <a class="nav-link"
                    id="logout"
                    >Cerrar Sesión</a>
                  </li>
                </ul>
              </div>
            </div>
          </nav>

           <!--Modal de inicio de sesion -->
          <div
          class="modal fade"
          id="iniciarSesion"
          tabindex="-1"
          aria-labelledby="iniciarSesionLabel"
          aria-hidden="true"
        >
          <div class="modal-dialog">
            <div class="modal-content text-white bg-dark">
              <div class="modal-header">
                <h5 class="modal-title fs-5 " id="iniciarSesionLabel">
                  Iniciar Sesión
                </h5>
                <button
                  type="button"
                  class="btn-close btn-close-white"
                  data-bs-dismiss="modal"
                  aria-label="Close"
                ></button>
              </div>
              <div class="modal-body">
                <form id="singin-form" action="">
                  <label  for="usuario">Usuario:</label>
                  <input
                    type="text"
                    id="iniciarSesionUsuario"
                    class="form-control mb-3"
                    placeholder="Usuario"
                  />
                  <label  for="password">Contraseña:</label>
                  <input
                    type="password"
                    id="iniciarSesionContrasena"
                    class="form-control mb-3"
                    placeholder="********"
                  />
                  <button type="submit" class="btn btn-primary">
                    Iniciar Sesión
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>';


?>







        
