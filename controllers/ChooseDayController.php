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
        // Mostrar la página de calendario
        header('Location: views/chooseDays.php');
    }
}