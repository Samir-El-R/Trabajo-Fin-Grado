<?php
// Archivo AdminController.php

class AdminController
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function showAndHiddenViews()
    {
        if ($_SESSION['show']) {
            
            $this->showManageTeacherManual();
            
        } else {
            
            $this->showManageTeacherAuto();
            
        }

    }
    public function showManageTeacherManual()
    {
        // Mostrar formulario de inicio de sesión
        require_once 'views/manageTeacherManual.php';
    }
    public function showManageTeacherAuto()
    {
        // Mostrar formulario de inicio de sesión
        require_once 'views/manageTeacherAuto.php';
    }
}