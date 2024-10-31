<?php

class Home extends Controller
{
    public function index()
    {
        $model = new Model;
        $arr['company'] = "OrelIT";

        $result = $model->where($arr);

        show($result);

        $this->view('home');
    }
}
