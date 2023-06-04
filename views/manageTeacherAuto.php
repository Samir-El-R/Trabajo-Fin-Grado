<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="classviewport" content="width=device-width, initial-scale=1.0">
    <link href="../libraries/bootstrap/css/bootstrap.min.css " rel="stylesheet" />
    <link href="../css/manageTeacherAuto.css" rel="stylesheet" />
    <script src="../libraries/bootstrap/js/bootstrap.bundle.min.js"></script>
    <title>Gestion CSV</title>
</head>

<body>
    <?php
    $nameView = "Gestion Manual";
    $indexPage="admin.php";
    include("../views/header.php");
    ?>

    <form action="../admin.php" method="POST" enctype="multipart/form-data">
        <div class="container_drop">
            <div class="card">
                <h3>Carga el CSV</h3>
                <div class="drop_box">
                    <header>
                        <h4>Seleccio</h4>
                    </header>
                    <p>Solo Se Soportan archivos: .CSV </p>
                    <input type="file" hidden accept=".csv" id="fileID" style="display:none;">
                    <button class="btn">Pulas Aquí para selecionar CSV</button>
                </div>

            </div>

        </div>
    </form>

    <?php
    include("../views/footer.php")
    ?>
    <script src="../js/app.js"></script>
</body>

</html>