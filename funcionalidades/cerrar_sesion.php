<?php
session_start();
if (session_status() === PHP_SESSION_ACTIVE) {
    // Destruir la sesión
    session_destroy();
    // Redireccionar al inicio o a otra página después de cerrar sesión
    header("Location: ../index.php");
    exit();
 } else {
    // La sesión no está activa
    echo "Eror, no hay ninguna sesión activa.";
 }
