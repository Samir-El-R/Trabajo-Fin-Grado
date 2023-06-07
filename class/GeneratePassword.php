<?php
function GeneratePassword() {
    $bytes = random_bytes(4);
    $contrasena = base64_encode($bytes);
    // Remover caracteres no deseados
    $contrasena = str_replace(array('/', '+', '=',','), '', $contrasena);
    // Recortar la contraseña a la longitud deseada
    $contrasena = substr($contrasena, 0, 4);
    return $contrasena;
}
