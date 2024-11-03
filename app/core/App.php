<?php

class App
{
    private $controller = 'Home';
    private $method = 'index';

    private function splitURL()
    {
        $URL = $_GET['url'] ?? 'home';
        $URL = explode('/', trim($URL, "/"));
        return $URL;
    }

    public function loadController()
    {
        $URL = $this->splitURL();

        // Determine if the URL contains 'admin'
        $isAdmin = false;
        if (!empty($URL[0]) && strtolower($URL[0]) === 'admin') {
            $isAdmin = true;
            unset($URL[0]);
            $URL = array_values($URL); // Reindex the array
        }

        // Check if the controller exists and select it
        $controllerPath = $isAdmin ? "../app/controllers/admin/" : "../app/controllers/user/";
        $filename = $controllerPath . ucfirst($URL[0] ?? 'Home') . ".php";
        if (file_exists($filename)) {
            require_once($filename);
            $this->controller = ucfirst($URL[0] ?? 'Home');
            unset($URL[0]);
        } else {
            require_once("../app/controllers/_404.php");
            $this->controller = '_404';
        }

        $controller = new $this->controller;

        // Check if the method exists and select it
        if (!empty($URL[1])) {
            if (method_exists($controller, $URL[1])) {
                $this->method = $URL[1];
                unset($URL[1]);
            }
        }

        call_user_func_array([$controller, $this->method], $URL);
    }
}
