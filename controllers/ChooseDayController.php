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
        // Mostrar la página de perfil
        header('Location: views/chooseDays.php');
    }
}