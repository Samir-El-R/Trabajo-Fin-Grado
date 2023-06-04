<?php

// Función para conectar a la base de datos
function connectToDatabase() {
    $servername = "nombre_servidor";
    $username = "nombre_usuario";
    $password = "contraseña";
    $dbname = "nombre_base_de_datos";

    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    return $conn;
}

// Función para registrar usuarios desde un archivo CSV
function registerUsersFromCSV($csvFile) {
    // Conectar a la base de datos
    $conn = connectToDatabase();

    // Abrir el archivo CSV
    $file = fopen($csvFile, 'r');

    // Leer los datos del archivo CSV
    while (($data = fgetcsv($file)) !== false) {
        // Obtener los valores de cada columna
        $nombre = $data[0];
        $apellido = $data[1];
        $email = $data[2];
        $password = $data[3];

        // Insertar el usuario en la base de datos
        $sql = "INSERT INTO usuarios (nombre, apellido, email, password) VALUES ('$nombre', '$apellido', '$email', '$password')";

        if ($conn->query($sql) === true) {
            echo "Usuario registrado: $nombre $apellido<br>";
        } else {
            echo "Error al registrar el usuario: " . $conn->error . "<br>";
        }
    }

    // Cerrar el archivo CSV
    fclose($file);

    // Cerrar la conexión a la base de datos
    $conn->close();
}

// Uso de la función de registro de usuarios desde CSV
$csvFile = 'ruta_del_archivo.csv'; // Reemplaza con la ruta de tu archivo CSV
registerUsersFromCSV($csvFile);

?>
