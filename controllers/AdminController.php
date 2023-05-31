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
        $this->showSelectTeachers();

        // if ($_SESSION['show']) {
            

        //     $profileController = new ProfileController($this->db);
        //     $profileController->showProfile();
            
        // } else {

        //     $ChooseDayController = new ChooseDayController($this->db);
        //     $ChooseDayController->showChooseDay();
            
        // }

    }
    public function showSelectTeachers()
    {
        // Mostrar formulario de inicio de sesión
        require_once 'views/selectTeachers.php';
    }
}
