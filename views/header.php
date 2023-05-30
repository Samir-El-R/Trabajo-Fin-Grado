<?php
// <a class="nav-link" 
// data-bs-toggle="modal"
// data-bs-target="#iniciarSesion"
// >Iniciar Sesión</a>
echo '

<nav class="navbar navbar-expand-lg bg-dark navbar-dark">
  <div class="container">
    <a class="navbar-brand" href="calendario.php">Jovellanos</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        
        <li class="nav-item logged-in">
        <form action="" method="POST">
          <input type="hidden" name="views" value="true">
          <button class="nav-link button" type="submit" id="toggleView" name="toggleView"> perfil</button>
        </form>
      
        </li>
        <li class="nav-item logged-out">
          <a class="nav-link" id="logout" href="../funcionalidades/cerrar_sesion.php">Cerrar Sesión</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
</div>';
