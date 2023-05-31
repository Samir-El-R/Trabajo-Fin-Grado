<?php
// require('config/connection.php');
$teacherManagement = new TeacherManager();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="libraries/bootstrap/css/bootstrap.min.css " rel="stylesheet" />
    <link href="css/selectTeachers.css" rel="stylesheet" />
    <script src="libraries/bootstrap/js/bootstrap.bundle.min.js"></script>
    <title>Gesionar Profesores</title>
</head>

<body>

    <div class="container my-5">
        <form action="" method="POST" class="d-md-flex d-sm-block justify-content-between">
            <input type="hidden" name="command" value="select-orders">
            <h1 class="h5 align-self-center col-3">Search Order</h1>
            <div class="btn-group align-self-center col-12 col-sm-12 col-md-8 col-lg-6">
                <select name="searchType" class="btn btn-outline-dark col-3 col-sm-3">
                    <option value="id">Profesor ID</option>
                    <option value="nombre">Nombre</option>
                    <option value="correo">Correo</option>
                    <option value="turno">Turno</option>
                    <option value="dedicacion">Dedicacion</option>
                </select>
                <input type="search" name="searchBy" class="col-6 col-sm-6">
                <input type="submit" value="Search" class="btn btn-outline-dark col-3 col-sm-3">
            </div>
        </form>
        <div class="d-md-flex d-none justify-content-md-between justify-content-sm-center align-content-center border-bottom border-2 my-2 bg-dark text-light p-3 rounded-3">
            <div class="col-2 text-sm-center text-md-start align-self-center">
                <h1 class="h5 fw-bold">Profesor ID</h1>
            </div>
            <div class="col-2 text-sm-center text-md-start align-self-center">
                <h1 class="h5 fw-bold">Nombre</h1>
            </div>
            <div class="col-2 align-self-center">
                <h1 class="h5 fw-bold">Correo</h1>
            </div>
            <div class="col-1 align-self-center">
                <h1 class="h5 fw-bold">Turno</h1>
            </div>
            <div class="col-1 align-self-center">
                <h1 class="h5 fw-bold">Roll</h1>
            </div>
            <div class="col-2 align-self-center">
                <h1 class="h5 fw-bold">Dedicacion</h1>
            </div>
            <div class="col-1 align-self-center">
                <h1 class="h5 fw-bold">eleminar</h1>
            </div>

        </div>
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['searchType']) && isset($_POST['searchBy'])) {
            $searchType = $_POST['searchType'];
            echo $searchType;
            $searchBy = $_POST['searchBy'];

            $sql = "SELECT * FROM profesores WHERE ";
            switch ($searchType):
                case "correo":
                    $sql .= "correo LIKE '%$searchBy%'";
                    break;
                case "nombre":
                    $sql .= "nombre LIKE '%$searchBy%'";
                    break;
                case "id":
                    $sql .= "id LIKE '%$searchBy%'";
                    break;
                case "turno":
                    $sql .= "turno LIKE '%$searchBy%'";
                    break;
                case "dedicacion":
                    $sql .= "dedicacion LIKE '%$searchBy%'";
                    break;
                default:
                    echo "Parámetro de búsqueda inválido";
                    exit();
            endswitch;

            $teachers = $teacherManagement->getTeachers($sql);
            foreach ($teachers as $teacher) { ?>
                <div class="d-md-flex d-sm-block justify-content-md-between justify-content-sm-center text-center border-bottom border-2 my-2 bg-light p-2 rounded-3">
                    <div class="col-md-2 text-sm-center text-md-start align-self-center my-2">
                        <h1 class="h6"> <?php echo $teacher['id']; ?></h1>
                    </div>
                    <div class="col-md-2 text-sm-center text-md-start align-self-center my-2">
                        <h1 class="h6"> <?php echo $teacher['nombre']; ?></h1>
                    </div>
                    <div class="col-md-2 text-sm-center text-md-start align-self-center my-2">
                        <h1 class="h6"> <?php echo $teacher['correo']; ?></h1>
                    </div>
                    <div class="col-md-1 text-sm-center text-md-start align-self-center my-2">
                        <h1 class="h6"> <?php echo $teacher['turno']; ?></h1>
                    </div>
                    <div class="col-md-1 text-sm-center text-md-start align-self-center my-2">
                        <h1 class="h6"> <?php echo $teacher['roles']; ?></h1>
                    </div>
                    <div class="col-md-2 text-sm-center text-md-start align-self-center my-2">
                        <h1 class="h6"> <?php echo $teacher['dedicacion']; ?></h1>
                    </div>
                    <div class="col-md-1 text-sm-center text-md-start align-self-center my-2">
                        <form action="admin.php" method="post">
                            <input type="hidden" name="id_teacher" value="<?php $teacher['id'] ?>">
                            <button type="submit" class="btn btn-outline-dark w-100" name="delete">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M4 7l16 0" />
                                    <path d="M10 11l0 6" />
                                    <path d="M14 11l0 6" />
                                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            <?php
            }
        } else {
            $teachers = $teacherManagement->getAllTeachers();

            foreach ($teachers as $teacher) { ?>
                <div class="d-md-flex d-sm-block justify-content-md-between justify-content-sm-center text-center border-bottom border-2 my-2 bg-light p-2 rounded-3">
                    <div class="col-md-2 text-sm-center text-md-start align-self-center my-2">
                        <h1 class="h6"> <?php echo $teacher['id']; ?></h1>
                    </div>
                    <div class="col-md-2 text-sm-center text-md-start align-self-center my-2">
                        <h1 class="h6"> <?php echo $teacher['nombre']; ?></h1>
                    </div>
                    <div class="col-md-2 text-sm-center text-md-start align-self-center my-2">
                        <h1 class="h6"> <?php echo $teacher['correo']; ?></h1>
                    </div>
                    <div class="col-md-1 text-sm-center text-md-start align-self-center my-2">
                        <h1 class="h6"> <?php echo $teacher['turno']; ?></h1>
                    </div>
                    <div class="col-md-1 text-sm-center text-md-start align-self-center my-2">
                        <h1 class="h6"> <?php echo $teacher['roles']; ?></h1>
                    </div>
                    <div class="col-md-2 text-sm-center text-md-start align-self-center my-2">
                        <h1 class="h6"> <?php echo $teacher['dedicacion']; ?></h1>
                    </div>
                    <div class="col-md-1 text-sm-center text-md-start align-self-center my-2">
                        <form action="admin.php" method="post">
                            <input type="hidden" name="id_teacher" value="<?php $teacher['id'] ?>">
                            <button type="submit" class="btn btn-outline-dark w-100" name="delete">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M4 7l16 0" />
                                    <path d="M10 11l0 6" />
                                    <path d="M14 11l0 6" />
                                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                </svg>
                            </button>
                        </form>
                    </div>
                    <!-- <div class="col-md-2 text-sm-center text-md-start align-self-center my-2">
                    </div> -->
                </div>
        <?php
            }
        } ?>

    </div>
</body>

</html>