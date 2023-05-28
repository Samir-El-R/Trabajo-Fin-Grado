<?php
function importarCSV($nombreArchivo, $nombreTabla)
{
    // Configuración de la base de datos
    $servidor = "localhost";
    $usuario = "root";
    $password = "";
    $basedatos = "app";

    // Conexión a la base de datos
    $conexion = new mysqli($servidor, $usuario, $password, $basedatos);

    // Verificar si hay errores de conexión
    if ($conexion->connect_error) {
        die("Error en la conexión a la base de datos: " . $conexion->connect_error);
    }

    // Abrir el archivo CSV
    $archivo = fopen($nombreArchivo, "r");

    // Verificar si se pudo abrir el archivo
    if ($archivo === false) {
        die("Error al abrir el archivo CSV");
    }

    // Leer y procesar cada línea del archivo CSV
    while (($datos = fgetcsv($archivo, 1000, ",")) !== false) {
        // Escapar los valores para prevenir inyección de SQL
        $valores = array_map(array($conexion, 'real_escape_string'), $datos);

        // Construir la consulta SQL
        $consulta = "INSERT INTO $nombreTabla (nombre, turno, dedicacion, correo, contrasena) VALUES ('$valores[0]', '$valores[1]', '$valores[2]', '$valores[3]', '$valores[4]')";

        // Ejecutar la consulta SQL
        if (!$conexion->query($consulta)) {
            echo "Error al ejecutar la consulta: " . $conexion->error;
        }
    }

    // Cerrar el archivo CSV
    fclose($archivo);

    // Cerrar la conexión a la base de datos
    $conexion->close();
}
?>