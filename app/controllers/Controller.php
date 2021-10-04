<?php

namespace Controllers;

class Controller
{
    public $twig = null;

    public function __construct()
    {
        // Create Twig
        $loader = new \Twig\Loader\FilesystemLoader('./resources/views');
        $this->twig = new \Twig\Environment($loader, ['cache' => false]);
    }
}