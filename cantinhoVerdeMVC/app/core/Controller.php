<?php

class Controller
{
    public function model($model)
    {
        require_once '../app/models/' . $model . '.php';
        return new $model;
    }

    public function view($view, $data = [])
    {
        $viewFile = '../app/views/' . $view . '.php';
        if (!file_exists($viewFile)) {
            throw new Exception("View {$view} não encontrada");
        }

        extract($data);
        require_once $viewFile;
    }
}
