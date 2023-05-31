<?php

$teacherManagement = new TeacherManager($db);
$teachers = $teacherManagement->getAllteachers();

foreach ($teachers as $uteacher) {
    echo "ID: " . $teacher['id'] . "<br>";
    echo "Nombre: " . $teacher['nombre'] . "<br>";
    echo "Email: " . $teacher['correo'] . "<br>";
    echo "Email: " . $teacher['turno'] . "<br>";
    echo "Email: " . $teacher['dedicacion'] . "<br>";
    echo '
    <form action="admin.php" method="post">
        <input type="hidden" name="id_teacher" value="' . $fila['id'] . '">
        <button type="submit" name="delete"> 
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
            <path d="M4 7l16 0" />
            <path d="M10 11l0 6" />
            <path d="M14 11l0 6" />
            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
        </svg> 
        </button>  
    </form> 
    <br>';
    echo "<br>";
}
