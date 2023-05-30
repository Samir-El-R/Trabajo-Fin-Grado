<?php
// Archivo AppController.php

class AppController
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function showAndHiddenViews()
    {
        if ($_SESSION['show']) {
            $profileController = new ProfileController($this->db);
            $profileController->showProfile();

        } else {
            $ChooseDayController = new ChooseDayController($this->db);
            $ChooseDayController->showChooseDay();
            
        }

    }
}
