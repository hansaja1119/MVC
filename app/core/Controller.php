<?php

trait Controller
{

    public function view($name, $data = [])
    {
        if (!empty($data)) {
            extract($data);
        }

        $filename = "../app/views/" . $name . ".view.php";
        if (file_exists($filename)) {
            require_once($filename);
        } else {
            require_once("../app/views/404.view.php");
        }
    }
}
