
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/loginStyle.css">
    <title>TeachOff</title>
</head>
<body>
    <h1>Deja de enseñar y empieza a disfrutar</h1>
    <div class="login-box">
        <h2>Inicio De Sesión</h2>
        <form action="index.php" method="POST">
        <input type="hidden" name="login" value="true">
            <div class="user-box">
                <input type="text" name="email" id="email" required="true">
                <label>Correo</label>
            </div>
            <div class="user-box">
                <input type="password" name="password" id="password" required="true">
                <label>Contraseña</label>
            </div>

            <a href="">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <input type="submit" required name="submit">
            </a>
        </form>
    </div>
</body>

</html>