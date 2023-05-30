<?php
// Archivo ChooseDayController.php

class ChooseDayController
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function showChooseDay()
    {
        // Obtener el usuario actualmente autenticado
        $authController = new AuthController($this->db);
        $user = $authController->getCurrentUser();

        // Mostrar la página de perfil
        require_once 'views/chooseDays.php';
    }
}
