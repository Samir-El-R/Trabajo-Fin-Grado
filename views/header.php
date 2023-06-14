<?php

echo '

<nav class="navbar navbar-expand-lg bg-dark navbar-dark">
  <div class="container">
    <a class="navbar-brand" href="'.$indexPage.'">Jovellanos</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item logged-in">
        <form action="'.$indexPage.'" method="POST">
          <input type="hidden" name="views" value="true">
          <button class="nav-link button" type="submit" id="toggleView" name="toggleView">'.$nameView.'</button>
        </form>
        </li>
        <li class="nav-item logged-out">
            <form action="'.$indexPage.'" method="POST">
              <input type="hidden" name="logout" value="true">
              <input class="nav-link button" id="logout" type="submit" value="Cerrar Sesión">used to access global
            </form>
        </li>
      </ul>
    </div>
  </div>
</nav>
</div>
';
